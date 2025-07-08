<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get precise date ranges with timezone consistency
        $now = Carbon::now();
        $today = $now->copy()->startOfDay();
        $tomorrow = $today->copy()->addDay();
        $yesterday = $today->copy()->subDay();
        $dayBeforeYesterday = $yesterday->copy()->subDay();

        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        // Basic Statistics - Use more specific queries
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount') ?? 0;
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();

        // Today's Statistics - Fixed date range
        $todayOrders = Order::whereBetween('created_at', [$today, $tomorrow])->count();
        $todayRevenue = Order::whereBetween('created_at', [$today, $tomorrow])
            ->where('payment_status', 'paid')
            ->sum('total_amount') ?? 0;

        // Yesterday's Statistics - Fixed date range
        $yesterdayOrders = Order::whereBetween('created_at', [$yesterday, $today])->count();
        $yesterdayRevenue = Order::whereBetween('created_at', [$yesterday, $today])
            ->where('payment_status', 'paid')
            ->sum('total_amount') ?? 0;

        // Current Month Statistics - More precise calculation
        $currentMonthRevenue = Order::whereBetween('created_at', [$startOfMonth, $now])
            ->where('payment_status', 'paid')
            ->sum('total_amount') ?? 0;

        $currentMonthOrders = Order::whereBetween('created_at', [$startOfMonth, $now])->count();

        // Last Month Statistics - Complete month data
        $lastMonthRevenue = Order::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->where('payment_status', 'paid')
            ->sum('total_amount') ?? 0;

        $lastMonthOrders = Order::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // Calculate percentage changes with proper handling of zero values
        $revenueChange = $this->calculatePercentageChange($todayRevenue, $yesterdayRevenue);
        $ordersChange = $this->calculatePercentageChange($todayOrders, $yesterdayOrders);
        $monthlyRevenueChange = $this->calculatePercentageChange($currentMonthRevenue, $lastMonthRevenue);
        $monthlyOrdersChange = $this->calculatePercentageChange($currentMonthOrders, $lastMonthOrders);

        // Revenue chart data with proper date handling
        $period = (int) request()->query('period', 30);
        $days = in_array($period, [7, 30, 90]) ? $period : 30;
        $chartStartDate = $now->copy()->subDays($days)->startOfDay();

        $revenueChartData = $this->getChartData('revenue', $chartStartDate, $days);
        $ordersChartData = $this->getChartData('orders', $chartStartDate, $days);

        // Order status distribution with better formatting
        $orderStatusData = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->map(function ($item) use ($totalOrders) {
                return [
                    'status' => $this->formatStatus($item->status),
                    'count' => (int) $item->count,
                    'percentage' => $totalOrders > 0 ? round(($item->count / $totalOrders) * 100, 1) : 0
                ];
            })->toArray();

        // Payment method distribution with proper formatting
        $paymentMethodData = Order::selectRaw('payment_method, COUNT(*) as count, SUM(total_amount) as amount')
            ->where('payment_status', 'paid')
            ->whereNotNull('payment_method')
            ->groupBy('payment_method')
            ->get()
            ->map(function ($item) {
                return [
                    'method' => $this->formatPaymentMethod($item->payment_method),
                    'count' => (int) $item->count,
                    'amount' => round((float) $item->amount, 2)
                ];
            })->toArray();

        // Low stock products with proper threshold checking
        $lowStockProducts = Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')
            ->where('is_active', true)
            ->orderBy('stock_quantity', 'asc')
            ->limit(10)
            ->get();

        // Monthly comparison data (last 12 months) with precise calculations
        $monthlyData = $this->getMonthlyComparisonData();

        // // Recent orders with better data handling
        // $recentOrders = Order::with('user')
        //     ->orderBy('created_at', 'desc')
        //     ->limit(10)
        //     ->get()
        //     ->map(function ($order) {
        //         return [
        //             'id' => $order->id,
        //             'order_number' => $order->order_number ?? 'N/A',
        //             'customer_name' => $this->getCustomerName($order),
        //             'total_amount' => round((float) $order->total_amount, 2),
        //             'status' => $this->formatStatus($order->status),
        //             'payment_status' => $this->formatStatus($order->payment_status),
        //             'created_at' => $order->created_at->format('M d, Y H:i'),
        //             'created_at_human' => $order->created_at->diffForHumans()
        //         ];
        //     });
        // Recent orders - Fixed customer name handling
        // Recent orders
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'customer_name' => $order->billing_first_name . ' ' . $order->billing_last_name,
                    'total_amount' => $order->total_amount,
                    'status' => $order->status,
                    'payment_status' => $order->payment_status,
                    'created_at' => $order->created_at->format('M d, Y H:i'),
                    'created_at_human' => $order->created_at->diffForHumans()
                ];
            });

        // Average order value with proper calculation
        $paidOrdersCount = Order::where('payment_status', 'paid')->count();
        $avgOrderValue = $paidOrdersCount > 0 ? round($totalRevenue / $paidOrdersCount, 2) : 0;

        // Conversion metrics (with placeholder notice)
        $totalSiteVisits = 10000; // TODO: Replace with actual analytics data
        $conversionRate = $totalSiteVisits > 0 ? round(($totalOrders / $totalSiteVisits) * 100, 2) : 0;

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'totalCustomers',
            'todayOrders',
            'todayRevenue',
            'currentMonthOrders',
            'revenueChange',
            'ordersChange',
            'monthlyRevenueChange',
            'monthlyOrdersChange',
            'currentMonthRevenue',
            'lastMonthRevenue',
            'revenueChartData',
            'ordersChartData',
            'orderStatusData',
            'paymentMethodData',
            'lowStockProducts',
            'monthlyData',
            'recentOrders',
            'avgOrderValue',
            'conversionRate'
        ));
    }

    public function getRevenueData(Request $request)
    {
        $period = (int) $request->get('period', 30);
        $days = in_array($period, [7, 30, 90]) ? $period : 30;
        $startDate = Carbon::now()->subDays($days)->startOfDay();

        $data = $this->getChartData('revenue', $startDate, $days);
        return response()->json($data);
    }

    public function getOrderStats(Request $request)
    {
        $period = (int) $request->get('period', 30);
        $days = in_array($period, [7, 30, 90]) ? $period : 30;
        $startDate = Carbon::now()->subDays($days)->startOfDay();

        $data = $this->getChartData('orders', $startDate, $days);
        return response()->json($data);
    }

    /**
     * Calculate percentage change between two values
     */
    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }

    /**
     * Get chart data for revenue or orders
     */
    private function getChartData($type, $startDate, $days)
    {
        if ($type === 'revenue') {
            $query = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as value')
                ->where('payment_status', 'paid');
        } else {
            $query = Order::selectRaw('DATE(created_at) as date, COUNT(*) as value');
        }

        $data = $query->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Fill in missing dates with zero values
        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $value = $data->get($date)->value ?? 0;

            $result[] = [
                'date' => Carbon::parse($date)->format('M d'),
                $type === 'revenue' ? 'revenue' : 'orders' => $type === 'revenue' ? round((float) $value, 2) : (int) $value,
                'formatted_date' => $date
            ];
        }

        return $result;
    }

    /**
     * Get monthly comparison data for the last 12 months
     */
    private function getMonthlyComparisonData()
    {
        $monthlyData = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();

            $monthlyRevenue = Order::whereBetween('created_at', [$monthStart, $monthEnd])
                ->where('payment_status', 'paid')
                ->sum('total_amount') ?? 0;

            $monthlyOrders = Order::whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();

            $monthlyData[] = [
                'month' => $month->format('M Y'),
                'revenue' => round((float) $monthlyRevenue, 2),
                'orders' => (int) $monthlyOrders,
                'short_month' => $month->format('M')
            ];
        }

        return $monthlyData;
    }

    /**
     * Format status strings consistently
     */
    private function formatStatus($status)
    {
        if (!$status) return 'N/A';

        return str_replace('_', ' ', ucwords(strtolower($status), ' _'));
    }

    /**
     * Format payment method strings
     */
    private function formatPaymentMethod($method)
    {
        if (!$method) return 'Unknown';

        return str_replace('_', ' ', ucwords(strtolower($method), ' _'));
    }

    /**
     * Get customer name with fallback options
     */
    private function getCustomerName($order)
    {
        if ($order->user && $order->user->name) {
            return $order->user->name;
        }

        $firstName = $order->billing_first_name ?? '';
        $lastName = $order->billing_last_name ?? '';

        if ($firstName || $lastName) {
            return trim($firstName . ' ' . $lastName);
        }

        return 'Guest Customer';
    }
}

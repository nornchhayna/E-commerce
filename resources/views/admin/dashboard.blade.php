@extends('admin.layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                        <p class="text-gray-600">Welcome back! Here's what's happening with your store.</p>
                    </div>
                    <div class="flex space-x-4">
                        <select id="periodSelector"
                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="7">Last 7 days</option>
                            <option value="30" selected>Last 30 days</option>
                            <option value="90">Last 90 days</option>
                        </select>
                        <button onclick="window.location.reload()"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Refresh
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <!-- Key Metrics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Revenue -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                            <p class="text-3xl font-bold text-gray-900">${{ number_format($totalRevenue, 2) }}</p>
                            <div class="flex items-center mt-2">
                                @if($revenueChange >= 0)
                                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    <span
                                        class="text-green-600 text-sm font-medium">+{{ number_format($revenueChange, 1) }}%</span>
                                @else
                                    <svg class="w-4 h-4 text-red-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                    <span
                                        class="text-red-600 text-sm font-medium">{{ number_format($revenueChange, 1) }}%</span>
                                @endif
                                <span class="text-gray-500 text-sm ml-1">vs yesterday</span>
                            </div>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Orders -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Orders</p>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalOrders) }}</p>
                            <div class="flex items-center mt-2">
                                @if($ordersChange >= 0)
                                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    <span
                                        class="text-green-600 text-sm font-medium">+{{ number_format($ordersChange, 1) }}%</span>
                                @else
                                    <svg class="w-4 h-4 text-red-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                    <span class="text-red-600 text-sm font-medium">{{ number_format($ordersChange, 1) }}%</span>
                                @endif
                                <span class="text-gray-500 text-sm ml-1">vs yesterday</span>
                            </div>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Average Order Value -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Avg Order Value</p>
                            <p class="text-3xl font-bold text-gray-900">${{ number_format($avgOrderValue, 2) }}</p>
                            <div class="flex items-center mt-2">
                                <span class="text-gray-500 text-sm">{{ number_format($conversionRate, 2) }}% conversion
                                    rate</span>
                            </div>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-full">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Monthly Revenue Change -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Monthly Revenue</p>
                            <p class="text-3xl font-bold text-gray-900">${{ number_format($currentMonthRevenue, 2) }}</p>
                            <div class="flex items-center mt-2">
                                @if($monthlyRevenueChange >= 0)
                                    <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    <span
                                        class="text-green-600 text-sm font-medium">+{{ number_format($monthlyRevenueChange, 1) }}%</span>
                                @else
                                    <svg class="w-4 h-4 text-red-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                    <span
                                        class="text-red-600 text-sm font-medium">{{ number_format($monthlyRevenueChange, 1) }}%</span>
                                @endif
                                <span class="text-gray-500 text-sm ml-1">vs last month</span>
                            </div>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Revenue Chart -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Revenue Trend</h3>
                        <select class="text-sm border-gray-300 rounded-md">
                            <option>Last 30 days</option>
                            <option>Last 90 days</option>
                            <option>Last year</option>
                        </select>
                    </div>
                    <div class="h-80">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Orders Chart -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Orders Trend</h3>
                        <select class="text-sm border-gray-300 rounded-md">
                            <option>Last 30 days</option>
                            <option>Last 90 days</option>
                            <option>Last year</option>
                        </select>
                    </div>
                    <div class="h-80">
                        <canvas id="ordersChart"></canvas>
                    </div>
                </div>
            </div> --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Revenue -->

                <!-- Total Orders, Avg Order Value, Monthly Revenue (unchanged) -->
                <!-- ... (copy from your original template) ... -->
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Revenue Chart -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Revenue Trend</h3>
                        <select id="revenuePeriodSelector" class="text-sm border-gray-300 rounded-md">
                            <option value="7">Last 7 days</option>
                            <option value="30" selected>Last 30 days</option>
                            <option value="90">Last 90 days</option>
                        </select>
                    </div>
                    <div class="h-80 chart-container">
                        <canvas linux-fork="true" id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Orders Chart -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Orders Trend</h3>
                        <select id="ordersPeriodSelector" class="text-sm border-gray-300 rounded-md">
                            <option value="7">Last 7 days</option>
                            <option value="30" selected>Last 30 days</option>
                            <option value="90">Last 90 days</option>
                        </select>
                    </div>
                    <div class="h-80 chart-container">
                        <canvas linux-fork="true" id="ordersChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Order Status and Payment Methods -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Order Status Distribution -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Status Distribution</h3>
                    <div class="space-y-4">
                        @foreach($orderStatusData as $status)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-4 h-4 rounded-full mr-3 
                                                                                                                                                        @if($status['status'] == 'Delivered') bg-green-500
                                                                                                                                                        @elseif($status['status'] == 'Shipped') bg-blue-500
                                                                                                                                                        @elseif($status['status'] == 'Processing') bg-yellow-500
                                                                                                                                                        @elseif($status['status'] == 'Pending') bg-orange-500
                                                                                                                                                        @elseif($status['status'] == 'Cancelled') bg-red-500
                                                                                                                                                            @else bg-gray-500
                                                                                                                                                        @endif">
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $status['status'] }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-500 mr-2">{{ $status['count'] }} orders</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $status['percentage'] }}%</span>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full 
                                                                                                                                                    @if($status['status'] == 'Delivered') bg-green-500
                                                                                                                                                    @elseif($status['status'] == 'Shipped') bg-blue-500
                                                                                                                                                    @elseif($status['status'] == 'Processing') bg-yellow-500
                                                                                                                                                    @elseif($status['status'] == 'Pending') bg-orange-500
                                                                                                                                                    @elseif($status['status'] == 'Cancelled') bg-red-500
                                                                                                                                                        @else bg-gray-500
                                                                                                                                                    @endif"
                                    style="width: {{ $status['percentage'] }}%">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Methods</h3>
                    <div class="space-y-4">
                        @foreach($paymentMethodData as $method)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $method['method'] }}</p>
                                    <p class="text-sm text-gray-500">{{ $method['count'] }} transactions</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">${{ number_format($method['amount'], 2) }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ number_format(($method['amount'] / $totalRevenue) * 100, 1) }}% of total
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Orders and Low Stock Alerts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                            <a href="{{ route('admin.orders.index') }}"
                                class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">View all</a>
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Order</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentOrders->take(5) as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $order['order_number'] }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $order['created_at_human'] }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $order['customer_name'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                ${{ number_format($order['total_amount'], 2) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                                                                                                                                @if($order['status'] == 'delivered') bg-green-100 text-green-800
                                                                                                                                                                @elseif($order['status'] == 'shipped') bg-blue-100 text-blue-800
                                                                                                                                                                @elseif($order['status'] == 'processing') bg-yellow-100 text-yellow-800
                                                                                                                                                                @elseif($order['status'] == 'pending') bg-orange-100 text-orange-800
                                                                                                                                                                    @else bg-red-100 text-red-800
                                                                                                                                                                @endif">
                                                {{ ucfirst($order['status']) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Low Stock Alerts -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Low Stock Alerts</h3>
                            <a href="{{ route('admin.products.index') }}"
                                class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">View all</a>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($lowStockProducts->count() > 0)
                            <div class="space-y-4">
                                @foreach($lowStockProducts->take(5) as $product)
                                    <div class="flex items-center justify-between p-4 border border-red-200 rounded-lg bg-red-50">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-red-100 rounded-full mr-3">
                                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $product->name }}</p>
                                                <p class="text-sm text-gray-500">SKU: {{ $product->sku }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-semibold text-red-600">{{ $product->stock_quantity }} left</p>
                                            <p class="text-xs text-gray-500">Threshold: {{ $product->low_stock_threshold }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500">All products are well stocked!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script>
        // Revenue Chart Data
        const revenueData = @json($revenueChartData);
        const ordersData = @json($ordersChartData);
        const monthlyData = @json($monthlyData);

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueData.map(item => item.date),
                datasets: [{
                    label: 'Revenue ($)',
                    data: revenueData.map(item => item.revenue),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return ' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    point: {
                        hoverRadius: 8
                    }
                }
            }
        });

        // Orders Chart
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: ordersData.map(item => item.date),
                datasets: [{
                    label: 'Orders',
                    data: ordersData.map(item => item.orders),
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgb(16, 185, 129)',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Period Selector
        document.getElementById('periodSelector').addEventListener('change', function () {
            const period = this.value;
            // You can implement AJAX calls here to update charts based on selected period
            // Example:
            // fetch(`/admin/dashboard/revenue?period=${period}`)
            //     .then(response => response.json())
            //     .then(data => {
            //         revenueChart.data.labels = data.map(item => item.date);
            //         revenueChart.data.datasets[0].data = data.map(item => item.revenue);
            //         revenueChart.update();
            //     });
        });

        // Auto-refresh every 5 minutes
        setInterval(function () {
            window.location.reload();
        }, 300000); // 5 minutes = 300000 milliseconds

        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function () {
            // Add hover effects to metric cards
            const metricCards = document.querySelectorAll('.bg-white.rounded-lg.shadow.p-6');
            metricCards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.classList.add('shadow-lg', 'transform', 'scale-105');
                    this.style.transition = 'all 0.2s ease-in-out';
                });
                card.addEventListener('mouseleave', function () {
                    this.classList.remove('shadow-lg', 'transform', 'scale-105');
                });
            });

            // Add loading states for dynamic content
            const refreshButton = document.querySelector('button[onclick="window.location.reload()"]');
            if (refreshButton) {
                refreshButton.addEventListener('click', function () {
                    this.innerHTML = `
                                                                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                                                </svg>
                                                                                Refreshing...
                                                                            `;
                    this.disabled = true;
                });
            }
        });

        // Format numbers with commas
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Add real-time updates (you can implement WebSocket or polling)
        function updateMetrics() {
            // This would be implemented with AJAX calls to get real-time data
            // Example implementation:
            /*
            fetch('/admin/dashboard/metrics')
                .then(response => response.json())
                .then(data => {
                    // Update metric values
                    document.querySelector('#totalRevenue').textContent = ' + formatNumber(data.totalRevenue);
                    document.querySelector('#totalOrders').textContent = formatNumber(data.totalOrders);
                    // Update other metrics...
                })
                .catch(error => console.error('Error updating metrics:', error));
            */
        }

        // Uncomment to enable real-time updates every 30 seconds
        // setInterval(updateMetrics, 30000);
    </script> --}}

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Chart data from Laravel
        let revenueData = @json($revenueChartData);
        let ordersData = @json($ordersChartData);

        // Debug data
        console.log('revenueData:', revenueData);
        console.log('ordersData:', ordersData);

        // Fallback for empty data
        if (!revenueData.length) {
            revenueData = [{ date: 'No Data', revenue: 0 }];
        }
        if (!ordersData.length) {
            ordersData = [{ date: 'No Data', orders: 0 }];
        }

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueData.map(item => item.date),
                datasets: [{
                    label: 'Revenue ($)',
                    data: revenueData.map(item => item.revenue),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            title: (context) => {
                                const index = context[0].dataIndex;
                                return revenueData[index].formatted_date || revenueData[index].date;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { callback: value => '$' + value.toLocaleString() }
                    },
                    x: { grid: { display: false } }
                },
                elements: { point: { hoverRadius: 8 } }
            }
        });

        // Orders Chart
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: ordersData.map(item => item.date),
                datasets: [{
                    label: 'Orders',
                    data: ordersData.map(item => item.orders),
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgb(16, 185, 129)',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            title: (context) => {
                                const index = context[0].dataIndex;
                                return ordersData[index].formatted_date || ordersData[index].date;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        // Period Selector (Global)
        document.getElementById('globalPeriodSelector').addEventListener('change', function () {
            const period = this.value;
            updateCharts(period);
            // Sync other selectors
            document.getElementById('revenuePeriodSelector').value = period;
            document.getElementById('ordersPeriodSelector').value = period;
        });

        // Revenue Period Selector
        document.getElementById('revenuePeriodSelector').addEventListener('change', function () {
            const period = this.value;
            updateRevenueChart(period);
            // Sync other selectors
            document.getElementById('globalPeriodSelector').value = period;
            document.getElementById('ordersPeriodSelector').value = period;
        });

        // Orders Period Selector
        document.getElementById('ordersPeriodSelector').addEventListener('change', function () {
            const period = this.value;
            updateOrdersChart(period);
            // Sync other selectors
            document.getElementById('globalPeriodSelector').value = period;
            document.getElementById('revenuePeriodSelector').value = period;
        });

        // Update both charts
        function updateCharts(period) {
            updateRevenueChart(period);
            updateOrdersChart(period);
        }

        // Update revenue chart
        function updateRevenueChart(period) {
            fetch(`/admin/dashboard/revenue?period=${period}`)
                .then(response => response.json())
                .then(data => {
                    revenueData = data.length ? data : [{ date: 'No Data', revenue: 0 }];
                    revenueChart.data.labels = revenueData.map(item => item.date);
                    revenueChart.data.datasets[0].data = revenueData.map(item => item.revenue);
                    revenueChart.update();
                })
                .catch(error => {
                    console.error('Error fetching revenue data:', error);
                    revenueData = [{ date: 'Error', revenue: 0 }];
                    revenueChart.data.labels = revenueData.map(item => item.date);
                    revenueChart.data.datasets[0].data = revenueData.map(item => item.revenue);
                    revenueChart.update();
                });
        }

        // Update orders chart
        function updateOrdersChart(period) {
            fetch(`/admin/dashboard/order-stats?period=${period}`)
                .then(response => response.json())
                .then(data => {
                    ordersData = data.length ? data : [{ date: 'No Data', orders: 0 }];
                    ordersChart.data.labels = ordersData.map(item => item.date);
                    ordersChart.data.datasets[0].data = ordersData.map(item => item.orders);
                    ordersChart.update();
                })
                .catch(error => {
                    console.error('Error fetching orders data:', error);
                    ordersData = [{ date: 'Error', orders: 0 }];
                    ordersChart.data.labels = ordersData.map(item => item.date);
                    ordersChart.data.datasets[0].data = ordersData.map(item => item.orders);
                    ordersChart.update();
                });
        }

        // Add hover effects to metric cards
        document.addEventListener('DOMContentLoaded', function () {
            const metricCards = document.querySelectorAll('.metric-card');
            metricCards.forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.classList.add('shadow-lg', 'transform', 'scale-105');
                    this.style.transition = 'all 0.2s ease-in-out';
                });
                card.addEventListener('mouseleave', function () {
                    this.classList.remove('shadow-lg', 'transform', 'scale-105');
                });
            });

            const refreshButton = document.querySelector('button[onclick="window.location.reload()"]');
            if (refreshButton) {
                refreshButton.addEventListener('click', function () {
                    this.innerHTML = `
                                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                Refreshing...
                                            `;
                    this.disabled = true;
                });
            }
        });

        // Format numbers with commas
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>


    <style>
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Custom scrollbar for tables */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #eae5e5;
            border-radius: 10px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Improved card hover effects */
        .metric-card {
            transition: all 0.3s ease;
        }

        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Chart containers */
        .chart-container {
            position: relative;
            height: 320px;
            margin: 20px 0;
        }

        /* Status badges */
        .status-badge {
            transition: all 0.2s ease;
        }

        .status-badge:hover {
            transform: scale(1.05);
        }

        /* Loading states */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #ccc;
            border-top-color: #333;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
    </style>
@endsection
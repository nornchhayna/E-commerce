<?php

namespace App\Services;

use Omnipay\Omnipay;
use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Carbon;

class PaymentService
{
    protected $paypalGateway;
    protected $httpClient;



    /**
     * Refund a PayPal payment.
     *
     * @param Order $order
     * @param float $amount
     * @return array
     */
    public function refundPaypalPayment(Order $order, float $amount)
    {
        // TODO: Implement refund logic using Omnipay PayPal gateway.
        // Example structure:
        // $response = $this->paypalGateway->refund([
        //     'transactionReference' => $order->transaction_id,
        //     'amount' => $amount,
        //     'currency' => $order->currency,
        // ])->send();
        //
        // if ($response->isSuccessful()) {
        //     // Update order status, log, etc.
        //     return ['status' => 'success', 'message' => 'Refund processed'];
        // } else {
        //     return ['status' => 'error', 'message' => $response->getMessage()];
        // }
        return [
            'status' => 'error',
            'message' => 'Refund functionality not implemented yet.'
        ];
    }
    public function __construct()
    {
        // Make sure you have installed omnipay/paypal
        $this->paypalGateway = Omnipay::create('PayPal_Rest');
        $this->paypalGateway->setClientId(Config::get('payment.paypal.client_id'));
        $this->paypalGateway->setSecret(Config::get('payment.paypal.secret'));
        $this->paypalGateway->setTestMode(Config::get('payment.paypal.mode') === 'sandbox');
        $this->httpClient = new Client();
    }

    public function initiatePaypalPayment(Order $order, array $cardDetails = [])
    {
        try {
            $purchaseData = [
                'amount'      => $order->total_amount,
                'currency'    => $order->currency,
                'description' => 'Order #' . $order->order_number,
                'returnUrl'   => route('customer.payment.success'),
                'cancelUrl'   => route('customer.payment.cancel'),
            ];

            // Only set card if card details are provided and supported
            if (!empty($cardDetails)) {
                $purchaseData['card'] = [
                    'number'     => $cardDetails['card_number'] ?? null,
                    'expiryMonth' => $cardDetails['expiry_month'] ?? null,
                    'expiryYear' => $cardDetails['expiry_year'] ?? null,
                    'cvv'        => $cardDetails['cvv'] ?? null,
                    'firstName'  => $cardDetails['first_name'] ?? null,
                    'lastName'   => $cardDetails['last_name'] ?? null,
                ];
            }

            $response = $this->paypalGateway->purchase($purchaseData)->send();

            if ($response->isRedirect()) {
                $order->update(['payment_method' => 'PayPal']);
                // getRedirectUrl() is available on the response object
                return [
                    'status' => 'redirect',
                    'url'    => $response->getRedirectUrl(),
                ];
            } elseif ($response->isSuccessful()) {
                $order->update([
                    'payment_method'  => 'PayPal',
                    'transaction_id'  => $response->getTransactionReference(),
                    'payment_status'  => 'completed',
                    'payment_date'    => Carbon::now(),
                    'status'          => 'processing',
                ]);
                return [
                    'status'  => 'success',
                    'message' => 'Payment completed',
                ];
            } else {
                return [
                    'status'  => 'error',
                    'message' => $response->getMessage(),
                ];
            }
        } catch (\Exception $e) {
            Log::error('PayPal Payment Error: ' . $e->getMessage(), ['exception' => $e]);
            return [
                'status'  => 'error',
                'message' => 'Payment failed: ' . $e->getMessage(),
            ];
        }
    }

    public function initiatePayWayPayment(Order $order)
    {
        // TODO: Implement PayWay payment logic
        return [
            'status' => 'error',
            'message' => 'PayWay payment not implemented yet.'
        ];
    }

    public function handlePayWayWebhook(array $payload)
    {
        // TODO: Implement PayWay webhook handling logic
        // Example: update order status based on webhook payload
        return true;
    }

    // ... (rest of your methods remain unchanged)
}

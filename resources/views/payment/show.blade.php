@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<div class="container mx-auto px-4 py-20">
    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8">
            <h1 class="text-3xl font-bold mb-4">Complete Payment</h1>
            <p class="text-gray-600 mb-8">Review your order and proceed to Paystack for secure checkout.</p>

            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <div class="flex justify-between mb-3">
                    <span class="text-gray-600">Order Number</span>
                    <span class="font-bold">{{ $order->order_number }}</span>
                </div>
                <div class="flex justify-between mb-3">
                    <span class="text-gray-600">Payment Amount</span>
                    <span class="font-bold">₵{{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Payment Method</span>
                    <span class="font-bold">Paystack</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="font-bold text-lg mb-4">Shipping Address</h2>
                    <p class="text-gray-700">{{ $order->shipping_address }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="font-bold text-lg mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>₵{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span>₵{{ number_format($order->shipping_cost, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span>₵{{ number_format($order->tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-gray-800 text-lg">
                            <span>Total</span>
                            <span>₵{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('payment.initiate', $order) }}" method="POST" class="text-center">
                @csrf
                <button type="submit" class="inline-flex items-center justify-center gap-3 w-full md:w-auto bg-purple-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-purple-700 transition">
                    <i class="fas fa-credit-card"></i>
                    Pay with Paystack
                </button>
            </form>

            <div class="mt-6 text-center text-gray-500">
                <p>If the payment does not complete, you can return here and try again.</p>
            </div>
        </div>
    </div>
</div>

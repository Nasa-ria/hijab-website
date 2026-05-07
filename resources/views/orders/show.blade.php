@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <div class="lg:w-2/3 bg-white rounded-lg shadow-md p-6">
            <div class="flex flex-col lg:flex-row lg:justify-between gap-6 mb-8">
                <div>
                    <p class="text-sm text-gray-500">Order Number</p>
                    <p class="font-bold text-xl">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Order Date</p>
                    <p class="font-bold text-xl">{{ $order->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Shipping Address</h2>
                <p class="text-gray-700">{{ $order->shipping_address }}</p>
            </div>

            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex gap-4 p-4 rounded-lg border border-gray-200">
                        @if($item->product->main_image)
                            <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded">
                        @else
                            <div class="w-24 h-24 bg-gray-100 rounded flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="text-lg font-bold">{{ $item->product->name }}</h3>
                            <p class="text-gray-600">Quantity: {{ $item->quantity }}</p>
                            <p class="text-gray-700 font-bold">₵{{ number_format($item->price, 2) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-600 text-sm">Subtotal</p>
                            <p class="font-bold text-lg">₵{{ number_format($item->subtotal, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="lg:w-1/3 space-y-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4">Order Summary</h2>
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
                    <div class="flex justify-between text-lg font-bold text-gray-800">
                        <span>Total</span>
                        <span>₵{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
                <div class="mt-6">
                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ ucfirst($order->status) }}</span>
                    <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm ml-2">{{ ucfirst($order->payment_status) }}</span>
                </div>
            </div>
            <a href="{{ route('orders.index') }}" class="block bg-purple-600 text-white text-center px-6 py-3 rounded-lg hover:bg-purple-700 transition">Back to Orders</a>
        </div>
    </div>
</div>

@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8">My Orders</h1>

    @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Order Number</p>
                            <p class="font-bold text-lg">{{ $order->order_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total</p>
                            <p class="font-bold text-lg">₵{{ number_format($order->total_amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Payment</p>
                            <p class="font-bold text-lg">{{ ucfirst($order->payment_status) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="font-bold text-lg">{{ ucfirst($order->status) }}</p>
                        </div>
                        <div>
                            <a href="{{ route('orders.show', $order) }}" class="inline-block bg-purple-600 text-white px-5 py-3 rounded-lg font-bold hover:bg-purple-700 transition">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-600 mb-2">No orders found</h2>
            <p class="text-gray-500 mb-6">You haven't placed any orders yet.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-purple-700 transition">Start Shopping</a>
        </div>
    @endif
</div>

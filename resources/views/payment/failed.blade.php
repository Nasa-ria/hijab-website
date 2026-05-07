@extends('layouts.app')

@section('title', 'Payment Failed')

@section('content')
<div class="container mx-auto px-4 py-20">
    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8 text-center">
            <div class="text-6xl text-red-500 mb-4">
                <i class="fas fa-times-circle"></i>
            </div>
            <h1 class="text-3xl font-bold mb-4">Payment Failed</h1>
            <p class="text-gray-600 mb-8">Something went wrong during the payment process. Please try again or contact support.</p>
            <a href="{{ route('payment.show', $order) }}" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-purple-700 transition">Retry Payment</a>
            <a href="{{ route('orders.show', $order) }}" class="inline-block ml-4 text-purple-600 font-bold hover:underline">View Order</a>
        </div>
    </div>
</div>

@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="page-container py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Shopping Cart</h1>
        <p class="mt-2 text-slate-600">{{ count($cart) }} {{ Str::plural('item', count($cart)) }} in your cart</p>
    </div>

    @if(count($cart) > 0)
        <div class="grid gap-8 lg:grid-cols-3">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-6">
                @foreach($cart as $key => $item)
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-lg transition">
                        <div class="flex gap-6">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-xl">
                            </div>

                            <div class="flex-1 min-w-0">
                                <a href="{{ route('products.show', $item['product_id']) }}" class="block">
                                    <h3 class="text-lg font-semibold text-slate-900 hover:text-brand transition line-clamp-2">{{ $item['name'] }}</h3>
                                </a>
                                <p class="text-brand font-semibold mt-1">₵{{ number_format($item['price'], 2) }} each</p>
                            </div>

                            <div class="flex flex-col items-end gap-4">
                                <!-- Quantity Controls -->
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-slate-200 rounded-xl overflow-hidden">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="px-3 py-2 text-slate-600 hover:bg-slate-50 transition {{ $item['quantity'] <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                        <i class="fas fa-minus text-xs"></i>
                                    </button>
                                    <span class="px-4 py-2 text-sm font-medium">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-2 text-slate-600 hover:bg-slate-50 transition">
                                        <i class="fas fa-plus text-xs"></i>
                                    </button>
                                </form>

                                <!-- Remove Button -->
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium transition">
                                        Remove
                                    </button>
                                </form>
                            </div>

                            <div class="text-right">
                                <p class="text-xl font-bold text-slate-900">₵{{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Cart Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center pt-6 border-t border-slate-200">
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear your cart?')">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium flex items-center gap-2 transition">
                            <i class="fas fa-trash"></i>
                            Clear Cart
                        </button>
                    </form>

                    <a href="{{ route('products.index') }}" class="text-brand hover:text-brand-dark font-medium flex items-center gap-2 transition">
                        <i class="fas fa-arrow-left"></i>
                        Continue Shopping
                    </a>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-slate-200 rounded-2xl p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-600">Subtotal ({{ count($cart) }} {{ Str::plural('item', count($cart)) }})</span>
                            <span class="font-medium">₵{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-600">Shipping</span>
                            <span class="font-medium">₵{{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-600">Tax (5%)</span>
                            <span class="font-medium">₵{{ number_format($tax, 2) }}</span>
                        </div>
                        <hr class="border-slate-200">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-brand">₵{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="bg-purple-50 border border-purple-100 rounded-2xl p-4 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-purple-600 text-white">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Secure checkout with Paystack</h3>
                                <p class="text-sm text-slate-600">Complete your payment after checkout using Paystack's secure payment flow.</p>
                            </div>
                        </div>
                    </div>

                    @auth
                        <a href="{{ route('checkout.index') }}" class="block w-full bg-brand text-black px-6 py-4 rounded-xl font-semibold hover:bg-brand-dark transition text-center mb-4">
                            <i class="fas fa-credit-card mr-2"></i>
                            Checkout & Pay
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-brand text-black px-6 py-4 rounded-xl font-semibold hover:bg-brand-dark transition text-center mb-3">
                            Login to Checkout
                        </a>
                        <a href="{{ route('register') }}" class="block w-full bg-slate-100 text-slate-700 px-6 py-4 rounded-xl font-semibold hover:bg-slate-200 transition text-center">
                            Create Account
                        </a>
                    @endauth

                    <!-- Security Badges -->
                    <div class="mt-6 pt-6 border-t border-slate-200">
                        <div class="flex items-center justify-center gap-4 text-xs text-slate-500">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-shield-alt"></i>
                                <span>Secure</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-lock"></i>
                                <span>SSL Protected</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-16">
            <div class="rounded-full bg-slate-100 p-8 mb-6 inline-block">
                <i class="fas fa-shopping-cart text-6xl text-slate-400"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 mb-2">Your cart is empty</h2>
            <p class="text-slate-600 mb-8 max-w-md mx-auto">Looks like you haven't added any products to your cart yet. Start shopping to fill it up!</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-brand text-white px-8 py-4 rounded-xl font-semibold hover:bg-brand-dark transition">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection

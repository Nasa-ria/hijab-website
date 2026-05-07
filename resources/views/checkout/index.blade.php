@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="page-container py-8">
    <!-- Progress Indicator -->
    <div class="mb-8">
        <div class="flex items-center justify-center">
            <div class="flex items-center">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-brand text-slate-400 text-sm font-semibold">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="w-16 h-0.5 bg-brand mx-2"></div>
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-brand text-slate-400 text-sm font-semibold">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="w-16 h-0.5 bg-slate-200 mx-2"></div>
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-200 text-slate text-sm font-semibold">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="w-16 h-0.5 bg-slate-200 mx-2"></div>
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-200 text-slate text-sm font-semibold">
                    <i class="fas fa-check"></i>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-4 text-sm text-slate-600">
            <span class="mx-8">Cart</span>
            <span class="mx-8 font-medium text-brand">Shipping</span>
            <span class="mx-8">Payment</span>
            <span class="mx-8">Complete</span>
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-3">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.store') }}" method="POST" class="bg-white border border-slate-200 rounded-2xl p-8 space-y-8">
                @csrf

                <div>
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Shipping Information</h3>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block font-medium text-slate-900 mb-2">Full Name</label>
                            <input type="text" value="{{ $user->name }}" disabled class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                        </div>

                        <div>
                            <label class="block font-medium text-slate-900 mb-2">Email Address</label>
                            <input type="email" value="{{ $user->email }}" disabled class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block font-medium text-slate-900 mb-2">Street Address</label>
                        <input type="text" name="shipping_address" required placeholder="Enter your full address" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition @error('shipping_address') border-red-500 @enderror">
                        @error('shipping_address')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid gap-6 md:grid-cols-3 mt-6">
                        <div>
                            <label class="block font-medium text-slate-900 mb-2">City</label>
                            <input type="text" name="city" required placeholder="City" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition @error('city') border-red-500 @enderror">
                            @error('city')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block font-medium text-slate-900 mb-2">Region</label>
                            <input type="text" name="region" placeholder="Region (optional)" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition">
                        </div>
                        <div>
                            <label class="block font-medium text-slate-900 mb-2">Postal Code</label>
                            <input type="text" name="postal_code" required placeholder="Postal code" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition @error('postal_code') border-red-500 @enderror">
                            @error('postal_code')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block font-medium text-slate-900 mb-2">Phone Number</label>
                        <input type="text" name="phone" required placeholder="+233 XX XXX XXXX" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Order Notes -->
                <div class="border-t border-slate-200 pt-6">
                    <label class="block font-medium text-slate-900 mb-2">Order Notes (Optional)</label>
                    <textarea name="notes" placeholder="Any special instructions for delivery..." rows="3" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition"></textarea>
                </div>

                <div class="border-t border-slate-200 pt-6">
                    <button type="submit" class="w-full bg-brand text-black px-8 py-4 rounded-xl font-semibold hover:bg-brand-dark transition flex items-center justify-center gap-2">
                        <i class="fas fa-credit-card"></i>
                        Continue to Payment
                    </button>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 sticky top-24">
                <h2 class="text-lg font-bold text-slate-900 mb-6">Order Summary</h2>

                <!-- Cart Items -->
                <div class="space-y-4 mb-6">
                    @foreach($cart as $item)
                        <div class="flex gap-3">
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded-lg flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 line-clamp-2">{{ $item['name'] }}</p>
                                <p class="text-xs text-slate-600">Qty: {{ $item['quantity'] }}</p>
                            </div>
                            <div class="text-sm font-semibold text-slate-900">
                                ₵{{ number_format($item['price'] * $item['quantity'], 2) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr class="border-slate-200 mb-6">

                <!-- Pricing Breakdown -->
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600">Subtotal</span>
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

                <!-- Back to Cart -->
                <a href="{{ route('cart.index') }}" class="text-brand hover:text-brand-dark font-medium flex items-center justify-center gap-2 transition">
                    <i class="fas fa-arrow-left"></i>
                    Back to Cart
                </a>

                <!-- Security Badges -->
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <div class="flex items-center justify-center gap-4 text-xs text-slate-500">
                        <div class="flex items-center gap-1">
                            <i class="fas fa-shield-alt"></i>
                            <span>Secure Checkout</span>
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
</div>
@endsection

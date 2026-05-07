@extends('layouts.app')

@section('title', 'Server Error')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-4">
    <div class="text-center max-w-md">
        <div class="mb-8">
            <div class="text-8xl font-bold text-slate-300 mb-4">500</div>
            <h1 class="text-2xl font-bold text-slate-900 mb-2">Server Error</h1>
            <p class="text-slate-600">Oops! Something went wrong on our end. We're working to fix this issue.</p>
        </div>

        <div class="space-y-4">
            <button onclick="window.location.reload()" class="inline-block bg-brand text-white px-8 py-4 rounded-xl font-semibold hover:bg-brand-dark transition">
                <i class="fas fa-refresh mr-2"></i>
                Try Again
            </button>
            <div>
                <a href="{{ route('home') }}" class="inline-block text-brand hover:text-brand-dark font-medium transition">
                    Go Home →
                </a>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="mt-12 pt-8 border-t border-slate-200">
            <p class="text-sm text-slate-600 mb-4">Need help? Contact our support</p>
            <div class="flex justify-center gap-4">
                <a href="mailto:support@hijabisplugg.com" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
                    <i class="fas fa-envelope"></i>
                </a>
                <a href="tel:+233123456789" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
                    <i class="fas fa-phone"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
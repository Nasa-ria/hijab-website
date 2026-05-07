@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center px-4">
    <div class="text-center max-w-md">
        <div class="mb-8">
            <div class="text-8xl font-bold text-slate-300 mb-4">404</div>
            <h1 class="text-2xl font-bold text-slate-900 mb-2">Page Not Found</h1>
            <p class="text-slate-600">Sorry, the page you're looking for doesn't exist or has been moved.</p>
        </div>

        <div class="space-y-4">
            <a href="{{ route('home') }}" class="inline-block bg-brand text-white px-8 py-4 rounded-xl font-semibold hover:bg-brand-dark transition">
                <i class="fas fa-home mr-2"></i>
                Go Home
            </a>
            <div>
                <a href="{{ route('products.index') }}" class="inline-block text-brand hover:text-brand-dark font-medium transition">
                    Browse Products →
                </a>
            </div>
        </div>

        <!-- Popular Categories -->
        <div class="mt-12 pt-8 border-t border-slate-200">
            <p class="text-sm text-slate-600 mb-4">Popular Categories</p>
            <div class="flex flex-wrap justify-center gap-2">
                <a href="{{ route('products.index', ['category' => 'hijabs']) }}" class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-slate-200 transition">
                    Hijabs
                </a>
                <a href="{{ route('products.index', ['category' => 'abayas']) }}" class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-slate-200 transition">
                    Abayas
                </a>
                <a href="{{ route('products.index', ['category' => 'accessories']) }}" class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm hover:bg-slate-200 transition">
                    Accessories
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
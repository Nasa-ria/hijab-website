@extends('layouts.app')

@section('title', 'Shop Products')

@section('content')
<div class="page-container py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Shop Products</h1>
        <p class="mt-2 text-slate-600">Discover our curated collection of quality products</p>
    </div>

    <div class="grid gap-8 lg:grid-cols-4">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Search -->
            <div class="mb-6">
                <form method="GET" action="{{ route('products.index') }}" class="relative">
                    <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 pr-12 text-sm shadow-sm transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Categories -->
            <div class="mb-6">
                <h3 class="font-semibold text-slate-900 mb-4">Categories</h3>
                <div class="space-y-2">
                    <a href="{{ route('products.index') }}" class="block rounded-lg px-3 py-2 text-sm transition hover:bg-slate-100 {{ !request('category') ? 'bg-brand text-white hover:bg-brand-dark' : 'text-slate-700' }}">All Categories</a>
                    @foreach($categories as $cat)
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="block rounded-lg px-3 py-2 text-sm transition hover:bg-slate-100 {{ request('category') === $cat->slug ? 'bg-brand text-white hover:bg-brand-dark' : 'text-slate-700' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Sorting -->
            <div class="mb-6">
                <h3 class="font-semibold text-slate-900 mb-4">Sort By</h3>
                <div class="space-y-2">
                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'latest'])) }}" class="block rounded-lg px-3 py-2 text-sm transition hover:bg-slate-100 {{ request('sort') === 'latest' || !request('sort') ? 'bg-brand text-white hover:bg-brand-dark' : 'text-slate-700' }}">Latest</a>
                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}" class="block rounded-lg px-3 py-2 text-sm transition hover:bg-slate-100 {{ request('sort') === 'price_low' ? 'bg-brand text-white hover:bg-brand-dark' : 'text-slate-700' }}">Price: Low to High</a>
                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}" class="block rounded-lg px-3 py-2 text-sm transition hover:bg-slate-100 {{ request('sort') === 'price_high' ? 'bg-brand text-white hover:bg-brand-dark' : 'text-slate-700' }}">Price: High to Low</a>
                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'rating'])) }}" class="block rounded-lg px-3 py-2 text-sm transition hover:bg-slate-100 {{ request('sort') === 'rating' ? 'bg-brand text-white hover:bg-brand-dark' : 'text-slate-700' }}">Top Rated</a>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="lg:col-span-3">
            @if($products->count() > 0)
                <div class="mb-6 flex items-center justify-between">
                    <p class="text-sm text-slate-600">{{ $products->total() }} products found</p>
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <span>Showing {{ $products->firstItem() }}-{{ $products->lastItem() }}</span>
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($products as $product)
                        <div class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                            <div class="relative h-64 overflow-hidden bg-slate-100">
                                @if($product->main_image)
                                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="flex h-full items-center justify-center text-slate-400">
                                        <i class="fas fa-image text-3xl"></i>
                                    </div>
                                @endif
                                @if(!$product->is_available)
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/60">
                                        <span class="rounded-full bg-red-500 px-4 py-2 text-sm font-semibold text-white">Sold Out</span>
                                    </div>
                                @endif
                                @if($product->sale_price)
                                    <div class="absolute top-3 right-3 rounded-full bg-red-500 px-3 py-1 text-xs font-semibold text-white">
                                        Sale
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">{{ $product->category->name ?? 'Category' }}</p>
                                <a href="{{ route('products.show', $product) }}" class="block">
                                    <h3 class="mt-2 text-lg font-semibold text-slate-900 group-hover:text-brand transition">{{ $product->name }}</h3>
                                </a>
                                <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ Str::limit($product->short_description, 80) }}</p>
                                <div class="mt-6 flex items-center justify-between gap-4">
                                    <div class="flex flex-col">
                                        @if($product->sale_price)
                                            <span class="text-sm text-slate-500 line-through">₵{{ number_format($product->price, 2) }}</span>
                                            <span class="text-lg font-bold text-brand">₵{{ number_format($product->sale_price, 2) }}</span>
                                        @else
                                            <span class="text-lg font-bold text-brand">₵{{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </div>
                                    @if($product->average_rating > 0)
                                        <div class="flex items-center gap-1 text-sm text-yellow-500">
                                            <i class="fas fa-star"></i>
                                            <span class="text-slate-600">{{ round($product->average_rating, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-6 grid gap-3">
                                    <a href="{{ route('products.show', $product) }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                                        View Details
                                    </a>
                                    @if($product->is_available && $product->stock_quantity > 0)
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="w-full rounded-full bg-brand px-4 py-3 text-sm font-semibold text-white transition hover:bg-brand-dark">
                                                <i class="fas fa-shopping-cart mr-2"></i>
                                                Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="w-full rounded-full bg-slate-300 px-4 py-3 text-sm font-semibold text-slate-600">
                                            Sold Out
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="rounded-full bg-slate-100 p-6 mb-6">
                        <i class="fas fa-search text-4xl text-slate-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-2">No Products Found</h2>
                    <p class="text-slate-600 mb-6 max-w-md">Try adjusting your search filters or browse our full collection</p>
                    <a href="{{ route('products.index') }}" class="rounded-full bg-brand px-6 py-3 text-sm font-semibold text-white transition hover:bg-brand-dark">
                        View All Products
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Hijabis Plugg — Fashion, Accessories & Lifestyle')

@section('content')
    <section class="bg-gradient-to-br from-purple-600 via-fuchsia-600 to-pink-500 text-white overflow-hidden">
        <div class="page-container relative py-20">
            <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.5),_transparent_40%)]"></div>
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                <div class="relative z-10">
                    <span class="inline-flex rounded-full bg-white/15 px-4 py-2 text-sm font-semibold uppercase tracking-[0.2em] text-white shadow-lg shadow-black/10">Shop the latest collection</span>
                    <h1 class="mt-8 text-4xl font-bold tracking-tight sm:text-5xl xl:text-6xl">
                        Discover stylish outfits, accessories, and everyday essentials made for confident living.
                    </h1>
                    <p class="mt-6 max-w-xl text-lg leading-8 text-white/90">
                        Hijabis Plugg brings quality fashion and lifestyle products to your doorstep with seamless browsing, trusted checkout, and fast delivery.
                    </p>
                    <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                        <a href="{{ route('products.index') }}" class="btn-brand inline-flex items-center justify-center rounded-full px-8 py-3 text-sm font-semibold shadow-lg shadow-black/20 transition hover:shadow-xl">
                            Shop Now
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                        <a href="{{ route('products.index') }}#categories" class="inline-flex items-center justify-center rounded-full border border-white/30 bg-white/10 px-8 py-3 text-sm font-semibold text-white transition hover:bg-white/20">
                            Browse Categories
                        </a>
                    </div>
                    <div class="mt-12 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-3xl bg-white/10 px-5 py-6 text-center">
                            <p class="text-3xl font-bold">4.9/5</p>
                            <p class="mt-2 text-sm text-white/80">Customer rating</p>
                        </div>
                        <div class="rounded-3xl bg-white/10 px-5 py-6 text-center">
                            <p class="text-3xl font-bold">24h</p>
                            <p class="mt-2 text-sm text-white/80">Fast support</p>
                        </div>
                        <div class="rounded-3xl bg-white/10 px-5 py-6 text-center">
                            <p class="text-3xl font-bold">100+</p>
                            <p class="mt-2 text-sm text-white/80">Top products</p>
                        </div>
                    </div>
                </div>

                <div class="relative z-10">
                    <div class="rounded-[2rem] border border-white/10 bg-white/10 p-6 shadow-2xl shadow-black/20 backdrop-blur-xl">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl bg-white/95 p-6 text-slate-900">
                                <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Season offer</p>
                                <p class="mt-4 text-3xl font-bold">Up to 30% off</p>
                                <p class="mt-3 text-sm text-slate-600">On selected styles & trending essentials.</p>
                            </div>
                            <div class="rounded-3xl bg-gradient-to-br from-purple-700 to-fuchsia-700 p-6 text-white">
                                <p class="text-sm uppercase tracking-[0.2em] text-white/80">Exclusive</p>
                                <p class="mt-4 text-3xl font-bold">Spring Drop</p>
                                <p class="mt-3 text-sm text-white/80">Refresh your wardrobe with premium picks.</p>
                            </div>
                        </div>
                        <div class="mt-6 grid gap-4">
                            <div class="rounded-3xl bg-white/95 p-5">
                                <p class="text-sm text-slate-500">Free delivery</p>
                                <p class="mt-2 font-semibold">On orders over ₵250</p>
                            </div>
                            <div class="rounded-3xl bg-white/95 p-5">
                                <p class="text-sm text-slate-500">Secure checkout</p>
                                <p class="mt-2 font-semibold">Trusted payment options</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-highlight py-20">
        <div class="page-container">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand">Browse categories</p>
                    <h2 class="mt-4 text-3xl font-bold text-slate-900">Shop by category</h2>
                </div>
                <p class="max-w-xl text-sm text-slate-600">Explore curated categories crafted to help you shop faster and discover the perfect products.</p>
            </div>
            <div id="categories" class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-purple-100 text-purple-700 transition group-hover:bg-purple-200">
                            <i class="fas fa-layer-group text-xl"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-semibold text-slate-900">{{ $category->name }}</h3>
                        <p class="mt-3 text-sm text-slate-500">Browse {{ $category->products_count ?? 'popular' }} products</p>
                    </a>
                @empty
                    <div class="rounded-[1.5rem] border border-slate-200 bg-white p-8 text-center text-slate-500">No categories are available yet.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="page-container py-20">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand">Featured products</p>
                <h2 class="mt-4 text-3xl font-bold text-slate-900">Hand-picked just for you</h2>
            </div>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                View all products
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($featuredProducts as $product)
                <a href="{{ route('products.show', $product) }}" class="group overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    @if($product->main_image)
                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="h-64 w-full object-cover transition duration-500 group-hover:scale-105">
                    @else
                        <div class="flex h-64 items-center justify-center bg-slate-100 text-slate-400">
                            <i class="fas fa-image text-4xl"></i>
                        </div>
                    @endif
                    <div class="p-6">
                        <p class="text-sm uppercase tracking-[0.25em] text-slate-400">{{ $product->category->name ?? 'Category' }}</p>
                        <h3 class="mt-4 text-xl font-semibold text-slate-900">{{ $product->name }}</h3>
                        <div class="mt-4 flex items-center justify-between gap-4">
                            <span class="text-lg font-bold text-brand">₵{{ number_format($product->sale_price ?? $product->price, 2) }}</span>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-600">{{ $product->average_rating > 0 ? round($product->average_rating, 1) . '★' : 'New' }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="rounded-[1.75rem] border border-slate-200 bg-white p-10 text-center text-slate-500">No featured products available yet.</div>
            @endforelse
        </div>
    </section>

    <section class="bg-slate-950 text-white py-20">
        <div class="page-container grid gap-10 lg:grid-cols-3">
            <div class="rounded-[2rem] bg-white/5 p-10 shadow-2xl shadow-black/20">
                <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Trust matters</p>
                <h2 class="mt-6 text-3xl font-bold">Loved by our community</h2>
                <p class="mt-4 text-sm leading-7 text-slate-300">Shop with confidence thanks to real customer reviews, secure checkout, and quick support.</p>
            </div>
            <div class="grid gap-6 rounded-[2rem] bg-white/5 p-10 shadow-2xl shadow-black/20">
                <div class="flex items-center justify-between rounded-3xl bg-white/10 p-6">
                    <div>
                        <p class="text-3xl font-bold">98%</p>
                        <p class="text-sm text-slate-300">Satisfied customers</p>
                    </div>
                    <i class="fas fa-heart text-3xl text-pink-400"></i>
                </div>
                <div class="flex items-center justify-between rounded-3xl bg-white/10 p-6">
                    <div>
                        <p class="text-3xl font-bold">12k</p>
                        <p class="text-sm text-slate-300">Orders delivered</p>
                    </div>
                    <i class="fas fa-truck text-3xl text-violet-400"></i>
                </div>
            </div>
            <div class="grid gap-6 rounded-[2rem] bg-white/5 p-10 shadow-2xl shadow-black/20">
                <div class="rounded-3xl bg-slate-900/90 p-6 text-slate-200">
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Customer story</p>
                    <p class="mt-4 text-lg font-semibold">"I found everything I needed in one place — fast delivery and beautiful quality."</p>
                </div>
                <div class="rounded-3xl bg-slate-900/90 p-6 text-slate-200">
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Trust score</p>
                    <p class="mt-4 text-lg font-semibold">99.8% secure payments</p>
                </div>
            </div>
        </div>
    </section>

    <section class="page-container py-20">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-12 shadow-xl">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-brand">Ready to shop?</p>
                    <h2 class="mt-4 text-4xl font-bold text-slate-900">Start your next wardrobe refresh today.</h2>
                    <p class="mt-6 max-w-xl text-sm leading-7 text-slate-600">Get fast checkout, real-time order tracking, and hand-selected products designed for modern everyday style.</p>
                </div>
                <a href="{{ route('products.index') }}" class="self-start rounded-full bg-brand px-8 py-4 text-sm font-semibold text-white transition hover:bg-brand-dark">Browse the collection</a>
            </div>
        </div>
    </section>
@endsection

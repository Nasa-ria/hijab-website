@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="page-container py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center gap-2 text-sm text-slate-600">
            <li><a href="{{ route('home') }}" class="hover:text-brand transition">Home</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('products.index') }}" class="hover:text-brand transition">Products</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-brand transition">{{ $product->category->name }}</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-slate-900 font-medium">{{ Str::limit($product->name, 40) }}</li>
        </ol>
    </nav>

    <div class="grid gap-12 lg:grid-cols-2 mb-16">
        <!-- Product Images -->
        <div class="space-y-4">
            <div class="relative overflow-hidden rounded-2xl bg-slate-100">
                @if($product->main_image)
                    <img id="mainImage" src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-96 lg:h-[500px] object-cover">
                @else
                    <div class="w-full h-96 lg:h-[500px] flex items-center justify-center text-slate-400">
                        <i class="fas fa-image text-6xl"></i>
                    </div>
                @endif
                @if(!$product->is_available)
                    <div class="absolute inset-0 flex items-center justify-center bg-black/60">
                        <span class="rounded-full bg-red-500 px-6 py-3 text-sm font-semibold text-white">Sold Out</span>
                    </div>
                @endif
                @if($product->sale_price)
                    <div class="absolute top-4 right-4 rounded-full bg-red-500 px-4 py-2 text-sm font-semibold text-white">
                        Sale
                    </div>
                @endif
            </div>

            @if($product->images->count() > 0)
                <div class="flex gap-3 overflow-x-auto pb-2">
                    @foreach($product->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product" class="w-20 h-20 object-cover rounded-lg cursor-pointer border-2 border-transparent hover:border-brand transition" onclick="document.getElementById('mainImage').src = this.src">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <div class="space-y-6">
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-2">{{ $product->name }}</h1>
                <div class="flex items-center gap-4 mb-4">
                    @if($product->average_rating > 0)
                        <div class="flex items-center gap-2">
                            <div class="flex text-yellow-500">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < round($product->average_rating))
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-sm text-slate-600 font-medium">{{ round($product->average_rating, 1) }} ({{ $product->total_reviews }} reviews)</span>
                        </div>
                    @else
                        <span class="text-sm text-slate-500">No reviews yet</span>
                    @endif
                </div>
            </div>

            <!-- Pricing -->
            <div class="flex items-center gap-4">
                @if($product->sale_price)
                    <span class="text-3xl font-bold text-brand">₵{{ number_format($product->sale_price, 2) }}</span>
                    <span class="text-xl text-slate-500 line-through">₵{{ number_format($product->price, 2) }}</span>
                    <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-600">
                        {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                    </span>
                @else
                    <span class="text-3xl font-bold text-brand">₵{{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            <!-- Stock Status -->
            <div class="flex items-center gap-2">
                @if($product->is_available && $product->stock_quantity > 0)
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="text-green-600 font-medium">In Stock ({{ $product->stock_quantity }} available)</span>
                @else
                    <i class="fas fa-times-circle text-red-500"></i>
                    <span class="text-red-600 font-medium">Out of Stock</span>
                @endif
            </div>

            <!-- Description -->
            <div>
                <h3 class="font-semibold text-slate-900 mb-3">Description</h3>
                <p class="text-slate-600 leading-relaxed">{{ $product->description }}</p>
            </div>

            <!-- Add to Cart -->
            @if($product->is_available && $product->stock_quantity > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center border border-slate-200 rounded-xl overflow-hidden">
                            <button type="button" onclick="decreaseQty()" class="px-4 py-3 text-slate-600 hover:bg-slate-50 transition">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="w-16 text-center py-3 border-x border-slate-200" readonly>
                            <button type="button" onclick="increaseQty({{ $product->stock_quantity }})" class="px-4 py-3 text-slate-600 hover:bg-slate-50 transition">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <button type="submit" class="flex-1 bg-brand text-black px-8 py-3 rounded-xl font-semibold hover:bg-brand-dark transition flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-cart"></i>
                            Add to Cart
                        </button>
                    </div>
                </form>
            @else
                <button disabled class="w-full bg-slate-300 text-slate-500 px-8 py-3 rounded-xl font-semibold cursor-not-allowed">
                    Out of Stock
                </button>
            @endif

            <!-- Share -->
            <div class="border-t border-slate-200 pt-6">
                <p class="text-slate-600 font-medium mb-4">Share this product:</p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <section class="mb-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-900">Customer Reviews</h2>
            @if($product->approvedReviews->count() > 0)
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <div class="flex text-yellow-500">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < round($product->average_rating))
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span>{{ round($product->average_rating, 1) }} ({{ $product->total_reviews }} reviews)</span>
                </div>
            @endif
        </div>

        @auth
            <!-- Review Form -->
            <div class="bg-white border border-slate-200 rounded-2xl p-8 mb-8">
                <h3 class="font-semibold text-slate-900 mb-6">Write a Review</h3>
                @if($userReview)
                    <form action="{{ route('reviews.update', $userReview) }}" method="POST">
                        @method('PUT')
                    @else
                    <form action="{{ route('reviews.store', $product) }}" method="POST">
                @endif
                    @csrf
                    <div class="mb-6">
                        <label class="block font-medium text-slate-900 mb-3">Rating</label>
                        <div class="flex gap-2 text-2xl">
                            @for($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="hidden"
                                    {{ $userReview && $userReview->rating == $i ? 'checked' : '' }}>
                                <label for="star{{ $i }}" class="cursor-pointer text-slate-300 hover:text-yellow-500 transition">
                                    <i class="fas fa-star"></i>
                                </label>
                            @endfor
                        </div>
                        @error('rating')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-slate-900 mb-3">Title (Optional)</label>
                        <input type="text" name="title" placeholder="Review title" value="{{ $userReview?->title }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition">
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-slate-900 mb-3">Comment</label>
                        <textarea name="comment" placeholder="Share your experience with this product" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition" rows="5">{{ $userReview?->comment }}</textarea>
                        @error('comment')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="rounded-xl bg-brand px-6 py-3 text-sm font-semibold text-black transition hover:bg-brand-dark">
                        {{ $userReview ? 'Update Review' : 'Submit Review' }}
                    </button>
                </form>
            </div>
        @else
            <div class="bg-brand/5 border border-brand/20 rounded-2xl px-6 py-4 mb-8">
                <p class="text-brand">
                    <a href="{{ route('login') }}" class="font-semibold hover:underline">Log in</a> to leave a review
                </p>
            </div>
        @endauth

        <!-- Reviews List -->
        @if($product->approvedReviews->count() > 0)
            <div class="space-y-6">
                @foreach($product->approvedReviews as $review)
                    <div class="bg-white border border-slate-200 rounded-2xl p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center">
                                    <span class="text-brand font-semibold text-sm">{{ substr($review->user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $review->user->name }}</p>
                                    <div class="flex items-center gap-2 text-sm text-slate-600">
                                        <div class="flex text-yellow-500">
                                            @for($i = 0; $i < $review->rating; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                            @for($i = $review->rating; $i < 5; $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                        </div>
                                        <span>{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($review->title)
                            <h4 class="font-semibold text-slate-900 mb-2">{{ $review->title }}</h4>
                        @endif

                        <p class="text-slate-600 mb-4">{{ $review->comment }}</p>

                        @if($review->admin_reply)
                            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-lg p-4">
                                <p class="font-semibold text-blue-900 mb-1">Admin Reply:</p>
                                <p class="text-blue-800">{{ $review->admin_reply }}</p>
                            </div>
                        @endif

                        @if(auth()->check() && auth()->id() === $review->user_id)
                            <div class="flex gap-2 mt-4 pt-4 border-t border-slate-200">
                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="rounded-full bg-slate-100 p-6 mb-6 inline-block">
                    <i class="fas fa-comments text-4xl text-slate-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-2">No reviews yet</h3>
                <p class="text-slate-600">Be the first to review this product!</p>
            </div>
        @endif
    </section>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-8">Related Products</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($relatedProducts as $related)
                    <a href="{{ route('products.show', $related) }}" class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="relative h-48 overflow-hidden bg-slate-100">
                            @if($related->main_image)
                                <img src="{{ asset('storage/' . $related->main_image) }}" alt="{{ $related->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center text-slate-400">
                                    <i class="fas fa-image text-3xl"></i>
                                </div>
                            @endif
                            @if(!$related->is_available)
                                <div class="absolute inset-0 flex items-center justify-center bg-black/60">
                                    <span class="rounded-full bg-red-500 px-4 py-2 text-xs font-semibold text-white">Sold Out</span>
                                </div>
                            @endif
                            @if($related->sale_price)
                                <div class="absolute top-3 right-3 rounded-full bg-red-500 px-3 py-1 text-xs font-semibold text-white">
                                    Sale
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mb-1">{{ $related->category->name ?? 'Category' }}</p>
                            <h3 class="text-sm font-semibold text-slate-900 group-hover:text-brand transition line-clamp-2">{{ $related->name }}</h3>
                            <div class="mt-3 flex items-center justify-between">
                                <div class="flex flex-col">
                                    @if($related->sale_price)
                                        <span class="text-xs text-slate-500 line-through">₵{{ number_format($related->price, 2) }}</span>
                                        <span class="text-sm font-bold text-brand">₵{{ number_format($related->sale_price, 2) }}</span>
                                    @else
                                        <span class="text-sm font-bold text-brand">₵{{ number_format($related->price, 2) }}</span>
                                    @endif
                                </div>
                                @if($related->average_rating > 0)
                                    <div class="flex items-center gap-1 text-xs text-yellow-500">
                                        <i class="fas fa-star"></i>
                                        <span class="text-slate-600">{{ round($related->average_rating, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>

<script>
    function increaseQty(max) {
        const qty = document.getElementById('quantity');
        if (parseInt(qty.value) < max) {
            qty.value = parseInt(qty.value) + 1;
        }
    }

    function decreaseQty() {
        const qty = document.getElementById('quantity');
        if (parseInt(qty.value) > 1) {
            qty.value = parseInt(qty.value) - 1;
        }
    }

    // Star rating display
    document.querySelectorAll('input[name="rating"]').forEach(input => {
        const label = document.querySelector(`label[for="${input.id}"]`);
        label.addEventListener('click', () => {
            document.querySelectorAll('input[name="rating"]').forEach((inp, idx) => {
                const lbl = document.querySelector(`label[for="${inp.id}"]`);
                if (idx < parseInt(input.value)) {
                    lbl.classList.add('text-yellow-500');
                    lbl.classList.remove('text-slate-300');
                } else {
                    lbl.classList.remove('text-yellow-500');
                    lbl.classList.add('text-slate-300');
                }
            });
        });
    });

    // Initial star display
    const checkedRating = document.querySelector('input[name="rating"]:checked');
    if (checkedRating) {
        const ratingValue = parseInt(checkedRating.value);
        document.querySelectorAll('input[name="rating"]').forEach((inp, idx) => {
            const lbl = document.querySelector(`label[for="${inp.id}"]`);
            if (idx < ratingValue) {
                lbl.classList.add('text-yellow-500');
                lbl.classList.remove('text-slate-300');
            }
        });
    }
</script>
@endsection

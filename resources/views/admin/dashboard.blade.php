@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')

@section('content')
<div class="page-container py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Admin Dashboard</h1>
        <p class="mt-2 text-slate-600">Welcome back! Here's what's happening with your store.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 mb-8">
        <!-- Total Products -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600 font-medium">Total Products</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $totalProducts }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-box text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600 font-medium">Total Orders</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $totalOrders }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600 font-medium">Total Revenue</p>
                    <p class="text-2xl font-bold text-slate-900">₵{{ number_format($totalRevenue, 2) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending Items -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600 font-medium">Pending Items</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $pendingOrders + $pendingReviews }}</p>
                    <p class="text-xs text-slate-500">{{ $pendingOrders }} orders, {{ $pendingReviews }} reviews</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-2">
        <!-- Recent Orders -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-900">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-brand hover:text-brand-dark font-medium text-sm transition">
                    View All →
                </a>
            </div>

            @if($recentOrders->count() > 0)
                <div class="space-y-4">
                    @foreach($recentOrders as $order)
                        <div class="flex items-center justify-between py-3 border-b border-slate-100 last:border-b-0">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center">
                                    <span class="text-slate-600 font-semibold text-sm">{{ substr($order->user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900">{{ $order->user->name }}</p>
                                    <p class="text-sm text-slate-600">Order #{{ $order->id }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-slate-900">₵{{ number_format($order->total_amount, 2) }}</p>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-shopping-cart text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-600">No orders yet</p>
                </div>
            @endif
        </div>

        <!-- Top Products -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-slate-900">Top Products</h2>
                <a href="{{ route('admin.products.index') }}" class="text-brand hover:text-brand-dark font-medium text-sm transition">
                    View All →
                </a>
            </div>

            @if($topProducts->count() > 0)
                <div class="space-y-4">
                    @foreach($topProducts as $product)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                @if($product->main_image)
                                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-slate-400 text-sm"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-slate-900 line-clamp-1">{{ $product->name }}</p>
                                <p class="text-sm text-slate-600">{{ $product->total_reviews }} reviews</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-slate-900">₵{{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-box text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-600">No products yet</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 bg-white border border-slate-200 rounded-2xl p-6">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Quick Actions</h2>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <button type="button" onclick="openModal('createProductModal')" class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-brand hover:bg-brand/5 transition">
                <div class="w-10 h-10 rounded-lg bg-brand/10 flex items-center justify-center">
                    <i class="fas fa-plus text-brand"></i>
                </div>
                <div>
                    <p class="font-medium text-slate-900">Add Product</p>
                    <p class="text-sm text-slate-600">Create new product</p>
                </div>
            </button>

            <button type="button" onclick="openModal('createCategoryModal')" class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-brand hover:bg-brand/5 transition">
                <div class="w-10 h-10 rounded-lg bg-brand/10 flex items-center justify-center">
                    <i class="fas fa-tags text-brand"></i>
                </div>
                <div>
                    <p class="font-medium text-slate-900">Add Category</p>
                    <p class="text-sm text-slate-600">Create new category</p>
                </div>
            </button>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-brand hover:bg-brand/5 transition">
                <div class="w-10 h-10 rounded-lg bg-brand/10 flex items-center justify-center">
                    <i class="fas fa-list text-brand"></i>
                </div>
                <div>
                    <p class="font-medium text-slate-900">Manage Orders</p>
                    <p class="text-sm text-slate-600">View all orders</p>
                </div>
            </a>

            <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-3 p-4 rounded-xl border border-slate-200 hover:border-brand hover:bg-brand/5 transition">
                <div class="w-10 h-10 rounded-lg bg-brand/10 flex items-center justify-center">
                    <i class="fas fa-star text-brand"></i>
                </div>
                <div>
                    <p class="font-medium text-slate-900">Manage Reviews</p>
                    <p class="text-sm text-slate-600">Approve reviews</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Create Product Modal -->
    <div id="createProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-4xl overflow-hidden rounded-3xl bg-white shadow-2xl">
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
                <h2 class="text-xl font-semibold text-slate-900">Add Product</h2>
                <button type="button" onclick="closeModal('createProductModal')" class="text-slate-500 hover:text-slate-900 transition">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <div class="p-6 max-h-[80vh] overflow-y-auto">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold mb-2">Product Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            @error('name')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block font-bold mb-2">Category</label>
                            <select name="category_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="block font-bold mb-2">Short Description</label>
                        <input type="text" name="short_description" value="{{ old('short_description') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                        @error('short_description')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block font-bold mb-2">Description</label>
                        <textarea name="description" rows="6" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">{{ old('description') }}</textarea>
                        @error('description')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block font-bold mb-2">Price</label>
                            <input type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            @error('price')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block font-bold mb-2">Sale Price</label>
                            <input type="number" name="sale_price" step="0.01" min="0" value="{{ old('sale_price') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            @error('sale_price')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block font-bold mb-2">Stock Quantity</label>
                            <input type="number" name="stock_quantity" min="0" value="{{ old('stock_quantity', 0) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            @error('stock_quantity')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold mb-2">Main Image</label>
                            <input type="file" name="main_image" class="w-full">
                            @error('main_image')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block font-bold mb-2">Additional Images</label>
                            <input type="file" name="images[]" multiple class="w-full">
                            @error('images.*')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-purple-700 transition">Save Product</button>
                        <button type="button" onclick="closeModal('createProductModal')" class="rounded-lg border border-slate-300 px-6 py-3 hover:bg-slate-50 transition">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div id="createCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl overflow-hidden rounded-3xl bg-white shadow-2xl">
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
                <h2 class="text-xl font-semibold text-slate-900">Add Category</h2>
                <button type="button" onclick="closeModal('createCategoryModal')" class="text-slate-500 hover:text-slate-900 transition">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <div class="p-6 max-h-[80vh] overflow-y-auto">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block font-bold mb-2">Category Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                        @error('name')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block font-bold mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg">{{ old('description') }}</textarea>
                        @error('description')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block font-bold mb-2">Category Image</label>
                        <input type="file" name="image" class="w-full">
                        @error('image')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-purple-700 transition">Create Category</button>
                        <button type="button" onclick="closeModal('createCategoryModal')" class="rounded-lg border border-slate-300 px-6 py-3 hover:bg-slate-50 transition">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (!modal) return;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
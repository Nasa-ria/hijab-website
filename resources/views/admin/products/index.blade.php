@extends('layouts.admin')

@section('title', 'Manage Products')
@section('page_title', 'Manage Products')

@section('content')
<div class="page-container py-8">
    @section('page_actions')
        <button type="button" onclick="openModal('createProductModal')" class="rounded-full bg-brand px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-brand/10 transition hover:bg-brand-dark">
            <i class="fas fa-plus mr-2"></i>
            Add Product
        </button>
    @endsection

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

    <!-- Header -->
    <div class="mb-8">
        <div>
            <h2 class="text-lg font-semibold text-slate-600 uppercase tracking-[0.24em] mb-2">Catalog</h2>
            <h1 class="text-3xl font-bold text-slate-900">Manage Products</h1>
            <p class="mt-2 text-slate-600">View and manage all products in your store.</p>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="mb-6 rounded-2xl bg-white border border-slate-200 p-6">
        <form method="GET" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 transition">
            </div>
            <button type="submit" class="rounded-xl bg-slate-100 px-6 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
                <i class="fas fa-search mr-2"></i>
                Search
            </button>
        </form>
    </div>

    <!-- Products Table -->
    <div class="rounded-2xl bg-white border border-slate-200 overflow-hidden">
        @if($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Product</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Category</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Price</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Stock</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($products as $product)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                            @if($product->main_image)
                                                <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-image text-slate-400 text-sm"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-900 line-clamp-1">{{ $product->name }}</p>
                                            <p class="text-sm text-slate-600">{{ $product->total_reviews }} reviews</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                        {{ $product->category->name ?? 'No Category' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm">
                                        @if($product->sale_price)
                                            <p class="font-semibold text-brand">₵{{ number_format($product->sale_price, 2) }}</p>
                                            <p class="text-slate-500 line-through">₵{{ number_format($product->price, 2) }}</p>
                                        @else
                                            <p class="font-semibold text-slate-900">₵{{ number_format($product->price, 2) }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium {{ $product->stock_quantity > 10 ? 'text-green-600' : ($product->stock_quantity > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                                        {{ $product->stock_quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $product->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->is_available ? 'Available' : 'Unavailable' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-slate-600 hover:text-brand transition">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-600 hover:text-red-600 transition">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="rounded-full bg-slate-100 p-6 mb-6 inline-block">
                    <i class="fas fa-box text-4xl text-slate-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-2">No products found</h3>
                <p class="text-slate-600 mb-8">Get started by adding your first product</p>
                <button type="button" onclick="openModal('createProductModal')" class="inline-block bg-brand text-white px-6 py-3 rounded-xl font-semibold hover:bg-brand-dark transition">
                    <i class="fas fa-plus mr-2"></i>
                    Add Your First Product
                </button>
            </div>
        @endif
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
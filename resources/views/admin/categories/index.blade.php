@extends('layouts.admin')

@section('page_title', 'Categories')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Categories</h1>
    <button type="button" onclick="openModal('createCategoryModal')" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
        <i class="fas fa-plus mr-2"></i>Add Category
    </button>
</div>

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

@if($categories->count() > 0)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($category->description, 60) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $category->products()->count() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($category->is_active)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Active</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete category?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
@else
    <div class="bg-white rounded-lg shadow-md p-12 text-center">
        <i class="fas fa-list text-6xl text-gray-300 mb-4"></i>
        <h2 class="text-2xl font-bold text-gray-600 mb-2">No categories yet</h2>
        <p class="text-gray-500">Create a new category to group your products.</p>
    </div>
@endif

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
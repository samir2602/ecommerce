@extends('layouts.app')

@section('title', 'Edit Product - Admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">✏️ Edit Product</div>
                <div class="card-body p-4">
                    <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <p class="mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Price ($)</label>
                                <input type="number" name="price" class="form-control" value="{{ $product->price }}" step="0.01" min="0" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Stock</label>
                                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" min="0" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Product Image</label>
                            @if($product->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $product->image) }}" style="width:100px;height:100px;object-fit:cover;" class="rounded">
                                    <small class="text-muted ms-2">Current image</small>
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*" />
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $product->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (visible to customers)</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Product</button>
                            <a href="/admin/products" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
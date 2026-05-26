@extends('layouts.app')

@section('title', 'Manage Categories - Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">🏷️ Manage Categories</h2>
        <a href="/admin/categories/create" class="btn btn-primary">+ Add Category</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="fw-semibold">{{ $category->name }}</td>
                        <td><small class="text-muted">{{ $category->slug }}</small></td>
                        <td>{{ Str::limit($category->description, 50)}}</td>
                        <td><span class="badge bg-primary">{{ $category->product_count}}</span></td>
                        <td>
                            <a href="/admin/categories/{{ $category->id }}/edit" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form method="POST" action="/admin/categories/{{ $category->id }}" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No categories found</td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>
    </div>
    {{ $categories->links() }}
@endsection
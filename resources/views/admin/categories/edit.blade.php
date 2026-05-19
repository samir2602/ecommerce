@extends('layouts.app')

@section('title', '')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">✏️ Edit Category</div>
                <div class="card-body p-4">
                    <form method="POST" action="/admin/categories/{{ $category->id }}">
                        @csrf
                        @method('PUT')

                        @if($errors->any())
                            @foreach ($error->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                            <a href="/admin/categories" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
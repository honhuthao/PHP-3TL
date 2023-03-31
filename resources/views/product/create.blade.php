@extends('layout.dashboard')
@section('content')
    <form action="/dashboard/product/create/store" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="card-header py-3">
                    <h5 class="mb-0 text-center"><strong>Product</strong></h5>
                </div>
                <!-- Name input -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-outline mb-4">
                    <input name="name" type="text" id="form7Example1" class="form-control" />
                    <label class="form-label" for="form7Example1">Name</label>
                </div>
                <!-- Category input -->
                <div>
                    {{-- label for select --}}
                    <label for="categorySelect">Category</label>
                    {{-- select --}}
                    <select id="categorySelect" class="form-control mb-4" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                </div>
                <!-- Slug input -->
                <div class="form-outline mb-4">
                    <input name="slug" id="form7Example2" class="form-control" />
                    <label class="form-label" for="form7Example2">Slug</label>
                </div>
                <!-- Description input -->
                <div class="form-outline mb-4">
                    <input name="description" id="form7Example2" class="form-control" />
                    <label class="form-label" for="form7Example2">Description</label>
                </div>
                <!-- Image input -->
                <div class="form-outline mb-4">
                    <input name="image" id="form7Example2" class="form-control" />
                    <label class="form-label" for="form7Example2">Image</label>
                </div>
                <!-- Price input -->
                <div class="form-outline mb-4">
                    <input name="price" min="0" type="number" id="form7Example2" class="form-control" />
                    <label class="form-label" for="form7Example2">Price</label>
                </div>
                <!-- Discount input -->
                <div class="form-outline mb-4">
                    <input name="discount" min="0" type="number" id="form7Example2" class="form-control" />
                    <label class="form-label" for="form7Example2">Discount</label>
                </div>
                <!-- Stock input -->
                <div class="form-outline mb-4">
                    <input name="stock" min="0" type="number" id="form7Example2" class="form-control" />
                    <label class="form-label" for="form7Example2">Stock</label>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
@endsection

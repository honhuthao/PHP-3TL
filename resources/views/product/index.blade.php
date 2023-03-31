@extends('layout.dashboard')

@section('title', 'Login')

@section('content')
    <section class="mb-4">
        {{-- add button on the right that lead to a new page --}}
        <div class="d-flex justify-content-end">
            <a href="/dashboard/product/create" class="btn btn-primary">
                Add</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-header py-3">
                    <h5 class="mb-0 text-center"><strong>Product</strong></h5>
                </div>

                <div class="card-body p-0">
                    <table class="table align-middle mb-0 bg-white table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr data-id="{{ $product->id }}">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td><img src="{{ $product->image }}" alt="image">
                                    </td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a href="/dashboard/product/edit/{{ $product->id }}"
                                            class="btn btn-link btn-sm btn-rounded">
                                            Edit
                                        </a>
                                        <form action="" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="deleteProduct({{ $product->id }})" type="button"
                                                class="btn btn-link btn-sm btn-rounded text-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        //delete product
        function deleteProduct(id) {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: '/dashboard/product/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        //update html
                        $('tr[data-id="' + id + '"]').remove();
                    }
                });
            }
        }
    </script>
@endsection

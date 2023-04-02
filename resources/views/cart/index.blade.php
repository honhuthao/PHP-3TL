@extends('layout.main')
@section('title', 'Your cart')

@section('content')
    <section class="mb-4 pt-5">
        <div class="card">
            <div class="card-body">
                <div class="card-header py-3">
                    <h5 class="mb-0 text-center"><strong>Your cart</strong></h5>
                </div>
                <div class="card-body p-0">
                    <table class="table align-middle mb-0 bg-white table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- if cart is null display nothing --}}
                            @if ($cart == null)
                                <tr>
                                    <td colspan="7" class="text-center">Cart is empty</td>
                                </tr>
                            @else
                                @foreach ($cart as $item)
                                    <tr data-id="{{ $item['id'] }}">
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td><img src="{{ $item['image'] }}" alt="image">
                                        </td>
                                        <td>{{ $item['price'] }}</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="number" class="form-control" value="{{ $item['quantity'] }}">
                                                <button onclick="updateQuantity(this)"
                                                    class="btn btn-primary">Update</button>
                                            </div>
                                        </td>
                                        <td>{{ $item['quantity'] * $item['price'] }}</td>
                                        <td>
                                            <button onclick="deleteItem(this)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    {{-- add a checkout button on the right --}}
                    <div class="d-flex justify-content-end mt-3 p-3">
                        <a onclick="deleteAll()" class="btn btn-danger me-3">
                            Delete cart</a>
                        <a href="/checkout" class="btn btn-primary">
                            Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function updateQuantity(element) {
            const quantity = element.previousElementSibling.value;
            const id = element.parentElement.parentElement.parentElement.dataset.id;
            $.ajax({
                url: '/cart/update',
                type: 'POST',
                data: {
                    id: id,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });
        }

        function deleteItem(element) {
            const id = element.parentElement.parentElement.dataset.id;
            $.ajax({
                url: '/cart/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });
        }

        function deleteAll() {
            $.ajax({
                url: '/cart/deleteall',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    iziToast.success({
                        title: 'Success',
                        message: 'Delete cart successfully',
                    });
                    window.location.href = '/';
                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });
        }
    </script>
@endsection

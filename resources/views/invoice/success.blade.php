@extends('layout.main')
@section('title', 'Main Pages')

@section('content')

    <section class="mb-4 pt-5">
        <div class="card">
            <div class="card-body">
                <div class="card-header py-3">
                    <h2 class="mb-0 text-center"><strong>Place order successfully</strong></h2>
                </div>
                <?php $total = 0; ?>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->products as $product)
                                <tr data-id="{{ $product->id }}">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td><img src="{{ $product->image }}" alt="image">
                                    </td>
                                    <td><u>đ</u> {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        {{ $product->pivot->quantity }}
                                    </td>
                                    <td><u>đ</u> {{ $product->pivot->quantity * $product->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <?php $total += $product->pivot->quantity * $product->price; ?>
                </div>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong><u>đ</u> {{ $total }}</strong>
                </li>

                <a href="/">Back to home page</a>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            Swal.fire(
                'Success!',
                'Place your order successfully!',
                'success'
            );
        });
    </script>
@endsection

@extends('layout.main')
@section('title', 'Main Pages')

@section('content')
    <!--Main layout-->
    <main class="mt-5 pt-4">
        <div class="container">
            <!-- Heading -->
            <h2 class="my-5 text-center">Checkout form</h2>

            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-8 mb-4">
                    <!--Card-->
                    <div class="card p-4">

                        <form method="POST" id="checkout-form" action="/checkout">
                            @csrf
                            <!--address-->
                            <p class="mb-0">
                                Address
                            </p>
                            <div class="form-outline mb-4">
                                <input type="text" class="form-control" name="address"
                                    value="{{ $customer ? $customer->address : '' }}" />
                            </div>

                            <!--address-2-->
                            <p class="mb-0">
                                Phone
                            </p>
                            <div class="form-outline mb-4">
                                <input type="text" class="form-control" name="phone"
                                    value="{{ $customer ? $customer->phone : '' }}" />
                            </div>

                            {{-- note --}}
                            <p class="mb-0">
                                Note
                            </p>
                            <div class="form-outline mb-4">
                                <textarea class="form-control" rows="4"></textarea>
                            </div>

                            {{-- checkbox to save info --}}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="save_info" />
                                <label class="form-check-label" for="flexCheckDefault">Save info</label>
                            </div>

                        </form>


                        <div class="my-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1" checked />
                                <label class="form-check-label" for="flexRadioDefault1"> Paypal </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2" />
                                <label class="form-check-label" for="flexRadioDefault2"> Cash on delivery </label>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" form="checkout-form">Place order</button>
                    </div>
                    <!--/.Card-->
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <!-- Heading -->
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                    </h4>

                    <!-- Cart -->
                    <ul class="list-group mb-3">
                        <?php $total = 0; ?>
                        @foreach ($cart as $item)
                            <?php $total += $item['price'] * $item['quantity']; ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <h6 class="my-0">{{ $item['name'] }}</h6>
                                    <small class="text-muted">{{ $item['quantity'] }}</small>
                                </div>
                                <span class="text-muted">{{ $item['price'] * $item['quantity'] }}</span>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>{{ $total }}</strong>
                        </li>
                    </ul>
                    <!-- Cart -->

                    <!-- Promo code -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Promo code" aria-label="Promo code"
                            aria-describedby="button-addon2" />
                        <button class="btn btn-primary" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                            redeem
                        </button>
                    </div>
                    <!-- Promo code -->
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
    </main>
    <!--Main layout-->
@endsection

@section('js')
    <script>
        //pressed the button
    </script>
@endsection

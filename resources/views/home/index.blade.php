@extends('layout.main')
@section('title', 'Main Pages')

@section('content')
    <section class="mb-4">

        {{-- Carousel --}}
        <div id="carouselExampleCaptions" class="carousel slide" data-mdb-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" style="height:auto">
                    <img src="https://assets2.razerzone.com/images/pnx.assets/4b93db266e7ee65c3a25a5ae582ed586/razer-affiliate-hero-mobile.jpg"
                        class="d-block w-100" alt="Wild Landscape" />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>RAZER</h5>
                        <p>By gamer For gamer</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://pbs.twimg.com/media/EhKcgO2XsAAu_4Y.jpg:large" class="d-block w-100" alt="Camera" />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Logitech</h5>
                        <p>Play your way</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/fe975933229345.56a557b7c9e9d.jpg"
                        class="d-block w-100" alt="Exotic Fruits" />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Steelseries</h5>
                        <p>Improve your game Winning is everything</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleCaptions"
                data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleCaptions"
                data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        {{-- End carousel --}}
        <div class="card">
            <div class="card-header py-3">
                <h1 class="mb-0 text-center"><strong>Product Catalog</strong></h1>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($products as $product)
                        <div class="col-3">
                            <div class="card">
                                <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp" class="card-img-top"
                                    alt="Hollywood Sign on The Hill" />
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">
                                        {{ strlen($product->description) > 25 ? substr($product->description, 0, 25) . '...' : $product->description }}
                                    </p>
                                </div>
                                <div class="card-footer d-flex" style="justify-content: space-between">
                                    <a href=""><u>đ</u> {{ number_format($product->price, 0, ',', '.') }}</a>
                                    <button type="button" class="btn btn-success"
                                        onclick="addToCart({{ $product->id }})">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <nav aria-label="Page navigation example" style="margin-right:5px; padding-top:15px;">
                <ul class="pagination justify-content-end">
                    <li class="page-item {{ $products->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1"
                            aria-disabled="{{ $products->previousPageUrl() ? 'false' : 'true' }}">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }} "><a class="page-link"
                                href="{{ $products->url($i) }}">{{ $i }}</a></li>
                    @endfor
                    <li class="page-item {{ $products->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $products->nextPageUrl() }}"
                            aria-disabled="{{ $products->nextPageUrl() ? 'false' : 'true' }}">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
    </section>
@endsection
@section('js')
    <script>
        //add to cart using ajax
        function addToCart(id) {
            $.ajax({
                url: '/cart/add/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {
                    console.log(data);
                    updateCartCount();
                    iziToast.success({
                        title: 'Success',
                        message: 'Product added to cart',
                    });
                    
                }

            });
        }
        $(document).ready(function() {
            updateCartCount();
        });

        function updateCartCount() {
            $.ajax({
                url: '/cart/count',
                method: 'GET',
                success: function(response) {
                    $('#cart-count').html(response.count);
                }
            });
        }
    </script>

@endsection

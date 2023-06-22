@extends('layouts.landing')


@section('content')
<!-- Carousel-->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($sliders as $slider)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->iteration - 1 }}" class="{{ $loop->first ? 'active' : '' }}"
                aria-current="{{ $loop->first ? 'true' : '' }}" aria-label="Slide 1"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($sliders as $slider)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="3000">
                <img src="{{ asset('storage/slider/' . $slider->image) }}" class="d-block w-100" alt="{{ $slider->image }}">
                <div class="carousel-caption d-none d-md-block" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3))">
                    <h5>{{ $slider->title }}</h5>
                    <p>{{ $slider->caption }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- Section-->
<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        {{-- Search --}}
        <form action="{{ route('landing.index') }}" method="GET">
            @csrf
            <div class="row g-3 mb-4">
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Min" name="min" value="{{ old('min') }}">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Max" name="max" value="{{ old('max') }}">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-dark">Terapkan</button>
                </div>
                <div class="col-sm-3 offset-1">
                    @if (Session::get('success'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </form>
        <hr>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @forelse ($products as $product)
                <div class="col mb-5">
                    <a href="{{ route('landing.detail', ['id' => $product->id]) }}" style="text-decoration: none" class="text-dark card-hover">
                        <div class="card h-100">
                            @if ($product['sale_price'] != 0)
                                <!-- Sale badge-->
                                <div class="badge bg-success text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            @endif

                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset('storage/product/' . $product->image) }}" alt="{{ $product->name }}" />

                            <!-- Product details-->
                            <div class="card-body p-4 pt-2">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 style="text-decoration: none" class="text-dark">
                                        <h5 class="fw-bolder">{{ $product->name }}</h5>
                                    </h5>
                                    <small>{{ $product->category->name }}</small>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        @for ($i = 0; $i < $product->rating; $i++)
                                            <div class="bi-star-fill"></div>
                                        @endfor
                                    </div>
                                    <!-- Product price-->
                                    @if ($product['sale_price'] != 0)
                                        <span class="text-muted text-decoration-line-through">Rp.{{ number_format($product->price, 0) }}</span>
                                        Rp.{{ number_format($product->sale_price, 0) }}
                                    @else
                                        Rp.{{ number_format($product->price, 0) }}
                                    @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <form action="{{ route('cart.add-landing', $product->id) }}" method="post">
                                    @csrf
                                    <input class="form-control text-center me-3" id="inputQuantity" type="hidden" value="1" style="max-width: 3rem" name="total"/>
                                    <div class="text-center"><button type="submit" class="btn btn-outline-dark mt-auto" href="#">Add to chart</button></div>
                                </form>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="alert alert-secondary w-100 text-center" role="alert">
                    <h4>Produk belum tersedia</h4>
                </div>
            @endforelse

        </div>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection

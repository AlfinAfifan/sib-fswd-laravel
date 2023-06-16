@extends('layouts.landing')


@section('content')
<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/product/'.$product->image) }}" alt="..." /></div>
            <div class="col-md-6">
                <div class="small mb-1">{{ $product->category->name }}</div>
                <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                <div class="fs-5 mb-5">
                    @if ($product->sale_price != 0)
                    <span class="text-decoration-line-through">Rp. {{ number_format($product->price, 0) }}</span>
                    <span>Rp. {{ number_format($product->sale_price, 0) }}</span>
                    @else
                    <span>Rp. {{ number_format($product->price, 0) }}</span>
                    @endif
                </div>
                <h5>Detail Produk</h5>
                <p class="lead">{{ $product->description }}</p>
                <div class="d-flex">
                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                    <button class="btn btn-outline-dark flex-shrink-0" type="button">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            @foreach ($related as $relate)
            <div class="col mb-5">
                <a href="{{ route('landing.detail', ['id' => $relate->id]) }}" style="text-decoration: none" class="text-dark">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ asset('storage/product/'.$relate->image) }}" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $relate->name }}</h5>
                                <div class="small">{{ $product->category->name }}</div>
                                <!-- Product price-->
                                @if ($relate->sale_price != 0)
                                Rp. {{ number_format($relate->sale_price) }}
                                @else
                                Rp. {{ number_format($relate->price) }}
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

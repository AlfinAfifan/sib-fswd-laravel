<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Keranjang Belanja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/style-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <style type="text/css">
        body {
            /* margin-top: 20px; */
        }

        select.form-input:not([size]):not([multiple]) {
            height: 44px;
        }

        select.form-input {
            padding-right: 38px;
            background-position: center right 17px;
            background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNv…9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K);
            background-repeat: no-repeat;
            background-size: 9px 9px;
        }

        .form-input:not(textarea) {
            height: 44px;
        }

        .form-input {
            padding: 0 18px 3px;
            border: 1px solid #dbe2e8;
            border-radius: 22px;
            background-color: #fff;
            color: #606975;
            font-family: 'Maven Pro', Helvetica, Arial, sans-serif;
            font-size: 14px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .shopping-cart,
        .wishlist-table,
        .order-table {
            margin-bottom: 20px;
        }

        .shopping-cart .table,
        .wishlist-table .table,
        .order-table .table {
            margin-bottom: 0;
        }

        .shopping-cart .btn,
        .wishlist-table .btn,
        .order-table .btn {
            margin: 0;
        }

        .shopping-cart>table>thead>tr>th,
        .shopping-cart>table>thead>tr>td,
        .shopping-cart>table>tbody>tr>th,
        .shopping-cart>table>tbody>tr>td,
        .wishlist-table>table>thead>tr>th,
        .wishlist-table>table>thead>tr>td,
        .wishlist-table>table>tbody>tr>th,
        .wishlist-table>table>tbody>tr>td,
        .order-table>table>thead>tr>th,
        .order-table>table>thead>tr>td,
        .order-table>table>tbody>tr>th,
        .order-table>table>tbody>tr>td {
            vertical-align: middle !important;
        }

        .shopping-cart>table thead th,
        .wishlist-table>table thead th,
        .order-table>table thead th {
            padding-top: 17px;
            padding-bottom: 17px;
            border-width: 1px;
        }

        .shopping-cart .remove-from-cart,
        .wishlist-table .remove-from-cart,
        .order-table .remove-from-cart {
            display: inline-block;
            color: #ff5252;
            font-size: 18px;
            line-height: 1;
            text-decoration: none;
        }

        .shopping-cart .count-input,
        .wishlist-table .count-input,
        .order-table .count-input {
            display: inline-block;
            width: 100%;
            width: 86px;
        }

        .shopping-cart .product-item,
        .wishlist-table .product-item,
        .order-table .product-item {
            display: table;
            width: 100%;
            min-width: 150px;
            margin-top: 5px;
            margin-bottom: 3px;
        }

        .shopping-cart .product-item .product-thumb,
        .shopping-cart .product-item .product-info,
        .wishlist-table .product-item .product-thumb,
        .wishlist-table .product-item .product-info,
        .order-table .product-item .product-thumb,
        .order-table .product-item .product-info {
            display: table-cell;
            vertical-align: top;
        }

        .shopping-cart .product-item .product-thumb,
        .wishlist-table .product-item .product-thumb,
        .order-table .product-item .product-thumb {
            width: 130px;
            padding-right: 20px;
        }

        .shopping-cart .product-item .product-thumb>img,
        .wishlist-table .product-item .product-thumb>img,
        .order-table .product-item .product-thumb>img {
            display: block;
            width: 100%;
        }

        @media screen and (max-width: 860px) {

            .shopping-cart .product-item .product-thumb,
            .wishlist-table .product-item .product-thumb,
            .order-table .product-item .product-thumb {
                display: none;
            }
        }

        .shopping-cart .product-item .product-info span,
        .wishlist-table .product-item .product-info span,
        .order-table .product-item .product-info span {
            display: block;
            font-size: 13px;
        }

        .shopping-cart .product-item .product-info span>em,
        .wishlist-table .product-item .product-info span>em,
        .order-table .product-item .product-info span>em {
            font-weight: 500;
            font-style: normal;
        }

        .shopping-cart .product-item .product-title,
        .wishlist-table .product-item .product-title,
        .order-table .product-item .product-title {
            margin-bottom: 6px;
            padding-top: 5px;
            font-size: 16px;
            font-weight: 500;
        }

        .shopping-cart .product-item .product-title>a,
        .wishlist-table .product-item .product-title>a,
        .order-table .product-item .product-title>a {
            transition: color 0.3s;
            color: #374250;
            line-height: 1.5;
            text-decoration: none;
        }

        .shopping-cart .product-item .product-title>a:hover,
        .wishlist-table .product-item .product-title>a:hover,
        .order-table .product-item .product-title>a:hover {
            color: #0da9ef;
        }

        .shopping-cart .product-item .product-title small,
        .wishlist-table .product-item .product-title small,
        .order-table .product-item .product-title small {
            display: inline;
            margin-left: 6px;
            font-weight: 500;
        }

        .wishlist-table .product-item .product-thumb {
            display: table-cell !important;
        }

        @media screen and (max-width: 576px) {
            .wishlist-table .product-item .product-thumb {
                display: none !important;
            }
        }

        .shopping-cart-footer {
            display: table;
            width: 100%;
            padding: 10px 0;
            border-top: 1px solid #e1e7ec;
        }

        .shopping-cart-footer>.column {
            display: table-cell;
            padding: 5px 0;
            vertical-align: middle;
        }

        .shopping-cart-footer>.column:last-child {
            text-align: right;
        }

        .shopping-cart-footer>.column:last-child .btn {
            margin-right: 0;
            margin-left: 15px;
        }

        @media (max-width: 768px) {
            .shopping-cart-footer>.column {
                display: block;
                width: 100%;
            }

            .shopping-cart-footer>.column:last-child {
                text-align: center;
            }

            .shopping-cart-footer>.column .btn {
                width: 100%;
                margin: 12px 0 !important;
            }
        }

        .coupon-form .form-input {
            display: inline-block;
            width: 100%;
            max-width: 235px;
            margin-right: 12px;
        }

        .form-control-sm:not(textarea) {
            height: 36px;
        }
    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />

    @include('partials.navbar-landing')

        <div class="container padding-bottom-3x mb-1 mt-5">

            <div class="table-responsive shopping-cart">
                @if (Session::get('error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Total Harga</th>
                            <th class="text-center">
                                <form onsubmit="return confirm('Are you sure delete all product?')" action="{{ route('cart.destroyAll') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Clear Cart</button>
                                </form>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orderDetail)
                            @foreach ($orderDetail as $detail)
                            <tr>
                                <td>
                                    <div class="product-item">
                                        <a class="product-thumb" href="{{ route('landing.detail', ['id' => $detail->products->id]) }}"><img
                                                src="{{ asset('storage/product/'. $detail->products->image) }}" alt="Product" /></a>
                                        <div class="product-info">
                                            <h4 class="product-title"><a href="{{ route('landing.detail', ['id' => $detail->products->id]) }}">{{ $detail->products->name }}</a></h4>
                                            <span><em>Size:</em> 10.5</span><span><em>Color:</em> Dark Blue</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-lg text-medium">Rp. {{ number_format($detail->products->price) }}</td>
                                <td class="text-center">
                                    <div class="count-input">
                                        <div class="form-control">{{ $detail->total }}</div>
                                    </div>
                                </td>
                                <td class="text-center text-lg text-medium">Rp. {{ number_format($detail->total_price, 0) }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Are you sure delete product number {{ $loop->iteration }}?');" action="{{ route('cart.destroy', $detail->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-from-cart btn btn-sm" data-toggle="tooltip" title data-original-title="Remove item"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <h4>Produk belum tersedia</h4>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>

            <div class="shopping-cart-footer">
                <div class="column text-lg">Subtotal:
                    <span class="text-medium">@if ($order) {{ number_format($order->total_price) }}
                                                @else 0
                                                @endif
                    </span>
                </div>
            </div>
            <div class="shopping-cart-footer">
                <div class="column">
                    <a class="btn btn-outline-secondary" href="{{ route('landing.index') }}"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a>
                </div>
                <div class="column">
                        <a class="btn btn-success" href="{{ route('cart.checkout') }}">Checkout</a>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>

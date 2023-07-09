@extends('layout.home')
@section('content')
@if(session('message'))
    <script>
        alert('{{ session("message") }}');
    </script>
@endif
<!-- Page Title -->
<section class="page-title text-center bg-light">
    <div class="container relative clearfix">
        <div class="title-holder">
            <div class="title-text">
                <h1 class="uppercase">Shopping Cart</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/katalog">Shop</a>
                    </li>
                    <li class="active">
                        Cart
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="content-wrapper oh">

    <!-- Cart -->
    <section class="section-wrap shopping-cart">
        <div class="container relative">
            <div class="row">

                <div class="col-md-12">
                    <div class="table-wrap mb-30">
                        <table class="shop_table cart table">
                            <thead>
                                <tr>
                                    <th class="product-name" colspan="2">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal" colspan="2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $carts)
                                <tr class="cart_item">
                                    <td class="product-thumbnail">
                                        <a href="#">
                                            <img src="/uploads/{{$carts->product->gambar}}" alt="">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="#">{{$carts->product->nama_produk}}</a>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount">{{$carts->product->harga}}</span>
                                    </td>
                                    <td class="product-quantity">
                                        <div class="quantity buttons_added">
                                            <input type="number" step="1" min="0" value="{{$carts->jumlah}}" title="Qty" class="input-text qty text">
                                            <div class="quantity-adjust">
                                                <a href="/cartPlus/{{$carts->id}}" class="plus">
                                                    <i class="fa fa-angle-up"></i>
                                                </a>
                                                <a href="/cartMinus/{{$carts->id}}" class="minus">
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount">{{$carts->total}}</span>
                                    </td>
                                    <td class="product-remove">
                                        <a href="/cart/{{$carts->id}}" class="remove" title="Remove this item">
                                            <i class="ui-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mb-50">
                        <div class="col-md-12">
                            <div class="cart_totals">
                                <table class="table shop_table">
                                    <tbody>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td>
                                                <strong><span class="amount">{{$grandTotal}}</span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="actions">
                                <div class="wc-proceed-to-checkout">
                                    <a href="/payment" class="btn btn-lg btn-dark"><span>proceed to checkout</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end col -->
            </div> <!-- end row -->


        </div> <!-- end container -->
    </section> <!-- end cart -->
    @endsection
    
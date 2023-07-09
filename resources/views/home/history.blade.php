@extends('layout.home')
@section('content')
<!-- Your Order -->
<section class="page-title text-center bg-light">
    <div class="container relative clearfix">
        <div class="title-holder">
            <div class="title-text">
                <h1 class="uppercase">History Transaksi</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li class="active">
                        History
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>
<br>
<div class="col-md-12">
    <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
        @foreach($history as $historys)
        <table class="table shop_table ecommerce-checkout-review-order-table">
            <tbody>
                <tr class="order-total">
                    <th><strong>ID Transaksi</strong></th>
                    <td>
                        {{$historys->id}}
                    </td>
                </tr>
                <tr class="order-total">
                    <th><strong>Status Transaksi</strong></th>
                    <td>
                        @if($historys->status == "Baru")
                        Gagal
                        @else
                        {{$historys->status}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <a href="/history/{{$historys->id}}" class="btn bg-dark text-white">Detail</a>
                    </td>
                </tr>
            </tbody>
        </table>
        @endforeach
    </div>
</div> <!-- end order review -->
</div>
<br>
@endsection
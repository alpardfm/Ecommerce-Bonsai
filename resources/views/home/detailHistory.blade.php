@extends('layout.home')
@section('content')
<!-- Your Order -->
<section class="page-title text-center bg-light">
    <div class="container relative clearfix">
        <div class="title-holder">
            <div class="title-text">
                <h1 class="uppercase">Detail History Transaksi</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        History
                    </li>
                    <li class="active">
                        Detail History
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>
<br>
<div class="col-md-12">
    <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
        <h2 class="heading uppercase bottom-line full-grey"><strong>Detail Transaksi</strong></h2>
        <table class="table shop_table ecommerce-checkout-review-order-table">
            <tbody>
                <tr class="order-total">
                    <th><strong>ID Invoice</strong></th>
                    <td>
                        <time datetime="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></time>/INV/{{$trx->invoice}}
                    </td>
                </tr>
                <tr class="order-total">
                    <th><strong>Nama Pemesan</strong></th>
                    <td>
                        {{$trx->member->nama_member}}
                    </td>
                </tr>
                <tr class="order-total">
                    <th><strong>No Hp</strong></th>
                    <td>
                        {{$trx->member->no_hp}}
                    </td>
                </tr>
                <tr class="order-total">
                    <th><strong>Alamat Pengiriman</strong></th>
                    <td>
                        {{$trx->member->detail_alamat}}, Kec {{$trx->member->kecamatan}}, Kab {{$trx->member->kabupaten}}, {{$trx->member->provinsi}}
                    </td>
                </tr>
                <tr class="order-total">
                    <th><strong>Ongkir</strong></th>
                    <td>
                        25000
                    </td>
                </tr>
                <tr class="order-total">
                    <th><strong>Total Yang Sudah Di Bayar</strong></th>
                    <td>
                        {{$trx->grand_total}}
                    </td>
                </tr>
                <tr class="order-total">
                    <th><strong>Status Transaksi</strong></th>
                    <td>
                        {{$trx->status}}
                    </td>
                </tr>
            </tbody>
        </table>

        <h2 class="heading uppercase bottom-line full-grey"><strong>List Produk Yang Dipesan</strong></h2>
        <table class="table shop_table ecommerce-checkout-review-order-table">
            <tbody>
                @foreach($trxDetail as $trxDetails)
                <tr>
                    <th>{{$trxDetails->product->nama_produk}}<span class="count"> x {{$trxDetails->jumlah}}</span></th>
                    <td>
                        <span class="amount">{{$trxDetails->total}}</span>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th><a class="btn bg-dark text-white" href="/history">Kembali</a></th>
                    <td>
                        <a class="btn bg-dark text-white" href="https://wa.me/085608690761?text=Halo%20saya%20{{$trx->member->nama_member}},%20Bisa%20bantu%20saya%20dengan%20invoice%20id%20{{$trx->invoice}}" target="blank">Whatsapp Kami</a>
                        @if($trx->status == "Selesai")
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Beri Komentar
                        </button>
                        @elseif($trx->status == "Dikirim")
                        <a class="btn bg-dark text-white" href="/diterima/{{$trx->id}}">Diterima</a>
                        @elseif($trx->status == "Diterima")
                        <a class="btn bg-dark text-white" href="/selesai/{{$trx->id}}">Selesai</a>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div> <!-- end order review -->

</div>
<br>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Header modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Survey Kepuasan Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body modal -->
            <div class="modal-body">
                <!-- Form dalam modal -->
                <form action="/addreview" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Review</label>
                        <input type="text" class="form-control" id="review" name="review" placeholder="Produk ini terbaik">
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <span class="star-rating star-5">
                            <input type="radio" name="rating" value="1"><i></i>
                            <input type="radio" name="rating" value="2"><i></i>
                            <input type="radio" name="rating" value="3"><i></i>
                            <input type="radio" name="rating" value="4"><i></i>
                            <input type="radio" name="rating" value="5"><i></i>
                        </span>
                    </div>
                    <input type="hidden" name="trxId" value="{{$trx->id}}">
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"> Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
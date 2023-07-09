@extends('layout.home')
@section('content')
<!-- Your Order -->
<div class="col-md-12">
    <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
        <h2 class="heading uppercase bottom-line full-grey"><strong>Invoice Transaksi</strong></h2>
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
                    <th><strong>Total Yang Sudah Di Bayar</strong></th>
                    <td>
                        {{$trx->grand_total}}
                    </td>
                </tr>
                <tr class="order-total">
                    <th><strong>Status Transaksi</strong></th>
                    <td>
                        @if($trx->status == "Baru")
                        Menunggu Pembayaran
                        @else
                        {{$trx->status}}
                        @endif

                    </td>
                </tr>
                <tr>
                    <th><a href="/" class="btn bg-dark text-white" id="pay-button">Kembali Ke Halaman Utama</a></th>
                    <td>
                        <a href="/katalog" class="btn bg-dark text-white" id="pay-button">Pesan Lagi ?</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div> <!-- end order review -->
<br>
</div>
@endsection
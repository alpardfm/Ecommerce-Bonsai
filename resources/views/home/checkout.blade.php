@extends('layout.home')
@section('content')
<div class="container">
    <br>
    <div class="col-md-12">
        <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
            <h2 class="heading uppercase bottom-line full-grey"><strong>Data Penerima</strong></h2>
            <table class="table shop_table ecommerce-checkout-review-order-table">
                <tbody>
                    <tr class="order-total">
                        <th>Nama Penerima</th>
                        <td>
                            {{$member->nama_member}}
                        </td>
                    </tr>
                    <tr>
                        <th>Provinsi</th>
                        <td>
                            {{$member->provinsi}}
                        </td>
                    </tr>
                    <tr>
                        <th>Kabupaten</th>
                        <td>
                            {{$member->kabupaten}}
                        </td>

                    </tr>
                    <tr>
                        <th>Kecamatan</th>
                        <td>
                            {{$member->kecamatan}}
                        </td>

                    </tr>
                    <tr>
                        <th>Detail Alamat</th>
                        <td>
                            {{$member->detail_alamat}}
                        </td>

                    </tr>
                    <tr>
                        <th>No Hp</th>
                        <td>
                            {{$member->no_hp}}
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div> <!-- end order review -->

    <!-- Your Order -->
    <div class="col-md-12">
        <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
            <h2 class="heading uppercase bottom-line full-grey"><strong>Data Pesanan</strong></h2>
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
                    <tr class="order-total">
                        <th><strong>Order Total</strong></th>
                        <td>
                            <strong><span class="amount">{{$trx->grand_total}}</span></strong>
                        </td>
                    </tr>
                    <tr class="order-total">
                        <th><strong>Invoice</strong></th>
                        <td>
                            <strong><span class="amount"><time datetime="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></time>/INV/{{$trx->invoice}}</span></strong>
                        </td>
                    </tr>
                    <tr class="order-total">
                        <th><strong>Status</strong></th>
                        <td>       
                            @if($trx->status == "Baru")
                            <strong><span class="amount">Menunggu Pembayaran</span></strong>
                            @else
                            <strong><span class="amount">{{$trx->status}}</span></strong>
                            @endif
                            
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <button class="btn bg-dark text-white" id="pay-button">Bayar</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div> <!-- end order review -->
    <br>
</div>
@endsection

@push('js')
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snapToken}}', {
            onSuccess: function(result) {
                /* You may add your own implementation here */
                alert("payment success!");
                window.location.href = '/invoice/{{$trx->id}}'
                console.log(result);
            },
            onPending: function(result) {
                /* You may add your own implementation here */
                alert("wating your payment!");
                console.log(result);
            },
            onError: function(result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                console.log(result);
            },
            onClose: function() {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        })
    });
</script>
@endpush
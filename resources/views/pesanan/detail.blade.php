@extends('layout.app')
@section('content')

<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="col-12 mb-12">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Pembeli</label>
                        <input type="email" class="form-control" value="{{$pesanan->member->nama_member}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kontak Penerima</label>
                        <input type="email" class="form-control" value="No : {{$pesanan->member->no_hp}}" readonly>
                        <br>
                        <input type="email" class="form-control" value="Email : {{$pesanan->member->email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat Penerima</label>
                        <input type="email" class="form-control" value="{{$pesanan->member->detail_alamat}}" readonly>
                        <br>
                        <input type="email" class="form-control" value="Kecamatan {{$pesanan->member->kecamatan}}" readonly>
                        <br>
                        <input type="email" class="form-control" value="Kabupaten {{$pesanan->member->kabupaten}}" readonly>
                        <br>
                        <input type="email" class="form-control" value="Provinsi {{$pesanan->member->provinsi}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Detail Transaksi</label>
                        <input type="email" class="form-control" value="Invoice : {{$pesanan->invoice}}" readonly>
                        <br>
                        <input type="email" class="form-control" value="Total Bayar : {{$pesanan->grand_total}}" readonly>
                        <br>
                        <input type="email" class="form-control" value="Status : {{$pesanan->status}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">List Pesanan</label>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id Produk</th>
                                        <th class="text-center">Nama Produk</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesananDetail as $list)
                                    <tr>
                                        <td class="text-center">{{$list->product->id}}</td>
                                        <td class="text-center">{{$list->product->nama_produk}}</td>
                                        <td class="text-center">{{$list->jumlah}}</td>
                                        <td class="text-center">{{$list->product->harga}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-pesanan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
@endpush
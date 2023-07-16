@extends('layout.app')
@section('content')

<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="col-12 mb-12">
                <form action="filterLaporan" method="get">
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label for="">Start Date</label>
                            <input type="date" name="date_from" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-5 form-group">
                            <label for="">End Date</label>
                            <input type="date" name="date_to" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-2 form-group" style="margin-top:25px;">
                            <input type="submit" class="btn btn-primary" value="Filter">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 mb-12">

                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Pendapatan</label>
                        <input type="email" class="form-control" value="{{$totalPendapatan}}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">List Produk Terjual</label>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id Produk</th>
                                        <th class="text-center">Nama Produk</th>
                                        <th class="text-center">Terjual</th>
                                        <th class="text-center">Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $list)
                                    <tr>
                                        <td class="text-center">
                                            {{$list->product->id}}
                                        </td>
                                        <td class="text-center">
                                            {{$list->product->nama_produk}}
                                        </td>
                                        <td class="text-center">
                                            {{$list->terjual}}
                                        </td>
                                        <td class="text-center">
                                            {{$list->pendapatan}}
                                        </td>
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
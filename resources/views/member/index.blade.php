@extends('layout.app')
@section('title', 'Data Member')
@section('content')

<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="col-4 mb-4">
                <input type="text" class="form-control" id="search" name="search" placeholder="Search">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Member</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col md-12">
                        <form class="form-member">
                            <div class="form-group">
                                <label for="">Nama Member</label>
                                <input type="text" class="form-control" name="nama_member" placeholder="Nama Member" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Provinsi</label>
                                <input type="text" class="form-control" name="provinsi" placeholder="Provinsi" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Kabupaten</label>
                                <input type="text" class="form-control" name="kabupaten" placeholder="Kabupaten" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Kecamatan</label>
                                <input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Detail Alamat</label>
                                <input type="text" class="form-control" name="detail_alamat" placeholder="Detail Alamat" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">No Hp</label>
                                <input type="text" class="form-control" name="no_hp" placeholder="No Hp" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="email" disabled>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(function() {
        $.ajax({
            url: '/api/members',
            success: function({
                data
            }) {
                let row;
                data.map(function(val, index) {
                    row += `
                        <tr>
                            <td class="text-center">${index+1}</td>
                            <td class="text-center">${val.nama_member}</td>
                            <td class="text-center">${val.email}</td>
                            <td class="text-center">
                                <a data-toggle="modal" href="modal-form" data-id="${val.id}" class="btn btn-primary modal-detail">Detail</a>
                            </td>
                        </tr>
                        `;
                });

                $('tbody').append(row)
            }
        });

        $(document).ready(function() {
            $("#search").on('keyup', function() {
                $('tbody').empty()
                var query = $(this).val();
                $.ajax({
                    url: "/api/members",
                    type: "GET",
                    data: {
                        search: query
                    },
                    success: function({
                        data
                    }) {
                        let row;
                        data.map(function(val, index) {
                            row += `
                        <tr>
                            <td class="text-center">${index+1}</td>
                            <td class="text-center">${val.nama_member}</td>
                            <td class="text-center">${val.email}</td>
                            <td class="text-center">
                                <a data-toggle="modal" href="modal-form" data-id="${val.id}" class="btn btn-primary modal-detail">Detail</a>
                            </td>
                        </tr>
                        `;
                        });

                        $('tbody').append(row)
                    }
                });
            });
        });

        $(document).on('click', '.modal-detail', function() {
            $('#modal-form').modal('show')
            const id = $(this).data('id')

            $.get('/api/members/' + id, function({
                data
            }) {
                $('input[name="nama_member"]').val(data.nama_member)
                $('input[name="provinsi"]').val(data.provinsi)
                $('input[name="kabupaten"]').val(data.kabupaten)
                $('input[name="kecamatan"]').val(data.kecamatan)
                $('input[name="detail_alamat"]').val(data.detail_alamat)
                $('input[name="no_hp"]').val(data.no_hp)
                $('input[name="email"]').val(data.email)
            })
        })

    });
</script>
@endpush
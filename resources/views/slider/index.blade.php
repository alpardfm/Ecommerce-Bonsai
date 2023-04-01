@extends('layout.app')
@section('title', 'Data Slider')
@section('content')

<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" id="search" name="search" placeholder="Search">
            </div>
            <div class="col">
                <div class="d-flex justify-content-end mb-4">
                    <a href="#modal-form" class="btn btn-primary modal-tambah">Tambah Data</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Slider</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">Gambar</th>
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
                <h5 class="modal-title">Form Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col md-12">
                        <form class="form-slider">
                            <div class="form-group">
                                <label for="">Nama Slider</label>
                                <input type="text" class="form-control" name="nama_slider" placeholder="Nama Slider" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" id="" cols="30" rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
            url: '/api/sliders',
            success: function({
                data
            }) {
                let row;
                data.map(function(val, index) {
                    row += `
                        <tr>
                            <td class="text-center">${index+1}</td>
                            <td class="text-center">${val.nama_slider}</td>
                            <td class="text-center">${val.deskripsi}</td>
                            <td class="text-center"><img src="/uploads/${val.gambar}" width="150"></td>
                            <td class="text-center">
                                <a data-toggle="modal" href="modal-form" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit</a>
                                <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">Hapus</a>
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
                    url: "/api/sliders",
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
                            <td class="text-center">${val.nama_slider}</td>
                            <td class="text-center">${val.deskripsi}</td>
                            <td class="text-center"><img src="/uploads/${val.gambar}" width="150"></td>
                            <td class="text-center">
                                <a data-toggle="modal" href="modal-form" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit</a>
                                <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">Hapus</a>
                            </td>
                        </tr>
                        `;
                        });

                        $('tbody').append(row)
                    }
                });
            });
        });

        $(document).on('click', '.btn-hapus', function() {
            const id = $(this).data('id')
            const token = localStorage.getItem('token')

            confirm_dialog = confirm('Apakah anda yakin ingin menghapus data ?');

            if (confirm_dialog) {
                $.ajax({
                    url: '/api/sliders/' + id,
                    type: 'DELETE',
                    headers: {
                        "Authorization": "Bearer " + token
                    },
                    success: function(data) {
                        if (data.success) {
                            alert(data.message)
                            location.reload()
                        } else {
                            alert(data.message)
                        }
                    }
                });
            }
        });

        $('.modal-tambah').click(function() {
            $('#modal-form').modal('show')
            $('input[name="nama_slider"]').val("")
            $('textarea[name="deskripsi"]').val("")

            $('.form-slider').submit(function(e) {
                e.preventDefault()
                const token = localStorage.getItem('token')
                const formdata = new FormData(this);
                $.ajax({
                    url: 'api/sliders',
                    type: 'POST',
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        "Authorization": "Bearer " + token
                    },
                    success: function(data) {
                        if (data.success) {
                            alert(data.message)
                            location.reload()
                        } else {
                            alert(data.message)
                        }

                    }
                })
            });
        });

        $(document).on('click', '.modal-ubah', function() {
            $('#modal-form').modal('show')
            const id = $(this).data('id')

            $.get('/api/sliders/' + id, function({
                data
            }) {
                $('input[name="nama_slider"]').val(data.nama_slider)
                $('textarea[name="deskripsi"]').val(data.deskripsi)
            })

            $('.form-slider').submit(function(e) {
                e.preventDefault()
                const token = localStorage.getItem('token')
                const formdata = new FormData(this);
                $.ajax({
                    url: `api/sliders/${id}?_method=PUT`,
                    type: 'POST',
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        "Authorization": "Bearer " + token
                    },
                    success: function(data) {
                        if (data.success) {
                            alert(data.message)
                            location.reload()
                        } else {
                            alert(data.message)
                        }

                    }
                })
            });
        })

    });
</script>
@endpush
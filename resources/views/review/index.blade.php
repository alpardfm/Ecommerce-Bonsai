@extends('layout.app')

@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data Reviews
        </h4>
    </div>
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
                        <th class="text-center">Member</th>
                        <th class="text-center">Produk</th>
                        <th class="text-center">Review</th>
                        <th class="text-center">Rating</th>
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
                <h5 class="modal-title">Form Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col md-12">
                        <form class="form-review">
                            <label for="">Member</label>
                            <select name="id_member" id="id_member" class="form-control">
                                @foreach ($members as $member)
                                <option value="{{$member->id}}">{{$member->nama_member}}</option>
                                @endforeach
                            </select>
                            <label for="">Produk</label>
                            <select name="id_produk" id="id_produk" class="form-control">
                                @foreach ($products as $produk)
                                <option value="{{$produk->id}}">{{$produk->nama_produk}}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="">Reviews</label>
                                <textarea name="review" placeholder="produk ini terbaik ....!!!" class="form-control" id="" cols="30" rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Rating</label>
                                <input type="number" class="form-control" name="rating" placeholder="10" required>
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
            url: '/api/reviews',
            success: function({
                data
            }) {
                let row;
                data.map(function(val, index) {
                    row += `
                        <tr>
                            <td class="text-center">${index+1}</td>
                            <td class="text-center">${val.member.nama_member}</td>
                            <td class="text-center">${val.product.nama_produk}</td>
                            <td class="text-center">${val.review}</td>
                            <td class="text-center">${val.rating}</td>
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
                    url: "/api/reviews",
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
                            <td class="text-center">${val.member.nama_member}</td>
                            <td class="text-center">${val.product.nama_produk}</td>
                            <td class="text-center">${val.review}</td>
                            <td class="text-center">${val.rating}</td>
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
                    url: '/api/reviews/' + id,
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
            $('input[name="id_member"]').val("")
            $('input[name="id_produk"]').val("")
            $('textarea[name="review"]').val("")
            $('input[name="rating"]').val(0)

            $('.form-review').submit(function(e) {
                e.preventDefault()
                const token = localStorage.getItem('token')
                const formdata = new FormData(this);
                $.ajax({
                    url: 'api/reviews',
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

            $.get('/api/reviews/' + id, function({
                data
            }) {
                $('input[name="id_member"]').val(data.id_member)
                $('input[name="id_produk"]').val(data.id_produk)
                $('textarea[name="review"]').val(data.review)
                $('input[name="rating"]').val(data.rating)
            })

            $('.form-review').submit(function(e) {
                e.preventDefault()
                const token = localStorage.getItem('token')
                const formdata = new FormData(this);
                $.ajax({
                    url: `api/reviews/${id}?_method=PUT`,
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
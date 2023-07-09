@extends('layout.app')
@section('title', 'Data Pesanan Diterima')
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
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Invoice</th>
                        <th class="text-center">Member</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(function() {
        $('tbody').empty()

        function rupiah(angka) {
            const format = angka.toString().split('').reverse().join('');
            const convert = format.match(/\d{1,3}/g);
            return 'Rp ' + convert.join('.').split('').reverse().join('');
        }

        function date(date) {
            var tgl = date.substr(0, 10)
            var jam = date.substr(11, 8)

            return `${tgl}, ${jam}`
        }

        const token = localStorage.getItem('token')
        $.ajax({
            url: '/api/order/diterima',
            headers: {
                "Authorization": "Bearer " + token
            },
            success: function({
                data
            }) {
                let row;
                data.map(function(val, index) {
                    row += `
                        <tr>
                            <td class="text-center">${index+1}</td>
                            <td class="text-center">${date(val.created_at)}</td>
                            <td class="text-center">${val.invoice}</td>
                            <td class="text-center">${val.member.nama_member}
                            <td class="text-center">${rupiah(val.grand_total)}
                            <td class="text-center">
                                <a href="/pesananDetail/${val.id}" class="btn btn-primary">Detail</a>
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
                const token = localStorage.getItem('token')
                var query = $(this).val();
                $.ajax({
                    url: "/api/order/diterima",
                    type: "GET",
                    headers: {
                        "Authorization": "Bearer " + token
                    },
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
                            <td class="text-center">${val.created_at}</td>
                            <td class="text-center">${val.invoice}</td>
                            <td class="text-center">${val.member.nama_member}
                            <td class="text-center">${val.grand_total}
                            <td class="text-center">
                                <a href="/pesananDetail/${val.id}" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                        `;
                        });

                        $('tbody').append(row)
                    }
                });
            });
        });

    });
</script>
@endpush
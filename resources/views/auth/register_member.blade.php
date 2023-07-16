@extends('layout.home')
@section('content')
<div class="flex py-10 md:py-20 px-5 md:px-32 bg-gray-200 min-h-screen">
    <div class="flex shadow w-full flex-col-reverse lg:flex-row">
        <div class="w-full bg-white p-10 px-5 md:px-20">
            <h1 class="font-bold text-xl text-gray-700">Register Page</h1>
            <p class="text-gray-600">Please fill all column to create your account!</p>
            <br>
            @if (Session::has('errors'))
            <ul>
                @foreach (Session::get('errors') as $error)
                <li style="color: red">{{$error[0]}}</li>
                @endforeach
            </ul>
            @endif
            @if (Session::has('failed'))
            <p style="color: red">{{Session::get('failed')}}</p>
            @endif
            <form action="/register_member" method="POST" class="mt-10">
                @csrf
                <div class="my-3">
                    <label class="font-semibold" for="nama">Nama</label>
                    <input type="text" placeholder="nama" name="nama_member" id="nama_member" class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="provinsi">Provinsi</label>
                    <input type="text" placeholder="provinsi" name="provinsi" id="provinsi" class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="kabupaten">Kabupaten</label>
                    <input type="text" placeholder="kabupaten" name="kabupaten" id="kabupaten" class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="kecamatan">Kecamatan</label>
                    <input type="text" placeholder="kecamatan" name="kecamatan" id="kecamatan" class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="detail_alamat">Detail Alamat</label>
                    <input type="text" placeholder="detail alamat" name="detail_alamat" id="detail_alamat" class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="no_hp">No Hp</label>
                    <input type="text" placeholder="no hp" name="no_hp" id="no_hp" class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="email">E-mail</label>
                    <input type="email" placeholder="yourmail@example.com" name="email" id="email" class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="password">Password</label>
                    <input type="password" placeholder="password" name="password" id="password" class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="konfirmasi_password">Konfirmasi Password</label>
                    <input type="password" placeholder="konfirmasi password" name="konfirmasi_password" id="konfirmasi_password" class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                </div>
                <div class="my-5">
                    <button type="submit" class="w-full rounded-full bg-blue-400 hover:bg-blue-600 text-white py-2">REGISTER</button>
                </div>
            </form>
            <span>Have an account? <a href="/login_member" class="text-blue-400 hover:text-blue-600">Login here.</a></span>
        </div>
    </div>
</div>
@endsection
@extends('layout.home')
@section('content')
<div class="flex py-10 md:py-20 px-10 md:px-40 bg-gray-200 min-h-screen">
    <div class="flex shadow w-full flex-col-reverse lg:flex-row">
        <div class="w-full bg-white p-10 px-20 md:px-40">
            <h1 class="font-bold text-xl text-gray-700">Login Page</h1>
            <p class="text-gray-600">Please login to start your session!</p>
            <br>
            @if (Session::has('errors'))
            <ul>
                @foreach (Session::get('errors') as $error)
                <li style="color: red">{{$error[0]}}</li>
                @endforeach
            </ul>
            @endif

            @if (Session::has('success'))
            <p style="color: green">{{Session::get('success')}}</p>
            @endif

            @if (Session::has('failed'))
            <p style="color: red">{{Session::get('failed')}}</p>
            @endif
            <form action="/login_member" method="POST" class="mt-10">
                @csrf
                <div class="my-3">
                    <label class="font-semibold" for="email">E-mail</label>
                    <input type="text" placeholder="yourmail@example.com" name="email" id="email" class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="password">Password</label>
                    <input type="password" placeholder="password" name="password" id="password" class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                </div>
                <div class="flex justify-between">
                    <div class="left">
                        <input type="checkbox" name="remember_me" id="remember_me">
                        <label for="remember_me">Remember Me</label>
                    </div>
                </div>
                <div class="my-5">
                    <button type="submit" class="w-full rounded-full bg-blue-400 hover:bg-blue-600 text-white py-2">LOGIN</button>
                </div>
            </form>
            <span>Dont have an account? <a href="/register_member" class="text-blue-400 hover:text-blue-600">Create here.</a></span>
        </div>
    </div>
</div>
@endsection
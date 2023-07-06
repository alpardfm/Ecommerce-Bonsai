@extends('layout.home');
@section('content')

<div class="content-wrapper oh">

    <!-- Hero Slider -->
    <section class="hero-wrap text-center relative">
        <div id="owl-hero" class="owl-carousel owl-theme light-arrows slider-animated">
            @foreach ($slider as $data)
            <div class="hero-slide overlay" style="background-image:url(uploads/{{$data->gambar}})">
                <div class="container">
                    <div class="hero-holder">
                        <div class="hero-message">
                            <h1 class="hero-title nocaps">{{$data->nama_slider}}</h1>
                            <h2 class="hero-subtitle lines">{{$data->deskripsi}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section> <!-- end hero slider -->

    <!-- Promo Banners -->
    <section class="section-wrap promo-banners pb-30">
        <div class="container">
            <div class="row">
            @foreach ($category as $categorys)
                <div class="col-xs-4 col-xxs-12 mb-30 promo-banner">
                    <a href="/katalog?idKategori={{$categorys->id}}">
                        <img src="/uploads/{{$categorys->gambar}}" alt="">
                        <div class="overlay"></div>
                        <div class="promo-inner valign">
                            <h2>{{$categorys->nama_kategori}}</h2>
                            <span>{{$categorys->deskripsi}}</span>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </section> <!-- end promo banners -->


    <!-- Trendy Products -->
    <section class="section-wrap-sm new-arrivals pb-50">
        <div class="container">

            <div class="row heading-row">
                <div class="col-md-12 text-center">
                    <h2 class="heading bottom-line">
                        Testimoni
                    </h2>
                </div>
            </div>

            <div class="row items-grid">
            @foreach ($testimoni as $testimonis)
                <div class="col-md-3 col-xs-6">
                    <div class="product-item hover-trigger">
                        <div class="product-img">
                            <a href="shop-single.html">
                                <img src="/uploads/{{$testimonis->gambar}}" alt="">
                            </a>
                            <div class="hover-overlay">
                                <div class="product-details valign">
                                    <h3 class="product-title">
                                        <a href="shop-single.html">{{$testimonis->nama_testimoni}}</a>
                                    </h3>
                                    <span class="price">
                                    {{$testimonis->deskripsi}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div> <!-- end row -->
        </div>
    </section> <!-- end trendy products -->

    <!-- Testimonials -->
    <section class="section-wrap relative testimonials bg-parallax overlay" style="background-image:url(img/testimonials/testimonial_bg.jpg);">
        <div class="container relative">

            <div class="row heading-row mb-20">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h2 class="heading white bottom-line">Ulasan Dari Pelanggan</h2>
                </div>
            </div>

            <div id="owl-testimonials" class="owl-carousel owl-theme text-center">
                @foreach ($review as $reviews)
                <div class="item">
                    <div class="testimonial">
                        <p class="testimonial-text">{{$reviews->review}}</p>
                        <span>{{$reviews->member->nama_member}}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </section> <!-- end testimonials -->
    @endsection
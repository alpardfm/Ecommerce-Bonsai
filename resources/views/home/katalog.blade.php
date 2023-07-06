@extends('layout.home')
@section('content')
<!-- Page Title -->
<section class="page-title text-center bg-light">
    <div class="container relative clearfix">
        <div class="title-holder">
            <div class="title-text">
                <h1 class="uppercase">Happy Shopping</h1>
            </div>
        </div>
    </div>
</section>

<div class="content-wrapper oh">

    <!-- Catalogue -->
    <section class="section-wrap pt-80 pb-40 catalogue">
        <div class="container relative">

            <div class="row">
                <div class="col-md-9 catalogue-col right mb-50">
                    <div class="shop-catalogue grid-view">

                        <div class="row items-grid">
                            @foreach ($produk as $produks)
                            <div class="col-md-4 col-xs-6 product product-grid">

                                <div class="product-item clearfix">
                                    <div class="product-img hover-trigger">
                                            <img src="/uploads/{{$produks->gambar}}" alt="">
                                        <div class="product-label">
                                            <span class="sale">sale</span>
                                        </div>
                                    </div>

                                    <div class="product-details">
                                        <b>
                                            <h3 class="product-title">
                                                <a href="shop-single.html">{{$produks->nama_produk}}</a>
                                            </h3>
                                        </b>
                                        <span class="category">
                                            <a href="catalogue-grid.html">{{$produks->subcategory->nama_subkategori}}</a>
                                        </span>
                                    </div>

                                    <span class="price">
                                        <del>
                                            <span>Rp. {{$produks->diskon}}</span>
                                        </del>
                                        <ins>
                                            <span class="amount">Rp. {{$produks->harga}}</span>
                                        </ins>
                                    </span>

                                    <div class="clear"></div>
                                    <br>
                                    <p style="text-align: justify;">{{$produks->deskripsi}}</p>
                                    <br>
                                    <a href="/beforeCart/{{$produks->id}}" class="btn btn-dark btn-md left"><span>Masukan Keranjang</span></a>



                                </div>
                            </div> <!-- end product -->
                            @endforeach

                        </div> <!-- end row -->
                    </div> <!-- end grid mode -->

                </div> <!-- end col -->


                <!-- Sidebar -->
                <aside class="col-md-3 sidebar left-sidebar">

                    <!-- Categories -->
                    <div class="widget categories">
                        <h3 class="widget-title heading uppercase relative bottom-line full-grey">Jenis Bonsai</h3>
                        <ul class="list-dividers">
                            @foreach ($katalog as $katalogs)
                            <li>
                                <a href="/katalog?idKatalog={{$katalogs->id}}">{{$katalogs->nama_subkategori}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </aside> <!-- end sidebar -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section> <!-- end catalog -->
    @endsection
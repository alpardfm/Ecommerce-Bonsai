@extends('layout.home')
@section('content')
<!-- Single Product -->
<section class="section-wrap pb-40 single-product">
    <div class="container-fluid semi-fluid">
        <div class="row">
            <div class="col-md-6 col-xs-6 mb-60">
                <div class="gallery-cell">
                    <a href="/uploads/{{ $produk->gambar }}" class="lightbox-img">
                        <img src="/uploads/{{ $produk->gambar }}" alt="" />
                        <i class="ui-zoom zoom-icon"></i>
                    </a>
                </div>
            </div> <!-- end col img slider -->

            <div class="col-md-6 col-xs-12 product-description-wrap">
                <ol class="breadcrumb">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/katalog">Shop</a>
                    </li>
                    <li class="active">
                        Add to cart
                    </li>
                </ol>
                @if($errors->any())
                <br>
                    <h4 style="color: red;">{{$errors->first()}}</h4>
                <br>
                @endif
                <form action="/addCart" method="POST">
                    @csrf
                    <h1 class="product-title">{{ $produk->nama_produk }}</h1>
                    <span class="price">
                        <del>
                            <span>Rp. {{ $produk->diskon }}</span>
                        </del>
                        <ins>
                            <span class="amount">Rp. {{ $produk->harga }}</span>
                        </ins>
                    </span>

                    <input type="hidden" id="id_produk" name="id_produk" value="{{ $produk->id }}">
                    <input type="hidden" id="id_member" name="id_member" value="{{ Auth::user()->id_member }}">

                    <div class="product-actions">
                        <span>Qty:</span>

                        <div class="quantity buttons_added">
                            <input type="number" step="1" min="0" value="1" title="Qty" class="input-text qty text" id="jumlah" name="jumlah" />
                            <div class="quantity-adjust">
                                <a href="#" class="plus">
                                    <i class="fa fa-angle-up"></i>
                                </a>
                                <a href="#" class="minus">
                                    <i class="fa fa-angle-down"></i>
                                </a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark btn-lg add-to-cart"><span>Add to Cart</span></button>
                    </div>

                </form>

                <!-- Accordion -->
                <div class="panel-group accordion mb-50" id="accordion">
                    <div class="panel">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="minus">Description<span>&nbsp;</span>
                            </a>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                {{ $produk->deskripsi }}
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="plus">Information<span>&nbsp;</span>
                            </a>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table shop_attributes">
                                    <tbody>
                                        <tr>
                                            <th>Kategori:</th>
                                            <td>{{$produk->category->nama_kategori}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis:</th>
                                            <td>{{$produk->subcategory->nama_subkategori}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="plus">Reviews<span>&nbsp;</span>
                            </a>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="reviews">
                                    <ul class="reviews-list">
                                        @foreach ($review as $reviews)
                                        <li>
                                            <div class="review-body">
                                                <div class="review-content">
                                                    <p class="review-author"><strong>{{$reviews->member->nama_member}}</strong> - {{$reviews->created_at}} </p>
                                                    @if($reviews->rating >= 5)
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    @elseif($reviews->rating == 4)
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($reviews->rating == 3)
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($reviews->rating == 2)
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @elseif($reviews->rating == 1)
                                                    <span class="fa fa-star" style="color:orange"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    @endif
                                                    <p>{{$reviews->review}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div> <!--  end reviews -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col product description -->
        </div> <!-- end row -->

    </div> <!-- end container -->
</section> <!-- end single product -->
@endsection
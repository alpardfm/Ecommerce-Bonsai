<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $slider = Slider::all();
        $review = Review::with('member')->get();
        $testimoni = Testimoni::all();
        $category = Category::all();
        return view('home.index', compact('slider', 'review', 'testimoni', 'category'));
    }

    function katalog(Request $request)
    {
        $katalog = Subcategory::all();
        $filter1 = "";
        $filter2 = "";

        $filter1 = $request->has('idKategori') ? $request->input('idKategori') : "";
        $filter2 = $request->has('idKatalog') ? $request->input('idKatalog') : "";

        $produk = Product::with('subcategory')
            ->where('id_kategori', 'LIKE', '%' . $filter1 . '%')
            ->where('id_subkategori', 'LIKE', '%' . $filter2 . '%')
            ->orderBy('id', 'desc')
            ->get();

        return view('home.katalog', compact('katalog', 'produk'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $slider = Slider::all();
        $produk = Product::all();
        return view('welcome', compact('slider','produk'));
    }
}

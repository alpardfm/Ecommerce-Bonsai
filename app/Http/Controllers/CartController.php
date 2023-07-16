<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id_member;
        $cart = Cart::with('product')
        ->where('id_member', 'LIKE', '%' . $user . '%')
        ->get();

        $grandTotal = Cart::where('id_member', 'LIKE', '%' . $user . '%')
        ->sum('total');

        return view('home.cart', compact('cart','grandTotal'));
    }

    public function before($id)
    {
        $produk = Product::with('category')
        ->with('subcategory')
        ->findOrFail($id);

        $review = Review::with('member')
        ->where('id_produk', 'LIKE', '%' . $produk->id . '%')
        ->get();

        return view('home.beforeCart', compact('produk','review'));
    }

    public function plus($id)
    {
        $dataCart = Cart::find($id);

        Product::where('id', $dataCart->id_produk)
        ->increment('stok', -1, ['updated_at' => Carbon::now()]);

        Cart::where('id', $id)
        ->increment('jumlah', 1, ['updated_at' => Carbon::now()]);

        return redirect('/cart');
    }

    public function minus($id)
    {
        $dataCart = Cart::find($id);

        Product::where('id', $dataCart->id_produk)
        ->increment('stok', 1, ['updated_at' => Carbon::now()]);

        Cart::where('id', $id)
        ->increment('jumlah', -1, ['updated_at' => Carbon::now()]);

        return redirect('/cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $produk = Product::findOrFail($input['id_produk']);
        if($produk->stok > $input['jumlah']){
            $produk->update([
                'stok' => $produk->stok - $input['jumlah']
            ]);
            $input['total'] = $produk->harga * $input['jumlah'];
    
            Cart::create($input);
    
            return redirect('/katalog');
        }else{
            return back()->withErrors(['msg' => 'Stok produk tidak mencukupi']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect('/cart');

    }
}

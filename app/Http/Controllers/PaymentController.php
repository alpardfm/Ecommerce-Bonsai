<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
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

        $member = Member::find($user);

        $grandTotal = Cart::where('id_member', 'LIKE', '%' . $user . '%')
            ->sum('total');

        return view('home.checkout', compact('cart', 'grandTotal', 'member'));
    }

    public function history() {
        $user = Auth::user()->id_member;
        $history = Order::where('id_member', 'LIKE', '%' . $user . '%')
        ->get();
        return view('home.history', compact('history'));
    }

    public function history_detail($id){
        $trx = Order::with('member')
        ->find($id);

        $trxDetail = OrderDetail::with('product')
            ->where('id_order', 'LIKE', '%' . $id . '%')
            ->get();
        
        return view('home.detailHistory', compact('trx','trxDetail'));
    }

    public function buat_review(Request $request){
        $trxs = OrderDetail::select('id_produk')
        ->distinct()
        ->where('id_order', 'LIKE', '%' . $request->trxId . '%')
        ->get();

        $users = Auth::user()->id_member;

        foreach($trxs as $trx){
            Review::create([
                'id_member' => $users,
                'id_produk' => $trx->id_produk,
                'review' => $request->review,
                'rating' => $request->rating
            ]);
        }

        return redirect('/');
    }

    public function invoice($id){
        $trx = Order::with('member')
        ->find($id);

        $trxDetail = OrderDetail::where('id_order', 'LIKE', '%' . $trx->id . '%')
        ->get();

        return view('home.invoice', compact('trx', 'trxDetail'));
    }

    public function callback(Request $request) {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == "capture"){
                $trx = Order::find($request->order_id);
                $trx->update(['status' => 'Dikonfirmasi']);
            }
        }
    }

    public function diterima($id){
        $trx = Order::find($id);
        $trx->update(['status' => 'Diterima']);

        return redirect('/history');
    }

    public function selesai($id){
        $trx = Order::find($id);
        $trx->update(['status' => 'Selesai']);

        return redirect('/history');
    }

    public function dikemas($id){
        $trx = Order::find($id);
        $trx->update(['status' => 'Dikemas']);

        return redirect('/pesanan');
    }

    public function dikirim($id){
        $trx = Order::find($id);
        $trx->update(['status' => 'Dikirim']);

        return redirect('/pesanan');
    }

    public function dikonfirmasi($id) {
        $trx = Order::find($id);
        $trx->update(['status' => 'Dikonfirmasi']);

        return redirect('/pesanan');
    }

    public function payment()
    {
        $user = Auth::user()->id_member;
        $cart = Cart::with('product')
            ->where('id_member', 'LIKE', '%' . $user . '%')
            ->get();

        $member = Member::find($user);

        $panjangCart = count($cart);

        if ($panjangCart < 1) {
            session()->flash('message', 'Keranjang anda saat ini sedang kosong');
            return redirect('/cart');
        }

        $grandTotal = Cart::where('id_member', 'LIKE', '%' . $user . '%')
            ->sum('total');

        $trx = Order::create([
            'id_member' => $user,
            'invoice' => rand(1, 1000),
            'grand_total' => $grandTotal + 25000,
            'status' => "Baru"
        ]);

        $trxDetail = [];

        foreach ($cart as $carts) {
            $trxTemp = OrderDetail::create([
                'id_order' => $trx->id,
                'id_produk' => $carts->id_produk,
                'jumlah' => $carts->jumlah,
                'total' => $carts->total
            ]);

            $trxTemp2 = OrderDetail::with('product')
            ->find($trxTemp->id);

            $carts->delete();

            array_push($trxDetail, $trxTemp2);
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $trx->id,
                'gross_amount' => $trx->grand_total,
            ),
            'customer_details' => array(
                'name' => $member->nama_member,
                'email' => $member->email,
                'phone' => $member->no_hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('home.checkout', compact('snapToken', 'trx', 'member', 'trxDetail'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

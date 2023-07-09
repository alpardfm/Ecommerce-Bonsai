<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['laporan', 'detail', 'listBaru', 'listDikonfirmasi', 'listDikemas', 'listDikirim', 'listDiterima', 'listSelesai']);
        $this->middleware('auth:api')->only(['index', 'store', 'update', 'destroy', 'ubah_status', 'baru', 'dikonfirmasi', 'dikemas', 'dikirim', 'diterima', 'selesai']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::with('member')->get();

        return response()->json([
            'data' => $order
        ]);
    }

    public function laporan()
    {
        $results = OrderDetail::with('product')
            ->join('orders', 'order_details.id_order', '=', 'orders.id')
            ->select('order_details.id_produk', DB::raw('SUM(order_details.jumlah) as terjual'), DB::raw('SUM(order_details.total) as pendapatan'))
            ->where('orders.status', 'Selesai')
            ->groupBy('order_details.id_produk')
            ->get();

        $totalPendapatan = OrderDetail::join('orders', 'order_details.id_order', '=', 'orders.id')
            ->where('orders.status', 'Selesai')
            ->sum('order_details.total');

        return view('laporan.index', compact('results', 'totalPendapatan'));
    }

    public function detail($id)
    {
        $pesanan = Order::with('member')
            ->find($id);

        $pesananDetail = OrderDetail::with('product')
            ->where('id_order', 'LIKE', '%' . $id . '%')
            ->get();

        return view('pesanan.detail', compact('pesanan', 'pesananDetail'));
    }

    public function listBaru()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == "admin") {
                return view('pesanan.baru');
            } else {
                return redirect('/login_member');
            }
        } else {
            return redirect('/login_member');
        }
    }


    public function baru(Request $request)
    {
        $search = $request->has('search') ? $request->search : "";
        $orders = Order::with('member')->where('status', 'Baru')
            ->where(function ($query) use ($search) {
                $query->where('created_at', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoice', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $orders
        ]);
    }

    public function listDikonfirmasi()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == "admin") {
                return view('pesanan.dikonfirmasi');
            } else {
                return redirect('/login_member');
            }
        } else {
            return redirect('/login_member');
        }
    }

    public function dikonfirmasi(Request $request)
    {

        $search = $request->has('search') ? $request->search : "";
        $orders = Order::with('member')->where('status', 'Dikonfirmasi')
            ->where(function ($query) use ($search) {
                $query->where('created_at', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoice', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $orders
        ]);
    }

    public function listDikemas()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == "admin") {
                return view('pesanan.dikemas');
            } else {
                return redirect('/login_member');
            }
        } else {
            return redirect('/login_member');
        }
    }

    public function dikemas(Request $request)
    {
        $search = $request->has('search') ? $request->search : "";
        $orders = Order::with('member')->where('status', 'Dikemas')
            ->where(function ($query) use ($search) {
                $query->where('created_at', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoice', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $orders
        ]);

        return response()->json([
            'data' => $orders
        ]);
    }

    public function listDikirim()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == "admin") {
                return view('pesanan.dikirim');
            } else {
                return redirect('/login_member');
            }
        } else {
            return redirect('/login_member');
        }
    }

    public function dikirim(Request $request)
    {
        $search = $request->has('search') ? $request->search : "";
        $orders = Order::with('member')->where('status', 'Dikirim')
            ->where(function ($query) use ($search) {
                $query->where('created_at', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoice', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $orders
        ]);

        return response()->json([
            'data' => $orders
        ]);
    }

    public function listDiterima()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == "admin") {
                return view('pesanan.diterima');
            } else {
                return redirect('/login_member');
            }
        } else {
            return redirect('/login_member');
        }
    }

    public function diterima(Request $request)
    {
        $search = $request->has('search') ? $request->search : "";
        $orders = Order::with('member')->where('status', 'Diterima')
            ->where(function ($query) use ($search) {
                $query->where('created_at', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoice', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $orders
        ]);

        return response()->json([
            'data' => $orders
        ]);
    }

    public function listSelesai()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == "admin") {
                return view('pesanan.selesai');
            } else {
                return redirect('/login_member');
            }
        } else {
            return redirect('/login_member');
        }
    }

    public function selesai(Request $request)
    {
        $search = $request->has('search') ? $request->search : "";
        $orders = Order::with('member')->where('status', 'Selesai')
            ->where(function ($query) use ($search) {
                $query->where('created_at', 'LIKE', '%' . $search . '%')
                    ->orWhere('invoice', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $orders
        ]);

        return response()->json([
            'data' => $orders
        ]);
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
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        $order = Order::create($input);

        for ($i = 0; $i < count($input['id_produk']); $i++) {
            OrderDetail::create([
                'id_order' => $order['id'],
                'id_produk' => $input['id_produk'][$i],
                'jumlah' => $input['jumlah'][$i],
                'total' => $input['total'][$i]
            ]);
        }

        return response()->json([
            'data' => $order
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json([
            'data' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        OrderDetail::where('id_order', $order['id'])->delete();

        $input = $request->all();
        $order->update($input);

        for ($i = 0; $i < count($input['id_produk']); $i++) {
            OrderDetail::create([
                'id_order' => $order['id'],
                'id_produk' => $input['id_produk'][$i],
                'jumlah' => $input['jumlah'][$i],
                'total' => $input['total'][$i]
            ]);
        }

        return response()->json([
            'message' => 'success',
            'data' => $order
        ]);
    }

    public function ubah_status(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Mengonfirmasi Pesanan',
            'data' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}

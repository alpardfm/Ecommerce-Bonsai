<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['list']);
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->has('search') ? $request->search : "";
        $review = Review::with('product')
            ->with('member')
            ->where('review', 'LIKE', '%' . $search . '%')
            ->orWhere('rating', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->get();


        return response()->json([
            'data' => $review
        ]);
    }

    public function list()
    {
        $products = Product::all();
        $members = Member::all();
        return view('review.index')->with('products', $products)->with('members', $members);
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
            'id_produk' => 'required',
            'review' => 'required',
            'rating' => 'required'

        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        $review = Review::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambah data',
            'data' => $review
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return response()->json([
            'data' => $review
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
            'id_produk' => 'required',
            'review' => 'required',
            'rating' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        $review->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengupdate data',
            'data' => $review
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data'
        ]);
    }
}

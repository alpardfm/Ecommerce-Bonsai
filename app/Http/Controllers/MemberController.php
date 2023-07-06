<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['list']);
        $this->middleware('auth:api')->only(['index', 'store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->has('search') ? $request->search : "";
        $members = Member::where('nama_member', 'LIKE', '%' . $search . '%')
            ->orWhere('provinsi', 'LIKE', '%' . $search . '%')
            ->orWhere('kabupaten', 'LIKE', '%' . $search . '%')
            ->orWhere('kecamatan', 'LIKE', '%' . $search . '%')
            ->orWhere('detail_alamat', 'LIKE', '%' . $search . '%')
            ->orWhere('no_hp', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->get();


        return response()->json([
            'data' => $members
        ]);
    }

    public function list()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == "admin") {
                return view('member.index');
            } else {
                return redirect('/login_member');
            }
        } else {
            return redirect('/login_member');
        }
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
            'nama_member' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'detail_alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $members = Member::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambah data',
            'data' => $members
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return response()->json([
            'data' => $member
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $validator = Validator::make($request->all(), [
            'nama_member' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'detail_alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        $member->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengupdate data',
            'data' => $member
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data'
        ]);
    }
}

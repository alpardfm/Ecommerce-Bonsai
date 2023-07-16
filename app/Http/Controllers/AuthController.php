<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credential = request(['email', 'password']);

        if (auth()->attempt($credential)) {
            $token = Auth::guard('api')->attempt($credential);
            return response()->json([
                'success' => true,
                'message' => 'login berhasil',
                'token' => $token
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'email atau password salah'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register_member()
    {
        return view('auth.register_member');
    }

    public function register_member_action(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user){
            Session::flash('failed', 'Email sudah terdaftar');
            return redirect('/register_member');
        }
        
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
            Session::flash('errors', $validator->errors()->toArray());
            return redirect('/register_member');
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $member = Member::create($input);

        User::create([
            'id_member' => $member->id,
            'name' => $input['nama_member'],
            'email' => $input['email'],
            'password' => $input['password'],
            'role' => 'member',
            'email_verified_at' => now()
        ]);

        Session::flash('success', 'Account successfully created');
        return redirect('/login_member');
    }

    public function login_member()
    {
        return view('auth.login_member');
    }

    public function login_member_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors()->toArray());
            return redirect('/login_member');
        }

        $credential = request(['email', 'password']);

        if (auth()->attempt($credential)) {
            Auth::guard('web')->attempt($credential);
            return redirect('/');
        }

        Session::flash('failed', "Email atau password salah");
        return redirect('/login_member');
    }

    public function logout_member()
    {
        Auth::logout();
        return redirect('/login_member');
    }
}

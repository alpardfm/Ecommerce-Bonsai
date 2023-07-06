<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['index']);    
    }

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == "admin"){
                return view('dashboard');
            }else {
                return redirect('/login_member');
            }
        } else {
            return redirect('/login_member');
        }
    }
}

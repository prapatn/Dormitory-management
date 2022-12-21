<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function authenticated()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == "owner") {
                return redirect('dormitory');
            } else {
                return redirect('dashboard');
            }
        } else {
            return redirect('auth.login');
        }
    }
}

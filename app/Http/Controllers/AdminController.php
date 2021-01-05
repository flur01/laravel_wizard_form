<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminAllMembers()
    {
        return redirect()->route('all-members');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('main-page');
    }
}

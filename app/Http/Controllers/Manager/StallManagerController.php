<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class StallManagerController extends Controller
{
    public function index()
    {
        $user = User::orderBy('created_at', 'DESC')->with('province')->get();
        return view('superAdmin.stalls.list', compact('user'));
    }
}

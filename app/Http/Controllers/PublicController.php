<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        if(env('APP_AUTH', true))
        {
            return redirect()->to('/login');
        }

        return view('homepage');
    }
}

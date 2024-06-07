<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;

class AdminController extends Controller
{
    public function index()
    {     
            return view('admin');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class foodOrderController extends Controller
{
    public function index()
    {
        return view('food.index');
    }
}

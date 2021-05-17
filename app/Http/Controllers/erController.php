<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;

class erController extends Controller
{
    public function ems()
    {
        return view('er.ems');
    }

}

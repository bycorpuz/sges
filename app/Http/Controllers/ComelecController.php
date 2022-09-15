<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComelecController extends Controller
{
    public function index() {
        return view('comelec.index');
    }
}

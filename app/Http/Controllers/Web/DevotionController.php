<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class DevotionController extends Controller
{
    public function index()
    {
        return view('devotions.index');
    }
}

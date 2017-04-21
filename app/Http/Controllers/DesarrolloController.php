<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Trello\Client;



class DesarrolloController extends Controller
{
    public function index(Request $request)
    {
        return view('vadmin.desarrollo.index');
    }
}

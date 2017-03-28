<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;

class VadminController extends Controller
{

    public function __construct()
    {
        // Date convert to passed time plugin
        Carbon::setLocale('es');
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users    = User::orderBy('id', 'ASC')->where('type','member')->get();
        $vendedores = User::orderBy('id', 'ASC')->where('role','seller')->get();
        return view('vadmin')->with('users', $users)->with('vendedores', $vendedores);
    }

    public function vendedores(Request $request)
    {
        $vendedores = User::orderBy('id', 'ASC')->where('role','seller')->get();
        return view('vadmin.vendedores')->with('vendedores', $vendedores);
    }


}

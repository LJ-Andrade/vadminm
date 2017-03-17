<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;


class WebController extends Controller
{

	public function __construct()
	{
        // Date convert to passed time plugin
		Carbon::setLocale('es');
	}

    public function home()
    {        
        return view('web');
    }

    public function contact()
    {  
        return view('contacto');
    }


}

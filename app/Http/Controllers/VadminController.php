<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Moneda;

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
        $users        = User::orderBy('id', 'ASC')->where('type','member')->get();
        $vendedores   = User::orderBy('id', 'ASC')->where('role','seller')->get();
        $dolarSistema = Moneda::where('nombre', '=', 'dolar')->first();
        $monedas      = Moneda::orderBy('id', 'ASC')->pluck('nombre','id');

        //---- Dolar Hoy API ----//
        $data_in = "http://ws.geeklab.com.ar/dolar/get-dolar-json.php";
        $data_json = @file_get_contents($data_in);
        if(strlen($data_json)>0)
        {
        $data_out = json_decode($data_json,true);
        
        if(is_array($data_out))
            {
                if(isset($data_out['libre'])) $dolarLibre = $data_out['libre'];
                if(isset($data_out['blue'])) $dolarBlue   = $data_out['blue'];
            }
        } else {
            $dolarBlue  = 'Sin Datos';
            $dolarLibre = 'Sin Datos';
        }
        ////    


        return view('vadmin')->with('users', $users)
            ->with('vendedores', $vendedores)
            ->with('monedas', $monedas)
            ->with('dolarSistema', $dolarSistema)
            ->with('dolarBlue', $dolarBlue)
            ->with('dolarLibre', $dolarLibre);
    }

    public function vendedores(Request $request)
    {
        $vendedores = User::orderBy('id', 'ASC')->where('role','seller')->get();
        return view('vadmin.vendedores')->with('vendedores', $vendedores);
    }


}

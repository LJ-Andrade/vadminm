<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Proveedor;
use App\Provincia;
use App\Localidad;
use App\Iva;

use Illuminate\Http\Request;
use Session;

class ProveedoresController extends Controller
{

    //////////////////////////////////////////////////
    //                  VIEW                        //
    //////////////////////////////////////////////////


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $proveedores = Proveedor::where('nombre', 'LIKE', "%$keyword%")->orWhere('razonsocial', 'LIKE', "%$keyword%")
                ->orderBy('id','DESC')->paginate($perPage);
        } else {
            $proveedores = Proveedor::orderBy('id','DESC')->paginate($perPage);
        }

        return view('vadmin.proveedores.index', compact('proveedores'));
        
    }


    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);

        return view('vadmin.proveedores.show', compact('proveedor'));
    }

    //////////////////////////////////////////////////
    //                 GET DATA                     //
    //////////////////////////////////////////////////

    public function get_provider($id)
    {   
        $provider = Proveedor::where('id', '=', $id)->first();
        
        if ($provider != null) {
            return response()->json(['proveedor' => $provider]);
        } else {
            return response()->json(['proveedor' => '0']);
        }      
    }

    public function provider_autocomplete(Request $request)
    {

        $input = $request->term;

        $queries = Proveedor::where('nombre', 'LIKE', '%'.$input.'%' )->take(10)->get();

        foreach ($queries as $query)
        {
            $results[] = ['id' => $query->id, 'value' => $query->nombre]; //you can take custom values as you want
        }
        return response()->json($results);
    }
    
    //////////////////////////////////////////////////
    //                   STORE                      //
    //////////////////////////////////////////////////

    public function create()
    {
        $ultproveedor_id = Proveedor::orderBy('id','DESC')->first();
        $provincias      = Provincia::orderBy('name', 'ASC')->pluck('name', 'id');
        $localidades     = Localidad::orderBy('name', 'ASC')->pluck('name', 'id');
        $iva             = Iva::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('vadmin.proveedores.create')
            ->with('ultproveedor_id', $ultproveedor_id)
            ->with('provincias', $provincias)
            ->with('localidades', $localidades)
            ->with('iva', $iva);
        
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'             => 'required|unique:proveedores,nombre',
        ],[
            'nombre.required'    => 'Debe ingresar un nombre',
            'nombre.unique'      => 'El proveedor ya existe',
        ]);
        
        $proveedor = new Proveedor($request->all());
        
        $proveedor->iva_id          = $request->iva;
        $proveedor->provincia_id    = $request->provincia;
        $proveedor->localidad_id    = $request->localidad;

        $proveedor->save();

        Session::flash('flash_message', 'Proveedor added!');

        return redirect('vadmin/proveedores');
    }


    //////////////////////////////////////////////////
    //                  EDIT                        //
    //////////////////////////////////////////////////
    
    public function edit($id)
    {
        $ultproveedor_id = Proveedor::orderBy('id','DESC')->first();
        $proveedor       = Proveedor::findOrFail($id);
        $provincias      = Provincia::orderBy('name', 'ASC')->pluck('name', 'id');
        $localidades     = Localidad::orderBy('name', 'ASC')->pluck('name', 'id');
        $iva             = Iva::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('vadmin.proveedores.edit')
            ->with('proveedor', $proveedor)
            ->with('provincias', $provincias)
            ->with('localidades', $localidades)
            ->with('ultproveedor_id', $ultproveedor_id)
            ->with('iva', $iva);
    }

    public function update($id, Request $request)
    {
        // $this->validate($request,[
        //     'nombre'              => 'required|unique:proveedores,nombre',
        // ],[
        //     'nombre.required'     => 'Debe ingresar un nombre',
        //     'nombre.unique'      => 'El item ya existe',
        // ]);
        
        $requestData = $request->all();
        
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($requestData);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->fill($request->all());
        $proveedor->save();

        Session::flash('flash_message', 'Proveedor actualizado');

        return redirect('vadmin/proveedores');
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Proveedor::find($id);
                    $record->delete();
                }
                return response()->json([
                    'success'   => true,
                ]); 
            }  catch (\Illuminate\Database\QueryException $e) {
                return response()->json([
                    'success'   => false,
                    'error'    => 'Error: '.$e
                ]);    
            }
        } else {
            try {
                $record = Proveedor::find($id);
                $record->delete();
                    return response()->json([
                        'success'   => true,
                    ]);  
                    
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'success'   => false,
                        'error'    => 'Error: '.$e
                    ]);    
                }
        }
    }


}

<?php

namespace App\Http\Controllers\Proveedores;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Proveedor;
use App\Provincia;
use App\Localidade;
use App\Iva;

use Illuminate\Http\Request;
use Session;

class ProveedoresController extends Controller
{

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

    public function create()
    {
        $ultproveedor_id = Proveedor::orderBy('id','DESC')->first();
        $provincias      = Provincia::orderBy('name', 'ASC')->pluck('name', 'id');
        $localidades     = Localidade::orderBy('name', 'ASC')->pluck('name', 'id');
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
            'nombre'              => 'required|unique:proveedores,nombre',
        ],[
            'nombre.required'     => 'Debe ingresar un nombre',
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

    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);

        return view('vadmin.proveedores.show', compact('proveedor'));
    }

    //////////////////////////////////////////////////
    //                  EDIT                        //
    //////////////////////////////////////////////////
    
    public function edit($id)
    {
        $proveedor   = Proveedor::findOrFail($id);
        $provincias  = Provincia::orderBy('name', 'ASC')->pluck('name', 'id');
        $localidades = Localidade::orderBy('name', 'ASC')->pluck('name', 'id');
        $iva         = Iva::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('vadmin.proveedores.edit')
            ->with('proveedor', $proveedor)
            ->with('provincias', $provincias)
            ->with('localidades', $localidades)
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

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Proveedor::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Proveedor::find($id);
            Proveedor::destroy($id);
        }
        echo 1;
    }


}

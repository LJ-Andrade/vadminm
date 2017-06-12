<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Factura;
use App\Cliente;
use App\Pedidositem;
use Illuminate\Http\Request;
use Session;

class FacturasController extends Controller
{

    //////////////////////////////////////////////////
    //                  INDEX                       //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $facturas = Factura::where('numero', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $facturas = Factura::paginate($perPage);
        }

        return view('vadmin.facturas.index', compact('facturas'));
    }

    //////////////////////////////////////////////////
    //                  CREATE                      //
    //////////////////////////////////////////////////

    public function create()
    {
        $clientes = Cliente::orderBy('id', 'ASC')->pluck('razonsocial', 'id');
        return view('vadmin.facturas.create')->with('clientes', $clientes);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'              => 'required|unique:facturas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'       => 'El item ya existe',
        ]);

        $requestData = $request->all();
        
        Factura::create($requestData);

        Session::flash('flash_message', 'Factura added!');

        return redirect('vadmin/facturas');
    }

    //////////////////////////////////////////////////
    //                  SHOW                        //
    //////////////////////////////////////////////////

    public function prepare_fc(Request $request)
    {

        $cliente = Cliente::where('id', '=', $request->clienteid)->first();
        $items   = $request->items;

        // Cambiar en pedidositems el id de pedido_id y ponerselo a factura_id

        $fc      = new Factura();
        $fc->cliente_id   = $request->clienteid;
        $fc->centroemisor = 'CentroTest';
        $fc->save();
        


        return response()->json([
            "id"    => $fc->id,
        ]);

        // return view('vadmin.facturas.show')
        //     ->with('fc', $fc);
    }


    //////////////////////////////////////////////////
    //                  SHOW                        //
    //////////////////////////////////////////////////

    public function show($id)
    {
        $factura = Factura::findOrFail($id);

        return view('vadmin.facturas.show', compact('factura'));
    }


    //////////////////////////////////////////////////
    //               EDIT / UPDATE                   //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $factura = Factura::findOrFail($id);

        return view('vadmin.facturas.edit', compact('factura'));
    }

    public function update($id, Request $request)
    {

        $this->validate($request,[
            'name'              => 'required|unique:facturas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        $requestData = $request->all();
        
        $factura = Factura::findOrFail($id);
        $factura->update($requestData);

        Session::flash('flash_message', 'Factura updated!');

        return redirect('vadmin/facturas');
    }

    //////////////////////////////////////////////////
    //                DESTROY                       //
    //////////////////////////////////////////////////

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Factura::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Factura::find($id);
            Factura::destroy($id);
        }
        echo 1;
    }


}

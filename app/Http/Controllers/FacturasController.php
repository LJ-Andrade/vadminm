<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Factura;
use App\Cliente;
use App\Pedidositem;
use Illuminate\Http\Request;
use Session;
// use GuzzleHttp\Exception\GuzzleException;
// use GuzzleHttp\Client;

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

  

    public function store_fc(Request $request)
    {
        
        $client = Cliente::findOrFail($request->clientid);
        
        try{
            $fc     = new Factura();

            $fc->numero        = $request->nro;
            $fc->cae           = $request->cae;
            $fc->vto           = $request->vto;
            $fc->pto_vta       = $request->pto_vta;
            $fc->tipo_fc       = $request->tipofcname;
            $fc->direntrega_id = $request->direntrega;
            $fc->iva           = $request->ivasubtotal;
            $fc->subtotal      = $request->subtotal;
            $fc->total         = $request->total;
            $fc->flete_id      = $request->flete;
            $fc->vendedor_id   = $request->vendedor;
            $fc->cliente_id    = $request->clientid;
            // Si sale todo bien
            $fc->estado  = '1';        
            // $fc->save();

            return response()->json(['success' => true,
                                     'message' => 'Documento guardado',
                                     'data'    => $fc]); 

        } catch(Exception $e) {

            return response()->json(['success' => false,
                                     'message' => 'Error: '.$e]); 
        }



    }


    // Almost obsolete
    public function get_fc_data(Request $request)
    {
        
        // Set Pending Orders to Done
        // They´re going to keep appearing in orders but not in FC

        // if(!$request->markAsFcDone == null) {
        //     $ordersFcDone = $request->markAsFcDone;
            
        //     foreach ($ordersFcDone as $orderid){
                
        //         $pedidoItem = Pedidositem::findOrFail($orderid);
        //         $pedidoItem->facturado = 1;
        //         $pedidoItem->save();

        //     }
        // }

       

        $cuit = $request->cuit;
     
        $fc      = new Factura();

        // **** FAKE DATA ****
        $fc->numero        = '0000-'.$request->cuit;
        $fc->tipo_fc_id    = $request->tipofcid;
        $fc->tipo_fc       = $request->tipofcname;
        $fc->cae           = '1234565';
        $fc->centroemisor  = 'CentroEmisor';
        $fc->direntrega_id = '2';
        $fc->iva           = $request->ivasubtotal;
        $fc->subtotal      = $request->subtotal;
        $fc->total         = $request->total;
        $fc->flete_id      = '2';
        $fc->vendedor_id   = '2';
        $fc->cliente_id    = $request->clientid;
        // Si sale todo bien
        $fc->estado  = '1';

         dd($fc);
        $fc->save();

        return redirect('vadmin/facturas');
    }

    //////////////////////////////////////////////////
    //                  SHOW                        //
    //////////////////////////////////////////////////


        
    public function ajax_list(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->paginate(12);
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
    // public function destroy($id)
    // {
    //     $item = Factura::find($id);
    //     $item->delete();
    //     echo 1;
    // }


    // // ---------- Ajax Bach Delete -------------- //
    // public function ajax_batch_delete(Request $request, $id)
    // {
    //     foreach ($request->id as $id) {
        
    //         $item  = Factura::find($id);
    //         Factura::destroy($id);
    //     }
    //     echo 1;
    // }


}

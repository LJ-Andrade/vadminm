<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Reparacionesitem;
use App\Reparacion;
use App\Producto;
use App\Cliente;
use Illuminate\Http\Request;
use Session;

class ReparacionesItemsController extends Controller
{

    //////////////////////////////////////////////////
    //                 INDEX                        //
    //////////////////////////////////////////////////
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $reparacionesitems = Reparacionesitem::where('producto_id', 'LIKE', "%$keyword%")
				->orWhere('pedido_id', 'LIKE', "%$keyword%")
				->orWhere('cantidad', 'LIKE', "%$keyword%")
				->orWhere('valor', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $reparacionesitems = Reparacionesitem::paginate($perPage);
        }

        return view('vadmin.reparacionesitems.index', compact('reparacionesitems'));
    }

    //////////////////////////////////////////////////
    //                 CREATE                       //
    //////////////////////////////////////////////////

    public function create()
    {
        $reparaciones = Reparacion::orderBy('id', 'ASC')->pluck('id', 'cliente_id');
        $productos    = Producto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('vadmin.reparacionesitems.create')
            ->with('reparaciones', $reparaciones)
            ->with('productos', $productos);
    }

    public function ajax_store(Request $request)
    {
        $response = $request->all();

        return response()->json([
            "result"   => 'Done',
            "data" => $response
        ]);

    }

    public function ajax_store_item(Request $request)
    {
        $item     = new Reparacionesitem($request->all());
        $item->save();
        $newitem  = Reparacionesitem::findOrFail($item->id);
        $producto = $newitem->producto->nombre;
        return response()->json([
            'producto' => $producto,
            'cantidad' => $item->cantidad,
            'valor'    => $item->valor
        ]);
    }

    public function store(Request $request)
    {
        
        $cliente    = Cliente::where('cliente_id', '=', $request->cliente_id );
        $reparacionesitem = new Reparacionesitem($request->all());
        $reparacionesitem->save();

        return redirect('vadmin/reparacionesitems');
    }

    //////////////////////////////////////////////////
    //                    SHOW                      //
    //////////////////////////////////////////////////

    public function show($id)
    {
        $reparacionesitem = Reparacionesitem::findOrFail($id);
        
        return view('vadmin.reparacionesitems.show', compact('reparacionesitem'));
    }

    //////////////////////////////////////////////////
    //                    EDIT                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $reparacionesitem = ReparacionesItem::findOrFail($id);

        return view('vadmin.reparacionesitems.edit', compact('reparacionesitem'));
    }

    public function update($id, Request $request)
    {

        $requestData = $request->all();
        
        $reparacionesitem = ReparacionesItem::findOrFail($id);
        $reparacionesitem->update($requestData);

        Session::flash('flash_message', 'ReparacionesItem updated!');

        return redirect('vadmin/reparaciones-items');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Reparacionesitem::find($id);
        $item->delete();
        return response()->json([
            "result"   => 1
        ]);
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Reparacionesitem::find($id);
            ReparacionesItem::destroy($id);
        }
        return response()->json([
            "result"   => 1
        ]);
    }


}

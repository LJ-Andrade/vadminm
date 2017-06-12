<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pedidositem;
use App\Pedido;
use App\Producto;
use App\Cliente;
use Illuminate\Http\Request;
use Session;

class PedidositemsController extends Controller
{
    //////////////////////////////////////////////////
    //                 INDEX                        //
    //////////////////////////////////////////////////
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $pedidositems = Pedidositem::where('producto_id', 'LIKE', "%$keyword%")
				->orWhere('pedido_id', 'LIKE', "%$keyword%")
				->orWhere('cantidad', 'LIKE', "%$keyword%")
				->orWhere('valor', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $pedidositems = Pedidositem::paginate($perPage);
        }

        return view('vadmin.pedidositems.index', compact('pedidositems'));
    }

    //////////////////////////////////////////////////
    //                 CREATE                       //
    //////////////////////////////////////////////////

    public function create()
    {
        $pedidos   = Pedido::orderBy('id', 'ASC')->pluck('id', 'cliente_id');
        $productos = Producto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('vadmin.pedidositems.create')
            ->with('pedidos', $pedidos)
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
        $item     = new Pedidositem($request->all());
        $item->save();
        $newitem  = Pedidositem::findOrFail($item->id);
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
        $pedidoitem = new Pedidositem($request->all());
        $pedidoitem->save();
        

        Session::flash('flash_message', 'Pedidositem added!');

        return redirect('vadmin/pedidositems');
    }

    //////////////////////////////////////////////////
    //                    SHOW                      //
    //////////////////////////////////////////////////

    public function show($id)
    {
        $pedidositem = Pedidositem::findOrFail($id);
        
        return view('vadmin.pedidositems.show', compact('pedidositem'));
    }


    //////////////////////////////////////////////////
    //                    EDIT                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $pedidositem = Pedidositem::findOrFail($id);

        return view('vadmin.pedidositems.edit', compact('pedidositem'));
    }

    public function update($id, Request $request)
    {

        $this->validate($request,[
            'name'              => 'required|unique:pedidositems,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        $requestData = $request->all();
        
        $pedidositem = Pedidositem::findOrFail($id);
        $pedidositem->update($requestData);

        Session::flash('flash_message', 'Pedidositem updated!');

        return redirect('vadmin/pedidositems');
    }

    //////////////////////////////////////////////////
    //                 FACTURACION                  //
    //////////////////////////////////////////////////


    public function get_pedidositems_fc($id)
    {
        $pedidositems = Pedidositem::where('cliente_id', '=', $id)->get();
        $cliente      = Cliente::where('id', '=', $id)->first();

        return view('vadmin/facturas/pedidoslist')
            ->with('pedidositems', $pedidositems)
            ->with('cliente', $cliente);      

    }



    //////////////////////////////////////////////////
    //                    DESTROY                   //
    //////////////////////////////////////////////////
    
    public function destroy($id)
    {
        $item = Pedidositem::find($id);
        $item->delete();

        return response()->json([
            "result"   => 1
        ]);
     
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Pedidositem::find($id);
            Pedidositem::destroy($id);
        }
        echo 1;
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pedido;
use App\Pedidositem;
use App\Producto;
use App\Cliente;
use App\Tipoct;
use App\Familia;
use Illuminate\Http\Request;
use Session;

class PedidosController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 20;

        if (!empty($keyword)) {
            $pedidos = Pedido::where('nombre', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $pedidos = Pedido::paginate($perPage);
        }

        return view('vadmin.pedidos.index', compact('pedidos'));
    }



    public function ajax_get_pedidos($id)
    {
        $pedidos  = Pedido::where('cliente_id', '=', $id)->first();
    
        if (is_null($pedidos)) {
            return response()->json([
                "response"   => 0
            ]);
        } else {
        
            return response()->json([
                "response"   => 1,
                "pedidos" => $pedidos
            ]);
            
        }


    }

    //////////////////////////////////////////////////
    //                 CREATE                       //
    //////////////////////////////////////////////////

    public function create()
    {
        $clientes  = Cliente::orderBy('razonsocial', 'DESC')->pluck('razonsocial', 'id');
        $productos = Producto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('vadmin.pedidos.create')
            ->with('clientes', $clientes)
            ->with('productos', $productos);
    }

    public function ajax_store(Request $request)
    {

        $pedido     = new Pedido($request->all());
        $pedido->save();
        $id         = $pedido->id;

        return response()->json([
            "result"   => 'Done',
            "pedidoid" => $id
        ]);

    }
    
    public function store(Request $request)
    {
        $pedido = new Pedido($request->all());

        $pedido->save();
        
        Session::flash('flash_message', 'Pedido generado!');


        return redirect('vadmin/pedidos/'.$pedido->id);
    }

    //////////////////////////////////////////////////
    //                   SHOW                       //
    //////////////////////////////////////////////////

    public function show($id)
    {
        $pedido     = Pedido::findOrFail($id);        
        $productos  = Producto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $cantidades = Pedidositem::where('pedido_id', '=', $id)->pluck('cantidad');
        $valores    = Pedidositem::where('pedido_id', '=', $id)->pluck('valor');
        $familias    = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');

        $tipo       = Tipoct::where('id', '=', $pedido->cliente->tipo_id)->first();
        if($tipo == null){
          $tipocte = '';
        } else {
          $tipocte    = $tipo->name;
        }
        $x     = count($cantidades);
        $total = 0;
        for ($i=0; $i < $x ; $i++) { 
            $total += ($cantidades[$i] * $valores[$i]);
        }


        return view('vadmin.pedidos.show')
            ->with('productos', $productos)
            ->with('tipocte', $tipocte)
            ->with('pedido', $pedido)
            ->with('total', $total)
            ->with('familias', $familias);
    }

    //////////////////////////////////////////////////
    //                   EDIT                       //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('vadmin.pedidos.edit', compact('pedido'));
    }

    public function update($id, Request $request)
    {

        $this->validate($request,[
            'nombre'              => 'required|unique:pedidos,nombre',
        ],[
            'nombre.required'     => 'Debe ingresar un nombre',
            'nombre.unique'      => 'El item ya existe',
        ]);

        $requestData = $request->all();
        
        $pedido = Pedido::findOrFail($id);
        $pedido->update($requestData);

        Session::flash('flash_message', 'Pedido updated!');

        return redirect('vadmin/pedidos');
    }

    public function update_status(Request $request)
    {
        echo 'ok';
    }

    //////////////////////////////////////////////////
    //                 DESTROY                      //
    //////////////////////////////////////////////////

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Pedido::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Pedido::find($id);
            Pedido::destroy($id);
        }
        echo 1;
    }


}

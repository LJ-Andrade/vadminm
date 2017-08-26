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
use Excel;
use PDF;


class PedidosController extends Controller
{
    
    //////////////////////////////////////////////////
    //                 INDEX                        //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
                
        $key     = $request->get('show');
        $name    = $request->get('name');
        $number  = $request->get('number');
        $perPage = 20;


        if (!empty($key)) {
            // Show All Orders (Sended too)
            if ($key=='5') {
                $pedidos = Pedido::paginate($perPage);
            } else {
                // Show all orders but sended
                $pedidos = Pedido::where('estado', '!=', "3")->paginate($perPage);
            }   
        } else {
            if($number) {
                $pedidos = Pedido::where('id', '=', "$number")->paginate($perPage);
            } else {
                $pedidos = Pedido::where('estado', '!=', "3")->paginate($perPage);
            }
        }

        
            // Show orders filtered by Id or Name 

        //     elseif($name) {
        //         $pedidos = Pedido::where('cliente', '=', "$name")->paginate($perPage);
        //     } elseif ($number) {
        //         $pedidos = Pedido::where('id', '=', "$number")->paginate($perPage);
        //     } else {}
        //         $pedidos = Pedido::where('estado', '=', "$key")->paginate($perPage);
        // }  {
        // }

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
        $clientes  = Cliente::orderBy('razonsocial', 'ASC')->pluck('razonsocial', 'id');
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
        // $familias   = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
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
            ->with('total', $total);
    }

    //////////////////////////////////////////////////
    //                  EXPORT                      //
    //////////////////////////////////////////////////


    public function exportPdf($id){
        $pedido     = Pedido::findOrFail($id);
        $productos  = Producto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $cantidades = Pedidositem::where('pedido_id', '=', $id)->pluck('cantidad');
        $valores    = Pedidositem::where('pedido_id', '=', $id)->pluck('valor');
        $tipo       = Tipoct::where('id', '=', $pedido->cliente->tipo_id)->first();
        $filename   = 'pedido-n-'.$pedido->id.'.pdf';
        
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

        $pdf  = PDF::loadView('vadmin.pedidos.export', compact('pedido', 'tipocte', 'productos', 'valores', 'total'));

        // For Test
        //  return view('vadmin.pedidos.export')
        //     ->with('productos', $productos)
        //     ->with('tipocte', $tipocte)
        //     ->with('pedido', $pedido)
        //     ->with('total', $total);
                
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream($filename);

    }

    //////////////////////////////////////////////////
    //               UPDATE STATUS                  //
    //////////////////////////////////////////////////
    
    public function updateStatus(Request $request, $id)
    {

        $pedido = Pedido::find($id);
        $pedido->estado = $request->estado;            
        $pedido->save();

        return response()->json([
            "lastStatus" => $pedido->estado,
        ]);

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
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Pedido::find($id);
                    $record->delete();
                }
                return response()->json([
                    'success'   => true,
                ]); 
            }  catch (Exception $e) {
                return response()->json([
                    'success'   => false,
                    'error'    => 'Error: '.$e
                ]);    
            }
        } else {
            try {
                $record = Pedido::find($id);
                $record->delete();
                    return response()->json([
                        'success'   => true,
                    ]);  
                    
                } catch (Exception $e) {
                    return response()->json([
                        'success'   => false,
                        'error'    => 'Error: '.$e
                    ]);    
                }
        }
    }


}

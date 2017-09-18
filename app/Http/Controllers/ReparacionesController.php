<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Reparacion;
use App\Reparacionesitem;
use App\Producto;
use App\Cliente;
use App\Familia;
use App\Tipoct;
use Illuminate\Http\Request;
use Session;
use Excel;
use PDF;

class ReparacionesController extends Controller
{
    //////////////////////////////////////////////////
    //                   INDEX                      //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $key = $request->get('show');
        $perPage = 25;
        
        if (!empty($key)) {
            if ($key=='5') {
                $reparaciones = Reparacion::paginate($perPage);
            } else {
                $reparaciones = Reparacion::where('estado', '=', "$key")->paginate($perPage);
            }
        } else {
            $reparaciones = Reparacion::where('estado', '!=', "4")->paginate($perPage);
        }

        return view('vadmin.reparaciones.index', compact('reparaciones'));
    }


    public function ajax_get_reparaciones($id)
    {
        $reparaciones = Reparacion::where('cliente_id', '=', $id)->first();
    
        if (is_null($reparaciones)) {
            return response()->json([
                "response"   => 0
            ]);
        } else {
        
            return response()->json([
                "response"   => 1,
                "reparaciones" => $reparaciones
            ]);
        
        }
    }

    //////////////////////////////////////////////////
    //                    CREATE                    //
    //////////////////////////////////////////////////


    public function create()
    {
        $clientes  = Cliente::orderBy('razonsocial', 'ASC')->pluck('razonsocial', 'id');
        $productos = Producto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('vadmin.reparaciones.create')
            ->with('clientes', $clientes)
            ->with('productos', $productos);
    }

    public function ajax_store(Request $request)
    {

        $pedido = new Reparacion($request->all());
        $pedido->save();
        $id     = $pedido->id;

        return response()->json([
            "result"       => 'Done',
            "reparacionid" => $id
        ]);

    }

    public function store(Request $request)
    {        
        $reparacion = new Reparacion($request->all());
        $reparacion->save();
        
        return redirect('vadmin/reparaciones/'.$reparacion->id);
    }

    //////////////////////////////////////////////////
    //                 SHOW                         //
    //////////////////////////////////////////////////
    
    public function show($id)
    {
        $reparacion = Reparacion::findOrFail($id);        
        $productos  = Producto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $cantidades = Reparacionesitem::where('reparacion_id', '=', $id)->pluck('cantidad');
        $valores    = Reparacionesitem::where('reparacion_id', '=', $id)->pluck('valor');
        // $familias   = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $tipo       = Tipoct::where('id', '=', $reparacion->cliente->tipo_id)->first();

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

        return view('vadmin.reparaciones.show')
            ->with('reparacion', $reparacion)
            ->with('productos', $productos)
            ->with('tipocte', $tipocte)
            ->with('total', $total);
    }


    //////////////////////////////////////////////////
    //                  EXPORT                      //
    //////////////////////////////////////////////////


    public function exportPdf($id){
        $reparacion = Reparacion::findOrFail($id);
        $productos  = Producto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $cantidades = Reparacionesitem::where('reparacion_id', '=', $id)->pluck('cantidad');
        $valores    = Reparacionesitem::where('reparacion_id', '=', $id)->pluck('valor');
        $tipo       = Tipoct::where('id', '=', $reparacion->cliente->tipo_id)->first();
        $filename   = 'reparacion-n-'.$reparacion->id.'.pdf';
        
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

        $pdf  = PDF::loadView('vadmin.reparaciones.export', compact('reparacion', 'tipocte', 'productos', 'valores', 'total'));

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

        $reparacion = Reparacion::find($id);
        $reparacion->estado = $request->estado;            
        // dd($request->estado);
        $reparacion->save();

        return response()->json([
            "lastStatus" => $reparacion->estado,
        ]);

    }


    //////////////////////////////////////////////////
    //                 EDIT                         //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $reparaciones = Reparacion::findOrFail($id);

        return view('vadmin.reparaciones.edit', compact('reparaciones'));
    }


    public function update($id, Request $request)
    {

        $this->validate($request,[
            'name'              => 'required|unique:reparaciones,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $reparaciones = Reparacion::findOrFail($id);
        $reparaciones->update($requestData);

        Session::flash('flash_message', 'Reparaciones updated!');

        return redirect('vadmin/reparaciones');
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Reparacion::find($id);
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
                $record = Reparacion::find($id);
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

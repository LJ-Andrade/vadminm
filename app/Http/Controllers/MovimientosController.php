<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Movimiento;
use App\Comprobante;
use Illuminate\Http\Request;
use Session;

class MovimientosController extends Controller
{

    //////////////////////////////////////////////////
    //                   VIEW                       //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $movimientos = Movimiento::where('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $movimientos = Movimiento::paginate($perPage);
        }

        return view('vadmin.movimientos.index', compact('movimientos'));
    }

    public function show($id)
    {
        $movimiento = Movimiento::findOrFail($id);

        return view('vadmin.movimientos.show', compact('movimiento'));
    }

    //////////////////////////////////////////////////
    //                   CREATE                     //
    //////////////////////////////////////////////////

    public function create()
    {
        return view('vadmin.movimientos.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $movement     = new Movimiento($request->all());
        $saldo        = Movimiento::sum('importe');
        // $saldo        = $saldo + $request->importe;
        
        $comprobante  = Comprobante::where('id','=',$request->comprobante_id)->first();
        if($comprobante){
            $movement->comprobante_nro = $comprobante->nro;
        }
        // $movement->subtotal = $saldo;

        $movement->save();

        return redirect($request->redirect)->with('message', 'Importe ingresado');  
    }

    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $movimiento = Movimiento::findOrFail($id);

        return view('vadmin.movimientos.edit', compact('movimiento'));
    }

    public function update($id, Request $request)
    {   
        $movimiento = Movimiento::findOrFail($id);

        $this->validate($request,[
            'name'          => 'required|unique:movimiento,name,'.$tiposcomprobantes->id
                                
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'       => 'El nombre ya existe'
        ]);
    
        $movimiento->fill($request->all());
        $movimiento = $movimiento->save();

        return redirect('vadmin/movimientos')->with('message','Actualizado Correctamente');

    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Movimiento::find($id);
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
                $record = Movimiento::find($id);
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

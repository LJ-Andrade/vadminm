<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TiposComprobante;
use Illuminate\Http\Request;
use Session;

class TiposComprobantesController extends Controller
{
    
    //////////////////////////////////////////////////
    //                   VIEW                       //
    //////////////////////////////////////////////////


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $tiposcomprobantes = TiposComprobante::where('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $tiposcomprobantes = TiposComprobante::paginate($perPage);
        }

        return view('vadmin.tiposcomprobantes.index', compact('tiposcomprobantes'));
    }

    public function show($id)
    {
        $tiposcomprobantes = TiposComprobante::findOrFail($id);

        return view('vadmin.tiposcomprobantes.show', compact('tiposcomprobantes'));
    }

    //////////////////////////////////////////////////
    //                   CREATE                     //
    //////////////////////////////////////////////////


    public function create()
    {
        return view('vadmin.tiposcomprobantes.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        TiposComprobante::create($requestData);

        Session::flash('flash_message', 'Comprobante agregado');

        return redirect('vadmin/tiposcomprobantes');
    }

    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $tiposcomprobante = TiposComprobante::findOrFail($id);

        return view('vadmin.tiposcomprobantes.edit', compact('tiposcomprobante'));
    }

    public function update($id, Request $request)
    {
        
        $tiposcomprobantes = TiposComprobante::findOrFail($id);

        $this->validate($request,[
            'name'          => 'required|unique:tiposcomprobantes,name,'.$tiposcomprobantes->id,
            'afipcode'      => 'required|unique:tiposcomprobantes,afipcode,'.$tiposcomprobantes->id,
            'letter'        => 'required'
                                
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'       => 'El nombre de la categoría ya existe',
            'afipcode.required' => 'Debe ingresar un código Afip',
            'afipcode.unique'   => 'El código ya está ingresado en otra categoría',
            'letter.required'   => 'Debe ingresar una letra'
        ]);
    
        $tiposcomprobantes->fill($request->all());
        $tiposcomprobantes = $tiposcomprobantes->save();

        return redirect('vadmin/tiposcomprobantes')->with('message','Comprobante actualizado');
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = TiposComprobante::find($id);
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
                $record = TiposComprobante::find($id);
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\NotasDeCredito;
use Illuminate\Http\Request;
use Session;

class NotasDeCreditosController extends Controller
{

    //////////////////////////////////////////////////
    //                   VIEW                       //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $notasDeCreditos = NotasDeCredito::where('nro', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $notasDeCreditos = NotasDeCredito::paginate($perPage);
        }

        return view('vadmin.notasdecredito.index', compact('notasDeCreditos'));
    }

    public function show($id)
    {
        $notasdecredito = NotasDeCredito::findOrFail($id);

        return view('vadmin.notasdecredito.show', compact('notasdecredito'));
    }

    //////////////////////////////////////////////////
    //                   CREATE                     //
    //////////////////////////////////////////////////

    public function create()
    {
        return view('vadmin.notasdecredito.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        NotasDeCredito::create($requestData);

        Session::flash('flash_message', 'NotasDeCredito added!');

        return redirect('vadmin/notasdecredito');
    }

    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $notasdecredito = NotasDeCredito::findOrFail($id);

        return view('vadmin.notas-de-creditos.edit', compact('notasdecredito'));
    }

    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $notasdecredito = NotasDeCredito::findOrFail($id);
        $notasdecredito->update($requestData);

        Session::flash('flash_message', 'NotasDeCredito updated!');

        return redirect('vadmin/notasdecredito');
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = NotasDeCredito::find($id);
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
                $record = NotasDeCredito::find($id);
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

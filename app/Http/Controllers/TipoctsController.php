<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tipoct;
use Illuminate\Http\Request;
use Session;

class TipoctsController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $tipocts = Tipoct::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $tipocts = Tipoct::paginate($perPage);
        }

        return view('vadmin.tipocts.index', compact('tipocts'));
    }

    public function create()
    {
        return view('vadmin.tipocts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'           => 'required|unique:tipocts,name',
        ],[
            'name.required'  => 'Debe ingresar un nombre',
            'name.unique'    => 'El item ya existe',
        ]);

        $requestData = $request->all();
        
        Tipoct::create($requestData);

        Session::flash('flash_message', 'Tipoct added!');

        return redirect('vadmin/tipocts');
    }

    public function show($id)
    {
        $tipoct = Tipoct::findOrFail($id);

        return view('vadmin.tipocts.show', compact('tipoct'));
    }


    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $tipoct = Tipoct::findOrFail($id);

        return view('vadmin.tipocts.edit', compact('tipoct'));
    }

    public function update($id, Request $request)
    {   

        $tipoct = Tipoct::findOrFail($id);

        $this->validate($request,[
            'name'          => 'required|unique:tipocts,name,'.$tipoct->id
        ],[
            'name.required' => 'Debe ingresar un tipo de cliente',
            'name.unique'   => 'El tipo de cliente ya existe',
        ]);


        $tipoct->fill($request->all());
        $tipoct->save();

        Session::flash('flash_message', 'Tipoct updated!');

        return redirect('vadmin/tipocts');
    }

        
    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   
        
        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Tipoct::find($id);
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
                $record = Tipoct::find($id);
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

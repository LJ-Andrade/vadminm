<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Provincia;
use Illuminate\Http\Request;
use Session;

class ProvinciasController extends Controller
{
    //////////////////////////////////////////////////
    //                   VIEW                       //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $provincias = Provincia::where('name', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $provincias = Provincia::paginate($perPage);
        }

        return view('vadmin.provincias.index', compact('provincias'));
    }

    public function show($id)
    {
        $provincia = Provincia::findOrFail($id);

        return view('vadmin.provincias.show', compact('provincia'));
    }

    //////////////////////////////////////////////////
    //                   CREATE                     //
    //////////////////////////////////////////////////


    public function create()
    {
        return view('vadmin.provincias.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'          => 'required|unique:provincias,name'
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'       => 'La provincia ya existe'
        ]);

        $requestData = $request->all();
        
        Provincia::create($requestData);

        Session::flash('flash_message', 'Provincia agregada');

        return redirect('vadmin/provincias');
    }

    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $provincia = Provincia::findOrFail($id);
        return view('vadmin.provincias.edit', compact('provincia'));
    }

    public function update($id, Request $request)
    {
        $provincia = Provincia::findOrFail($id);

        $this->validate($request,[
            'name'          => 'required|unique:provincias,name,'.$provincia->id
                                
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'       => 'El nombre de la categoría ya existe'
        ]);
    
        $provincia->fill($request->all());
        $provincia = $provincia->save();

        Session::flash('flash_message', 'Provincia actualizada');

        return redirect('vadmin/provincias');
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Provincia::find($id);
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
                $record = Provincia::find($id);
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


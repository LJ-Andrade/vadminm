<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Zona;
use Illuminate\Http\Request;
use Session;

class ZonasController extends Controller
{

    //////////////////////////////////////////////////
    //                    VIEW                      //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $zonas = Zona::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $zonas = Zona::paginate($perPage);
        }

        return view('vadmin.zonas.index', compact('zonas'));
    }

    public function show($id)
    {
        $zona = Zona::findOrFail($id);

        return view('vadmin.zonas.show', compact('zona'));
    }

    //////////////////////////////////////////////////
    //                  CREATE                      //
    //////////////////////////////////////////////////

    public function create()
    {
        return view('vadmin.zonas.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'             => 'required|unique:zonas,name',
        ],[
            'name.required'    => 'Debe ingresar un nombre',
            'name.unique'      => 'La zona ya existe',
        ]);
        
        $requestData = $request->all();
        Zona::create($requestData);

        return redirect('vadmin/zonas')->with('message', 'Zona creada');
    }

    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $zona = Zona::findOrFail($id);

        return view('vadmin.zonas.edit', compact('zona'));
    }

    public function update($id, Request $request)
    {
        $zona = Zona::findOrFail($id);

        $this->validate($request,[
            'name'          => 'required|unique:zonas,name,'.$zona->id
        ],[
            'name.required' => 'Debe ingresar un nombre',
            'name.unique'   => 'La zona ya existe',
        ]);

        $zona->fill($request->all());
        $zona->save();

        Session::flash('flash_message', 'Zona updated!');

        return redirect('vadmin/zonas');
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {

            try {
                foreach ($request->id as $id) {
                    $record = Zona::find($id);
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
                $record = Zona::find($id);
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

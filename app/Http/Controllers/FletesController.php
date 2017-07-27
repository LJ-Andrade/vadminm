<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Flete;
use App\Provincia;
use App\Localidad;

use Illuminate\Http\Request;
use Session;

class FletesController extends Controller
{

    //////////////////////////////////////////////////
    //                  VIEW                        //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $fletes = Flete::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $fletes = Flete::paginate($perPage);
        }

        return view('vadmin.fletes.index', compact('fletes'));
    }

    public function show($id)
    {
        $flete = Flete::findOrFail($id);

        return view('vadmin.fletes.show', compact('flete'));
    }

    //////////////////////////////////////////////////
    //                  CREATE                      //
    //////////////////////////////////////////////////

    public function create()
    {
        $provincias   = Provincia::orderBy('name', 'ASC')->pluck('name', 'id');
        $localidades  = Localidad::orderBy('name', 'ASC')->pluck('name', 'id');
        
        return view('vadmin.fletes.create')
            ->with('provincias', $provincias)
            ->with('localidades', $localidades);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'              => 'required|unique:fletes,name'
        ],[
            'name.required'     => 'Debe ingresar una localidad',
            'name.unique'      => 'La localidad ya existe',
        ]);

        $requestData = $request->all();
        
        Flete::create($requestData);

        Session::flash('flash_message', 'Flete agregado');

        return redirect('vadmin/fletes');
    }

    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $flete = Flete::findOrFail($id);

        $provincias   = Provincia::orderBy('name', 'ASC')->pluck('name', 'id');
        $localidades  = Localidad::orderBy('name', 'ASC')->pluck('name', 'id');
            if(is_null($flete->localidad)){
        $locId = ''; 
        } else { 
            $locId = $flete->localidad->id; 
        }

        return view('vadmin.fletes.edit')
            ->with('flete', $flete)
            ->with('locId', $locId)
            ->with('provincias', $provincias)
            ->with('localidades', $localidades);
    }

    public function update($id, Request $request)
    {
        $flete = Flete::findOrFail($id);

        $this->validate($request,[
            'name'          => 'required|unique:fletes,name,'.$flete->id,
        ],[
            'name.required' => 'Debe ingresar un nombre',
            'name.unique'   => 'El flete ya existe',
        ]);

        $flete->fill($request->all());
        $flete = $flete->save();

        Session::flash('flash_message', 'Flete actualizado');

        return redirect('vadmin/fletes');
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Flete::find($id);
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
                $record = Flete::find($id);
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

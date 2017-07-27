<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Localidad;
use App\Provincia;
use Illuminate\Http\Request;
use Session;

class LocalidadesController extends Controller
{

    //////////////////////////////////////////////////
    //                   VIEW                       //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $localidades = Localidad::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $localidades = Localidad::orderBy('name','ASC')->paginate($perPage);
        }

        return view('vadmin.localidades.index', compact('localidades'));
    }

    public function show($id)
    {
        $localidad = Localidad::findOrFail($id);
        return view('vadmin.localidades.show', compact('localidad'));
    }

    public function get_locs($id)
    {        
        $localidades = Localidad::where('province_id', '=', $id)->get();
        return response()->json($localidades);
    }

    //////////////////////////////////////////////////
    //                   CREATE                     //
    //////////////////////////////////////////////////

    public function create()
    {
        $provincias = Provincia::orderBy('name', 'ASC')->pluck('name', 'id');
        
        return view('vadmin.localidades.create')->with('provincias', $provincias);
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name'          => 'required|unique:localidades,name',
            'province_id'   => 'required'

        ],[
            'name.required'        => 'Debe ingresar una localidad',
            'name.unique'          => 'La localidad ya existe',
            'province_id.required' => 'Debe ingresar una provincia'
        ]);

        
        $requestData = $request->all();
        
        Localidad::create($requestData);

        Session::flash('flash_message', 'Localidade added!');

        return redirect('vadmin/localidades');
    }

    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $localidad = Localidad::findOrFail($id);
        $provincias = Provincia::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('vadmin.localidades.edit')
            ->with('localidad', $localidad)
            ->with('provincias', $provincias);

    }

    public function update($id, Request $request)
    {
        $localidad = Localidad::findOrFail($id);

        $this->validate($request,[
            'name'          => 'required|unique:localidades,name,'.$localidad->id,
            'province_id'   => 'required'

        ],[
            'name.required'        => 'Debe ingresar una localidad',
            'name.unique'          => 'La localidad ya existe',
            'province_id.required' => 'Debe ingresar una provincia'
        ]);
        
        $localidad->fill($request->all());
        $localidad = $localidad->save();

        Session::flash('flash_message', 'La localidad fue actualizada');

        return redirect('vadmin/localidades');
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Localidad::find($id);
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
                $record = Localidad::find($id);
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

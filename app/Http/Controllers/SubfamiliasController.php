<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subfamilia;
use App\Familia;
use Illuminate\Http\Request;
use Session;

class SubfamiliasController extends Controller
{   
    //////////////////////////////////////////////////
    //                   VIEW                       //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $subfamilias = Subfamilia::where('nombre', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $subfamilias = Subfamilia::paginate($perPage);
        }
        return view('vadmin.subfamilias.index', compact('subfamilias'));
    }   

    public function show($id)
    {
        $subfamilia = Subfamilia::findOrFail($id);
        return view('vadmin.subfamilias.show', compact('subfamilia'));
    }

    //////////////////////////////////////////////////
    //                   CREATE                     //
    //////////////////////////////////////////////////

    public function create()
    {

        $familias = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('vadmin.subfamilias.create')->with('familias', $familias);

    }

    public function store(Request $request)
    {
        
        $watch = Subfamilia::where('nombre','=', $request->nombre)->where('familia_id', '=', $request->familia_id)->get();
        if($watch->isEmpty()){ 
            $requestData = $request->all();
            Subfamilia::create($requestData);
        } else {
        
            $this->validate($request,[
                'nombre'          => 'required|unique:subfamilias,nombre',
            ],[
                'nombre.required' => 'Debe ingresar un nombre',
                'nombre.unique'   => 'La subfamilia ya existe',
            ]);
        }


        return redirect('vadmin/subfamilias')->with('message', 'Subfamilia creada correctamente');
    }

    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $subfamilia = Subfamilia::findOrFail($id);
        $familias   = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');

        return view('vadmin.subfamilias.edit')
            ->with('subfamilia', $subfamilia)
            ->with('familias', $familias);
    }

    public function update($id, Request $request)
    {

        $subfamilia = Subfamilia::findOrFail($id);
        $watch = Subfamilia::where('nombre','=', $request->nombre)->where('familia_id', '=', $request->familia_id)->get();
        // dd($watch);
        if($watch->isEmpty()){ 
            $subfamilia->fill($request->all());
            $subfamilia = $subfamilia->save();
        } else {
            $this->validate($request,[
                'nombre'          => 'required|unique:subfamilias,nombre,'.$subfamilia->id
            ],[
                'nombre.required' => 'Debe ingresar un nombre',
                'nombre.unique'   => 'La subfamilia ya existe',
            ]);
        }

        return redirect('vadmin/subfamilias')->with('message', 'Subfamilia editada correctamente');
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Subfamilia::find($id);
                    $record->delete();
                }
                return response()->json([
                    'success'   => true,
                ]); 
            }  catch ( \Illuminate\Database\QueryException $e) {
       
                return response()->json([
                    'success'   => false,
                    'error'    => 'Error: '.$e
                ]);    
            }
        } else {
            try {
                $record = Subfamilia::find($id);
                $record->delete();
                    return response()->json([
                        'success'   => true,
                    ]);  
                    
                } catch ( \Illuminate\Database\QueryException $e ) {
                    return response()->json([
                        'success'   => false,
                        'error'    => 'Error: '.$e
                    ]);    
                }
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Categoria;
use Illuminate\Http\Request;
use Session;

class CategoriasController extends Controller
{

    //////////////////////////////////////////////////
    //                   VIEW                       //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $categorias = Categoria::where('nombre', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $categorias = Categoria::paginate($perPage);
        }

        return view('vadmin.categorias.index', compact('categorias'));
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('vadmin.categorias.show', compact('categoria'));
    }

    //////////////////////////////////////////////////
    //                   CREATE                     //
    //////////////////////////////////////////////////

    public function create()
    {
        return view('vadmin.categorias.create');
    }


    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Categoria::create($requestData);

        return redirect('vadmin/categorias')->with('message','Categoría creada');;
    }

    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('vadmin.categorias.edit', compact('categoria'));
    }

    public function update($id, Request $request)
    {   
        $categoria = Categoria::findOrFail($id);

        $this->validate($request,[
            'nombre'          => 'required|unique:categorias,nombre,'.$categoria->id
                                
        ],[
            'nombre.required'     => 'Debe ingresar un nombre',
            'nombre.unique'       => 'El nombre ya existe'
        ]);
    
        $categoria->fill($request->all());
        $categoria = $categoria->save();

        return redirect('vadmin/categorias')->with('message','Actualizado Correctamente');

    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Categoria::find($id);
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
                $record = Categoria::find($id);
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Iva;
use Illuminate\Http\Request;
use Session;

class IvasController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 20;

        if (!empty($keyword)) {
            $ivas = Iva::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $ivas = Iva::paginate($perPage);
        }

        return view('vadmin.ivas.index', compact('ivas'));
    }

    public function create()
    {
        return view('vadmin.ivas.create');
    }

    public function store(Request $request)
    {   
        $this->validate($request,[
            'name'          => 'required|unique:ivas,name',
            'afipcode'      => 'required|unique:ivas,afipcode',
            'tipofc'        => 'required|unique:ivas,tipofc'
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'       => 'El nombre de la categoría ya existe',
            'afipcode.required' => 'Debe ingresar un código Afip',
            'afipcode.unique'   => 'El código ya está ingresado en otra categoría',
            'tipofc.required'   => 'Debe ingresar un tipo de factura',
            'tipofc.unique'     => 'El tipo de factura ya está en uso en otra categoría',
        ]);
        
        $requestData = $request->all();
        
        Iva::create($requestData);

        Session::flash('flash_message', 'Se ha creado la categoría'. $request->name );

        return redirect('vadmin/ivas');
    }

    public function show($id)
    {
        $iva = Iva::findOrFail($id);
        return view('vadmin.ivas.show', compact('iva'));
    }

    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $iva = Iva::findOrFail($id);
        return view('vadmin.ivas.edit', compact('iva'));
    }

    public function update($id, Request $request)
    {

        $iva = Iva::findOrFail($id);

        $this->validate($request,[
            'name'          => 'required|unique:ivas,name,'.$iva->id,
            'afipcode'      => 'required|unique:ivas,afipcode,'.$iva->id,
            'tipofc'        => 'required|unique:ivas,tipofc,'.$iva->id
                                
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'       => 'El nombre de la categoría ya existe',
            'afipcode.required' => 'Debe ingresar un código Afip',
            'afipcode.unique'   => 'El código ya está ingresado en otra categoría',
            'tipofc.required'   => 'Debe ingresar un tipo de factura',
            'tipofc.unique'     => 'El tipo de factura ya está en uso en otra categoría',
        ]);
    
        $iva->fill($request->all());
        $iva = $iva->save();

        Session::flash('flash_message', 'La categoría fue actualizada');

        return redirect('vadmin/ivas');
    }

    
    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   
        
        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Iva::find($id);
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
                $record = Iva::find($id);
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

} // End

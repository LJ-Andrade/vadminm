<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Moneda;
use Illuminate\Http\Request;
use Session;

class MonedasController extends Controller
{

    //////////////////////////////////////////////////
    //                  DISPLAY                     //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $monedas = Moneda::where('nombre', 'LIKE', "%$keyword%")
				->orWhere('valor', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $monedas = Moneda::paginate($perPage);
        }

        return view('vadmin.monedas.index', compact('monedas'));
    }

    public function show($id)
    {
        $moneda = Moneda::findOrFail($id);

        return view('vadmin.monedas.show', compact('moneda'));
    }

    //////////////////////////////////////////////////
    //                  CREATE                      //
    //////////////////////////////////////////////////

    public function create()
    {
        return view('vadmin.monedas.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'          => 'required|unique:monedas,nombre',
            'valor'           => 'required',
        ],[
            'valor'           => 'Un valor es requerido',
            'nombre.required' => 'El nombre de la moneda es requerido',
            'nombre.unique'   => 'Hay otra moneda con ese nombre',
        ]);

        $requestData = $request->all();
        Moneda::create($requestData);

        return redirect('vadmin/monedas')->with('message', 'Moneda creada');
    }

    //////////////////////////////////////////////////
    //                 UPDATE                       //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $moneda = Moneda::findOrFail($id);

        return view('vadmin.monedas.edit', compact('moneda'));
    }

    public function update($id, Request $request)
    {
        $moneda = Moneda::findOrFail($id);

        $this->validate($request,[
            'nombre'          => 'required|unique:monedas,nombre,'.$moneda->id,
            'valor'           => 'required',
        ],[
            'valor'           => 'Un valor es requerido',
            'nombre.required' => 'El nombre de la moneda es requerido',
            'nombre.unique'   => 'Hay otra moneda con ese nombre',
        ]);

        $moneda->fill($request->all());
        $moneda = $moneda->save();

        return redirect('vadmin/monedas')->with('Message', 'Moneda actualizada');
    }

    public function updateDolarValue($id, Request $request)
    {
        $moneda = Moneda::find($id);
        $moneda->valor = $request->value;
        $moneda->update();

        if($moneda->update()) {
            return response()->json([
                'Status' => 1,
                'Value'  => $request->value
            ]);
        } else {
            return response()->json([
                'Status' => 0,
            ]);
        }
        
    }

    public function updateCurrencyValue($id, Request $request)
    {
        $moneda = Moneda::find($id);
        $moneda->valor = $request->value;
        $moneda->update();

        if($moneda->update()) {
            return response()->json([
                'Status' => 1,
                'Value'  => $request->value
            ]);
        } else {
            return response()->json([
                'Status' => 0,
            ]);
        }
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Moneda::find($id);
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
                $record = Moneda::find($id);
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

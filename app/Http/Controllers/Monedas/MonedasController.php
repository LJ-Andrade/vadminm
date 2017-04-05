<?php

namespace App\Http\Controllers\Monedas;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Moneda;
use Illuminate\Http\Request;
use Session;

class MonedasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.monedas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'              => 'required|unique:monedas,nombre',
        ],[
            'nombre.required'     => 'Debe ingresar un nombre',
            'nombre.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        Moneda::create($requestData);

        Session::flash('flash_message', 'Moneda added!');

        return redirect('vadmin/monedas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $moneda = Moneda::findOrFail($id);

        return view('vadmin.monedas.show', compact('moneda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $moneda = Moneda::findOrFail($id);

        return view('vadmin.monedas.edit', compact('moneda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $this->validate($request,[
            'nombre'              => 'required|unique:monedas,nombre',
        ],[
            'nombre.required'     => 'Debe ingresar un nombre',
            'nombre.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $moneda = Moneda::findOrFail($id);
        $moneda->update($requestData);

        Session::flash('flash_message', 'Moneda updated!');

        return redirect('vadmin/monedas');
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

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Moneda::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Moneda::find($id);
            Moneda::destroy($id);
        }
        echo 1;
    }


}

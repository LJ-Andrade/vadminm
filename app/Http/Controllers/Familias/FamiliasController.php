<?php

namespace App\Http\Controllers\Familias;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Familia;
use Illuminate\Http\Request;
use Session;
use App\Proveedor;

class FamiliasController extends Controller
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
            $familias = Familia::where('nombre', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $familias = Familia::paginate($perPage);
        }

        return view('vadmin.familias.index', compact('familias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->pluck('nombre', 'id');

        return view('vadmin.familias.create')->with('proveedores', $proveedores);
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
            'nombre'              => 'required|unique:familias,nombre',
        ],[
            'nombre.required'     => 'Debe ingresar un nombre',
            'nombre.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        Familia::create($requestData);

        Session::flash('flash_message', 'Familia added!');

        return redirect('vadmin/familias');
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
        $familia = Familia::findOrFail($id);

        return view('vadmin.familias.show', compact('familia'));
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
        $familia = Familia::findOrFail($id);

        return view('vadmin.familias.edit', compact('familia'));
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
            'nombre'              => 'required|unique:familias,nombre',
        ],[
            'nombre.required'     => 'Debe ingresar un nombre',
            'nombre.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $familia = Familia::findOrFail($id);
        $familia->update($requestData);

        Session::flash('flash_message', 'Familia updated!');

        return redirect('vadmin/familias');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Familia::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Familia::find($id);
            Familia::destroy($id);
        }
        echo 1;
    }


}

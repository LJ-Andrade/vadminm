<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Retencione;
use Illuminate\Http\Request;
use Session;

class RetencionesController extends Controller
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
            $retenciones = Retencione::where('tipo', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $retenciones = Retencione::paginate($perPage);
        }

        return view('vadmin.retenciones.index', compact('retenciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.retenciones.create');
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
            'name'              => 'required|unique:retenciones,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        Retencione::create($requestData);

        Session::flash('flash_message', 'Retencione added!');

        return redirect('vadmin/retenciones');
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
        $retencione = Retencione::findOrFail($id);

        return view('vadmin.retenciones.show', compact('retencione'));
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
        $retencione = Retencione::findOrFail($id);

        return view('vadmin.retenciones.edit', compact('retencione'));
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
            'name'              => 'required|unique:retenciones,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $retencione = Retencione::findOrFail($id);
        $retencione->update($requestData);

        Session::flash('flash_message', 'Retencione updated!');

        return redirect('vadmin/retenciones');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Retencione::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Retencione::find($id);
            Retencione::destroy($id);
        }
        echo 1;
    }


}

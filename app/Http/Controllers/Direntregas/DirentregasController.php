<?php

namespace App\Http\Controllers\Direntregas;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Direntrega;
use Illuminate\Http\Request;
use Session;
use App\Provincia;
use App\Localidade;
use App\Cliente;

class DirentregasController extends Controller
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
            $direntregas = Direntrega::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $direntregas = Direntrega::paginate($perPage);
        }

        return view('vadmin.direntregas.index', compact('direntregas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $clientes     = Cliente::orderBy('razonsocial', 'ASC')->pluck('razonsocial', 'id');
        $provincias   = Provincia::orderBy('name', 'ASC')->pluck('name', 'name');
        $localidades  = Localidade::orderBy('name', 'ASC')->pluck('name', 'name');

        return view('vadmin.direntregas.create')
            ->with('clientes', $clientes) 
            ->with('provincias', $provincias)
            ->with('localidades', $localidades);
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
            'name'              => 'required|unique:direntregas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        $dirEntrega = new Direntrega($request->all());

        $dirEntrega->cliente  = $request->cliente;

        $dirEntrega->save();

        Session::flash('flash_message', 'Direntrega added!');

        return redirect('vadmin/direntregas');
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
        $direntrega = Direntrega::findOrFail($id);

        return view('vadmin.direntregas.show', compact('direntrega'));
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
        $direntrega = Direntrega::findOrFail($id);

        return view('vadmin.direntregas.edit', compact('direntrega'));
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
            'name'              => 'required|unique:direntregas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $direntrega = Direntrega::findOrFail($id);
        $direntrega->update($requestData);

        Session::flash('flash_message', 'Direntrega updated!');

        return redirect('vadmin/direntregas');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Direntrega::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Direntrega::find($id);
            Direntrega::destroy($id);
        }
        echo 1;
    }


}

<?php

namespace App\Http\Controllers\Localidades;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Localidade;
use Illuminate\Http\Request;
use Session;

class LocalidadesController extends Controller
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
            $localidades = Localidade::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $localidades = Localidade::paginate($perPage);
        }

        return view('vadmin.localidades.index', compact('localidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.localidades.create');
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
            'name'              => 'required|unique:localidades,name',

        ],[
            'name.required'     => 'Debe ingresar una localidad',
            'name.unique'      => 'La localidad ya existe',
        ]);

        
        $requestData = $request->all();
        
        Localidade::create($requestData);

        Session::flash('flash_message', 'Localidade added!');

        return redirect('vadmin/localidades');
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
        $localidade = Localidade::findOrFail($id);

        return view('vadmin.localidades.show', compact('localidade'));
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
        $localidade = Localidade::findOrFail($id);

        return view('vadmin.localidades.edit', compact('localidade'));
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
            'name'              => 'required|unique:localidades,name',
        ],[
            'name.required'     => 'Debe ingresar una localidad',
            'name.unique'      => 'La localidad ya existe',
        ]);
        
        $requestData = $request->all();
        
        $localidade = Localidade::findOrFail($id);
        $localidade->update($requestData);

        Session::flash('flash_message', 'Localidade updated!');

        return redirect('vadmin/localidades');
    }

    // ---------- Delete -------------- //

    public function destroy($id)
    {
        $localidad = Localidade::find($id);
        $localidad->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $localidades  = Localidade::find($id);
            Localidade::destroy($id);
        }
        echo 1;
    }
}

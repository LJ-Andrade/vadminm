<?php

namespace App\Http\Controllers\Zonas;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Zona;
use Illuminate\Http\Request;
use Session;

class ZonasController extends Controller
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
            $zonas = Zona::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $zonas = Zona::paginate($perPage);
        }

        return view('vadmin.zonas.index', compact('zonas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.zonas.create');
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
            'name'              => 'required|unique:zonas,name',
        ],[
            'name.required'     => 'Debe ingresar una localidad',
            'name.unique'      => 'La localidad ya existe',
        ]);


        
        $requestData = $request->all();
        
        Zona::create($requestData);

        Session::flash('flash_message', 'Zona added!');

        return redirect('vadmin/zonas');
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
        $zona = Zona::findOrFail($id);

        return view('vadmin.zonas.show', compact('zona'));
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
        $zona = Zona::findOrFail($id);

        return view('vadmin.zonas.edit', compact('zona'));
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
            'name'              => 'required|unique:zonas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $zona = Zona::findOrFail($id);
        $zona->update($requestData);

        Session::flash('flash_message', 'Zona updated!');

        return redirect('vadmin/zonas');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Zona::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Zona::find($id);
            Zona::destroy($id);
        }
        echo 1;
    }


}

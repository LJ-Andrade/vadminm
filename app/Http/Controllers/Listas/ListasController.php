<?php

namespace App\Http\Controllers\Listas;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lista;
use Illuminate\Http\Request;
use Session;

class ListasController extends Controller
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
            $listas = Lista::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $listas = Lista::paginate($perPage);
        }

        return view('vadmin.listas.index', compact('listas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.listas.create');
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
            'name'              => 'required|unique:listas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        Lista::create($requestData);

        Session::flash('flash_message', 'Lista added!');

        return redirect('vadmin/listas');
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
        $lista = Lista::findOrFail($id);

        return view('vadmin.listas.show', compact('lista'));
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
        $lista = Lista::findOrFail($id);

        return view('vadmin.listas.edit', compact('lista'));
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
            'name'              => 'required|unique:listas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $lista = Lista::findOrFail($id);
        $lista->update($requestData);

        Session::flash('flash_message', 'Lista updated!');

        return redirect('vadmin/listas');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Lista::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Lista::find($id);
            Lista::destroy($id);
        }
        echo 1;
    }


}

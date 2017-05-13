<?php

namespace App\Http\Controllers\Condicventas;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Condicventa;
use Illuminate\Http\Request;
use Session;

class CondicventasController extends Controller
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
            $condicventas = Condicventa::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $condicventas = Condicventa::paginate($perPage);
        }

        return view('vadmin.condicventas.index', compact('condicventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.condicventas.create');
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
            'name'              => 'required|unique:condicventas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'       => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        Condicventa::create($requestData);

        Session::flash('flash_message', 'Condicventa added!');

        return redirect('vadmin/condicventas');
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
        $condicventa = Condicventa::findOrFail($id);

        return view('vadmin.condicventas.show', compact('condicventa'));
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
        $condicventa = Condicventa::findOrFail($id);

        return view('vadmin.condicventas.edit', compact('condicventa'));
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
            'name'              => 'required|unique:condicventas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $condicventa = Condicventa::findOrFail($id);
        $condicventa->update($requestData);

        Session::flash('flash_message', 'Condicventa updated!');

        return redirect('vadmin/condicventas');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Condicventa::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Condicventa::find($id);
            Condicventa::destroy($id);
        }
        echo 1;
    }


}




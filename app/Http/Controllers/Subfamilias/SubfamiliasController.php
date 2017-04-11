<?php

namespace App\Http\Controllers\Subfamilias;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subfamilia;
use App\Familia;
use Illuminate\Http\Request;
use Session;

class SubfamiliasController extends Controller
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
            $subfamilias = Subfamilia::where('nombre', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $subfamilias = Subfamilia::paginate($perPage);
        }

        return view('vadmin.subfamilias.index', compact('subfamilias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $familias = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');

        return view('vadmin.subfamilias.create')->with('familias', $familias);

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
        // $this->validate($request,[
        //     'nombre'              => 'required|unique:subfamilias,nombre',
        // ],[
        //     'nombre.required'     => 'Debe ingresar un nombre',
        //     'nombre.unique'      => 'El item ya existe',
        // ]);


        
        $requestData = $request->all();
        
        Subfamilia::create($requestData);

        Session::flash('flash_message', 'Subfamilia added!');

        return redirect('vadmin/subfamilias');
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
        $subfamilia = Subfamilia::findOrFail($id);

        return view('vadmin.subfamilias.show', compact('subfamilia'));
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
        $subfamilia = Subfamilia::findOrFail($id);
        $familia    = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');

        return view('vadmin.subfamilias.edit')->with('subfamilia', $subfamilia)->with('familia', $familia);
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

        // $this->validate($request,[
        //     'nombre'              => 'required|unique:subfamilias,nombre',
        // ],[
        //     'nombre.required'     => 'Debe ingresar un nombre',
        //     'nombre.unique'      => 'El item ya existe',
        // ]);


        
        $requestData = $request->all();
        
        $subfamilia = Subfamilia::findOrFail($id);
        $subfamilia->update($requestData);

        Session::flash('flash_message', 'Subfamilia updated!');

        return redirect('vadmin/subfamilias');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Subfamilia::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Subfamilia::find($id);
            Subfamilia::destroy($id);
        }
        echo 1;
    }


}

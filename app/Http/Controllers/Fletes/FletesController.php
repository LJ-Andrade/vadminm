<?php

namespace App\Http\Controllers\Fletes;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Flete;
use Illuminate\Http\Request;
use Session;

class FletesController extends Controller
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
            $fletes = Flete::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $fletes = Flete::paginate($perPage);
        }

        return view('vadmin.fletes.index', compact('fletes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.fletes.create');
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
            'name'              => 'required|unique:fletes,name',
        ],[
            'name.required'     => 'Debe ingresar una localidad',
            'name.unique'      => 'La localidad ya existe',
        ]);


        
        $requestData = $request->all();
        
        Flete::create($requestData);

        Session::flash('flash_message', 'Flete added!');

        return redirect('vadmin/fletes');
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
        $flete = Flete::findOrFail($id);

        return view('vadmin.fletes.show', compact('flete'));
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
        $flete = Flete::findOrFail($id);

        return view('vadmin.fletes.edit', compact('flete'));
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
            'name'              => 'required|unique:fletes,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $flete = Flete::findOrFail($id);
        $flete->update($requestData);

        Session::flash('flash_message', 'Flete updated!');

        return redirect('vadmin/fletes');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Flete::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Flete::find($id);
            Flete::destroy($id);
        }
        echo 1;
    }


}

<?php

namespace App\Http\Controllers\Tipocts;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tipoct;
use Illuminate\Http\Request;
use Session;

class TipoctsController extends Controller
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
            $tipocts = Tipoct::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $tipocts = Tipoct::paginate($perPage);
        }

        return view('vadmin.tipocts.index', compact('tipocts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.tipocts.create');
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
            'name'              => 'required|unique:tipocts,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        Tipoct::create($requestData);

        Session::flash('flash_message', 'Tipoct added!');

        return redirect('vadmin/tipocts');
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
        $tipoct = Tipoct::findOrFail($id);

        return view('vadmin.tipocts.show', compact('tipoct'));
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
        $tipoct = Tipoct::findOrFail($id);

        return view('vadmin.tipocts.edit', compact('tipoct'));
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
            'name'              => 'required|unique:tipocts,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $tipoct = Tipoct::findOrFail($id);
        $tipoct->update($requestData);

        Session::flash('flash_message', 'Tipoct updated!');

        return redirect('vadmin/tipocts');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Tipoct::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Tipoct::find($id);
            Tipoct::destroy($id);
        }
        echo 1;
    }


}

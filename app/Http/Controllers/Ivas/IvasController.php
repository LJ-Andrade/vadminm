<?php

namespace App\Http\Controllers\Ivas;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Iva;
use Illuminate\Http\Request;
use Session;

class IvasController extends Controller
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
            $ivas = Iva::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $ivas = Iva::paginate($perPage);
        }

        return view('vadmin.ivas.index', compact('ivas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.ivas.create');
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
            'name'              => 'required|unique:ivas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        Iva::create($requestData);

        Session::flash('flash_message', 'Iva added!');

        return redirect('vadmin/ivas');
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
        $iva = Iva::findOrFail($id);

        return view('vadmin.ivas.show', compact('iva'));
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
        $iva = Iva::findOrFail($id);

        return view('vadmin.ivas.edit', compact('iva'));
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
            'name'              => 'required|unique:ivas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $iva = Iva::findOrFail($id);
        $iva->update($requestData);

        Session::flash('flash_message', 'Iva updated!');

        return redirect('vadmin/ivas');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Iva::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Iva::find($id);
            Iva::destroy($id);
        }
        echo 1;
    }


}

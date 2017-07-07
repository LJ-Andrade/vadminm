<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pago;
use Illuminate\Http\Request;
use Session;

class PagosController extends Controller
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
            $pagos = Pago::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $pagos = Pago::paginate($perPage);
        }

        return view('vadmin.pagos.index', compact('pagos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.pagos.create');
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
            'name'              => 'required|unique:pagos,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        Pago::create($requestData);

        Session::flash('flash_message', 'Pago added!');

        return redirect('vadmin/pagos');
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
        $pago = Pago::findOrFail($id);

        return view('vadmin.pagos.show', compact('pago'));
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
        $pago = Pago::findOrFail($id);

        return view('vadmin.pagos.edit', compact('pago'));
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
            'name'              => 'required|unique:pagos,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $pago = Pago::findOrFail($id);
        $pago->update($requestData);

        Session::flash('flash_message', 'Pago updated!');

        return redirect('vadmin/pagos');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Pago::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Pago::find($id);
            Pago::destroy($id);
        }
        echo 1;
    }


}

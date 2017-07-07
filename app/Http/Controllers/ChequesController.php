<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cheque;
use Illuminate\Http\Request;
use Session;

class ChequesController extends Controller
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
            $cheques = Cheque::where('banco', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $cheques = Cheque::paginate($perPage);
        }

        return view('vadmin.cheques.index', compact('cheques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.cheques.create');
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
            'name'              => 'required|unique:cheques,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        Cheque::create($requestData);

        Session::flash('flash_message', 'Cheque added!');

        return redirect('vadmin/cheques');
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
        $cheque = Cheque::findOrFail($id);

        return view('vadmin.cheques.show', compact('cheque'));
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
        $cheque = Cheque::findOrFail($id);

        return view('vadmin.cheques.edit', compact('cheque'));
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
            'name'              => 'required|unique:cheques,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $cheque = Cheque::findOrFail($id);
        $cheque->update($requestData);

        Session::flash('flash_message', 'Cheque updated!');

        return redirect('vadmin/cheques');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Cheque::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Cheque::find($id);
            Cheque::destroy($id);
        }
        echo 1;
    }


}

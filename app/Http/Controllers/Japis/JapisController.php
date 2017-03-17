<?php

namespace App\Http\Controllers\Japis;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Japi;
use Illuminate\Http\Request;
use Session;

class JapisController extends Controller
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
            $japis = Japi::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $japis = Japi::paginate($perPage);
        }

        return view('vadmin.japis.index', compact('japis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.japis.create');
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
            'name'              => 'required|unique:japis,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        Japi::create($requestData);

        Session::flash('flash_message', 'Japi added!');

        return redirect('vadmin/japis');
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
        $japi = Japi::findOrFail($id);

        return view('vadmin.japis.show', compact('japi'));
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
        $japi = Japi::findOrFail($id);

        return view('vadmin.japis.edit', compact('japi'));
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
            'name'              => 'required|unique:japis,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $japi = Japi::findOrFail($id);
        $japi->update($requestData);

        Session::flash('flash_message', 'Japi updated!');

        return redirect('vadmin/japis');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Japi::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Japi::find($id);
            Japi::destroy($id);
        }
        echo 1;
    }


}

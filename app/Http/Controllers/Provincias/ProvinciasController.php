<?php

namespace App\Http\Controllers\Provincias;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Provincia;
use Illuminate\Http\Request;
use Session;

class ProvinciasController extends Controller
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
            $provincias = Provincia::where('name', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $provincias = Provincia::paginate($perPage);
        }

        return view('vadmin.provincias.index', compact('provincias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vadmin.provincias.create');
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
        
        $requestData = $request->all();
        
        Provincia::create($requestData);

        Session::flash('flash_message', 'Provincia added!');

        return redirect('vadmin/provincias');
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
        $provincia = Provincia::findOrFail($id);

        return view('vadmin.provincias.show', compact('provincia'));
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
        $provincia = Provincia::findOrFail($id);

        return view('vadmin.provincias.edit', compact('provincia'));
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
        
        $requestData = $request->all();
        
        $provincia = Provincia::findOrFail($id);
        $provincia->update($requestData);

        Session::flash('flash_message', 'Provincia updated!');

        return redirect('vadmin/provincias');
    }

        // ---------- Delete -------------- //

    public function destroy($id)
    {
        $item = Provincia::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Provincia::find($id);
            Provincia::destroy($id);
        }
        echo 1;
    }


}


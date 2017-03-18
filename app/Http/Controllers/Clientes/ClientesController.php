<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use App\Cliente;
use App\Provincia;
use App\Localidade;
use App\Iva;
use App\Condicventa;
use App\User;
use App\Flete;
use App\Zona;
use App\Lista;
use App\Direntrega;

class ClientesController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $clientes = Cliente::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $clientes = Cliente::paginate($perPage);
        }

        return view('vadmin.clientes.index')->with('clientes', $clientes);
    }

    public function ajax_list(Request $request)
    {
        $clientes = Cliente::orderBy('id', 'DESC')->paginate(10);
        return view('vadmin/clientes/list')->with('clientes', $clientes);   
    }


    public function create()
    {
        $provincias   = Provincia::orderBy('name', 'ASC')->pluck('name', 'id');
        $localidades  = Localidade::orderBy('name', 'ASC')->pluck('name', 'id');
        $iva          = Iva::orderBy('name', 'ASC')->pluck('name', 'id');
        $condicventas = Condicventa::orderBy('name', 'ASC')->pluck('name', 'id');
        $users        = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $flete        = Flete::orderBy('name', 'ASC')->pluck('name', 'id');
        $zona         = Zona::orderBy('name', 'ASC')->pluck('name', 'id');
        $lista        = Lista::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('vadmin.clientes.create')
            ->with('provincias', $provincias)
            ->with('localidades', $localidades)
            ->with('iva', $iva)
            ->with('condicventas', $condicventas)
            ->with('users', $users)
            ->with('flete', $flete)
            ->with('zona', $zona)
            ->with('lista', $lista);

    }

     //////////////////////////////////////////////////
    //                  STORE                        //
    //////////////////////////////////////////////////

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'name'              => 'required|unique:clientes,name',
        // ],[
        //     'name.required'     => 'Debe ingresar un item',
        //     'name.unique'      => 'El cliente ya existe',
        // ]);
        
        // dd($request->all());
        
        $cliente = new Cliente($request->all());
        // dd($cliente);


        $cliente->iva_id          = $request->iva;
        $cliente->provincia_id    = $request->provincia;
        $cliente->localidad_id    = $request->localidad;
        $cliente->iva_id          = $request->iva;
        $cliente->condicventas_id = $request->condicventas;
        $cliente->listas_id       = $request->listas;
        $cliente->user_id         = $request->vendedor;
        $cliente->zona_id         = $request->zona;
        $cliente->flete_id        = $request->flete;
        // dd($request->direntrega);
        
        // create a new event
        $calles                   = $request->direntrega;
        dd($calles);
        
        $cliente->direntrega_id   = $calles;
        
        // dd($dirEntrega);
        // $request->direntrega;
        // $request->locentrega;
        // $request->telentrega;
        // $request->proventrega;
        




        $cliente->save();
        
        Session::flash('flash_message', 'Cliente ingresado correctamente');

        return redirect('vadmin/clientes');
    }


    //////////////////////////////////////////////////
    //                  SHOW                        //
    //////////////////////////////////////////////////

    public function show($id)
    {

        $cliente = Cliente::findOrFail($id);

        return view('vadmin.clientes.show')->with('cliente', $cliente);
    }



    //////////////////////////////////////////////////
    //                  EDIT                        //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('vadmin.clientes.edit', compact('cliente'));
    }

    public function update($id, Request $request)
    {

        $this->validate($request,[
            'name'              => 'required|unique:clientes,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $cliente = Cliente::findOrFail($id);
        $cliente->update($requestData);

        Session::flash('flash_message', 'Cliente updated!');

        return redirect('vadmin/clientes');
    }

    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Cliente::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Cliente::find($id);
            Cliente::destroy($id);
        }
        echo 1;
    }


}

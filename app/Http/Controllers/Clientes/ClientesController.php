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

    //////////////////////////////////////////////////
    //                  LIST                        //
    //////////////////////////////////////////////////

    public function ajax_list(Request $request)
    {
        $clientes = Cliente::orderBy('id', 'DESC')->paginate(10);
        return view('vadmin/clientes/list')->with('clientes', $clientes);   
    }

    //////////////////////////////////////////////////
    //                  SEARCH                      //
    //////////////////////////////////////////////////


    public function ajax_list_search(Request $request)
    {   
       
        if ($request->ajax())
        {

            if (isset($_GET['name'])){
                $name = $_GET['name'];
            } 

             if (isset($_GET['id'])){
                $id = $_GET['id'];
            }

            // $clientes = Cliente::where('razonsocial', 'LIKE', '%'.$name.'%' )->paginate(20);

            if ($name != '' and $id != ''){
                // Search User AND Role
                $clientes = Cliente::where('razonsocial', 'LIKE', '%'.$name.'%' )
                ->where('id', 'LIKE', '%'.$id.'%')->paginate(20);
            } else if($name != '') {
                // Search by name
                 $clientes = Cliente::where('razonsocial', 'LIKE', '%'.$name.'%' )->paginate(20);
           
            } else if ($id !='') {
                // Search by Name or Email
                $clientes = Cliente::where('id', 'LIKE', '%'.$id.'%' )->paginate(20);
            } else {
                // Seatch All
                $clientes = Cliente::orderBy('id', 'ASC')->paginate(12);
            }

            return view('vadmin/clientes/list')->with('clientes', $clientes);  
        }

    }


    //////////////////////////////////////////////////
    //                  CREATE                      //
    //////////////////////////////////////////////////


    public function create()
    {
        $cliente_id   = Cliente::orderBy('id','DESC')->first();
        $provincias   = Provincia::orderBy('name', 'ASC')->pluck('name', 'id');
        $localidades  = Localidade::orderBy('name', 'ASC')->pluck('name', 'id');
        $iva          = Iva::orderBy('name', 'ASC')->pluck('name', 'id');
        $condicventas = Condicventa::orderBy('name', 'ASC')->pluck('name', 'id');
        $users        = User::where('role', '=', 'seller')->pluck('name', 'id');
        $flete        = Flete::orderBy('name', 'ASC')->pluck('name', 'id');
        $zona         = Zona::orderBy('name', 'ASC')->pluck('name', 'id');
        $lista        = Lista::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('vadmin.clientes.create')
            ->with('cliente_id', $cliente_id)
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
    //                  STORE                       //
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
        $cliente->limitcred       = $request->limitcred;
        $cliente->condicventas_id = $request->condicventas;
        $cliente->listas_id       = $request->listas;
        $cliente->user_id         = $request->vendedor;
        $cliente->zona_id         = $request->zona;
        $cliente->flete_id        = $request->flete;
        // dd($request->direntrega);
        
        // create a new event
        // $calles                   = $request->direntrega;
        // dd($request->direntrega);
        
        // $cliente->direntrega_id   = $calles;
        
        // dd($dirEntrega);
        // $request->direntrega;
        // $request->locentrega;
        // $request->telentrega;
        // $request->proventrega;
        


        // dd($cliente);

        $cliente->save();
        
        Session::flash('flash_message', 'Cliente ingresado correctamente');

        return redirect('vadmin/clientes');
    }


    //////////////////////////////////////////////////
    //                  SHOW                        //
    //////////////////////////////////////////////////

    public function show($id)
    {

        $cliente    = Cliente::findOrFail($id);
        $dirEntrega = Direntrega::where('client_id', '=', $id);
 

        return view('vadmin.clientes.show')
            ->with('cliente', $cliente)
            ->with('dirEntrega', $dirEntrega);
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

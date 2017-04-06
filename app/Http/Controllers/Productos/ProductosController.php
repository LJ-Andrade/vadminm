<?php

namespace App\Http\Controllers\Productos;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Producto;
use App\Proveedor;
use App\Familia;
use App\Subfamilia;
use Illuminate\Http\Request;
use Session;

class ProductosController extends Controller
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
            $productos = Producto::where('nombre', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $productos = Producto::paginate($perPage);
        }

        return view('vadmin.productos.index', compact('productos'));
    }

    //////////////////////////////////////////////////
    //                  LIST                        //
    //////////////////////////////////////////////////

    public function ajax_list(Request $request)
    {
        $productos = Producto::orderBy('id', 'DESC')->paginate(20);
        return view('vadmin/productos/list')->with('productos', $productos);   
    }

    
    //////////////////////////////////////////////////
    //                  SEARCH                      //
    //////////////////////////////////////////////////


    // public function ajax_list_search(Request $request)
    // {   
       
    //     if ($request->ajax())
    //     {

    //         if (isset($_GET['nombre'])){
    //             $nombre = $_GET['nombre'];
    //         } 

    //          if (isset($_GET['id'])){
    //             $id = $_GET['id'];
    //         }

    //         // $clientes = Cliente::where('razonsocial', 'LIKE', '%'.$nombre.'%' )->paginate(20);

    //         if ($nombre != '' and $id != ''){
    //             // Search User AND Role
    //             $clientes = Cliente::where('razonsocial', 'LIKE', '%'.$nombre.'%' )
    //             ->where('id', 'LIKE', '%'.$id.'%')->paginate(20);
    //         } else if($nombre != '') {
    //             // Search by nombre
    //              $clientes = Cliente::where('razonsocial', 'LIKE', '%'.$nombre.'%' )->paginate(20);
           
    //         } else if ($id !='') {
    //             // Search by nombre or Email
    //             $clientes = Cliente::where('id', 'LIKE', '%'.$id.'%' )->paginate(20);
    //         } else {
    //             // Seatch All
    //             $clientes = Cliente::orderBy('id', 'ASC')->paginate(12);
    //         }

    //         return view('vadmin/clientes/list')->with('clientes', $clientes);  
    //     }

    // }

    //////////////////////////////////////////////////
    //                  CREATE                      //
    //////////////////////////////////////////////////


    public function create()
    {

        $producto_id  = Producto::orderBy('id','DESC')->first();
        $proveedor    = Proveedor::orderBy('id','DESC')->first();
        $familias     = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $subfamilias  = Subfamilia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
       
        return view('vadmin.productos.create')
            ->with('producto_id', $producto_id)
            ->with('proveedor', $proveedor)
            ->with('familias', $familias)
            ->with('subfamilias', $subfamilias);

    }

    public function ajax_build_id(Request $request)
    {
        
        
        $familias = Familia::where('id', '=', $request->id)->first();

        // dd($familias->nombre);

        if (is_null($familias)) {
            echo 'No Existe';
            // return response()->json(['id'=>'0']);
        } else {
            return response()->json([
                        'familia'=>$familias->nombre,
                        'id'     =>$familias->id                    
                    ]);
        }


    }
    
    public function ajax_build_id_none(Request $request)
    {
        echo 'deadend';
    }
    //////////////////////////////////////////////////
    //                  STORE                       //
    //////////////////////////////////////////////////

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'nombre'              => 'required|unique:clientes,nombre',
        // ],[
        //     'nombre.required'     => 'Debe ingresar un item',
        //     'nombre.unique'      => 'El cliente ya existe',
        // ]);
        
        // dd($request->all());
        
        $cliente = new Cliente($request->all());

        $cliente->iva_id          = $request->iva;
        $cliente->provincia_id    = $request->provincia;
        $cliente->localidad_id    = $request->localidad;
        $cliente->limitcred       = $request->limitcred;
        $cliente->condicventas_id = $request->condicventas;
        $cliente->listas_id       = $request->listas;
        $cliente->user_id         = $request->vendedor;
        $cliente->zona_id         = $request->zona;
        $cliente->flete_id        = $request->flete;
        
        // dd($cliente);
        
        $cliente->save();

        $entrega = new Direntrega();
        
        $entrega->nombre         = $request->dirnombre;
        $entrega->cliente_id   = $request->id_direntrega; 
        $entrega->localidad_id = '1';
        $entrega->provincia_id = '1';
        $entrega->telefono     = '1122122';

        // dd($entrega); 
        $entrega->save();
        
        Session::flash('flash_message', 'Cliente ingresado correctamente');

        return redirect('vadmin/productos');
    }

    //////////////////////////////////////////////////
    //                  SHOW                        //
    //////////////////////////////////////////////////

    public function show($id)
    {

        $cliente    = Cliente::findOrFail($id);
        $dirEntrega = Direntrega::where('client_id', '=', $id);
 

        return view('vadmin.productos.show')
            ->with('cliente', $cliente)
            ->with('dirEntrega', $dirEntrega);
    }

    //////////////////////////////////////////////////
    //                  EDIT                        //
    //////////////////////////////////////////////////
    
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view('vadmin.productos.edit', compact('producto'));
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
            'nombre'              => 'required|unique:productos,nombre',
        ],[
            'nombre.required'     => 'Debe ingresar un nombre',
            'nombre.unique'      => 'El item ya existe',
        ]);


        
        $requestData = $request->all();
        
        $producto = Producto::findOrFail($id);
        $producto->update($requestData);

        Session::flash('flash_message', 'Producto updated!');

        return redirect('vadmin/productos');
    }

    //////////////////////////////////////////////////
    //                 DESTROY                      //
    //////////////////////////////////////////////////

   
    // ---------- Delete -------------- //
    public function destroy($id)
    {
        $item = Producto::find($id);
        $item->delete();
        echo 1;
    }


    // ---------- Ajax Bach Delete -------------- //
    public function ajax_batch_delete(Request $request, $id)
    {
        foreach ($request->id as $id) {
        
            $item  = Producto::find($id);
            Producto::destroy($id);
        }
        echo 1;
    }


}

<?php

namespace App\Http\Controllers\Productos;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Producto;
use App\Proveedor;
use App\Familia;
use App\Subfamilia;
use App\Moneda;
use App\Iva;
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

        $dolarsist = Moneda::where('nombre', '=', 'Dolar')->first();

        return view('vadmin.productos.index')->with('productos', $productos)->with('dolarsist', $dolarsist);
    }

    //////////////////////////////////////////////////
    //                  LIST                        //
    //////////////////////////////////////////////////

    public function ajax_list(Request $request)
    {
        $productos = Producto::orderBy('id', 'DESC')->paginate(20);
        $dolarsist = Moneda::where('nombre', '=', 'Dolar')->first();
        return view('vadmin/productos/list')->with('productos', $productos)->with('dolarsist', $dolarsist);   
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
        $proveedor    = Proveedor::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $familias     = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $subfamilias  = Subfamilia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $monedas      = Moneda::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
       
        if(is_null($producto_id)){
            $producto_id = 0;
        }

        return view('vadmin.productos.create')
            ->with('producto_id', $producto_id)
            ->with('proveedor', $proveedor)
            ->with('familias', $familias)
            ->with('subfamilias', $subfamilias)
            ->with('monedas', $monedas);

    }

    public function ajax_subfamilias($id) {

        $subfamilias = Subfamilia::where('familia_id', '=', $id)->get();

        return response()->json($subfamilias);

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
        $dolarsist = Moneda::where('nombre', '=', 'Dolar')->first();

        $producto = new Producto($request->all());

        $producto->preciocosto   = $request->preciocosto / $dolarsist->valor;
        $producto->preciocosto   = round($producto->preciocosto, 2);
        $producto->preciooferta  = $request->preciooferta / $dolarsist->valor;
        $producto->preciooferta   = round($producto->preciooferta, 2);

        $producto->proveedor_id  = $request->proveedor_id;
        $producto->familia_id    = $request->familia_id;
        $producto->subfamilia_id = $request->subfamilia_id;

        // dd($producto);
        
        $producto->save();

        Session::flash('flash_message', 'Producto ingresado correctamente');

        return redirect('vadmin/productos');
    }

    //////////////////////////////////////////////////
    //                  SHOW                        //
    //////////////////////////////////////////////////


    public function show($id)
    {
        $dolarsist = Moneda::where('nombre', '=', 'Dolar')->first();
        $producto  = Producto::findOrFail($id);

        $fullid    = $producto->familia_id.'-'.$id;
        
        $valgremiouss      = calcFinalPrice($producto->preciocosto, $producto->pjegremio);
        $valparticularuss  = calcFinalPrice($producto->preciocosto, $producto->pjeparticular);
        $valespecialuss    = calcFinalPrice($producto->preciocosto, $producto->pjeespecial);

        $preciocostopesos  = $producto->preciocosto * $dolarsist->valor;
        $precioofertapesos = $producto->preciooferta * $dolarsist->valor;
        $valorgremio       = calcFinalPriceConvert($producto->preciocosto, $producto->pjegremio, $dolarsist->valor);
        $valorparticular   = calcFinalPriceConvert($producto->preciocosto, $producto->pjeparticular, $dolarsist->valor);
        $valorespecial     = calcFinalPriceConvert($producto->preciocosto, $producto->pjeespecial, $dolarsist->valor);
          
        return view('vadmin.productos.show')
            ->with('producto', $producto)
            ->with('fullid', $fullid)
            ->with('preciocostopesos', $preciocostopesos)
            ->with('valorgremio', $valorgremio)
            ->with('valorparticular', $valorparticular)
            ->with('valorespecial', $valorespecial)
            ->with('valgremiouss', $valgremiouss)
            ->with('valparticularuss', $valparticularuss)
            ->with('valespecialuss', $valespecialuss)
            ->with('precioofertapesos', $precioofertapesos);

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

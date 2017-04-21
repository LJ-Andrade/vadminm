<?php

namespace App\Http\Controllers\Productos;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Session;

use App\Producto;
use App\Proveedor;
use App\Familia;
use App\Subfamilia;
use App\Moneda;
use App\Iva;

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
        return view('vadmin/productos/list')
            ->with('productos', $productos)
            ->with('dolarsist', $dolarsist);   
    }

    
    //////////////////////////////////////////////////
    //                  SEARCH                      //
    //////////////////////////////////////////////////


    public function ajax_list_search(Request $request)
    {   
        if ($request->ajax())
        {
            if ($request->get('nombre')){
                $nombre = $_GET['nombre'];
            } else {
                $nombre = '';
            }

            if ($request->get('id')){
                $id = $_GET['id'];
            } else {
                $id = '';
            }

            if ($nombre != '' and $id != ''){
                // Show All
                $productos = Producto::where('nombre', 'LIKE', '%'.$nombre.'%' )
                ->where('id', 'LIKE', '%'.$id.'%')->paginate(20);
            } else if($nombre != '') {
                // Search by nombre
                 $productos = Producto::where('nombre', 'LIKE', '%'.$nombre.'%' )->paginate(20);
            } else if ($id !='') {
                // Search by nombre or Id
                $productos = Producto::where('id', 'LIKE', '%'.$id.'%' )->paginate(20);
            } else {
                // Show All
                $productos = Producto::orderBy('id', 'ASC')->paginate(12);
            }
            return view('vadmin/productos/list')->with('productos', $productos);  
        }
    }

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


    //////////////////////////////////////////////////
    //                  STORE                       //
    //////////////////////////////////////////////////

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'              => 'required|unique:productos,nombre',
            'codproveedor'        => 'required|unique:productos,codproveedor',
        ],[
            'nombre.required'     => 'Debe ingresar un nombre',
            'nombre.unique'       => 'El producto ya existe',
            'codproveedor.unique' => 'Ya existe un producto con el código de proveedor ingresado',
        ]);
        
        $dolarsist = Moneda::where('nombre', '=', 'Dolar')->first();
        $eurosist  = Moneda::where('nombre', '=', 'Euro-Dolar')->first();
        $producto  = new Producto($request->all());
        // Convert Input Value to Dolar
        switch ($request->moneda) {
            case 1:
                $producto->preciocosto   = $request->preciocosto / $dolarsist->valor;
                $producto->preciocosto   = formatNum($producto->preciocosto, 2);
                break;
            case 2:
                $producto->preciocosto   = $request->preciocosto;
                $producto->preciocosto   = formatNum($producto->preciocosto, 2);
                break;
            case 3:
                $producto->preciocosto   = $request->preciocosto / $eurosist->valor;
                $producto->preciocosto   = formatNum($producto->preciocosto, 2);
                break;
            default:
                $producto->preciocosto   = $request->preciocosto / $dolarsist->valor;
                $producto->preciocosto   = formatNum($producto->preciocosto, 2);
                break;
        }

        $producto->proveedor_id  = $request->proveedor_id;
        $producto->familia_id    = $request->familia_id;
        $producto->subfamilia_id = $request->subfamilia_id;
        
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
        $monedas   = Moneda::orderBy('nombre', 'ASC')->pluck('nombre', 'id');

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
            ->with('monedas', $monedas)
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
    //              SHOW PRODUCTS AJAX              //
    //////////////////////////////////////////////////

    public function ajax_subfamilias($id) {

        $subfamilias = Subfamilia::where('familia_id', '=', $id)->get();

        return response()->json($subfamilias);

    }

    public function ajax_show_products($id)
    {
        $productos = Producto::where('subfamilia_id', '=', $id)->get();

        return response()->json($productos);
    }


    //////////////////////////////////////////////////
    //                  EDIT                        //
    //////////////////////////////////////////////////
    
    public function edit($id)
    {
        $producto     = Producto::findOrFail($id);
        $proveedor    = Proveedor::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $familias     = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $subfamilias  = Subfamilia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $monedas      = Moneda::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $subfamiliaId = $producto->subfamilia->id;
        
        return view('vadmin.productos.edit')
            ->with('producto', $producto)
            ->with('proveedor', $proveedor)
            ->with('familias', $familias)
            ->with('subfamilias', $subfamilias)
            ->with('subfamiliaId', $subfamiliaId)
            ->with('monedas', $monedas);

    }

    public function update($id, Request $request)
    {

        $requestData = $request->all();
        $producto    = Producto::findOrFail($id);

        $this->validate($request,[
            'codproveedor'        => Rule::unique('productos')->ignore($producto->id, 'id')
        ],[
            'codproveedor.unique' => 'Ya existe un producto con ese código de proveedor',
        ]);

        $producto->update($requestData);

        Session::flash('flash_message', 'Producto updated!');

        return redirect('vadmin/productos');
    }

    //////////////////////////////////////////////////
    //               UPDATE STATUS                  //
    //////////////////////////////////////////////////
    public function updateStatus(Request $request, $id)
    {

        $producto = Producto::find($id);
        $producto->estado = $request->estado;            
        $producto->save();

        return response()->json([
            "lastStatus" => $producto->estado,
        ]);

    }

    //////////////////////////////////////////////////
    //               UPDATE STOCK                   //
    //////////////////////////////////////////////////
    public function updateStock(Request $request, $id)
    {
            $producto = Producto::find($id);
            $producto->stockactual = $request->value;   
            $producto->save();

            return response()->json([
                "response" => 'Done'
            ]);

    }

    //////////////////////////////////////////////////
    //               UPDATE STOCK                   //
    //////////////////////////////////////////////////
    public function updateCostPrice(Request $request, $id)
    {

        $producto              = Producto::find($id);
        $producto->preciocosto = $request->value;
        $producto->save();

        return response()->json([
            "Id"          => $id,
            "NuevoPrecio" => $request->value,
            "Moneda"      => $request->value2,
            "Estado"      => "Hecho"
        ]);
    
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

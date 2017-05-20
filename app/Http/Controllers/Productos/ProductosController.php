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

    public function index(Request $request)
    {
        $name = $request->get('name');
        $code = $request->get('code');
        $perPage = 25;

        if ($name != '' and $code != ''){
                // Search User AND Role
                $productos = Producto::where('nombre', 'LIKE', "%$name%")->where('id', 'LIKE', "%$code%")
                ->paginate($perPage);
            } else if ($name != '') {
                // Search by name
                $productos = Producto::where('nombre', 'LIKE', "%$name%")->paginate($perPage);
           
            } else if ($code !='') {
                // Search by Name or Email
                $productos = Producto::where('id', 'LIKE', "%$code%")->paginate($perPage);
            } else {
                // Seatch All
                $productos = Producto::paginate($perPage);
        }

        $dolarsist = Moneda::where('nombre', '=', 'Dolar')->first();
        return view('vadmin.productos.index')->with('productos', $productos)->with('dolarsist', $dolarsist);
    }

    
    public function get_product($id)
    {

       $producto = Producto::where('id', '=', $id)->first();

        //    calcFinalPriceConvert($producto->costo, );
       dd($this->calculatePrice());
       
       return response()->json(['producto' => $producto]);

    }

    public function get_product_and_price(Request $request) 
    {
        $tipocte      = $request->tipocte;
        $id           = $request->id;
        
        $producto     = Producto::where('id', '=', $id)->first();
        if($producto == null){
            return response()->json(['producto' => 'No existe',
                                     'precio' => '0',
                                     'preciooferta'   => '0',
                                     'cantoferta' => '0',
                                     'exist' => 0
                                    ]);
                                     
        } else {

            $price = $this->calculatePrice($id, $tipocte);
            return response()->json(['producto'       => $producto->nombre,
                                     'precio'         => $price,
                                     'preciooferta'   => $producto->preciooferta,
                                     'cantoferta' => $producto->cantoferta,
                                     'exist' => 1
                                    ]);

        }
    }


    public function product_autocomplete(Request $request){

            $term = $request->term;

            $queries = Producto::where('nombre', 'LIKE', '%'.$term.'%' )->take(6)->get();

            foreach ($queries as $query)
            {
                $results[] = ['id' => $query->id, 'value' => $query->nombre]; //you can take custom values as you want
            }
            return response()->json($results);
    }
    

    public function calculatePrice($id, $tipocte)
    {

        $producto  = Producto::where('id', '=', $id)->first();
        $dolarsist = Moneda::where('nombre', '=', 'Dolar')->first();
        $eurosist  = Moneda::where('nombre', '=', 'Euro')->first();
        
        // Calculate Cost
        switch ($producto->monedacompra) {
            case 1:
                $costo = $producto->costopesos;
                break;
            case 2:
                
                $costo = $producto->costodolar * $dolarsist->valor;
                break;
            case 3:
                $costo = $producto->costopesos * $eurosist->valor;
                break;
            default:
                $costo = $producto->costopesos;
                break;
        }


        switch ($tipocte) {
            case 1:
                $price = calcFinalPrice($costo, $producto->pjegremio);
                break;
            case 2:
                $price = calcFinalPrice($costo, $producto->pjeparticular);
                break;
            case 3:
                $price = calcFinalPrice($costo, $producto->pjeespecial);
                break;
            default:
                $price = calcFinalPrice($costo, $producto->pjegremio);
                break;
        }

        return $price;

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
        
        $producto  = new Producto($request->all());
        // Store cost by money type
        switch ($request->monedacompra) {
            case 1:
                $producto->costopesos    = formatNum($request->costo, 2);
                break;
            case 2:
                $producto->costodolar    = formatNum($request->costo, 2);
                break;
            case 3:
                $producto->costoeuro     = formatNum($request->costo, 2);
                break;
            default:
                $producto->costopesos    = formatNum($request->costo, 2);
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
        $dolarsist    = Moneda::where('nombre', '=', 'Dolar')->first();
        $eurosist     = Moneda::where('nombre', '=', 'Euro')->first();
        $producto     = Producto::findOrFail($id);
        $monedas      = Moneda::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $fullid       = $producto->familia_id.'-'.$producto->subfamilia_id.'-'.$id;
        $monedacompra = Moneda::where('id', '=', $producto->monedacompra)->first();
        
        switch ($producto->monedacompra) {
            case 1:
                $valorcompra     = formatNum($producto->costopesos, 2);
                $finalgremio     = calcFinalPrice($valorcompra, $producto->pjegremio);
                $finalparticular = calcFinalPrice($valorcompra, $producto->pjeparticulat);
                $finalespecial   = calcFinalPrice($valorcompra, $producto->pjeespecial);
                break;
            case 2:
                $valorcompra     = formatNum($producto->costodolar, 2);
                                  //calcFinalPriceConvert(cost, porcentage, moneyactualvalue);
                $finalgremio     = calcFinalPriceConvert($valorcompra, $producto->pjegremio,     $dolarsist->valor);
                $finalparticular = calcFinalPriceConvert($valorcompra, $producto->pjeparticular, $dolarsist->valor);
                $finalespecial   = calcFinalPriceConvert($valorcompra, $producto->pjeespecial,   $dolarsist->valor);
                break;
            case 3:
                $valorcompra     = formatNum($producto->costoeuro, 2);
                $finalgremio     = calcFinalPriceConvert($valorcompra, $producto->pjegremio,     $eurosist->valor);
                $finalparticular = calcFinalPriceConvert($valorcompra, $producto->pjeparticular, $eurosist->valor);
                $finalespecial   = calcFinalPriceConvert($valorcompra, $producto->pjeespecial,   $eurosist->valor);
                break;
            default:
                $valorcompra = formatNum($producto->costopesos, 2);
                break;
        }

          
        return view('vadmin.productos.show')
            ->with('producto', $producto)
            ->with('fullid', $fullid)
            ->with('monedas', $monedas)
            ->with('monedacompra', $monedacompra)
            ->with('valorcompra', $valorcompra)
            ->with('finalgremio', $finalgremio)
            ->with('finalparticular', $finalparticular)
            ->with('finalespecial', $finalespecial);
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
        $monedacompra = Moneda::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $subfamiliaId = $producto->subfamilia->id;

        switch ($producto->monedacompra) {
            case 1:
                $costo = $producto->costopesos;
                break;
            case 2:
                $costo = $producto->costodolar;
                break;
            case 3:
                $costo = $producto->costoeuro;
                break;
            default:
                $costo = $producto->costopesos;
                break;
        }

        return view('vadmin.productos.edit')
            ->with('costo', $costo)
            ->with('producto', $producto)
            ->with('proveedor', $proveedor)
            ->with('familias', $familias)
            ->with('subfamilias', $subfamilias)
            ->with('subfamiliaId', $subfamiliaId)
            ->with('monedacompra', $monedacompra);

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

              // Store cost by money type
        switch ($request->monedacompra) {
            case 1:
                $producto->costopesos = formatNum($request->costo, 2);
                $producto->costodolar = 0;
                $producto->costoeuro  = 0;
                break;
            case 2:
                $producto->costodolar = formatNum($request->costo, 2);
                $producto->costopesos = 0;
                $producto->costoeuro  = 0;
                break;
            case 3:
                $producto->costoeuro  = formatNum($request->costo, 2);
                $producto->costopesos = 0;
                $producto->costodolar = 0;
                break;
            default:
                $producto->costopesos    = formatNum($request->costo, 2);
                break;
        }



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

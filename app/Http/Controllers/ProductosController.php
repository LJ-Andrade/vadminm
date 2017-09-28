<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Session;

use App\Producto;
use App\Proveedor;
use App\Categoria;
use App\Familia;
use App\Subfamilia;
use App\Moneda;
use App\Iva;
use App\Tipoct;
use Excel;
use PDF;

class ProductosController extends Controller
{

    //////////////////////////////////////////////////
    //                  VIEW                        //
    //////////////////////////////////////////////////

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

    public function get_product_full_price($id)
    {
        $producto = Producto::where('id', '=', $id)->first();
        $data = $this->calculateAllPrices($id);

        return response()->json($data);

    }

    public function get_product_and_price(Request $request) 
    {
        $tipocte      = $request->tipocte;
        $id           = $request->id;
        
        $producto     = Producto::where('codigo', '=', $id)->first();
        
        if($producto == null){
            return response()->json(['exist'        => 0, 
                                     'producto'     => 'No existe',
                                     'precio'       => '0',
                                     'preciooferta' => '0',
                                     'cantoferta'   => '0'
                                    ]);
                                     
        } else {

            // $price = $this->calculatePrice($id, $tipocte);
            $data = $this->calculatePrice($id, $tipocte);
            $price = $data['price'];
            $offer = $data['offer'];
            return response()->json(['exist'          => 1,
                                     'operacion'      => $request->operacion,
                                     'producto'       => $producto->nombre,
                                     'productoid'     => $producto->id,
                                     'precio'         => $price,
                                     'preciooferta'   => $offer,
                                     'cantoferta'     => $producto->cantoferta
                                    ]);

        }
    }

    public function get_product_data(Request $request)
    {
        $tipocte  = $request->tipocte;
        $id       = $request->id;
        
        $product = Producto::where('id', '=', $id)->first();
        
        if($product == null)
        {
            return response()->json(['exist'        => 0,
                                     'product'      => 'No existe',
                                     'price'        => '0',
                                     'offerprice'   => '0',
                                     'offerammount' => '0',
                                     'iva'          => '0'
                                    ]);
        } else {
            $pricedata = $this->calculatePrice($id, $tipocte);
                                     
            return response()->json(['exist'        => 1,
                                     'product'      => $product->nombre,
                                     'price'        => $pricedata['price'],
                                     'offerprice'   => $pricedata['offer'],
                                     'offerammount' => $product->cantoferta,
                                     'iva'          => $product->condiva
                                    ]);
        }

    }

    public function get_product_stock($id)
    {
        $product = Producto::where('id', '=', $id)->first();
        if($product == null)
        {
            return response()->json(['exist'    => 0,
                                     'product'  => 'No existe',
                                     'id'       => '0',
                                     'stock'    => '0',
                                     'stockmin' => '0',
                                     'stockmax' => '0'
                                    ]);
        } else {                                     
            return response()->json(['exist'    => 1,
                                     'product'  => $product->nombre,
                                     'id'       => $product->id,
                                     'stock'    => $product->stockactual,
                                     'stockmin' => $product->stockmin,
                                     'stockmax' => $product->stockmax
                                    ]);
        }
    }


    public function calculatePrice($id, $tipocte)
    {
        $producto  = Producto::where('codigo', '=', $id)->first();
        $dolarsist = Moneda::where('nombre', '=', 'Dolar')->first();
        $eurosist  = Moneda::where('nombre', '=', 'Euro')->first();
        
        // Calculate Cost
        switch ($producto->monedacompra) {
            // Pesos
            case 1:
                $costo = $producto->costopesos;
                break;
            // Dolar
            case 2:  
                $costo = $producto->costodolar * $dolarsist->valor;
                break;
            // Euro
            case 3:
                $costo = $producto->costoeuro * $eurosist->valor;
                break;
            default:
                $costo = $producto->costopesos;
                break;
        }


        switch ($tipocte) {
            case 1:
                $price = calcFinalPrice($costo, $producto->pjegremio);
                $offer = calcFinalPrice($costo, $producto->pjeoferta);
                break;
            case 2:
                $price = calcFinalPrice($costo, $producto->pjeparticular);
                $offer = calcFinalPrice($costo, $producto->pjeoferta);
                break;
            case 3:
                $price = calcFinalPrice($costo, $producto->pjeespecial);
                $offer = calcFinalPrice($costo, $producto->pjeoferta);
                break;
            default:
                $price = calcFinalPrice($costo, $producto->pjegremio);
                $offer = calcFinalPrice($costo, $producto->pjeoferta);
                break;
        }

        return array('price' => $price, 'offer' => $offer);

    }

    public function calculateAllPrices($id){
        $producto  = Producto::where('id', '=', $id)->first();
        $dolarsist = Moneda::where('nombre', '=', 'Dolar')->first();
        $eurosist  = Moneda::where('nombre', '=', 'Euro')->first();

        switch ($producto->monedacompra) {
            // Pesos
            case 1:
                $costo            = $producto->costopesos;
                $costopesos       = $producto->costopesos;
                $monedacompra = 'Pesos';
                break;
            // Dolar
            case 2:  
                $costopesos   = $producto->costodolar * $dolarsist->valor;
                $costo        = $producto->costodolar;
                $monedacompra = 'Dólares';
                break;
            // Euro
            case 3:
                $costopesos   = $producto->costoeuro * $eurosist->valor;
                $costo        = $producto->costoeuro;
                $monedacompra = 'Euro';
                break;
            default:
                $costo = $producto->costopesos;
                break;
        }
                $preciogremio     = calcFinalPrice($costopesos, $producto->pjegremio);
                $precioparticular = calcFinalPrice($costopesos, $producto->pjeparticular);
                $precioespecial   = calcFinalPrice($costopesos, $producto->pjeespecial);
                if($producto->pjeoferta != 0){
                    $preciooferta = calcFinalPrice($costopesos, $producto->pjeoferta);
                } else {
                    $preciooferta = 0;
                }

        
        return array('monedacompra' => $monedacompra,
                     'costo'        => $costo,
                     'costopesos'   => $costopesos,
                     'gremio'       => $preciogremio,
                     'particular'   => $precioparticular,
                     'especial'     => $precioespecial,
                     'preciooferta' => $preciooferta,
                     'cantoferta'   => $producto->cantoferta
                     );

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
    
    //////////////////////////////////////////////////
    //                  STOCK                       //
    //////////////////////////////////////////////////

    public function stock(Request $request)
    {   
        // Get Stock Order
        if($request->get('order')){
            $order = $request->get('order');
        } else {
            $order = 'ASC';
        }

        // Gey Search Keys
        $bycode = $request->get('code');
        $byname = $request->get('name');
        
        if($bycode && $byname) {
            $products      = Producto::where('id', '=', "$bycode")->where('nombre', 'LIKE', "%$byname%")->orderBy('stockactual', "$order")->paginate(20);
            $searchMessage = 'Descripción con: "'.$byname.'" y código: "'. $bycode.'"';
        } elseif($bycode) {
            $products      = Producto::where('id', '=', "$bycode")->orderBy('stockactual', "$order")->paginate(20);
            $searchMessage = 'Con código: "'.$bycode.'"';
        } elseif($byname) {
            $products      = Producto::where('nombre', 'LIKE', "%$byname%")->orderBy('stockactual', "$order")->paginate(20);
            $searchMessage = 'Descripción con: "'.$byname.'"';
        } else {
            $products      = Producto::orderBy('stockactual', $order)->paginate(20);
            $searchMessage = 'Descripción con: "'.$byname.'"';
        }

        return view('vadmin.productos.stock')
            ->with('products', $products)
            ->with('searchMessage', $searchMessage);

    }

    //////////////////////////////////////////////////
    //               PRICES LIST                    //
    //////////////////////////////////////////////////

    public function listas(Request $request)
    {
        $categorias  = Categoria::orderBy('id', 'DESC')->get();
        $familias    = Familia::orderBy('id', 'DESC')->get();
        $subfamilias = Subfamilia::orderBy('id', 'DESC')->get();
        $tiposcte    = Tipoct::orderBy('id', 'ASC')->get();
        $dolarsist   = Moneda::where('id', '=', '2')->first();
        $eurosist    = Moneda::where('id', '=', '3')->first();
        $dolarsist   = $dolarsist->valor;
        $eurosist    = $eurosist->valor;


        if($request->get('familias')){
            
            $products = Producto::where('familia_id', '=', $request->get('familias'))->paginate(50);
            $searchMessage = '';
            
        } else {

            // Get Stock Order
            if($request->get('order')){
                $order = $request->get('order');
            } else {
                $order = 'ASC';
            }

            $searchMessage = '';
            $products = Producto::orderBy('id', 'ASC')->paginate(50);
        }    
        return view('vadmin.productos.listas')
            ->with('products', $products)
            ->with('categorias', $categorias)
            ->with('familias', $familias)
            ->with('subfamilias', $subfamilias)
            ->with('tiposcte', $tiposcte)
            ->with('eurosist', $eurosist)
            ->with('dolarsist', $dolarsist)
            ->with('searchMessage', $searchMessage);

    }

    public function exportPricesListPdf($familias, $tipocte)
    {   
        
        $dolarsist   = Moneda::where('id', '=', '2')->first();
        $eurosist    = Moneda::where('id', '=', '3')->first();
        $dolarsist   = $dolarsist->valor;
        $eurosist    = $eurosist->valor;
        if($familias == 'X'){
            $products   = Producto::orderBy('id', 'ASC')->paginate(50);
        } else {
            $products   = Producto::where('familia_id', '=', $familias)->paginate(50);
        }

        $pdf = PDF::loadView('vadmin.productos.listasexport', compact('products', 'familias', 'subfamilias', 'tipocte', 'eurosist', 'dolarsist', 'searchMessage'));

        // $pdf->setPaper('A4', 'landscape');
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('test.pdf');
    }

    public function exportPricesListExcel($familias, $tipocte)
    {
        
        $filename = 'Lista de Precios';
        Excel::create($filename, function($excel) use($familias, $tipocte){

            $excel->sheet('Listado', function($sheet) use($familias, $tipocte) {   
                                   
                $dolarsist   = Moneda::where('id', '=', '2')->first();
                $eurosist    = Moneda::where('id', '=', '3')->first();
                $dolarsist   = $dolarsist->valor;
                $eurosist    = $eurosist->valor;
                if($familias == 'X'){
                    $products   = Producto::orderBy('id', 'ASC')->paginate(50);
                } else {
                    $products   = Producto::where('familia_id', '=', $familias)->paginate(50);
                }
                $sheet->loadView('vadmin.productos.listasexport', compact('products', 'familias', 'subfamilias', 'tipocte', 'eurosist', 'dolarsist', 'searchMessage'));
            });

        })->export('xls');
    }

    //////////////////////////////////////////////////
    //                  SHOW                        //
    //////////////////////////////////////////////////


    public function show($id)
    {
        $dolarsist    = Moneda::where('id', '=', '2')->first();
        $eurosist     = Moneda::where('id', '=', '3')->first();
        $producto     = Producto::findOrFail($id);
        $monedas      = Moneda::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $monedacompra = Moneda::where('id', '=', $producto->monedacompra)->first();
        switch ($producto->monedacompra) {
            case 1:
                $valorcompra     = formatNum($producto->costopesos, 2);
                $finalgremio     = calcFinalPrice($valorcompra, $producto->pjegremio);
                $finalparticular = calcFinalPrice($valorcompra, $producto->pjeparticular);
                $finalespecial   = calcFinalPrice($valorcompra, $producto->pjeespecial);
                $finaloferta     = calcFinalPrice($valorcompra, $producto->pjeoferta);
                break;
            case 2:
                $valorcompra     = formatNum($producto->costodolar, 2);
                $finalgremio     = calcFinalPriceConvert($valorcompra, $producto->pjegremio,     $dolarsist->valor);
                $finalparticular = calcFinalPriceConvert($valorcompra, $producto->pjeparticular, $dolarsist->valor);
                $finalespecial   = calcFinalPriceConvert($valorcompra, $producto->pjeespecial,   $dolarsist->valor);
                $finaloferta     = calcFinalPriceConvert($valorcompra, $producto->pjeoferta,     $dolarsist->valor);
                break;
            case 3:
                $valorcompra     = formatNum($producto->costoeuro, 2);
                $finalgremio     = calcFinalPriceConvert($valorcompra, $producto->pjegremio,     $eurosist->valor);
                $finalparticular = calcFinalPriceConvert($valorcompra, $producto->pjeparticular, $eurosist->valor);
                $finalespecial   = calcFinalPriceConvert($valorcompra, $producto->pjeespecial,   $eurosist->valor);
                $finaloferta     = calcFinalPriceConvert($valorcompra, $producto->pjeoferta,     $eurosist->valor);
                break;
            default:
                $valorcompra = formatNum($producto->costopesos, 2);
                break;
        }
        
        // dd($finalgremio);
                  
        return view('vadmin.productos.show')
            ->with('producto', $producto)
            ->with('monedas', $monedas)
            ->with('monedacompra', $monedacompra)
            ->with('valorcompra', $valorcompra)
            ->with('finalgremio', $finalgremio)
            ->with('finalparticular', $finalparticular)
            ->with('finalespecial', $finalespecial)
            ->with('finaloferta', $finaloferta);
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
    //                  CREATE                      //
    //////////////////////////////////////////////////

    public function create()
    {
        
        $ultCodigo    = Producto::orderBy('id','DESC')->first();
        $proveedor    = Proveedor::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $categorias   = Categoria::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $familias     = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $subfamilias  = Subfamilia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $monedas      = Moneda::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $currency     = '';
        $origin       = null;

        

        if(is_null($ultCodigo)){
            $ultCodigo = '-';
        } else {
            $ultCodigo = $ultCodigo->codigo;
        }

        return view('vadmin.productos.create')
            ->with('ultCodigo', $ultCodigo)
            ->with('proveedor', $proveedor)
            ->with('categorias', $categorias)
            ->with('familias', $familias)
            ->with('subfamilias', $subfamilias)
            ->with('monedas', $monedas)
            ->with('origin', $origin)
            ->with('currency', $currency);

    }

    public function store(Request $request)
    {
        
        $this->validate($request,[
            'nombre'              => 'required|unique:productos,nombre',
        ],[
            'nombre.required'     => 'Debe ingresar un nombre',
            'nombre.unique'       => 'El producto ya existe',
            
        ]);
        
        // dd($request->all());
            
        $producto  = new Producto($request->all());
        // Store cost by money type
        
        if($request->codproveedor == null){
            $producto->codproveedor = ' ';
        }
        
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
        $producto->moneda_id     = $request->monedacompra;
        
        if (is_null($request->oferta)){
            $producto->oferta = 'off';
            $producto->pjeoferta  = 0;
            $producto->cantoferta = 0;
        }
        
        $producto->save();

        return redirect('vadmin/productos')->with('message', 'Producto creado satisfactoriamente');
    }

    //////////////////////////////////////////////////
    //                  EDIT                        //
    //////////////////////////////////////////////////
    
    public function edit($id)
    {
        $producto     = Producto::findOrFail($id);
        $oferta       = $producto->oferta;
        $proveedor    = Proveedor::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $categorias   = Categoria::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $familias     = Familia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $subfamilias  = Subfamilia::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $monedacompra = Moneda::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $subfamiliaId = $producto->subfamilia->id;
        $monedas      = Moneda::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $currency     = Moneda::where('id','=', $producto->monedacompra)->first();
        $currency     = $currency->id;
        $origin       = $producto->origen;

        $ultCodigo    = Producto::orderBy('id','DESC')->first();
        if(is_null($ultCodigo)){
            $ultCodigo = 0;
        } else {
            $ultCodigo = intVal($ultCodigo->codigo);
        }

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
            ->with('producto', $producto)
            ->with('ultCodigo', $ultCodigo)
            ->with('oferta', $oferta)
            ->with('proveedor', $proveedor)
            ->with('categorias', $categorias)
            ->with('familias', $familias)
            ->with('subfamilias', $subfamilias)
            ->with('subfamiliaId', $subfamiliaId)
            ->with('origin', $origin)
            ->with('monedacompra', $monedacompra)
            ->with('monedas', $monedas)
            ->with('currency', $currency);

    }



    public function update($id, Request $request)
    {
        $requestData = $request->all();
        $producto    = Producto::findOrFail($id);

        // dd($request->codproveedor);
        if($request->codproveedor == null){
            $producto->codproveedor = ' ';
        }
        
        $this->validate($request,[
            'codproveedor'        => Rule::unique('productos')->ignore($producto->id, 'id')
            ],[
            'codproveedor.unique' => 'Ya existe un producto con ese código de proveedor',
            ]);
            
            // Store cost by money type
            switch ($request->monedacompra) {
                case 1:
                $producto->costopesos = formatNum($request->costopesos, 2);
                $producto->costodolar = 0;
                $producto->costoeuro  = 0;
                break;
                case 2:
                $producto->costodolar = formatNum($request->costodolar,2);
                $producto->costopesos = 0;
                $producto->costoeuro  = 0;
                
                break;
                case 3:
                $producto->costoeuro  = formatNum($request->costoeuro, 2);
                $producto->costopesos = 0;
                $producto->costodolar = 0;
                break;
                default:
                $producto->costopesos    = formatNum($request->costopesos, 2);
                break;
            }
        
        
        if($producto->oferta == 'off')
        {
            $producto->pjeoferta  = 0;
            $producto->cantoferta = 0;
        }

        if (is_null($request->oferta)){
            $producto->oferta     = 'off';
            $producto->pjeoferta  = 0;
            $producto->cantoferta = 0;
        } else {
        
        };
        
        $producto->save();

        return redirect('vadmin/productos')->with('message', 'Producto "'.$producto->nombre.'" actualizado');
    }

    //////////////////////////////////////////////////
    //               UPDATE STATUS                  //
    //////////////////////////////////////////////////
    public function updateStatus(Request $request, $id)
    {

        $producto = Producto::find($id);
        
        switch ($request->action) {
            case 'activar':
                $producto->estado = 'activo';
                break;
            case 'pausar':
                $producto->estado = 'pausado';
                break;
            default:
                $producto->estado = 'indefinido';
                break;
        }
             
        $producto->save();

        return response()->json([
            "newstatus" => $producto->estado,
        ]);

    }

    //////////////////////////////////////////////////
    //               UPDATE STOCK                   //
    //////////////////////////////////////////////////
    public function updateStock(Request $request, $id)
    {
            $producto      = Producto::find($id);
            $newStockValue = $request->value;
            $producto->stockactual = $producto->stockactual + $newStockValue;
            $producto->save();

            return response()->json([
                "response" => '1',
                "newstock" => $producto->stockactual
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

    public function updateCurrencyAndPrice(Request $request)
    {
        try {
        
            $producto  = Producto::find($request->id);
            $price     = $request->price;
            $currency  = $request->currency;

            switch ($currency) {
            case 1:
                $producto->costopesos = $price;
                $producto->costodolar = 0;
                $producto->costoeuro  = 0;
                break;
            case 2:
                $producto->costodolar = $price;    
                $producto->costopesos = 0;
                $producto->costoeuro  = 0;
                break;
            case 3:
                $producto->costoeuro  = $price;  
                $producto->costodolar = 0;
                $producto->costopesos = 0;
                break;
            }

            $producto->monedacompra = $currency;
            $producto->save();
            
            return response()->json([
                'success'     => true,
                'message'     => 'Producto Actualizado'
            ]);
        
        } catch (Exception $e) {
            return response()->json([
                'success'     => true,
                'message'     => 'Error: '. $e
            ]);
        }
    }


    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Producto::find($id);
                    $record->delete();
                }
                return response()->json([
                    'success'   => true,
                ]); 
            }  catch (\Illuminate\Database\QueryException $e) {
                return response()->json([
                    'success'   => false,
                    'error'    => 'Error: '.$e
                ]);    
            }
        } else {
            try {
                $record = Producto::find($id);
                $record->delete();
                    return response()->json([
                        'success'   => true,
                    ]);  
                    
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'success'   => false,
                        'error'    => 'Error: '.$e
                    ]);    
                }
        }
    }

}

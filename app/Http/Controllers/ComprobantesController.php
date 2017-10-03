<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comprobante;
use Illuminate\Http\Request;
use Session;
use App\Cliente;
use App\TiposComprobante;
use App\Pedidositem;
use App\Movimiento;
use App\Producto;

class ComprobantesController extends Controller
{

    //////////////////////////////////////////////////
    //                   VIEW                       //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $comprobantes = Comprobante::where('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $comprobantes = Comprobante::paginate($perPage);
        }

        return view('vadmin.comprobantes.index', compact('comprobantes'));
    }

    public function show($id)
    {
        $comprobante = Comprobante::findOrFail($id);

        return view('vadmin.comprobantes.show', compact('comprobante'));
    }

    //////////////////////////////////////////////////
    //                   CREATE                     //
    //////////////////////////////////////////////////
 
    public function create()
    {
        $clientes         = Cliente::orderBy('id', 'ASC')->pluck('razonsocial', 'id');
        $tiposcomprobante = TiposComprobante::orderBy('name', 'ASC')->get();

        return view('vadmin.comprobantes.create')
            ->with('clientes', $clientes)
            ->with('tiposcomprobante', $tiposcomprobante);
    }

   
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Comprobante::create($requestData);

        Session::flash('flash_message', 'Comprobante added!');

        return redirect('vadmin/comprobantes');
    }

    public function get_pending_orders($id)
    {
        $pedidositems = Pedidositem::where('cliente_id', '=', $id)->where('facturado', '=', 0)->get();
        return view('vadmin/comprobantes/pedidoslist')->with('pedidositems', $pedidositems);   
        
    }


    public function generate_comp(Request $request)
    {
        $client   = Cliente::findOrFail($request->clientid);
        
        // Generate $products Array;
        if (!($request->items == null)){
            $products = array();    
            foreach ($request->items as $item){

                $products[] = array( 
                                "type"        => "",
                                "code"        => $item['code'],
                                "description" => $item['description'],
                                "price"       => floatval($item['price']),
                                "quantity"    => intval($item['quantity']),
                                "sum_price"   => floatval($item['sum_price']),
                                "sum_tax"     => floatval($item['sum_tax']),
                                "discount"    => floatval($item['discount']),
                                "total"       => floatval($item['total']),
                                );
            }
        } else {
            $products = null;
        }

        if($client->provincia){
            $provincia = $client->provincia->name;
        } else {
            $pronvincia = '';
        }

        if($client->codpostal){
            $codpostal = $client->codpostal;
        } else {
            $codpostal = '';
        }

        // Json To WebService
        $docModel  = array( 
                    "color" => array (
                        "red" => 41,
                        "green" => 76,
                        "blue" => 120
                    ),
                    "text" => array (
                        "phone" => "Teléfono:",
                        "fax" => "Fax:",
                        "document_id" => "CUIT:",
                        "email" => "Email:",
                        "customer" => "Cliente:",
                        "invoice_num" => "Nro.:",
                        "date" => "Fecha:",
                        "customer_num" => "ID Cliente:",
                        "page" => "Página",
                        "of" => "de",
                        "type" => "Tipo",
                        "desc" => "Descripción",
                        "price" => "Precio",
                        "quantity" => "Cant.",
                        "sum_price" => "Monto",
                        "sum_tax" => "IVA (21%)",
                        "pro_total" => "Total",
                        "sub_total" => "Subtotal",
                        "tax_rate" => "IVA %",
                        "shipping" => "EnvÃ­o",
                        "total" => "Total",
                        "continued" => "Continua en pag ",
                        "simbol_left" => "  $    ",
                        "simbol_right" => ""
                    ),
                    "description_left" => "",
                    "customer_data" => array (
                        "num" => strval($client->id),
                        "name" => $client->razonsocial,
                        "address" => $client->dirfiscal,
                        "postal_code" => $codpostal,
                        "city" => $provincia,
                        "country" => "Argentina",
                        "ident" => $client->cuit,
                        "doc_type" => 80
                    ),
                    "company_data" => array (
                        "name" => "Bit Ingeniería",
                        "address" =>  "Italia 945",
                        "postal_code" =>  "1708",
                        "city" => "Castelar",
                        "phone" => "+54(11)-20923168",
                        "fax" => "011-1569375707",
                        "ident" => "20-93980259-3",
                        "email" => "contacto@bitingenieria.com.ar",
                        "web" => "http:\/\/www.bitingenieria.com.ar"
                    ),
                    "tipo_comp" => $request->tipo_comp,
                    "pto_vta" => 140,
                    "invoice_num" => "",
                    "tax" => 20,
                    "date" => $request->date,
                    "products" => $products,
                    "base" => array(
                        "subtotal" => floatval($request->subtotal),
                        "sum_tax" => floatval($request->ivasubtotal),
                        "discount" => floatval(0),
                        "total" => floatval($request->total)
                    )
                );
            // dd($docModel);
            return response()->json($docModel); 
    }

    public function store_comp(Request $request)
    {
 
        $client = Cliente::findOrFail($request->clientid);
        try{
                        
            $comp                = new Comprobante();
            $comp->nro           = $request->nro;
            $comp->cae           = $request->cae;
            $comp->vto           = $request->vto;
            $comp->pto_vta       = $request->pto_vta;
            $comp->letra         = $request->letter;
            $comp->afipcode      = $request->tipo_comp;
            $comp->direntrega_id = $request->direntrega;
            $comp->iva           = $request->ivasubtotal;
            $comp->subtotal      = $request->subtotal;
            $comp->total         = $request->total;
            $comp->flete_id      = $request->flete;
            $comp->vendedor_id   = $request->vendedor;
            $comp->cliente_id    = $request->clientid;
            
            $comp->estado        = '1';  
            $comp->modo          = $request->modo;
            $comp->op            = $request->op;
            $comp->doc_filename  = $request->nro;

            // $comp->save();
            // $this->saveMovement($request->clientid, $request->total, $request->modo, $request->op, $request->nro);
            // Set pending orders to done
            
                // if($request->markdone){    
                        
                //     // Set Facturado
                //     foreach ($request->markdone as $orderid){
                //         $pedidoItem = Pedidositem::findOrFail($orderid);
                //         $pedidoItem->facturado = 1;
                //         $pedidoItem->save();
                //     }

                // Discount Stock from WHITE
                if($request->letter == 'A' || $request->letter == 'B'){
                    
                    foreach ($request->items as $item) {
                        $id       = $item['code'];
                        $quantity = $item['quantity'];
                        $this->discountStock($id, $quantity, $request->pto_vta);
                    }                    
                }
                

                $movement = 'Movimiento';
                return response()->json(['success'  => true,
                                         'message'  => 'Documento guardado',
                                         'data'     => $comp,
                                         'movement' => $movement]); 
       
            } catch(Exception $e) {
            return response()->json(['success' => false,
                                     'message' => 'Error: '.$e]); 
        }

    }

    public function discountStock($code, $quantity, $ptovta)
    {   
        $product = Producto::where('codigo', $code)->first();
        switch($ptovta){
            case '140': 
                $product->stock1 = $product->stock1 - $quantity; 
            break;
            case '150': 
                $product->stock2 = $product->stock2 - $quantity; 
                break;
                default: '';
            }
        $product->save();        
    }

    public function saveMovement($clienteid, $total, $modo, $op, $nro){
        // Save as Movement
        $saldo        = Movimiento::sum('importe');
        
        $movement                  = new Movimiento();
        $movement->cliente_id      = $clienteid;
        if($op == 'E'){
            $movement->importe         = -$total;
        } elseif($op == 'I'){  
            $movement->importe         = $total;
        }

        $saldo = $saldo + $movement->importe;
        $movement->subtotal = $saldo;


        $movement->modo            = $modo;
        $movement->op              = $op;
        $movement->comprobante_nro = $nro;
        $movement->save();
    }


    //////////////////////////////////////////////////
    //                  UPDATE                      //
    //////////////////////////////////////////////////

 
    public function edit($id)
    {
        $comprobante = Comprobante::findOrFail($id);

        return view('vadmin.comprobantes.edit', compact('comprobante'));
    }

   
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $comprobante = Comprobante::findOrFail($id);
        $comprobante->update($requestData);

        Session::flash('flash_message', 'Comprobante updated!');

        return redirect('vadmin/comprobantes');
    }


    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Comprobante::find($id);
                    $record->delete();
                }
                return response()->json([
                    'success'   => true,
                ]); 
            }  catch (Exception $e) {
                return response()->json([
                    'success'   => false,
                    'error'    => 'Error: '.$e
                ]);    
            }
        } else {
            try {
                $record = Comprobante::find($id);
                $record->delete();
                    return response()->json([
                        'success'   => true,
                    ]);  
                    
                } catch (Exception $e) {
                    return response()->json([
                        'success'   => false,
                        'error'    => 'Error: '.$e
                    ]);    
                }
        }
    }

}

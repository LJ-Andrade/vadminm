<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Factura;
use App\Cliente;
use App\Pedidositem;
use Illuminate\Http\Request;
use Session;
// use GuzzleHttp\Exception\GuzzleException;
// use GuzzleHttp\Client;

class FacturasController extends Controller
{

    //////////////////////////////////////////////////
    //                  INDEX                       //
    //////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $facturas = Factura::where('numero', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $facturas = Factura::paginate($perPage);
        }

        return view('vadmin.facturas.index', compact('facturas'));
    }

    //////////////////////////////////////////////////
    //                  CREATE                      //
    //////////////////////////////////////////////////

    public function create()
    {
        $clientes = Cliente::orderBy('id', 'ASC')->pluck('razonsocial', 'id');
        return view('vadmin.facturas.create')->with('clientes', $clientes);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'              => 'required|unique:facturas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'       => 'El item ya existe',
        ]);

        $requestData = $request->all();
        
        Factura::create($requestData);

        Session::flash('flash_message', 'Factura added!');

        return redirect('vadmin/facturas');
    }   

    public function get_pending_orders($id)
    {
        $pedidositems = Pedidositem::where('cliente_id', '=', $id)->where('facturado', '=', 0)->get();
        return view('vadmin/facturas/pedidoslist')->with('pedidositems', $pedidositems);   
        
    }


    public function generate_fc(Request $request)
    {
        $client   = Cliente::findOrFail($request->clientid);
        
        // Generate $products Array;
        if (!($request->items == null)){
            $products = array();    
            foreach ($request->items as $item){

                $products[] = array( 
                                "type"        => "P",
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

        // Json To WebService
        $fcmodel  = array( 
                    "color" => array (
                        "red" => 41,
                        "green" => 76,
                        "blue" => 120
                    ),
                    "text" => array (
                        "phone" => "TelÃ©fono:",
                        "fax" => "Fax:",
                        "document_id" => "CUIT:",
                        "email" => "Email:",
                        "customer" => "Cliente:",
                        "invoice_num" => "Nro.:",
                        "date" => "Fecha:",
                        "customer_num" => "ID Cliente:",
                        "page" => "PÃ¡gina",
                        "of" => "de",
                        "type" => "Tipo",
                        "desc" => "DescripciÃ³n",
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
                        "postal_code" => $client->codpostal,
                        "city" => $client->provincia->name,
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
                    "tipo_comp" => 1,
                    "pto_vta" => 140,
                    "invoice_num" => "0140-00000625",
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
            // dd($fcmodel);
            return response()->json($fcmodel); 
    }

    public function store_fc(Request $request)
    {
        
        $client = Cliente::findOrFail($request->clientid);
        $fc     = new Factura();

        $fc->numero        = $request->nro;
        $fc->cae           = $request->cae;
        $fc->vto           = $request->vto;
        $fc->pto_vta       = 140;
        $fc->tipo_fc       = $request->tipofcname;
        $fc->direntrega_id = '2';
        $fc->iva           = $request->ivasubtotal;
        $fc->subtotal      = $request->subtotal;
        $fc->total         = $request->total;
        $fc->flete_id      = '2';
        $fc->vendedor_id   = '2';
        $fc->cliente_id    = $request->clientid;
        // Si sale todo bien
        $fc->estado  = '1';

         dd($fc);
        $fc->save();


    }


    // Almost obsolete
    public function get_fc_data(Request $request)
    {
        
        // Set Pending Orders to Done
        // They´re going to keep appearing in orders but not in FC

        // if(!$request->markAsFcDone == null) {
        //     $ordersFcDone = $request->markAsFcDone;
            
        //     foreach ($ordersFcDone as $orderid){
                
        //         $pedidoItem = Pedidositem::findOrFail($orderid);
        //         $pedidoItem->facturado = 1;
        //         $pedidoItem->save();

        //     }
        // }

       

        $cuit = $request->cuit;
     
        $fc      = new Factura();

        // **** FAKE DATA ****
        $fc->numero        = '0000-'.$request->cuit;
        $fc->tipo_fc_id    = $request->tipofcid;
        $fc->tipo_fc       = $request->tipofcname;
        $fc->cae           = '1234565';
        $fc->centroemisor  = 'CentroEmisor';
        $fc->direntrega_id = '2';
        $fc->iva           = $request->ivasubtotal;
        $fc->subtotal      = $request->subtotal;
        $fc->total         = $request->total;
        $fc->flete_id      = '2';
        $fc->vendedor_id   = '2';
        $fc->cliente_id    = $request->clientid;
        // Si sale todo bien
        $fc->estado  = '1';

         dd($fc);
        $fc->save();

        return redirect('vadmin/facturas');
    }

    //////////////////////////////////////////////////
    //                  SHOW                        //
    //////////////////////////////////////////////////


        
    public function ajax_list(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->paginate(12);
    }




    //////////////////////////////////////////////////
    //                  SHOW                        //
    //////////////////////////////////////////////////

    public function show($id)
    {
        $factura = Factura::findOrFail($id);

        return view('vadmin.facturas.show', compact('factura'));
    }


    //////////////////////////////////////////////////
    //               EDIT / UPDATE                   //
    //////////////////////////////////////////////////

    public function edit($id)
    {
        $factura = Factura::findOrFail($id);

        return view('vadmin.facturas.edit', compact('factura'));
    }

    public function update($id, Request $request)
    {

        $this->validate($request,[
            'name'              => 'required|unique:facturas,name',
        ],[
            'name.required'     => 'Debe ingresar un nombre',
            'name.unique'      => 'El item ya existe',
        ]);


        $requestData = $request->all();
        
        $factura = Factura::findOrFail($id);
        $factura->update($requestData);

        Session::flash('flash_message', 'Factura updated!');

        return redirect('vadmin/facturas');
    }

    //////////////////////////////////////////////////
    //                DESTROY                       //
    //////////////////////////////////////////////////

    // ---------- Delete -------------- //
    // public function destroy($id)
    // {
    //     $item = Factura::find($id);
    //     $item->delete();
    //     echo 1;
    // }


    // // ---------- Ajax Bach Delete -------------- //
    // public function ajax_batch_delete(Request $request, $id)
    // {
    //     foreach ($request->id as $id) {
        
    //         $item  = Factura::find($id);
    //         Factura::destroy($id);
    //     }
    //     echo 1;
    // }


}

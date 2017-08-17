<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pago;
use App\Factura;
use App\Comprobante;
use Illuminate\Http\Request;
use Session;

class PagosController extends Controller
{

    /////////////////////////////////////////////////
	//                   VIEW                      //
	/////////////////////////////////////////////////

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $pagos = Pago::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $pagos = Pago::paginate($perPage);
        }

        return view('vadmin.pagos.index', compact('pagos'));
    }


    public function show($id)
    {
        $pago = Pago::findOrFail($id);

        return view('vadmin.pagos.show', compact('pago'));
    }

    /////////////////////////////////////////////////
	//                   CREATE                    //
	/////////////////////////////////////////////////

    public function create()
    {
        return view('vadmin.pagos.create');
    }

    public function store(Request $request)
    {
        if($request->factura_id != null){
            $factura_id = $request->factura_id;
            $facturaNro = Comprobante::findOrFail($request->factura_id);
            $facturaNro = $facturaNro->nro;
        } else {
            $facturaNro = '';
        }

        $importe       = $request->importe;
        $clientId      = $request->cliente_id;
        $facturaId     = $request->factura_id;

        // Banco
        $bcoMovimiento = $request->bco_movimiento;
        
        // Cheque
        $chBanco       = $request->ch_banco;
        $chBancoNro    = $request->ch_banco_nro;
        $chSucursal    = $request->sucursal;
        $chFechaCobro  = $request->ch_fechacobro;
        $chCuit        = $request->ch_cuit;

        // Retención
        $retTipo         = $request->ret_tipo;
        $retNro          = $request->ret_nro;
        $retJurisdiccion = $request->ret_jurisdicción;
       
        switch ($request->modo) {
            // Efectivo
            case 'E':
                try {    
                    $this->store_efvo($clientId, $importe, $facturaNro, $facturaId);
                    return redirect($request->redirect)->with('message', 'Importe ingresado');
                } catch(Exception $e){
                    return redirect('vadmin/clientes/cuenta/'.$clientId)->with('message', 'Error: '.$e);
                }
                break;
            // Banco
            case 'B':
                try {
                    $this->store_banco($clientId, $importe, $facturaNro, $facturaId, $bcoMovimiento);
                    return redirect($request->redirect)->with('message', 'Importe ingresado');
                } catch(Exception $e){
                    return redirect('vadmin/clientes/cuenta/'.$clientId)->with('message', 'Error: '.$e);
                }
                break;
            // Cheque
            case 'C':
                try {
                    $this->store_cheque($clientId, $importe, $facturaNro, $facturaId, $chBanco, $chBancoNro, $chSucursal, $chFechaCobro, $chCuit);
                    return redirect($request->redirect)->with('message', 'Importe ingresado');
                } catch(Exception $e){
                    return redirect('vadmin/clientes/cuenta/'.$clientId)->with('message', 'Error: '.$e);
                }
                break;
            // Retención
            case 'R':
                try {
                    $this->store_retencion($clientId, $importe, $facturaNro, $facturaId, $retTipo, $retNro, $retJurisdiccion);
                    return redirect($request->redirect)->with('message', 'Importe ingresado');
                } catch(Exception $e){
                   return redirect('vadmin/clientes/cuenta/'.$clientId)->with('message', 'Error: '.$e);
                }
                break;
            default:
                return redirect('vadmin/clientes/cuenta/'.$clientId)->with('message', 'Operación desconocida');
                break;
        }
    }

    public function store_efvo($clientId, $importe, $facturaNro, $facturaId)
    {
        $payment = new Pago();
        $payment->cliente_id   = $clientId;
        $payment->modo         = 'E';
        $payment->importe      = $importe;
        $payment->factura_nro  = $facturaNro;
        $payment->factura_id   = $facturaId;

        $payment->save();     
    }

    public function store_banco($clientId, $importe, $facturaNro, $facturaId, $bcoMovimiento)
    {
        $payment = new Pago();
        $payment->cliente_id     = $clientId;
        $payment->modo           = 'B';
        $payment->importe        = $importe;
        $payment->factura_nro    = $facturaNro;
        $payment->factura_id     = $facturaId;
        $payment->bco_movimiento = $bcoMovimiento;

        $payment->save();     
    }

    public function store_cheque($clientId, $importe, $facturaNro, $facturaId, $chBanco, $chBancoNro, $chSucursal, $chFechaCobro, $chCuit)
    {
        $payment = new Pago();
        $payment->cliente_id    = $clientId;
        $payment->modo          = 'C';
        $payment->importe       = $importe;
        $payment->factura_nro   = $facturaNro;
        $payment->factura_id    = $facturaId;
        $payment->ch_banco      = $chBanco;
        $payment->ch_banco_nro  = $chBancoNro;
        $payment->ch_sucursal   = $chSucursal;
        $payment->ch_fechacobro = $chFechaCobro;
        $payment->ch_cuit       = $chCuit;

        $payment->save();  
    }

    public function store_retencion($clientId, $importe, $facturaNro, $facturaId, $retTipo, $retNro, $retJurisdiccion)
    {
        $payment = new Pago();
        $payment->cliente_id       = $clientId;
        $payment->modo             = 'R';
        $payment->importe          = $importe;
        $payment->factura_nro      = $facturaNro;
        $payment->factura_id       = $facturaId;
     
        // Retencion
        $payment->ret_tipo         = $retTipo;
        $payment->ret_nro          = $retNro;
        $payment->ret_jurisdiccion = $retJurisdiccion; 

        $payment->save();  
    }

    /////////////////////////////////////////////////
	//                   UPDATE                    //
	/////////////////////////////////////////////////

    public function edit($id)
    {
        $pago = Pago::findOrFail($id);

        return view('vadmin.pagos.edit', compact('pago'));
    }

    public function update($id, Request $request)
    {

        $this->validate($request,[
            'name'          => 'required|unique:pagos,name',
        ],[
            'name.required' => 'Debe ingresar un nombre',
            'name.unique'   => 'El item ya existe',
        ]);

        $requestData = $request->all();
        
        $pago = Pago::findOrFail($id);
        $pago->update($requestData);

        Session::flash('flash_message', 'Pago updated!');

        return redirect('vadmin/pagos');
    }

    //////////////////////////////////////////////////
    //                  DESTROY                     //
    //////////////////////////////////////////////////

    public function destroy(Request $request, $id)
    {   

        if(is_array($request->id)) {
            try {
                foreach ($request->id as $id) {
                    $record = Pago::find($id);
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
                $record = Pago::find($id);
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

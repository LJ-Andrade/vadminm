<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use DB;
use Excel;
use PDF;
use App\Pago;
use App\Flete;
use App\Zona;

class FileExportController extends Controller
{
    public function importExport()
	{
		return view('importExport');
	}

    
	public function exportPdf($model, $ammount)
	{
        
        switch($model){
            case 'Flete':
                $view    = Flete::orderBy('name', 'DESC')->get();
                $varname = 'fletes';
            break;
        }

            $pdf  = PDF::loadView('vadmin.'. $view .'.exportList', compact ($varname));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('exportado.pdf');
	}


    public function exportExcel($model, $filename)
    {
        Excel::create($filename, function($excel) use($model){

            $excel->sheet('Listado', function($sheet) use($model){              
                
                $data    = $this->getExportModel($model);
                $name    = $data[0];
                $results = $data[1];
                $sheet->loadView('vadmin.'.$name.'.exportList')->with($name, $results);
            });

        })->export('xls');
    }


    public function getExportModel($model){
        switch($model){
            case 'Flete':
                $name = 'fletes';
                $results = Flete::orderBy('name', 'ASC')->get();
            break;
            case 'Zona':
                $name = 'zonas';
                $results = Zona::orderBy('name', 'ASC')->get();
            break;
            
        }         
        $data = array($name, $results);
        return $data;
    }


    // public function exportItemPdf($view, $id, $filename){


    //     $pdf  = PDF::loadView('vadmin.pedidos.export/.$id', compact ($varname));
    //     $pdf->setPaper('A4', 'landscape');
    //     return $pdf->download($filaname);
        
    // }


}

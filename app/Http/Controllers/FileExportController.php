<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use DB;
use Excel;
use App\Pago;

class FileExportController extends Controller
{
    public function importExport()
	{
		return view('importExport');
	}
	public function downloadExcelFromDb($db, $type, $filename)
	{
        switch($db){
            case 'Pago':
                $data = Pago::get()->toArray();
            break;
        }

		return Excel::create($filename, function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}

    public function exportAccount($id)
    {

        // $movimientos = 
        Excel::create('New file', function($excel) {

            $excel->sheet('New sheet', function($sheet) {

                $sheet->loadView('vadmin.clientes.index');

            });

        });
    }

}

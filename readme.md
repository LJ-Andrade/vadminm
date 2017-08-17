# VADMIN Documentación

VADmin es un gestor de contenido para empresas.

## Creación automática de Cruds.
php artisan crud:generate NombreEnPlural --fields="name#string;" --view-path=vadmin --route-group=vadmin


## Traer datos de cliente
User componente


## Funciones Ajax Javascript

Debe estár incluído el componente ajaxscripts.blade.php

**Para traer objeto con data de cliente**

**Pasar Ruta e Id del cliente**

var id    = pasar id;
var route = "{{ url('vadmin/get_client') }}/"+id+"";

getClientData(route).done(function(data){
    var razonsocial = data.client['razonsocial'];
    output.html(razonsocial);
});

## Exportar a Excel

### Exportar tabla de base de datos a Excel

    **Boton:**
    *Parámetros ('vadmin/MODELO/EXTENSION/NOMBRE DE ARCHIVO')*
    
    <a href="{{ URL::to('vadmin/downloadExcel/Pago/xls',str_replace(' ', '-', $client->razonsocial.'('.$fecha.')')) }}"><button class="btnSmall green-back">Descargar Excel</button></a>

    **Ruta**
    Route::get('downloadExcel/{db}/{type}/{filename}', 'FileExportController@downloadExcelFromDb');

    **Método:**
    *Parámetros (Id de Cliente, Extensión, Nombre de Archivo)*
    
    public function exportAccount($id, $type, $filename){
        Excel::create($filename, function($excel) use($id){

            $excel->sheet('Nombre De Hoja', function($sheet) use($id) {              
                $data = array(datos);
                $sheet->loadView('vadmin.seccion.vista')->with('data', $data);
            });

        })->export($type);
    }

### Desarrollado por Leandro Andrade - Studio Vimana - 2017

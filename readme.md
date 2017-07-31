### VADMIN Documentación

VADmin es un gestor de contenido para empresas.

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

## Exportar a Exel

# Exportar base de datos completa a Excel

    **Botton:**
    *Parámetros ('vadmin/RUTA/MODELO/EXTENSION/NOMBRE DE ARCHIVO')*
    
    <td>
        <a href="{{ URL::to('vadmin/downloadExcel/Pago/xls',str_replace(' ', '-', $client->razonsocial.'('.$fecha.')')) }}"><button class="btnSmall green-back">Descargar Excel</button></a>
    </td>

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

## VADMIN Documentación

VADmin es un gestor de contenido para empresas.

## Funciones Ajax Javascript

Debe estár incluído el componente ajaxscripts.blade.php

=====================================
Para traer objeto con data de cliente
-------------------------------------
Pasar Ruta e Id del cliente

var id    = pasar id;
var route = "{{ url('vadmin/get_client') }}/"+id+"";

getClientData(route).done(function(data){
    var razonsocial = data.client['razonsocial'];
    output.html(razonsocial);
});

=====================================


### Desarrollado por Leandro Andrade - Studio Vimana - 2017

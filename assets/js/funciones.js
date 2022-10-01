async function nuevo_cliente(){
    const { value: formValues } = await Swal.fire({
        title: "Nuevo cliente",
        html:
            `<label for="nombre" style="text-align:left;display:block;margin-top: .5rem;margin-bottom: -.5rem;">Nombre</label><input id="nombre" class="swal2-input" value="">` +
            `<label for="apellidos" style="text-align:left;display:block;margin-top: .5rem;margin-bottom: -.5rem;">Apellidos</label><input id="apellidos" class="swal2-input" value="">` +
            `<label for="dato" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">Dato</label><input id="dato" class="swal2-input" value="">` +
            `<label for="dni" style="text-align:left;display:block;margin-top: .5rem;margin-bottom: -.5rem;">DNI/NIF</label><input id="dni" class="swal2-input" value="">` +
            `<label for="telefono" style="text-align:left;display:block;margin-top: .5rem;margin-bottom: -.5rem;">Telefono</label><input id="telefono" class="swal2-input" value="">` +
            `<label for="email" style="text-align:left;display:block;margin-top: .5rem;margin-bottom: -.5rem;">Email</label><input id="email" type="email" class="swal2-input" value="">` +
            `<label for="observaciones_privadas" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">Observaciones privadas (Solo las ves tú)</label><textarea id="observaciones_privadas" class="swal2-textarea"></textarea>`+
                    `<label for="observaciones_publicas" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">Observaciones públicas (Ellos pueden escribir aquí)</label><textarea id="observaciones_publicas" class="swal2-textarea"></textarea>`,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Guardar',
        cancelButtonColor: '#d33',
        preConfirm: () => {
            return [
                document.getElementById('nombre').value,
                document.getElementById('apellidos').value,
                document.getElementById('dato').value,
                document.getElementById('dni').value,
                document.getElementById('telefono').value,
                document.getElementById('email').value,
                document.getElementById('observaciones_privadas').value,
                document.getElementById('observaciones_publicas').value
            ]
        }
    })

    if (formValues) {
        if(formValues[0] != "" || formValues[1] != "" || formValues[2] != "" || 
            formValues[3] != "" || formValues[4] != "" || formValues[5] != "" || formValues[6] != "" || formValues[7] != ""){
                var param = {
                    "nombre" : formValues[0],
                    "apellidos" : formValues[1],
                    "dato" : formValues[2],
                    "dni" : formValues[3],
                    "telefono" : formValues[4],
                    "email" : formValues[5],
                    "observaciones_privadas" : formValues[6],
                    "observaciones_publicas" : formValues[7]
                }
                await $.ajax({
                    data: param,
                    url:  'create/crearCliente.php',
                    type: 'post',
                    beforeSend: function () {
                    },
                    success: function (e) { 
                        if(e == 1){
                            return e; 
                        }else{
                            return e;
                        }
                    },
                    error: function (e) {
                        return e;               
                    }
                });
        }else{
            return "vacio";
        }
    }else{
        return false;
    }
}

async function mostrar_datos(e){
    var cliente = 0;
    $.ajax({
        data: {'identificador' : e},
        url:   'select/getCliente.php',
        type:  'post',
        beforeSend: function () {
        },
        success: async function (response) { 
            cliente = response;
            if(cliente != 0){
              cliente = JSON.parse(cliente);

              const { value: formValues } = await Swal.fire({
                title: "Ver/modificar cliente",
                html:
                    `<label for="nombre" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">Nombre</label><input id="nombre" class="swal2-input" value="${cliente.nombre}">` +
                    `<label for="apellidos" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">Apellidos</label><input id="apellidos" class="swal2-input" value="${cliente.apellidos}">` +
                    `<label for="dato" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">Dato</label><input id="dato" class="swal2-input" value="${cliente.dato}">` +
                    `<label for="dni" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">DNI/NIF</label><input id="dni" class="swal2-input" value="${cliente.dni}">` +
                    `<label for="telefono" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">Telefono</label><input id="telefono" class="swal2-input" value="${cliente.telefono}">` +
                    `<label for="email" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">Email</label><input id="email" type="email" class="swal2-input" value="${cliente.email}">` +
                    `<label for="observaciones_privadas" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">Observaciones privadas (Solo las ves tú)</label><textarea id="observaciones_privadas" class="swal2-textarea">${cliente.observaciones_privadas}</textarea>`+
                    `<label for="observaciones_publicas" style="display:block;margin-top: .5rem;margin-bottom: -.5rem;">Observaciones públicas (Ellos pueden escribir aquí)</label><textarea id="observaciones_publicas" class="swal2-textarea">${cliente.observaciones_publicas}</textarea>`,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Guardar',
                cancelButtonColor: '#d33',
                preConfirm: () => {
                    return [
                        document.getElementById('nombre').value,
                        document.getElementById('apellidos').value,
                        document.getElementById('dato').value,
                        document.getElementById('dni').value,
                        document.getElementById('telefono').value,
                        document.getElementById('email').value,
                        document.getElementById('observaciones_privadas').value,
                        document.getElementById('observaciones_publicas').value
                    ]
                }
              })
              if (formValues) {
                if(cliente.nombre != formValues[0] || cliente.apellidos != formValues[1] || cliente.dato != formValues[2] || cliente.dni != formValues[3]
                  || cliente.telefono != formValues[4] || cliente.email != formValues[5] || cliente.observaciones_privadas != formValues[6] || cliente.observaciones_publicas != formValues[7]){
                  var param = {
                    "nombre" : formValues[0],
                    "apellidos" : formValues[1],
                    "dato" : formValues[2],
                    "dni" : formValues[3],
                    "telefono" : formValues[4],
                    "email" : formValues[5],
                    "observaciones_privadas" : formValues[6],
                    "observaciones_publicas" : formValues[7],
                    "id" : cliente.id
                  }
                  modificar_cliente(param);
                }
              }
            }
        },
        error: function (response) { 
            Swal.fire("Error al guardar los datos")               
        }
    });  
}

function modificar_cliente(cliente){
    $.ajax({
        data: cliente,
        url:  'update/modificarCliente.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) { 
            var datos = JSON.parse(response)
            document.getElementById('na').innerHTML = datos.nombre+" "+datos.apellidos;
            document.getElementById('da').innerHTML = datos.dato;
            document.getElementById('dn').innerHTML = datos.dni;
            document.getElementById('te').innerHTML = datos.telefono;
            document.getElementById('em').innerHTML = datos.email;
            document.getElementById('obpr').innerHTML = datos.observaciones_privadas;
            document.getElementById('obpu').innerHTML = datos.observaciones_publicas;
            Swal.fire("¡Cliente modificado!", '', "success") 
        },
        error: function (response) { 
            Swal.fire("Error al guardar los datos", response, "error")               
        }
    });
}

async function crear_cliente_tabla(){
    await nuevo_cliente().then( res => {
        if(res == undefined){
        Swal.fire("¡Cliente guardado!", '', "success");
        cargar_clientes();
        }else if(res == 'vacio'){
        Swal.fire("¡Rellena los datos!", '', "error");
        }else if(res != false && res != 'vacio' && res != undefined){
        Swal.fire("¡Ops!", 'No podemos procesar la solicitud', "error");          
        }
    })
}

async function getClientes(){
    var clientes;
    await $.ajax({
        data: {},
        url:  'select/getClientes.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) { 
            clientes = response;
        },
        error: function (response) { 
            clientes = "Error "+JSON.stringify(response);
            // Swal.fire("Error al guardar los datos", JSON.stringify(response), "error")               
        }
    });
    return clientes;
}

async function crear_cliente_comunion(){
    var clientes = await getClientes();
    var clientes = JSON.parse(clientes)
    const { value: fruit } = await Swal.fire({
        title: 'Selecciona un cliente de la lista',
        input: 'select',
        inputOptions: clientes,
        inputPlaceholder: 'Selecciona un cliente de la lista',
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
                console.log(value)
                resolve()
            })
        }
    })
    
    if (fruit) {
        Swal.fire(`You selected: ${fruit}`)
    }
}

function ir_a_clientes(){
    location.href = "clientes.php";
}

function ir_a_cliente(e){
    location.href = "cliente.php?id="+e;
}

function ir_a_boda(e){
    location.href = "boda.php?id="+e;
}

function ir_a_bodas(){
    location.href = "bodas.php";
}

function crear_reportaje_tabla(){
    console.log("Nuevo reportaje")
}

function mostrar_comunion(e){
    location.href = "comunion.php?id="+e;
}
function ir_a_comuniones(){
    location.href = "comuniones.php";
}

function borrarImagen(codigo, carpeta, foto){
    var param = {
        "codigo" : codigo,
        "carpeta": carpeta,
        "foto": foto
    }
    $.ajax({
        data: param,
        url:  'delete/borrarImagen.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) { 
            console.log(response)
            $('#'+response).remove()
            Swal.fire("¡Imagen borrada!", '', "success")
        },
        error: function (response) { 
            Swal.fire("Error al guardar los datos", JSON.stringify(response), "error")               
        }
    });
}

function crear_cliente_comunion(){

    let fecha_comunion,fecha_reportaje,fecha_album;

    Swal.fire({
        title: 'Nueva Comunión',
        html: '<label for="fecha_comunion">Fecha de la comunión</label>'+
                '<input class="swal2-input" id="fecha_comunion">'+
                '<label for="fecha_reportaje">Fecha del reportaje</label>'+
                '<input class="swal2-input" id="fecha_reportaje">'+
                '<label for="fecha_album">Fecha del albúm</label>'+
                '<input class="swal2-input" id="fecha_album">'+
                '<label for="dato">Etiqueta o dato diferencial</label>'+
                '<input class="swal2-input" id="dato">'+
                '<label for="nombre_nino">Nombre del niño</label>'+
                '<input class="swal2-input" id="nombre_nino">'+
                '<label for="apellidos">Apellidos</label>'+
                '<input class="swal2-input" id="apellidos">'+
                '<label for="email">Teléfono</label>'+
                '<input class="swal2-input" id="telefono">'+
                '<label for="email">Email</label>'+
                '<input class="swal2-input" id="email">'+
                '<label for="observaciones">Observaciones (Nombre de los padres y más datos)</label>'+
                '<textarea class="swal2-input" id="observaciones"></textarea>',
        showLoaderOnConfirm: true,
        stopKeydownPropagation: false,
        preConfirm: () => {
            var datos = {
                "nombre" : document.getElementById('nombre_nino').value,
                "apellidos" : document.getElementById('apellidos').value,
                "dato" : document.getElementById('dato').value,
                "telefono" : document.getElementById('telefono').value,
                "email" : document.getElementById('email').value,
                "observaciones" : document.getElementById('observaciones').value,
                "fecha_comunion" : document.getElementById('fecha_comunion').value,
                "fecha_reportaje" : document.getElementById('fecha_reportaje').value,
                "fecha_album" : document.getElementById('fecha_album').value
            }
            
            guardar_comunion_y_cliente(datos);
        
        },
        allowOutsideClick: () => !Swal.isLoading(),
        willOpen: () => {
            fecha_comunion = flatpickr(
                Swal.getPopup().querySelector('#fecha_comunion'), 
                {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                    }, 
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                        longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    },
                    },
                }
            ),
            fecha_reportaje = flatpickr(
                Swal.getPopup().querySelector('#fecha_reportaje'), 
                {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    locale: {
                        firstDayOfWeek: 1,
                        weekdays: {
                            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                        }, 
                        months: {
                            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                            longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        },
                    },
                }
            ),
            fecha_album = flatpickr(
            Swal.getPopup().querySelector('#fecha_album'), 
                {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                    }, 
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                        longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    },
                    },
                }
            )
        }
    })
}


function crear_comunion(){

    let fecha_comunion,fecha_reportaje,fecha_album;

    Swal.fire({
        title: 'Nueva Comunión',
        html: '<label for="fecha_comunion">Fecha de la comunión</label>'+
                '<input class="swal2-input" id="fecha_comunion">'+
                '<label for="fecha_reportaje">Fecha del reportaje</label>'+
                '<input class="swal2-input" id="fecha_reportaje">'+
                '<label for="fecha_album">Fecha del albúm</label>'+
                '<input class="swal2-input" id="fecha_album">'+
                '<label for="dato">Etiqueta o dato diferencial</label>'+
                `<input class="swal2-input" id="dato" value="${document.getElementById('da').innerHTML}">`+
                '<label for="observaciones">Observaciones</label>'+
                '<textarea class="swal2-input" id="observaciones"></textarea>',
        showLoaderOnConfirm: true,
        stopKeydownPropagation: false,
        preConfirm: () => {
            var datos = {
                "codigo_cliente" : document.getElementById('codigo_cliente').value,
                "dato" : document.getElementById('dato').value,
                "observaciones" : document.getElementById('observaciones').value,
                "fecha_comunion" : document.getElementById('fecha_comunion').value,
                "fecha_reportaje" : document.getElementById('fecha_reportaje').value,
                "fecha_album" : document.getElementById('fecha_album').value
            }
            if(document.getElementById('fecha_comunion').value == ""){
                Swal.fire("Rellena la fecha de la comunión", "Este campo no puede estar vacio", "error")
            }else{
                guardar_comunion(datos);
            }
        
        },
        allowOutsideClick: () => !Swal.isLoading(),
        willOpen: () => {
            fecha_comunion = flatpickr(
                Swal.getPopup().querySelector('#fecha_comunion'), 
                {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                    }, 
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                        longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    },
                    },
                }
            ),
            fecha_reportaje = flatpickr(
                Swal.getPopup().querySelector('#fecha_reportaje'), 
                {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    locale: {
                        firstDayOfWeek: 1,
                        weekdays: {
                            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                        }, 
                        months: {
                            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                            longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        },
                    },
                }
            ),
            fecha_album = flatpickr(
            Swal.getPopup().querySelector('#fecha_album'), 
                {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                    }, 
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                        longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    },
                    },
                }
            )
        }
    })
}

function guardar_comunion_y_cliente(datos){
    $.ajax({
        type: 'POST',
        url: 'create/crearClienteComunion.php',
        data: datos,
        success : function(response) {
            var res = JSON.parse(response)
            if(res.code == 200){
                mostrar_comunion(res.comunion)
            }else{
                Swal.fire('¡Ha ocurrido un error!', res.txt , 'error')
            }
        },
        error : function() {
            Swal.fire('¡Ha ocurrido un error!', 'Intentalo más tarde ', 'error')
        },
    })

}

function guardar_comunion(datos){
    $.ajax({
        type: 'POST',
        url: 'create/crearComunion.php',
        data: datos,
        success : function(response) {
            var res = JSON.parse(response)
            console.log(res)
            if(res.code == 200){
                mostrar_comunion(res.comunion)
            }else{
                Swal.fire('¡Ha ocurrido un error!', res.txt , 'error')
            }
        },
        error : function() {
            Swal.fire('¡Ha ocurrido un error!', 'Intentalo más tarde ', 'error')
        },
    })

}

function pintarDocumentos(e){
    var params = {
        "codigo" : e
    }
    $.ajax({
        data: params,
        url:   'select/documentos_comunion.php',
        type:  'get',
        beforeSend: function () {
        },
        success: function (response) { 
            document.getElementById('most_doc').innerHTML = response;
        },
        error: function (response) { 
            Swal.fire("¡Ha ocurrido un error!", '', "error");              
        }
    });
}

function borrarDocumentoComunion(a,b,e){
    var params = {
        "codigo" : a,
        "ruta" : b
    }
    Swal.fire({
        title: '¿Seguro que quieres eliminar el documento?',
        text: "No podrás recuperarlo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, ¡bórralo!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                data: params,
                url:   'delete/borrarDocumentoComunion.php',
                type:  'post',
                beforeSend: function () {
                },
                success: function (response) { 
                    console.log("documento " + b + " borrado.")
                    pintarDocumentos(e)
                },
                error: function (response) { 
                    Swal.fire("¡Ha ocurrido un error!", '', "error");              
                }
            });  
        }
      })
}

function mostrarDocumento(e){
    location.href = e;
}

function copiarAlPortapapeles(id_elemento) {
    var aux = document.createElement("input");
    aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
    Swal.fire("Enlace copiado","","success");
}
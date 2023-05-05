// -----------------------------------------------------------------------
// 	Universidad Nacional Autonoma de Honduras (UNAH)
// 		Facultad de Ciencias Economicas
// 	Departamento de Informatica administrativa
//          Analisis, Programacion y Evaluacion de Sistemas
//                     Primer Periodo 2023
// Equipo:
// Gerson David Garcia Calderon ........( gerson.garcia@unah.hn)
// Elsy Yohana Maradiaga Lazo...........( elsy.maradiaga@unah.hn)
// Miguel Alejandro Cardenas Amaya......(mcardenasa@unah.hn)
// Edwin Jahir Juanez Ayala.............(edinjuanez@unah.hn)
// Bayron Alberto Meraz Dubon...........(bayronmeraz@unah.hn)
// Catedratico:
// Lic. Karla Melisa Garcia Pineda 
// ---------------------------------------------------------------------
// Programa:         Modulo de Personas
// Fecha:             23-febrero-2023
// Programador:       Elsy Maradiaga 
// descripcion:      Modulo que registra los datos de las personas(Cliente y Proveedor) 
////MODULO PERSONAS--------ELSY YOHANA MARADIAGA 
let tableRegistros;// para mandar a llamar la tabla de personas
let tableDireccion;
let rowTable = "";
$(document).on('focusin', function (e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});
// esta es la tabla que se muestra en la vista general que se muestra los registros que se han hecho al igual se muestra el pdf, excel entre otros
tableRegistros = $('#tableRegistros').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": " " + base_url + "/Personas/getPersonas",// mandamos a llamar el controlador para mostrar los registros que hay en la base de datos 
        "dataSrc": ""
    },
    "columns": [
        { "data": "COD_PERSONA" },
        { "data": "tbl_tipo_persona" },//se utiliza el INNER JOIN que se mando a llamar en el modelo de la tabla de personas
        { "data": "NOMBRE" },
        { "data": "GENERO" },
        { "data": "FECHA_NACIMIENTO" },
        { "data": "tbl_tipo_identificacion" },//tabla para la iudentificacion
        { "data": "IDENTIFICACION" },
        { "data": "status" },
        { "data": "options" }
    ],
    'dom': 'lBfrtip',
    'buttons': [
        {//extensiones para descargar el documento de todos los registros que estan en la tabla 
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr": "Copiar",
            "className": "btn btn-secondary"
        }, {
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr": "Esportar a Excel",
            "className": "btn btn-success"
        }, {
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr": "Esportar a PDF",
            "className": "btn btn-danger"
        }, {
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr": "Esportar a CSV",
            "className": "btn btn-info"
        }
    ],
    "resonsieve": "true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "desc"]]


});
//Accion para poder guardar los registros 
window.addEventListener('load', function () {
    //mandamos a llamar el formulario de registro de personas
    if (document.querySelector("#formPersonas")) {
        let formPersonas = document.querySelector("#formPersonas");
        formPersonas.onsubmit = function (e) {
            e.preventDefault();
            //aqui evaluamos que todos los campos esten llenos y no vacios
            let strNOMBRE = document.querySelector('#txtNombre').value;
            let intGENERO = document.querySelector('#listgenero').value;
            let intFECHA_NACIMIENTO = document.querySelector('#datefecha').value;
            let intCOD_TIPO_IDENTIFICACION = document.querySelector('#listTipoIdentificacion').value;
            let intIDENTIFICACION = document.querySelector('#txtIdentificacion').value;
            let intCOD_TIPO_PERSONA = document.querySelector('#listTipoPersona').value;
            let intESTADO = document.querySelector('#listStatus').value;
            if (strNOMBRE == '' || intGENERO == '' || intFECHA_NACIMIENTO == ''
                || intCOD_TIPO_IDENTIFICACION == '' || intIDENTIFICACION == '' || intCOD_TIPO_PERSONA == '' || intESTADO == '') {
                swal.fire("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            // Mostrar el spinner de carga
            divLoading.style.display = "flex";

            // Crear una nueva instancia del objeto XMLHttpRequest para enviar una solicitud AJAX
            let request = (window.XMLHttpRequest) ?
                new XMLHttpRequest() :
                new ActiveXObject('Microsoft.XMLHTTP');

            // Especificar la URL a la que se enviará la solicitud AJAX
            let ajaxUrl = base_url + '/Personas/setPersona';

            // Crear un objeto FormData que contendrá los datos del formulario a enviar
            let formData = new FormData(formPersonas);

            // Abrir la solicitud AJAX con el método POST y la URL especificada
            request.open("POST", ajaxUrl, true);

            // Enviar la solicitud AJAX con los datos del formulario
            request.send(formData);

            // Esperar la respuesta de la solicitud AJAX
            request.onreadystatechange = function () {
                // Si la solicitud AJAX ha sido completada y la respuesta tiene un estado exitoso (código 200)
                if (request.readyState == 4 && request.status == 200) {
                    // Parsear la respuesta JSON
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        // Si la respuesta indica éxito, mostrar una alerta de éxito
                        swal.fire("", objData.msg, "success");

                        // Actualizar el valor del campo de ID de la persona con el valor devuelto por el servidor
                        document.querySelector("#idPersona").value = objData.COD_PERSONA;

                        // Si la variable "rowTable" está vacía, significa que se está insertando una nueva fila en la tabla
                        if (rowTable == "") {
                            // Recargar los datos de la tabla con el método "ajax.reload()" del plugin DataTables
                            tableRegistros.api().ajax.reload();
                        } else {
                            // Si la variable "rowTable" no está vacía, significa que se está editando una fila existente en la tabla

                            // Construir el HTML para mostrar el estado de la persona
                            htmlStatus = intESTADO == 1 ?
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';

                            // Construir el HTML para mostrar el género de la persona
                            htmlgenero = intGENERO == 1 ?
                                '<span >FEMENINO</span>' :
                                '<span >MASCULINO</span>';

                            // Actualizar los valores de las celdas de la fila editada con los nuevos valores proporcionados por el servidor
                            rowTable.cells[1].textContent = strNOMBRE;
                            rowTable.cells[2].textContent = htmlgenero;
                            rowTable.cells[3].textContent = intFECHA_NACIMIENTO;
                            rowTable.cells[4].textContent = intCOD_TIPO_IDENTIFICACION;
                            rowTable.cells[5].textContent = intIDENTIFICACION;
                            rowTable.cells[6].textContent = intCOD_TIPO_PERSONA;
                            rowTable.cells[7].innerHTML = htmlStatus;

                            // Limpiar la variable "rowTable" para indicar que ya no se está editando ninguna fila
                            rowTable = "";
                        }
                    } else {
                        // Si la respuesta indica un error, mostrar una alerta de error
                        swal.fire("Error", objData.msg, "error");
                    }
                }

                // Ocultar el spinner de carga
                divLoading.style.display = "none";

                // Retornar falso para evitar el comportamiento predeterminado del botón de enviar formulario
                return false;
            }

        }
    }
    if (document.querySelector("#formDireccion")) {

        let formDireccion = document.querySelector("#formDireccion");
        formDireccion.onsubmit = function (e) {
            e.preventDefault();
            //aqui evaluamos que todos los campos esten llenos y no vacios
            let intCOD_TIPO_DIRECCION = document.querySelector('#listTipoDireccion').value;
            let strCIUDAD = document.querySelector('#txtCiudad').value;
            let strCALLE = document.querySelector('#txtCalle').value;
            let strCASA = document.querySelector('#txtCasa').value;
            let strCOLONIA = document.querySelector('#txtColonia').value;
            let strAVENIDA = document.querySelector('#txtAvenida').value;
            let strDIRECCION1 = document.querySelector('#txtDireccion1').value;
            let strDIRECCION2 = document.querySelector('#txtDireccion2').value;
            let intESTADO = document.querySelector('#listStatus').value;
            if (intCOD_TIPO_DIRECCION == '' || strCIUDAD == '' || strCALLE == '' || strCASA == ''
                || strCOLONIA == '' || strAVENIDA == '' || strDIRECCION1 == ''
                || strDIRECCION2 == '' || intESTADO == '') {
                swal.fire("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            // Mostrar el spinner de carga
            divLoading.style.display = "flex";
            // Crear una nueva instancia del objeto XMLHttpRequest para enviar una solicitud AJAX
            let request = (window.XMLHttpRequest) ?
                new XMLHttpRequest() :
                new ActiveXObject('Microsoft.XMLHTTP');
            // Especificar la URL a la que se enviará la solicitud AJAX
            let ajaxUrl = base_url + '/Personas/setDireccion';
            // Crear un objeto FormData que contendrá los datos del formulario a enviar
            let formData = new FormData(formDireccion);
            // Abrir la solicitud AJAX con el método POST y la URL especificada
            request.open("POST", ajaxUrl, true);

            // Enviar la solicitud AJAX con los datos del formulario
            request.send(formData);
            // Esperar la respuesta de la solicitud AJAX
            request.onreadystatechange = function () {
                // Si la solicitud AJAX ha sido completada y la respuesta tiene un estado exitoso (código 200)
                if (request.readyState == 4 && request.status == 200) {
                    // Parsear la respuesta JSON
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        // Si la respuesta indica éxito, mostrar una alerta de éxito
                        swal.fire("", objData.msg, "success");
                        // Actualizar el valor del campo de ID de la persona con el valor devuelto por el servidor
                        document.querySelector("#idPersona").value = objData.COD_DIRECCION;
                        // Establece el valor del campo "idPersona" en el valor de "COD_DIRECCION" del objeto "objData"

                        let listTipoDireccion = document.getElementById("listTipoDireccion").value;
                        let txtCiudad = document.getElementById("txtCiudad").value;
                        let txtCalle = document.getElementById("txtCalle").value;
                        let txtCasa = document.getElementById("txtCasa").value;
                        let txtColonia = document.getElementById("txtColonia").value;
                        let txtAvenida = document.getElementById("txtAvenida").value;
                        let txtDireccion1 = document.getElementById("txtDireccion1").value;
                        let txtDireccion2 = document.getElementById("txtDireccion2").value;
                        let listStatus = document.getElementById("listStatus").value;
                        // Obtiene los valores de diferentes campos del formulario y los guarda en variables para usarlos posteriormente

                        let name_table = document.getElementById("tablaModal");
                        // Obtiene la tabla con id "tablaModal" y la guarda en la variable "name_table"

                        let row = name_table.insertRow(0 + 1);
                        // Inserta una nueva fila en la tabla "name_table", después de la primera fila (encabezado)

                        let cell1 = row.insertCell(0);
                        let cell2 = row.insertCell(1);
                        let cell3 = row.insertCell(2);
                        let cell4 = row.insertCell(3);
                        let cell5 = row.insertCell(4);
                        let cell6 = row.insertCell(5);
                        let cell7 = row.insertCell(6);
                        let cell8 = row.insertCell(7);
                        let cell9 = row.insertCell(8);
                        let cell10 = row.insertCell(9);
                        let cell11 = row.insertCell(10);
                        // Inserta 11 celdas en la nueva fila insertada anteriormente

                        htmlStatus = intESTADO == 1 ?
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                        htmlTipo = intCOD_TIPO_DIRECCION == 1 ?
                            '<span>CASA</span>' :
                            '<span>TRABAJO</span>';
                        // Crea dos variables que contienen código HTML dependiendo del valor de las variables "intESTADO" e "intCOD_TIPO_DIRECCION"

                        cell1.textContent = objData.COD_DIRECCION;
                        // Establece el valor de la celda 1 en el valor de "COD_DIRECCION" del objeto "objData"

                        cell2.innerHTML = '<p name="listTipoDireccion[]" class="non-margin">' + htmlTipo + '</p>';
                        // Establece el contenido HTML de la celda 2 con el valor de la variable "htmlTipo"

                        cell3.innerHTML = '<p name="txtCiudad[]" class="non-margin">' + txtCiudad + '</p>';
                        // Establece el contenido HTML de la celda 3 con el valor de la variable "txtCiudad"

                        // Las líneas siguientes hacen lo mismo para las celdas 4 a 10, respectivamente

                        cell4.innerHTML = '<p name="txtCalle[]" class="non-margin">' + txtCalle + '</p>';
                        cell5.innerHTML = '<p name="txtCasa[]" class="non-margin">' + txtCasa + '</p>';
                        cell6.innerHTML = '<p name="txtColonia[]" class="non-margin">' + txtColonia + '</p>';
                        cell7.innerHTML = '<p name="txtAvenida[]" class="non-margin">' + txtAvenida + '</p>';
                        cell8.innerHTML = '<p name="txtDireccion1[]" class="non-margin">' + txtDireccion1 + '</p>';
                        cell9.innerHTML = '<p name="txtDireccion2[]" class="non-margin">' + txtDireccion2 + '</p>';
                        cell10.innerHTML = '<p name="listStatus[]" class="non-margin">' + htmlStatus + '</p>';
                        cell11.innerHTML = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' + objData.COD_DIRECCION + ', this.parentNode.parentNode)" title="Eliminar "><i class="far fa-trash-alt"></i></button>';

                    } else {
                        swal.fire("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;

            }
        }
    }

    if (document.querySelector("#formTelefono")) {

        let formTelefono = document.querySelector("#formTelefono");
        formTelefono.onsubmit = function (e) {
            e.preventDefault();
            //aqui evaluamos que todos los campos esten llenos y no vacios
            let intCOD_TIPO_TELEFONO = document.querySelector('#listTipoTelefono').value;
            let intTELEFONO = document.querySelector('#txtTelefono').value;
            let intCODIGO_AREA = document.querySelector('#txtCodigo').value;
            let intESTADO = document.querySelector('#listStatus').value;
            if (intCOD_TIPO_TELEFONO == '' || intTELEFONO == ''
                || intCODIGO_AREA == '' || intESTADO == '') {
                swal.fire("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            divLoading.style.display = "flex";
            // Crear una nueva instancia del objeto XMLHttpRequest para enviar una solicitud AJAX
            let request = (window.XMLHttpRequest) ?
                new XMLHttpRequest() :
                new ActiveXObject('Microsoft.XMLHTTP');
            // Especificar la URL a la que se enviará la solicitud AJAX
            let ajaxUrl = base_url + '/Personas/setTelefono';
            // Crear un objeto FormData que contendrá los datos del formulario a enviar
            let formData = new FormData(formTelefono);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal.fire("", objData.msg, "success");
                        document.querySelector("#idPersona").value = objData.COD_TELEFONO;

                        let listTipoTelefono = document.getElementById("listTipoTelefono").value;
                        let txtTelefono = document.getElementById("txtTelefono").value;
                        let txtCodigo = document.getElementById("txtCodigo").value;
                        let listStatus = document.getElementById("listStatus").value;
                        let name_table = document.getElementById("tablaModalTelefono");

                        let row = name_table.insertRow(0 + 1);
                        let cell1 = row.insertCell(0);
                        let cell3 = row.insertCell(1);
                        let cell4 = row.insertCell(2);
                        let cell5 = row.insertCell(3);
                        let cell6 = row.insertCell(4);
                        let cell7 = row.insertCell(5);
                        let cell8 = row.insertCell(6);
                        htmlStatus = intESTADO == 1 ?
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                        htmlTipo = intCOD_TIPO_TELEFONO == 1 ?
                            '<span>CASA</span>' :
                            '<span>TRABAJO</span>';
                        '<span>PERSONAL</span>';
                        // celda1.textContent = objData.COD_DIRECCION
                        cell1.textContent = objData.COD_TELEFONO;
                        cell3.innerHTML = '<p name="listTipoTelefono[]" class="non-margin">' + htmlTipo + '</p>';
                        cell4.innerHTML = '<p name="txtTelefono[]" class="non-margin">' + txtTelefono + '</p>';
                        cell5.innerHTML = '<p name="txtCodigo[]" class="non-margin">' + txtCodigo + '</p>';
                        cell6.innerHTML = '<p name="listStatus[]" class="non-margin">' + htmlStatus + '</p>';
                        cell7.innerHTML = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' + objData.COD_TELEFONO + ', this.parentNode.parentNode)" title="Eliminar "><i class="far fa-trash-alt"></i></button>';
                        cell8.innerHTML = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(' + objData.COD_TELEFONO + ')" title="Editar"><i class="far fa-edit"></i></button>';

                        ;



                    } else {
                        swal.fire("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;

            }
        }
    }
}, false);
//esta funcion es para el boton de Ver El registro de una persona
function fntViewInfo(idPersona) {

    // Se crea una instancia de XMLHttpRequest para hacer la petición
    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Personas/getPersona/' + idPersona;
    // Se construye la URL para hacer la petición GET al servidor
    request.open("GET", ajaxUrl, true);
    request.send();
    // Función que se ejecutará cada vez que el estado de la petición cambie
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                let objPersona = objData.data;
                let estadoPersona = objPersona.status == 1 ?
                    'Activo' :
                    'Inactivo';
                let GeneroPersona = objPersona.GENERO == 1 ?
                    'Femenino' :
                    'Masculino';
                // Se actualizan los valores de las celdas en la vista de la tabla de personas
                document.querySelector("#celTipoP").textContent = objPersona.tbl_tipo_persona;
                document.querySelector("#celNombre").textContent = objPersona.NOMBRE;
                document.querySelector("#celGenero").textContent = GeneroPersona;
                document.querySelector("#celFecha").textContent = objPersona.FECHA_NACIMIENTO;
                document.querySelector("#celTipoI").textContent = objPersona.tbl_tipo_identificacion;
                document.querySelector("#celIdent").textContent = objPersona.IDENTIFICACION;
                document.querySelector("#celStatus").textContent = estadoPersona;

                // Se muestra el modal que muestra la información de la persona
                $('#modalViewPersona').modal('show');
                let direccionAjaxUrl = base_url + '/Personas/getDireccion/' + idPersona;

                // Crear una solicitud AJAX para obtener los datos de dirección
                let direccionRequest = (window.XMLHttpRequest) ?
                    new XMLHttpRequest() :
                    new ActiveXObject('Microsoft.XMLHTTP');

                direccionRequest.open("GET", direccionAjaxUrl, true);
                direccionRequest.send();

                direccionRequest.onreadystatechange = function () {
                    if (direccionRequest.readyState == 4 && direccionRequest.status == 200) {
                        let objData = JSON.parse(direccionRequest.responseText);
                        if (objData.status) {
                            let direccionData = objData.data;
                            let tableDireccion = document.getElementById('tableDireccion').getElementsByTagName('tbody')[0];

                            // Agregar cada dirección a la tabla
                            // Itera sobre cada objeto en el arreglo direccionData y crea una fila en la tabla por cada objeto.
                            direccionData.forEach(function (direccion) {
                                // Evalúa el valor de la propiedad 'status' de cada objeto y establece el estado de la dirección
                                let estadoDireccion = direccion.status == 1 ?
                                    '<span class="badge badge-success">Activo</span>' :
                                    '<span class="badge badge-danger">Inactivo</span>';
                                // Crea una nueva fila en la tabla y la asigna a la variable 'row'.
                                let row = tableDireccion.insertRow();
                                // Agrega las celdas de la fila con los valores correspondientes del objeto 'direccion'.
                                row.innerHTML = '<td>' + direccion.COD_DIRECCION + '</td>' +
                                    '<td>' + direccion.tbl_personas + '</td>' +
                                    '<td>' + direccion.tbl_tipo_direccion + '</td>' +
                                    '<td>' + direccion.CIUDAD + '</td>' +
                                    '<td>' + direccion.CALLE + '</td>' +
                                    '<td>' + direccion.CASA + '</td>' +
                                    '<td>' + direccion.COLONIA + '</td>' +
                                    '<td>' + direccion.AVENIDA + '</td>' +
                                    '<td>' + direccion.DIRECCION1 + '</td>' +
                                    '<td>' + direccion.DIRECCION2 + '</td>' +
                                    '<td>' + estadoDireccion + '</td>';
                            });
                        } else {
                            swal.fire("Error", objData.msg, "error");
                        }
                    }
                }
                let telefonoAjaxUrl = base_url + '/Personas/getTelefono/' + idPersona; // Reemplaza "getDireccion" con el nombre correcto del método en tu controlador de direcciones

                let telefonoRequest = (window.XMLHttpRequest) ?
                    new XMLHttpRequest() :
                    new ActiveXObject('Microsoft.XMLHTTP');

                telefonoRequest.open("GET", telefonoAjaxUrl, true);
                telefonoRequest.send();
                telefonoRequest.onreadystatechange = function () {
                    if (telefonoRequest.readyState == 4 && telefonoRequest.status == 200) {
                        let objData = JSON.parse(telefonoRequest.responseText);
                        if (objData.status) {

                            let objTelefono = objData.data;
                            let tableTelefono = document.getElementById('tableTelefono').getElementsByTagName('tbody')[0];

                            // Itera sobre cada objeto en el arreglo telefonoData y crea una fila en la tabla por cada objeto.
                            objTelefono.forEach(function (telefono) {
                                let estadoTelefono = telefono.status == 1 ?
                                    '<span class="badge badge-success">Activo</span>' :
                                    '<span class="badge badge-danger">Inactivo</span>';
                                // Crea una nueva fila en la tabla y la asigna a la variable 'row'.
                                let row = tableTelefono.insertRow();
                                // Agrega las celdas de la fila con los valores correspondientes del objeto 'telefono'.
                                row.innerHTML = '<td>' + telefono.COD_TELEFONO + '</td>' +
                                    '<td>' + telefono.tbl_personas + '</td>' +
                                    '<td>' + telefono.tbl_tipo_telefono + '</td>' +
                                    '<td>' + telefono.TELEFONO + '</td>' +
                                    '<td>' + telefono.CODIGO_AREA + '</td>' +
                                    '<td>' + estadoTelefono + '</td>';
                            });
                            $('#modalViewPersona').modal('show');

                        } else {
                            swal.fire("Error", objData.msg, "error");
                        }
                    }

                }



            } else {
                swal.fire("Error", objData.msg, "error");
            }

        }


    }





}
function fntEditInfo(element, idPersona) {
    // Se obtiene la fila de la tabla en la que se hizo clic en el botón "Editar"
    rowTable = element.parentNode.parentNode.parentNode;

    // Se actualiza el título del modal
    document.querySelector('#titleModal').innerHTML = "Actualizar Registro";

    // Se cambia el estilo del encabezado del modal para indicar que se está actualizando un registro
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");

    // Se cambia el texto y el color del botón de acción del formulario
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Guardar";

    // Se crea una solicitud XMLHttpRequest para obtener los datos de la persona que se desea actualizar
    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');

    // Se construye la URL de la solicitud a partir del id de la persona que se desea actualizar
    let ajaxUrl = base_url + '/Personas/getPersona/' + idPersona;

    // Se envía la solicitud GET para obtener los datos de la persona
    request.open("GET", ajaxUrl, true);
    request.send();

    // Se espera a que la solicitud finalice y se reciben los datos de la persona
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                // Se obtienen los datos de la persona y se colocan en los campos del formulario para que se puedan editar
                let objPersona = objData.data;
                document.querySelector("#idPersona").value = objPersona.COD_PERSONA;
                document.querySelector("#listTipoPersona").value = objPersona.COD_TIPO_PERSONA;
                document.querySelector("#txtNombre").value = objPersona.NOMBRE;
                document.querySelector("#listgenero").value = objPersona.GENERO;
                document.querySelector("#datefecha").value = objPersona.FECHA_NACIMIENTO;
                document.querySelector("#listTipoIdentificacion").value = objPersona.COD_TIPO_IDENTIFICACION;
                document.querySelector("#txtIdentificacion").value = objPersona.IDENTIFICACION;
                document.querySelector("#listStatus").value = objPersona.status;

                // Se actualizan los selectores de lista usando Bootstrap Select
                $('#listTipoPersona').selectpicker('render');
                $('#listgenero').selectpicker('render');
                $('#listTipoIdentificacion').selectpicker('render');
                $('#listStatus').selectpicker('render');
                let request = (window.XMLHttpRequest) ?
                    new XMLHttpRequest() :
                    new ActiveXObject('Microsoft.XMLHTTP');
                //  let requestDireccion = new XMLHttpRequest();
                let ajaxUrlDireccion = base_url + '/Personas/getDireccion/' + idPersona;
                request.open('GET', ajaxUrlDireccion, true);
                request.send();
                request.onreadystatechange = function () {

                    // mostrar el botón de editar

                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        //let Direccion = JSON.parse(requestDireccion.responseText);
                        if (objData.status) { // Verifica si la respuesta tiene un estado positivo
                            let tablaModal = document.querySelector("#tablaModal tbody"); // Obtiene la tabla modal del DOM
                            tablaModal.innerHTML = ""; // Limpia el contenido de la tabla
                            for (let direccion of objData.data) { // Recorre los datos de dirección recibidos
                                let tablaModalRow = document.createElement("tr"); // Crea una nueva fila de tabla
                                tablaModalRow.innerHTML = `
                                    <td>${direccion.COD_DIRECCION}</td>
                                    <td>${direccion.COD_TIPO_DIRECCION}</td>
                                    <td>${direccion.CIUDAD}</td>
                                    <td>${direccion.CALLE}</td>
                                    <td>${direccion.CASA}</td>
                                    <td>${direccion.COLONIA}</td>
                                    <td>${direccion.AVENIDA}</td>
                                    <td>${direccion.DIRECCION1}</td>
                                    <td>${direccion.DIRECCION2}</td>
                                    <td>${direccion.status}</td>
                                `; // Crea la estructura de una fila con los datos recibidos
                                tablaModal.appendChild(tablaModalRow); // Agrega la fila a la tabla
                            }
                            $('#modalFormPersonas').modal('show'); // Muestra el modal
                        }
                        


                        let requestTelefono = (window.XMLHttpRequest) ?
                            new XMLHttpRequest() :
                            new ActiveXObject('Microsoft.XMLHTTP');
                        //  let requestDireccion = new XMLHttpRequest();
                        let ajaxUrlTelefono = base_url + '/Personas/getTelefono/' + idPersona;
                        requestTelefono.open('GET', ajaxUrlTelefono, true);
                        requestTelefono.send();
                        requestTelefono.onreadystatechange = function () {

                            // mostrar el botón de editar

                            if (requestTelefono.readyState == 4 && requestTelefono.status == 200) {
                                let objData = JSON.parse(requestTelefono.responseText);
                                //let Direccion = JSON.parse(requestDireccion.responseText);
                                if (objData.status) {
                                    // let objPersona = objData.data;
                                    let tablaModalTelefono = document.querySelector("#tablaModalTelefono tbody");
                                    tablaModalTelefono.innerHTML = "";
                                    for (let telefono of objData.data) {
                                        let tablaModalTelefonoRow = document.createElement("tr");
                                        tablaModalTelefonoRow.innerHTML = `
                                            <td>${telefono.COD_TELEFONO}</td>
                                            <td>${telefono.COD_TIPO_TELEFONO}</td>
                                            <td>${telefono.TELEFONO}</td>
                                            <td>${telefono.CODIGO_AREA}</td>
                                            <td>${telefono.status}</td>
                                        `;
                                        tablaModalTelefono.appendChild(tablaModalTelefonoRow);
                                    }
                                    $('#modalFormPersonas').modal('show');
                                    // Acceder a los datos obtenidos de la persona y la dirección
                                }


                            }
                        }
                    }

                }
            } else {
                swal.fire("Error", objData.msg, "error");
            }
        }
    }
}

function fntDelInfo(idPersona, row) {
    Swal.fire({
        title: 'Eliminar Registro',
        text: '¿Realmente quiere eliminar el Registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No, cancelar!',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Personas/delPersona';
            let strData = 'idPersona=' + idPersona;
            request.open('POST', ajaxUrl, true);
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        Swal.fire({
                            title: 'Eliminar!',
                            text: objData.msg,
                            icon: 'success'
                        });
                        tableRegistros.api().ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Atención!',
                            text: objData.msg,
                            icon: 'error'
                        });
                    }
                }
            }
            if (result.isConfirmed) {
                let requestDireccion = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrlDireccion = base_url + '/Personas/delDireccion';
                let strDataDireccion = 'idPersona=' + idPersona;
                requestDireccion.open('POST', ajaxUrlDireccion, true);
                requestDireccion.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                requestDireccion.send(strDataDireccion);
                requestDireccion.onreadystatechange = function () {
                    if (requestDireccion.readyState == 4 && requestDireccion.status == 200) {
                        let objData = JSON.parse(requestDireccion.responseText);
                        if (objData.status) {
                            Swal.fire({
                                title: 'Eliminado!',
                                text: objData.msg,
                                icon: 'success'
                            });
                            row.parentNode.removeChild(row);
                        } else {
                            Swal.fire({
                                title: 'Atención!',
                                text: objData.msg,
                                icon: 'error'
                            });
                        }
                    }
                }
                let requestTelefono = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrlTelefono = base_url + '/Personas/delTelefono';
                let strDataTelefono = 'idPersona=' + idPersona;
                requestTelefono.open('POST', ajaxUrlTelefono, true);
                requestTelefono.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                requestTelefono.send(strDataTelefono);
                requestTelefono.onreadystatechange = function () {
                    if (requestTelefono.readyState == 4 && requestTelefono.status == 200) {
                        let objData = JSON.parse(requestTelefono.responseText);
                        if (objData.status) {
                            Swal.fire({
                                title: 'Eliminado!',
                                text: objData.msg,
                                icon: 'success'
                            });
                            row.parentNode.removeChild(row);
                        } else {
                            Swal.fire({
                                title: 'Atención!',
                                text: objData.msg,
                                icon: 'error'
                            });
                        }
                    }
                }
            }


        }
    });
}

function openModal() {
    rowTable = "";
    document.querySelector('#idPersona').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    // document.querySelector('#btnAgregarForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Registro";
    document.querySelector("#formPersonas").reset();

    $('#modalFormPersonas').modal('show');

}
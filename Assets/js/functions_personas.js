let tableRegistros;
let tableDireccion;
let rowTable = "";
$(document).on('focusin', function (e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});
tableRegistros = $('#tableRegistros').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": " " + base_url + "/Personas/getPersonas",
        "dataSrc": ""
    },
    "columns": [
        { "data": "COD_PERSONA" },
        { "data": "tbl_tipo_persona" },
        { "data": "NOMBRE" },
        { "data": "GENERO" },
        { "data": "FECHA_NACIMIENTO" },
        { "data": "tbl_tipo_identificacion" },
        { "data": "IDENTIFICACION" },
        { "data": "status" },
        { "data": "options" }
    ],
    'dom': 'lBfrtip',
    'buttons': [
        {
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

window.addEventListener('load', function () {

    if (document.querySelector("#formPersonas")) {
        let formPersonas = document.querySelector("#formPersonas");
        formPersonas.onsubmit = function (e) {
            e.preventDefault();
            let strNOMBRE = document.querySelector('#txtNombre').value;
            let intGENERO = document.querySelector('#listgenero').value;
            let intFECHA_NACIMIENTO = document.querySelector('#datefecha').value;
            let intCOD_TIPO_IDENTIFICACION = document.querySelector('#listTipoIdentificacion').value;
            let intIDENTIFICACION = document.querySelector('#txtIdentificacion').value;
            let intCOD_TIPO_PERSONA = document.querySelector('#listTipoPersona').value;
            let intESTADO = document.querySelector('#listStatus').value;
            if (strNOMBRE == '' || intGENERO == '' || intFECHA_NACIMIENTO == ''
                || intCOD_TIPO_IDENTIFICACION == '' || intIDENTIFICACION == '' || intCOD_TIPO_PERSONA == ''  || intESTADO == '') {
                swal.fire("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ?
                new XMLHttpRequest() :
                new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Personas/setPersona';
            let formData = new FormData(formPersonas);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal.fire("", objData.msg, "success");
                        document.querySelector("#idPersona").value = objData.COD_PERSONA;

                        if (rowTable == "") {
                            tableRegistros.api().ajax.reload();
                        } else {
                            htmlStatus = intESTADO == 1 ?
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                            htmlgenero = intGENERO == 1 ?
                                '<span >FEMENINO</span>' :
                                '<span >MASCULINO</span>';
                            rowTable.cells[1].textContent = strNOMBRE;
                            rowTable.cells[2].textContent = htmlgenero;
                            rowTable.cells[3].textContent = intFECHA_NACIMIENTO;
                            rowTable.cells[4].textContent = intCOD_TIPO_IDENTIFICACION;
                            rowTable.cells[5].textContent = intIDENTIFICACION;
                            rowTable.cells[6].textContent = intCOD_TIPO_PERSONA;
                            rowTable.cells[7].innerHTML = htmlStatus;
                            rowTable = "";

                        }
                    } else {
                        swal.fire("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;

            }
        }
    }
    if (document.querySelector("#formDireccion")) {

        let formDireccion = document.querySelector("#formDireccion");
        formDireccion.onsubmit = function (e) {
            e.preventDefault();
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
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ?
                new XMLHttpRequest() :
                new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Personas/setDireccion';
            let formData = new FormData(formDireccion);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal.fire("", objData.msg, "success");
                        document.querySelector("#idPersona").value = objData.COD_DIRECCION;

                        let listTipoDireccion = document.getElementById("listTipoDireccion").value;
                        let txtCiudad = document.getElementById("txtCiudad").value;
                        let txtCalle = document.getElementById("txtCalle").value;
                        let txtCasa = document.getElementById("txtCasa").value;
                        let txtColonia = document.getElementById("txtColonia").value;
                        let txtAvenida = document.getElementById("txtAvenida").value;
                        let txtDireccion1 = document.getElementById("txtDireccion1").value;
                        let txtDireccion2 = document.getElementById("txtDireccion2").value;
                        let listStatus = document.getElementById("listStatus").value;
                        let name_table = document.getElementById("tablaModal");

                        let row = name_table.insertRow(0 + 1);
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
                  
                        htmlStatus = intESTADO == 1 ?
                            '<span class="badge badge-success">Activo</span>' :
                            '<span class="badge badge-danger">Inactivo</span>';
                        htmlTipo = intCOD_TIPO_DIRECCION == 1 ?
                            '<span>CASA</span>' :
                            '<span>TRABAJO</span>';
                        // celda1.textContent = objData.COD_DIRECCION
                        cell1.textContent = objData.COD_DIRECCION;
                        cell2.innerHTML = '<p name="listTipoDireccion[]" class="non-margin">' + htmlTipo + '</p>';
                        cell3.innerHTML = '<p name="txtCiudad[]" class="non-margin">' + txtCiudad + '</p>';
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
            let request = (window.XMLHttpRequest) ?
                new XMLHttpRequest() :
                new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Personas/setTelefono';
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
function fntViewInfo(idPersona) {
    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Personas/getPersona/' + idPersona;

    request.open("GET", ajaxUrl, true);
    request.send();
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
                    document.querySelector("#celTipoP").textContent = objPersona.tbl_tipo_persona;
                    document.querySelector("#celNombre").textContent = objPersona.NOMBRE;
                    document.querySelector("#celGenero").textContent = GeneroPersona;
                    document.querySelector("#celFecha").textContent = objPersona.FECHA_NACIMIENTO;
                    document.querySelector("#celTipoI").textContent = objPersona.tbl_tipo_identificacion;
                    document.querySelector("#celIdent").textContent = objPersona.IDENTIFICACION;
                    document.querySelector("#celStatus").textContent = estadoPersona;
                    

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
                      direccionData.forEach(function(direccion) {
                        let estadoDireccion = direccion.status == 1 ?
                          '<span class="badge badge-success">Activo</span>' :
                          '<span class="badge badge-danger">Inactivo</span>';
              
                        let row = tableDireccion.insertRow();
              
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
                    
                            // Agregar cada dirección a la tabla
                            objTelefono.forEach(function(telefono) {
                              let estadoTelefono = telefono.status == 1 ?
                                '<span class="badge badge-success">Activo</span>' :
                                '<span class="badge badge-danger">Inactivo</span>';
                    
                              let row = tableTelefono.insertRow();
                    
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
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Registro";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Guardar";

    let request = (window.XMLHttpRequest) ?
        new XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Personas/getPersona/' + idPersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {

                let objPersona = objData.data;
                document.querySelector("#idPersona").value = objPersona.COD_PERSONA;
                document.querySelector("#listTipoPersona").value = objPersona.COD_TIPO_PERSONA;
                document.querySelector("#txtNombre").value = objPersona.NOMBRE;
                document.querySelector("#listgenero").value = objPersona.GENERO;
                document.querySelector("#datefecha").value = objPersona.FECHA_NACIMIENTO;
                document.querySelector("#listTipoIdentificacion").value = objPersona.COD_TIPO_IDENTIFICACION;
                document.querySelector("#txtIdentificacion").value = objPersona.IDENTIFICACION;
                document.querySelector("#listStatus").value = objPersona.status;
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
                        if (objData.status) {
                            let tablaModal = document.querySelector("#tablaModal tbody");
                            tablaModal.innerHTML = "";
                            for (let direccion of objData.data) {
                                let tablaModalRow = document.createElement("tr");
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
                                `;
                                tablaModal.appendChild(tablaModalRow);
                            }
                            $('#modalFormPersonas').modal('show');
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
function fntDelInfoDireccion(idPersona) {
    swal({
        title: "¿Está seguro?",
        text: "Una vez eliminada, no podrá recuperar esta dirección",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            let request = (window.XMLHttpRequest) ?
                new XMLHttpRequest() :
                new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Personas/delDireccion/' + idPersona;
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("", objData.msg, "success");
                        // Elimina la fila de la tabla
                        let tableRow = document.getElementById("direccion-" + idPersona);
                        tableRow.parentNode.removeChild(tableRow);
                    } else {
                        Swal.fire("Error", objData.msg, "error");
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
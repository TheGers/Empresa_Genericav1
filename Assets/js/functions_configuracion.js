let tableConfiguracion;
let rowTable = "";

// ---------------------------------- PARA ABRIR EL MODAL ---------------------------------

function openModal() {
    rowTable = "";
    document.querySelector('#idConfiguracion').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "MANTENIMIENTO DE CAI";
    document.querySelector("#formConfiguracion").reset();
    $('#modalFormConfiguracion').modal('show');
}


//    ----------------------------------- BOTONES Y DECLARACION DE COLUMNAS -----------------------------------

tableConfiguracion = $('#tableConfiguracion').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": " " + base_url + "/Configuracion/getConfiguracions",
        "dataSrc": ""
    },

    "columns": [
        { "data": "COD_REGIMEN" },
        { "data": "FECHA_INICIO" },
        { "data": "FECHA_LIMITE" },
        { "data": "RANGO_DESDE" },
        { "data": "RANGO_HASTA" },
        { "data": "CAI" },
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


//    ----------------------------------- PARA AGREGAR - BUENO-----------------------------------
//NUEVA CAI
let formConfiguracion = document.querySelector("#formConfiguracion");
formConfiguracion.onsubmit = function (e) {
    e.preventDefault();
    let intFECHA_INICIO = document.querySelector('#txtFechainicio').value;
    let intFECHA_LIMITE = document.querySelector('#txtFechaLimite').value;
    let strRANGO_DESDE = document.querySelector('#txtRangodesde').value;
    let strRANGO_HASTA = document.querySelector('#txtRangohasta').value;
    let strCAI = document.querySelector('#txtCai').value;
    let intStatus = document.querySelector('#listStatus').value;
    if (intFECHA_INICIO == '' || intFECHA_LIMITE == '' || strRANGO_DESDE == '' || strRANGO_HASTA == '' || strCAI == '' || intStatus == '') {
        Swal.fire({
            title: 'Atención',
            text: 'Todos los campos son obligatorios.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false;
    }
    divLoading.style.display = "flex";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Configuracion/setConfiguracion';
    let formData = new FormData(formConfiguracion);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                if (rowTable == "") {
                    tableConfiguracion.api().ajax.reload();
                } else {
                    htmlStatus = intStatus == 1 ?
                        '<span class="badge badge-success">Activo</span>' :
                        '<span class="badge badge-danger">Inactivo</span>';
                    rowTable.cells[1].textContent = intFECHA_INICIO;
                    rowTable.cells[2].textContent = intFECHA_LIMITE;
                    rowTable.cells[3].textContent = strRANGO_DESDE;
                    rowTable.cells[4].textContent = strRANGO_HASTA;
                    rowTable.cells[5].textContent = strCAI;
                    rowTable.cells[6].innerHTML = htmlStatus;
                    rowTable = "";
                }
                $('#modalFormConfiguracion').modal("hide");
                    formConfiguracion.reset();
            } else {
                Swal.fire({
                    title: 'Error',
                    text: objData.msg,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }
        divLoading.style.display = "none";
        return false;
    }
}

// ---------------------------------- PARA EDITAR  ---------------------------------

function fntEditInfo(element, idConfiguracion) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    var idConfiguracion = idConfiguracion;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Configuracion/getConfiguracion/' + idConfiguracion;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idConfiguracion").value = objData.data.idConfiguracion;
                document.querySelector("#txtFechainicio").value = objData.data.FECHA_INICIO;
                document.querySelector("#txtFechaLimite").value = objData.data.FECHA_LIMITE;
                document.querySelector("#txtCai").value = objData.data.CAI;
                document.querySelector("#txtRangodesde").value = objData.data.RANGO_DESDE;
                document.querySelector("#txtRangohasta").value = objData.data.RANGO_HASTA;

                if (objData.data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
                $('#modalFormConfiguracion').modal('show');
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo salió mal',
                  })
            }
        }
    }
}

// ---------------------------------- PARA ELIMINAR  ---------------------------------

function fntDelInfo(idConfiguracion) {
    var idConfiguracion = idConfiguracion;
    Swal.fire({
        title: "Eliminar CAI",
        text: "¿Realmente quiere eliminarlo?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar!",
        cancelButtonText: "No, cancelar!",
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Configuracion/delConfiguracion';
            var strData = "idConfiguracion=" + idConfiguracion;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        Swal.fire({
                            title: "Eliminar!",
                            text: objData.msg,
                            icon: "success",
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                tableConfiguracion.api().ajax.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Atención!",
                            text: objData.msg,
                            icon: "error",
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        });
                    }
                }
            }
        }
    });
}

document.write(`<script src="${base_url}/Assets/js/plugins/JsBarcode.all.min.js"></script>`); // script de mandado a llamar de la funcion agregada para el apartado del codigo de barras

let tableProductos; //variable global para la funcion de retorno de la vista html 
let rowTable = "";

$(document).on('focusin', function (e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});
tableProductos = $('#tableProductos').dataTable({//funcion de mostrar la tabla de productos en la interfaz
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": " " + base_url + "/Productos/getProductos",
        "dataSrc": ""
    },
    "columns": [
        { "data": "COD_PRODUCTO" },
        { "data": "BARCODIGO" },
        { "data": "NOMBRE_PRODUCTO" },
        { "data": "tbl_categoria" },  //variables a mostrar en la tabla 
        { "data": "DESCRIPCION" },
        { "data": "PRECIO" },
        { "data": "PrecioVenta" },
        { "data": "EXISTENCIA" },
        { "data": "status" },
        { "data": "options" }
    ],
    "columnDefs": [
        { 'className': "textcenter", "targets": [3] },
        { 'className': "textright", "targets": [4] },
        { 'className': "textcenter", "targets": [5] }
    ],
    'dom': 'lBfrtip',
    'buttons': [
        {
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr": "Copiar",
            "className": "btn btn-secondary",
            "exportOptions": {
                "columns": [0, 1, 2, 3, 4, 5, 6]
            }
        }, {
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",   //funciones de exportacion de archivos de las tablas
            "titleAttr": "Esportar a Excel",
            "className": "btn btn-success",
            "exportOptions": {
                "columns": [0, 1, 2, 3, 4, 5, 6]
            }
        }, {
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr": "Esportar a PDF",
            "className": "btn btn-danger",
            "exportOptions": {
                "columns": [0, 1, 2, 3, 4, 5, 6]
            }
        }, {
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr": "Esportar a CSV",
            "className": "btn btn-info",
            "exportOptions": {
                "columns": [0, 1, 2, 3, 4, 5, 6]
            }
        }
    ],
    "resonsieve": "true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "desc"]]
});
window.addEventListener('load', function () {  //funcion de creacion de un nuevo producto

    if (document.querySelector("#formProductos")) {
        let formProductos = document.querySelector("#formProductos"); //llamado de la id del formulario
        formProductos.onsubmit = function (e) {
            e.preventDefault();
            let strNOMBRE_PRODUCTO = document.querySelector('#txtNombre').value;
            let strBarcodigo = document.querySelector('#txtBARCODIGO').value;
            let strDESCRIPCION = document.querySelector('#txtDescripcion').value;  //equivalencia de formulario con variables para su manipulacion
            let intPRECIO = document.querySelector('#txtPrecio').value;
            let intCOD_CATEGORIA = document.querySelector('#listCategoria').value;
            let intPRECIOVENTA = document.querySelector('#txtPrecioVenta').value;
            let intEXISTENCIA = document.querySelector('#txtStock').value;
            let intESTADO = document.querySelector('#listStatus').value;
            if (strNOMBRE_PRODUCTO == '' || strDESCRIPCION == '' || intPRECIO == ''|| intPRECIOVENTA=='' || intEXISTENCIA == '' || intESTADO == '' || strBarcodigo=="") {
                swal.fire("Atención", "Todos los campos son obligatorios.", "error"); // validacion de variables tengan datos incorporados para proceder con la inserccion
                return false;
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ?
                new XMLHttpRequest() :
                new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Productos/setProducto'; // mandado a llamar del controlador 
            let formData = new FormData(formProductos);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if(request.readyState == 4 && request.status == 200){ 
                    let objData = JSON.parse(request.responseText);//mandado a llamar por medio de json todos los datos
                    if(objData.status)
                    {
                        swal.fire("", objData.msg ,"success");
                        document.querySelector("#idProducto").value = objData.COD_PRODUCTO;

                        if(rowTable == ""){
                            tableProductos.api().ajax.reload();
                        }else{
                           htmlStatus = intESTADO == 1 ? 
                            '<span class="badge badge-success">Activo</span>' : 
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = strBarcodigo;
                            rowTable.cells[2].textContent = strNOMBRE_PRODUCTO;
                            rowTable.cells[3].textContent = intCOD_CATEGORIA;
                            rowTable.cells[4].textContent = strDESCRIPCION;
                            rowTable.cells[5].textContent = intPRECIO; //conteo de variables 
                            rowTable.cells[6].textContent = intPRECIOVENTA;
                            rowTable.cells[7].textContent = intEXISTENCIA;
                            rowTable.cells[8].innerHTML =  htmlStatus;
                            rowTable = ""; 
                        }
                    }else{
                        swal.fire("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;

            }
        }
    }
    fntCategorias();
}, false);
function fntViewInfo(idProducto){ //funcion de mostrar por id 
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/getProducto/'+idProducto; //mandado a llamar por parametro lo que es el controlador
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
              
                let objProducto = objData.data;
                let estadoProducto = objProducto.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celNombre").innerHTML = objProducto.NOMBRE_PRODUCTO;
                document.querySelector("#txtBARCODIGO").innerHTML = objProducto.BARCODIGO;
                document.querySelector("#celCategoria").innerHTML = objProducto.tbl_categoria; //funcion de asignacion de espacio a los datos para luego mostrarlos
                document.querySelector("#celDescripcion").innerHTML = objProducto.DESCRIPCION;
                document.querySelector("#celPrecio").innerHTML = objProducto.PRECIO;
                document.querySelector("#celPrecioVenta").innerHTML = objProducto.PrecioVenta;
                document.querySelector("#celStock").innerHTML = objProducto.EXISTENCIA;
                document.querySelector("#celStatus").innerHTML = estadoProducto;
                $('#modalViewProducto').modal('show'); //retorno del formulario de modal

            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    } 
}


function fntEditInfo(element,idProducto){//funcion de editar prudcto
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar Producto"; //cambio de nombre del modasl
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="GUARDAR"; //boton de guardar cambios de productos
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/getProducto/'+idProducto; //mandado a llamar el controlador para el editar producto
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                
                let objProducto = objData.data;
                document.querySelector("#idProducto").value = objProducto.COD_PRODUCTO;
                document.querySelector("#txtNombre").value = objProducto.NOMBRE_PRODUCTO;
                document.querySelector("#txtBARCODIGO").value = objProducto.BARCODIGO;
                document.querySelector("#listCategoria").value = objProducto.COD_CATEGORIA;
                document.querySelector("#txtDescripcion").value = objProducto.DESCRIPCION; //variables del formulario html del modal a variable normal para manipulacion
                document.querySelector("#txtPrecio").value = objProducto.PRECIO;
                document.querySelector("#txtPrecioVenta").value = objProducto.PrecioVenta;
                document.querySelector("#txtStock").value = objProducto.EXISTENCIA;
                document.querySelector("#listStatus").value = objProducto.status;
                $('#listCategoria').selectpicker('render');
                $('#listStatus').selectpicker('render');
              

                    
                $('#modalFormProductos').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}
function fntDelInfo(idProducto){ //funcion de eliminar producto
    Swal.fire({
        title: "Eliminar Producto",
        text: "¿Realmente quiere eliminar el producto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Productos/delProducto'; //mandado a llamar el controlador 
            let strData = "idProducto="+idProducto;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        Swal.fire({
                            title: "Eliminar!",
                            text: objData.msg,
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: "Aceptar",
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if(result.isConfirmed){
                                tableProductos.api().ajax.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            title: "Atención!",
                            text: objData.msg,
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonText: "Aceptar",
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        });
                    }
                }
            }
        }
    });
}

function fntCategorias() { //funcion de deteccion de categoria para el producto
    if (document.querySelector('#listCategoria')) {
        let ajaxUrl = base_url + '/Categorias/getSelectCategorias'; //mandado a llamar el controlador 
        let request = (window.XMLHttpRequest) ?
            new XMLHttpRequest() :
            new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listCategoria').innerHTML = request.responseText;
                $('#listCategoria').selectpicker('render'); ///formulario de la seccion de categoria
            }
        }
    }
}


if(document.querySelector("#txtBARCODIGO")){ //funcion de codigo de barras
    let inputCodigo = document.querySelector("#txtBARCODIGO");
    inputCodigo.onkeyup = function() {
        if(inputCodigo.value.length >= 5){
            document.querySelector('#divBarCode').classList.remove("notblock");
            fntBarcode();
       }else{
            document.querySelector('#divBarCode').classList.add("notblock");
       }
    };
}

tinymce.init({
	selector: '#txtDescripcion', //funcion para descripcion 
	width: "100%",
    height: 400,    
    statubar: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});

function fntBarcode(){ //funcion de asignacion de variable del html
    let codigo = document.querySelector("#txtBARCODIGO").value;
    JsBarcode("#barcode", codigo);
}

function fntPrintBarcode(area){ //funcion de impresion del codigo de barras
    let elemntArea = document.querySelector(area);
    let vprint = window.open(' ', 'popimpr', 'height=400,width=600');
    vprint.document.write(elemntArea.innerHTML );
    vprint.document.close();
    vprint.print();
    vprint.close();
}


function openModal() { //funcion de mandado a llamar el modal de creacion de productos
    rowTable = "";
    document.querySelector('#idProducto').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Producto";
    document.querySelector("#formProductos").reset();

    $('#modalFormProductos').modal('show');

}
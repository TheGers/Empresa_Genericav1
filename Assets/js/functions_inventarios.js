let tableinventario;
let rowTable = "";




//    ----------------------------------- BOTONES Y DECLARACION DE COLUMNAS -----------------------------------

tableinventario = $('#tableinventario').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax": {
        "url": " " + base_url + "/Inventarios/getInventario",
        "dataSrc": ""
    },

    "columns": [
        { "data": "COD_INVENTARIO" },
        { "data": "accion" },
        { "data": "Nom_factura" },
        { "data": "ISV" },
        { "data": "TOTAL" },
        { "data": "CREADO_POR" },
        { "data": "FECHA_CREACION" },
        { "data": "status" },
      

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

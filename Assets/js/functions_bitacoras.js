let tableBitacoras;
let rowTable = "";

tableBitacoras = $('#tableBitacoras').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"/Bitacoras/getBitacoras", //mandado a llamar el controlador 
        "dataSrc":""
    },
    
    "columns":[
        {"data":"id"},
            {"data":"accion"},
            {"data":"vista"},
            {"data":"campo"},
            {"data":"dato_anterior"},
            {"data":"nuevo_dato"},
            {"data":"FECHA_CREACION"},
            {"data":"CREADO_POR"}, //varibles a mostrar en el data table
            {"data":"MODIFICADO_POR"},
            {"data":"FECHA_MODIFICADO"},
            {"data":"status"},
           
    ],
    
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]  
});








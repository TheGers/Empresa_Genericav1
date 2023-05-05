let tablePregunta;
let rowTable = "";
 document.addEventListener('DOMContentLoaded', function(){
    tablePregunta = $('#tablePregunta').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Preguntas/getPreguntas", //mandado a llamar el controlador
            "dataSrc": ""
        },
    
        "columns": [
            { "data": "COD_PRREGUNTA" },
            { "data": "COD_USUARIO" },
            { "data": "PREGUNTA" }, //variables mostrar en data tables
            { "data": "status" },
            { "data": "options" },
    
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
                "text": "<i class='fas fa-file-excel'></i> Excel", //funciones de exportaciones de datos
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
    


      //NUEVO Pregunta
      var formPregunta = document.querySelector("#formPregunta"); //formulario de inseccion de preguntas
      formPregunta.onsubmit = function(e) {
          e.preventDefault();
          var listUsuario = document.querySelector('#listUsuario').value;
          var strPregunta = document.querySelector('#txtPregunta').value;
          var strRespuesta = document.querySelector('#txtRespuesta').value;    
          var intStatus = document.querySelector('#listStatus').value;         //variables a ser insertardas 
          if(listUsuario == '' || strPregunta == '' || strRespuesta == '' || intStatus == '')
          {
              swal.fire("Atención", "Todos los campos son obligatorios." , "error");
              return false;
          }
          divLoading.style.display = "flex";
          var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          var ajaxUrl = base_url+'/Preguntas/setPregunta'; //mandado a llamar el controlador
          var formData = new FormData(formPregunta);
          request.open("POST",ajaxUrl,true);
          request.send(formData);
          request.onreadystatechange = function(){
             if(request.readyState == 4 && request.status == 200){
                  
                  var objData = JSON.parse(request.responseText);//envio de datos por medio de json
                  if(objData.status)
                  {
                      $('#modalFormPregunta').modal("hide");
                      formPregunta.reset();
                      swal.fire("Pregunta agregada", objData.msg ,"success");
                      tablePregunta.api().ajax.reload();
                  }else{
                      swal.fire("Error", objData.msg , "error");
                  }              
              } 
              divLoading.style.display = "none";
              return false;
          }
  
          
      }

 });

 function fntEditInfo(element,COD_PRREGUNTA ){//funcion de editar la pregunta 
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar Pregunta";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";//modificacion del modal para la interfaz acorde a actualizar 
    var COD_PRREGUNTA =COD_PRREGUNTA;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Preguntas/getPregunta/'+COD_PRREGUNTA ;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#idPregunta").value = objData.data.COD_PRREGUNTA ;
                document.querySelector("#listUsuario").value = objData.data.COD_USUARIO; //equivalencias de datos a editar
                document.querySelector("#txtPregunta").value = objData.data.PREGUNTA;
                document.querySelector('#txtRespuesta').value = objData.data.RESPUESTA;
           

                if(objData.data.status == 1)
                {
                    var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                }else{
                    var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                }
                var htmlSelect = `${optionSelect}
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                `;
                document.querySelector("#listStatus").innerHTML = htmlSelect;
               

                $('#modalFormPregunta').modal('show');

            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}

function fntDelInfo(idPregunta) {
    var idPregunta = idPregunta;
    Swal.fire({ //funcion de eliminar las preguntas  de recuperacion
        title: 'Eliminar Pregunta',
        text: '¿Realmente quiere eliminar la Pregunta?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar!',
        cancelButtonText: 'No, cancelar!'
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Preguntas/delPregunta/'; //mandado a llamar el controlador
            var strData = "idPregunta="+idPregunta;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        Swal.fire(
                            'Eliminar!',
                            objData.msg,
                            'success'
                        );
                        tableRoles.api().ajax.reload(function(){
                            fntEditInfo();
                            fntDelInfo();
                            
                        });
                    }else{
                        Swal.fire(
                            'Atención!',
                            objData.msg,
                            'error'
                        );
                    }
                }
            }
        }
    });
}



//    ----------------------------------- BOTONES Y DECLARACION DE COLUMNAS -----------------------------------


function openModal(){ //funcion de modal para manipulacion de datos

    document.querySelector('#idPregunta').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Pregunta";
    document.querySelector("#formPregunta").reset();
	$('#modalFormPregunta').modal('show');
}






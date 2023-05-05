const formulario = document.querySelector('#formulario');

/* document.addEventListener('DOMContentLoaded', function () {


var formularioEmpresa = document.querySelector('#formulario');
formularioEmpresa.onsubmit = function(e){
    e.preventDefault();

    var intID = document.querySelector('#id').value;
        var strRTN = document.querySelector('#rtn').value;
        var strNombre = document.querySelector('#nombre').value;
        var strDescripcion = document.querySelector('#descripcion').value;        
        var strtelefono = document.querySelector('#telefono').value;   
        var strcorreo = document.querySelector('#correo').value;   
        var strDireccion = document.querySelector('#correo').value;   
        var mensaje = document.querySelector('#mensaje').value;   
        if(strNombre == '' || strDescripcion == '' || intStatus == ''  || strRTN == ''  || strtelefono == ''  || strcorreo == '' || strDireccion == ''  || mensaje == '' )
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Empresas/setEmpresas'; 
        var formData = new FormData(formRol);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#formularioEmpresa').modal("hide");
                    formRol.reset();
                    swal.fire(" Datos de la Empresa", objData.msg ,"success");
                    tableEmpresa.api().ajax.reload();
                }else{
                    swal.fire("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }


}



        

    



});
$('#tableEmpresa').DataTable();
 */


document.addEventListener("DOMContentLoaded", function() {
    let formulario = document.getElementById("#formulario");
    if (formulario) {
      myForm.onsubmit = function() {
        e.preventDefault();

    var intID = document.querySelector('#id').value;
        var strRTN = document.querySelector('#rtn').value;
        var strNombre = document.querySelector('#nombre').value;
        var strDescripcion = document.querySelector('#descripcion').value;        
        var strtelefono = document.querySelector('#telefono').value;   
        var strcorreo = document.querySelector('#correo').value;   
        var strDireccion = document.querySelector('#correo').value;   
        var mensaje = document.querySelector('#mensaje').value;   
        if(strNombre == '' || strDescripcion == '' || intStatus == ''  || strRTN == ''  || strtelefono == ''  || strcorreo == '' || strDireccion == ''  || mensaje == '' )
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Empresas/setEmpresas'; 
        var formData = new FormData(formRol);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#formularioEmpresa').modal("hide");
                    formRol.reset();
                    swal.fire(" Datos de la Empresa", objData.msg ,"success");
                    tableEmpresa.api().ajax.reload();
                }else{
                    swal.fire("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }

      };
    } else {
      console.error("Element not found");
    }
  });
  
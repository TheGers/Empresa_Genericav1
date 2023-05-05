$('.date-picker').datepicker({
    // Establece el texto para el botón de cerrar.
    closeText: 'Cerrar',
    // Establece el texto para el botón de mes anterior.
    prevText: '<Ant',
    // Establece el texto para el botón de mes siguiente.
    nextText: 'Sig>',
    // Establece el texto para el botón de "hoy".
    currentText: 'Hoy',
    // Establece los nombres de los meses.
    monthNames: ['1 -', '2 -', '3 -', '4 -', '5 -', '6 -', '7 -', '8 -', '9 -', '10 -', '11 -', '12 -'],
    // Establece los nombres cortos de los meses.
    monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    // Permite al usuario cambiar el mes.
    changeMonth: true,
    // Permite al usuario cambiar el año.
    changeYear: true,
    // Muestra un panel de botones para seleccionar mes y año.
    showButtonPanel: true,
    // Establece el formato de la fecha.
    dateFormat: 'dd-MM yy',
    // Oculta los días de la semana.
    showDays: false,
    // Función que se llama cuando se cierra el calendario.
    onClose: function (dateText, inst) {
        // Establece la fecha seleccionada en el primer día del mes.
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
    }
});
//funcion para buscar por el mes las ventas que tuvo la empresa
function fntSearchVMes() {
    let fecha = document.querySelector(".ventasMes").value;
    if (fecha == "") {
        swal("", "Seleccione mes y año", "error");
        return false;
    } else {
        let request = (window.XMLHttpRequest) ?
            new XMLHttpRequest() :
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Dashboard/ventasMes';
        divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('fecha', fecha);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                $("#graficaMes").html(request.responseText);
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}
//funcion para buscar por el año las ventas que tuvo la empresa
function fntSearchVAnio() {
    let anio = document.querySelector(".ventasAnio").value;
    if (anio == "") {
        swal.fire("", "Ingrese año ", "error");
        return false;
    } else {
        let request = (window.XMLHttpRequest) ?
            new XMLHttpRequest() :
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/Dashboard/ventasAnio';
        divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('anio', anio);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
                $("#graficaAnio").html(request.responseText);
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}
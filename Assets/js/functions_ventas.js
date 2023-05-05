let tableVentas;
let rowTable = "";
$(document).on("focusin", function (e) {
  if ($(e.target).closest(".tox-dialog").length) {
    e.stopImmediatePropagation();
  }
});

tableVentas = $("#tableVentas").DataTable({
  aProcessing: true,
  aServerSide: true,
  language: {
    url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
  },
  ajax: {
    url: " " + base_url + "/Ventas/getVentas",
    dataSrc: "",
  },
  columns: [
    { data: "COD_VENTA" },
    { data: "FECHA_CREACION" },
    { data: "tbl_personas" },
    { data: "NUMERO_FACTURA" },
    { data: "TOTAL" },
    { data: "status" },
    { data: "options" },
  ],
  dom: "lBfrtip",
  buttons: [
    {
      extend: "copyHtml5",
      text: "<i class='far fa-copy'></i> Copiar",
      titleAttr: "Copiar",
      className: "btn btn-secondary",
    },
    {
      extend: "excelHtml5",
      text: "<i class='fas fa-file-excel'></i> Excel",
      titleAttr: "Esportar a Excel",
      className: "btn btn-success",
    },
    {
      extend: "pdfHtml5",
      text: "<i class='fas fa-file-pdf'></i> PDF",
      titleAttr: "Esportar a PDF",
      className: "btn btn-danger",
    },
    {
      extend: "csvHtml5",
      text: "<i class='fas fa-file-csv'></i> CSV",
      titleAttr: "Esportar a CSV",
      className: "btn btn-info",
    },
  ],
  resonsieve: "true",
  bDestroy: true,
  iDisplayLength: 12,
  order: [[0, "desc"]],
});

// -------------------------------------------------CAPTURACION - JAHIR----------------------------------------------------

const inputBuscarCodigo = document.querySelector("#buscarProductoCodigo");
const inputBuscarNombre = document.querySelector("#buscarProductoNombre");
const barcode = document.querySelector("#barcode");
const nombre = document.querySelector("#nombre");
const containerCodigo = document.querySelector("#containerCodigo");
const containerNombre = document.querySelector("#containerNombre");

const tblNuevaVenta = document.querySelector("#tblNuevaVenta tbody");
const totalPagar = document.querySelector("#totalPagar");
const ISV = document.querySelector("#ISV");
const serie = document.querySelector("#serie");

const telefonoCliente = document.querySelector("#telefonoCliente");
const direccionCliente = document.querySelector("#clienteDireccion");
const errorCliente = document.querySelector("#errorCliente");
const idCliente = document.querySelector("#idCliente");
const btnAccion = document.querySelector("#btnAccion");

let listaCarrito;

document.addEventListener("DOMContentLoaded", function () {
  // ----Comprobar Productos en localStorage----
  if (localStorage.getItem("posVenta") != null) {
    listaCarrito = JSON.parse(localStorage.getItem("posVenta"));
  }
  // ----MOSTRAR INPUT PARA BUSQUEDA POR NOMBRE----
  nombre.addEventListener("click", function () {
    containerCodigo.classList.add("d-none");
    containerNombre.classList.remove("d-none");
  });
  // ----MOSTRAR INPUT PARA BUSQUEDA POR CODIGO----
  barcode.addEventListener("click", function () {
    containerNombre.classList.add("d-none");
    containerCodigo.classList.remove("d-none");
  });
  inputBuscarCodigo.addEventListener("keyup", function (e) {
    if (e.keyCode === 13) {
      buscarProducto(e.target.value);
    }
    return;
  });
  $("#buscarCliente").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: base_url + "/Personas/buscarCliente/",
        dataType: "json",
        data: {
          term: request.term,
        },
        success: function (data) {
          response(data);
          if (data.length > 0) {
            errorCliente.textContent = "";
          } else {
            errorCliente.textContent = "NO HAY CLIENTE CON ESE NOMBRE";
          }
        },
      });
    },
    minLength: 2,
    select: function (event, ui) {
      telefonoCliente.value = ui.item.TELEFONO;
      direccionCliente.innerHTML = ui.item.DIRECCION1;
      idCliente.value = ui.item.COD_PERSONA;
      serie.focus();
    },
  });
  // -------------------------------------------------AUTO COMPLETAR PRODUCTO - JAHIR-------------------------------------------
  $("#buscarProductoNombre").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: base_url + "/productos/buscarPorNombre/",
        dataType: "json",
        data: {
          term: request.term,
        },
        success: function (data) {
          response(data);
        },
      });
    },
    minLength: 2,
    select: function (event, ui) {
      console.log(ui.item);
      agregarProducto(ui.item.COD_PRODUCTO, 1);
      inputBuscarNombre.value = "";
      inputBuscarNombre.focus();
      return false;
    },
  });

  // ---- CARGAR DATOS ----
  mostrarProducto();

  //Completar venta
  btnAccion.addEventListener("click", function () {
    const filas = document.querySelectorAll("#tblNuevaVenta tr").length;

    if (filas < 2) {
      alertaPersonalizada("warning", "CARRITO VACIO");
      return;
    } else if (idCliente.value == "" && telefonoCliente.value == "") {
      alertaPersonalizada("warning", "EL CLIENTE ES REQUERIDO");
      return;
    } else if (serie.value == "") {
      alertaPersonalizada("warning", "EL NUMERO DE FACTURA ES REQUERIDO");
      return;
    } else {
      const url = base_url + "/ventas/registraVenta/";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(
        JSON.stringify({
          productos: listaCarrito,
          idCliente: idCliente.value,
          serie: serie.value,
        })
      );
      //Verificar Datos
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          console.log(this.responseText);
          alertaPersonalizada(res.type, res.msg);
          if (res.type == 'success') {
            localStorage.removeItem('posVenta');
            setTimeout(() => {
              Swal.fire({
                title: 'Desea generar reporte?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ticked',
                denyButtonText: `Factura`,
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  const ruta = base_url + '/ventas/reporte/ticked/' + res.COD_VENTA;
                  window.open(ruta, '_blank');
                } else if (result.isDenied) {
                  const ruta = base_url + '/ventas/reporte/factura/' + res.COD_VENTA;
                  window.open(ruta, '_blank');
                }
                window.location.reload();
              })
            }, 2000);
          }
        }
      };
    }
  });
});

// ---------------------------------------BUSCAR PRODUCTO POR MEDIO DE CODIGO (COD_PRODUCTO) - JAHIR------------------------------------------

function buscarProducto(valor) {
  const url = base_url + "/productos/buscarPorCodigo/" + valor;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      console.log(this.responseText);
      agregarProducto(res.COD_PRODUCTO, 1);
      inputBuscarCodigo.value = "";
      inputBuscarCodigo.focus();
    }
  };
}

// ------------------------------------------LISTAR PROVEEDORES EN EL SELECTOR DE COMPRAS-------------------------------------------

function fntPersonas() {
  if (document.querySelector("#listCliente")) {
    let ajaxUrl = base_url + "/Personas/getSelectPersonas";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listCliente").innerHTML =
          request.responseText;
        $("#listCliente").selectpicker("render");
      }
    };
  }
}

// ----------------------------------------------AGREGAR PRODUCTOS A LocalStorage - JAHIR----------------------------------------------

function agregarProducto(COD_PRODUCTO, EXISTENCIA) {
  if (localStorage.getItem("posVenta") == null) {
    listaCarrito = [];
  } else {
    for (let i = 0; i < listaCarrito.length; i++) {
      if (listaCarrito[i]["COD_PRODUCTO"] == COD_PRODUCTO) {
        listaCarrito[i]["EXISTENCIA"] = parseInt(
          listaCarrito[i]["EXISTENCIA"] + 1
        );
        localStorage.setItem("posVenta", JSON.stringify(listaCarrito));
        alertaPersonalizada("success", "PRODUCTO AGREGADO");
        mostrarProducto();
        return;
      }
    }
  }
  listaCarrito.push({
    COD_PRODUCTO: COD_PRODUCTO,
    EXISTENCIA: EXISTENCIA,
  });
  localStorage.setItem("posVenta", JSON.stringify(listaCarrito));
  alertaPersonalizada("success", "PRODUCTO AGREGADO");
  mostrarProducto();
}

// ------------------------------------ALERTA PERSONALIZADA DE AGREGAR PRODUCTOS - JAHIR--------------------------

function alertaPersonalizada(type, msg) {
  Swal.fire({
    toast: true,
    position: "top-right",
    icon: type,
    title: msg,
    showConfirmButton: false,
    timer: 2000,
  });
}

// ------------------------------------CARGAR PRODUCTOS - JAHIR----------------------------------

function mostrarProducto() {
  if (localStorage.getItem("posVenta") != null) {
    const url = base_url + "/Productos/mostrarDatosVentas/";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(JSON.stringify(listaCarrito));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        let html = "";
        if (res.productos.length > 0) {
          res.productos.forEach((producto) => {
            html += `<tr>
                               <td width="200"><p align="center">${producto.BARCODIGO}</p></td>
                              <td>${producto.NOMBRE_PRODUCTO}</td>
                              <td>${producto.PrecioVenta}</td>
                              <td width="100"> 
                              <input type="number" class="form-control inputCantidad" data-id="${producto.COD_PRODUCTO}" value="${producto.EXISTENCIA}" placeholder="Cantidad">
                              </td>
                              <td>${producto.subTotal}</td>
                              <td><button class="btn btn-danger btnEliminar" data-id="${producto.COD_PRODUCTO}" type="button"><i class="fas fa-trash"></i></button></td>
                          </tr>`;
          });
          tblNuevaVenta.innerHTML = html;
          totalPagar.value = res.total;
          ISV.value = res.isv;
          btneliminarProducto();
          agregarCantidad();
        } else {
          tblNuevaVenta.innerHTML = "";
        }
      }
    };
  } else {
    tblNuevaVenta.innerHTML = `<tr>
          <td colspan="4" class="text-center">CARRITO VACIO</td>
      </tr>`;
  }
}

// ------------------------------------BTN ELIMINAR PRODUCTO - JAHIR------------------------------------------
function btneliminarProducto() {
  let lista = document.querySelectorAll(".btnEliminar");
  for (let i = 0; i < lista.length; i++) {
    lista[i].addEventListener("click", function () {
      let idProducto = lista[i].getAttribute("data-id");
      console.log(idProducto);
      eliminarProducto(idProducto);
    });
  }
}

// ------------------------------------ELIMINAR PRODUCTO - JAHIR------------------------------------------

function eliminarProducto(idProducto) {
  for (let i = 0; i < listaCarrito.length; i++) {
    if (listaCarrito[i]["COD_PRODUCTO"] == idProducto) {
      listaCarrito.splice(i, 1);
    }
  }
  localStorage.setItem("posVenta", JSON.stringify(listaCarrito));
  alertaPersonalizada("success", "PRODUCTO ELIMINADO");
  mostrarProducto();
}

//------------------------------------agregar evento change para cambiar la cantidad-------------------------

function agregarCantidad() {
  let lista = document.querySelectorAll(".inputCantidad");
  for (let i = 0; i < lista.length; i++) {
    lista[i].addEventListener("change", function () {
      let COD_PRODUCTO = lista[i].getAttribute("data-id");
      let EXISTENCIA = lista[i].value;
      cambiarCantidad(COD_PRODUCTO, EXISTENCIA);
    });
  }
}

//------------------------------------agregar evento change para cambiar la cantidad-------------------------

function cambiarCantidad(COD_PRODUCTO, EXISTENCIA) {
  for (let i = 0; i < listaCarrito.length; i++) {
    if (listaCarrito[i]["COD_PRODUCTO"] == COD_PRODUCTO) {
      listaCarrito[i]["EXISTENCIA"] = EXISTENCIA;
    }
  }
  localStorage.setItem("posVenta", JSON.stringify(listaCarrito));
  mostrarProducto();
}

//------------------------------------VER REPORTE DE LA COMPRA-------------------------

function verReporte(COD_VENTA) {
  Swal.fire({
    title: 'Dsesea generar reporte?',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: 'Ticked',
    denyButtonText: `Factura`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      const ruta = base_url + '/ventas/reporte/ticked/' + COD_VENTA;
      window.open(ruta, '_blank');
    } else if (result.isDenied) {
      const ruta = base_url + '/ventas/reporte/factura/' + COD_VENTA;
      window.open(ruta, '_blank');
    }

  })
}

//------------------------------------ANULAR LA VENTA-------------------------

function anularVenta(COD_VENTA) {
  // Preguntar al usuario si desea anular la venta
  Swal.fire({
    title: "Esta seguro de anular la venta?",
    text: "La existencia de los productos sufrira una rebaja!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Anular!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "/ventas/anular/" + COD_VENTA;
      //hacer una instancia del objeto XMLHttpRequest
      const http = new XMLHttpRequest();
      //Abrir una Conexion - POST - DELETE
      http.open("DELETE", url, true);
      //Enviar Datos
      http.send();
      //verificar estados
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertaPersonalizada(res.type, res.msg);
          if (res.type == "success") {
            tableVentas.ajax.reload();
          }
        }
      }
    }
  })
}
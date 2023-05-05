// -------------------------------------------------CAPTURACION - JAHIR----------------------------------------------------

const inputBuscarCodigo = document.querySelector("#buscarProductoCodigo");
const inputBuscarNombre = document.querySelector("#buscarProductoNombre");
const barcode = document.querySelector("#barcode");
const nombre = document.querySelector("#nombre");
const containerCodigo = document.querySelector("#containerCodigo");
const containerNombre = document.querySelector("#containerNombre");

const tblNuevaCompra = document.querySelector("#tblNuevaCompra tbody");
const totalPagar = document.querySelector("#totalPagar");
const ISV = document.querySelector("#ISV");
const serie = document.querySelector("#serie");
const cai = document.querySelector("#cai");

const telefonoProveedor = document.querySelector("#telefonoProveedor");
const direccionProveedor = document.querySelector("#proveedorDireccion");
const errorProveedor = document.querySelector("#errorProveedor");
const idProveedor = document.querySelector("#idProveedor");
const btnAccion = document.querySelector("#btnAccion");


let rowTable = "";
let listaCarrito, tableCompras ;


document.addEventListener("DOMContentLoaded", function () {
  // ----Comprobar Productos en localStorage----
  if (localStorage.getItem("posCompra") != null) {
    listaCarrito = JSON.parse(localStorage.getItem("posCompra"));
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
  $("#buscarProveedor").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: base_url + "/Personas/buscarPorNombre/",
        dataType: "json",
        data: {
          term: request.term,
        },
        success: function (data) {
          response(data);
          if (data.length > 0) {
            errorProveedor.textContent = "";
          } else {
            errorProveedor.textContent = "NO HAY PROVEEDOR CON ESE NOMBRE";
          }
        },
      });
    },
    minLength: 2,
    select: function (event, ui) {
      telefonoProveedor.value = ui.item.TELEFONO;
      direccionProveedor.innerHTML = ui.item.DIRECCION1;
      idProveedor.value = ui.item.COD_PERSONA;
      serie.focus();
    },
  });
  //mostrar historial de compras
  //cargar datos con el plugin datatables
  $(document).on("focusin", function (e) {
    if ($(e.target).closest(".tox-dialog").length) {
      e.stopImmediatePropagation();
    }
  });
  tableCompras = $('#tableCompras').DataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "/Compras/getCompras",
      dataSrc: "",
    },
    columns: [
      { data: "COD_COMPRA" },
      { data: "FECHA_CREACION" },
      { data: "tbl_personas" },
      { data: "CAI" },
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
    responsive: true,
    bDestroy: true,
    iDisplayLength: 12,
    order: [[0, "desc"]],
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

  //Completar compra
  btnAccion.addEventListener("click", function () {
    const filas = document.querySelectorAll("#tblNuevaCompra tr").length;

    if (filas < 2) {
      alertaPersonalizada("warning", "CARRITO VACIO");
      return;
    } else if (idProveedor.value == "" && telefonoProveedor.value == "") {
      alertaPersonalizada("warning", "EL PROVEEDOR ES REQUERIDO");
      return;
    } else if (serie.value == "") {
      alertaPersonalizada("warning", "EL NUMERO DE FACTURA ES REQUERIDO");
      return;
    }else if (cai.value == "") {
        alertaPersonalizada("warning", "EL CAI DE LA FACTURA ES REQUERIDO");
        return;
    } else {
      const url = base_url + "/compras/registraCompra/";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(
        JSON.stringify({
          productos: listaCarrito,
          idProveedor: idProveedor.value,
          serie: serie.value,
          cai: cai.value,
        })
      );
      //Verificar Datos
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          console.log(this.responseText);
          alertaPersonalizada(res.type, res.msg);
          localStorage.removeItem("posCompra");
          setTimeout(function() {
          window.location.reload();
        }, 2000);
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
  if (document.querySelector("#listProveedor")) {
    let ajaxUrl = base_url + "/Personas/getSelectPersonas";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listProveedor").innerHTML =
          request.responseText;
        $("#listProveedor").selectpicker("render");
      }
    };
  }
}

// ----------------------------------------------AGREGAR PRODUCTOS A LocalStorage - JAHIR----------------------------------------------

function agregarProducto(COD_PRODUCTO, EXISTENCIA) {
  if (localStorage.getItem("posCompra") == null) {
    listaCarrito = [];
  } else {
    for (let i = 0; i < listaCarrito.length; i++) {
      if (listaCarrito[i]["COD_PRODUCTO"] == COD_PRODUCTO) {
        listaCarrito[i]["EXISTENCIA"] = parseInt(
          listaCarrito[i]["EXISTENCIA"] + 1
        );
        localStorage.setItem("posCompra", JSON.stringify(listaCarrito));
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
  localStorage.setItem("posCompra", JSON.stringify(listaCarrito));
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
  if (localStorage.getItem("posCompra") != null) {
    const url = base_url + "/productos/mostrarDatos/";
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
                            <td width="200"><p align="right">${producto.PRECIO}</p></td>
                            <td width="100"> 
                            <input type="number" class="form-control inputCantidad" data-id="${producto.COD_PRODUCTO}" value="${producto.EXISTENCIA}" placeholder="Cantidad">
                            </td>
                            <td><p align="right">${producto.subTotal}</p></td>
                            <td><button class="btn btn-danger btnEliminar" data-id="${producto.COD_PRODUCTO}" type="button"><i class="fas fa-trash"></i></button></td>
                        </tr>`;
          });
          tblNuevaCompra.innerHTML = html;
          totalPagar.value = res.total;
          ISV.value = res.isv; 

          btneliminarProducto();
          agregarCantidad();
        } else {
          tblNuevaCompra.innerHTML = "";
        }
      }
    };
  } else {
    tblNuevaCompra.innerHTML = `<tr>
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
  localStorage.setItem("posCompra", JSON.stringify(listaCarrito));
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
  localStorage.setItem("posCompra", JSON.stringify(listaCarrito));
  mostrarProducto();
}

function verReporte(COD_COMPRA) {
  Swal.fire({
    title: "Desea generar el comprobante?",
    showCancelButton: true,
    confirmButtonText: "Comprobante Compra",
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      const ruta = base_url + "/compras/reporte/factura/" + COD_COMPRA;
      window.open(ruta, "_blank");
    }   
  });
}

function anularCompra(COD_COMPRA) {
  // Preguntar al usuario si desea anular la compra
  Swal.fire({
    title: "Esta seguro de anular la compra?",
    text: "La existencia de los productos sufrira una rebaja!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Anular!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "/compras/anular/" + COD_COMPRA;
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
            tableCompras.ajax.reload();
          }
        }
      }
    }
  })
}

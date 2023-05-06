// -----------------------------------------------------------------------
// 	Universidad Nacional Autonoma de Honduras (UNAH)
// 		Facultad de Ciencias Economicas
// 	Departamento de Informatica administrativa
//          Analisis, Programacion y Evaluacion de Sistemas
//                     Primer Periodo 2023
// Equipo:
// Gerson David Garcia Calderon ........( gerson.garcia@unah.hn)
// Elsy Yohana Maradiaga Lazo...........( elsy.maradiaga@unah.hn)
// Miguel Alejandro Cardenas Amaya......(mcardenasa@unah.hn)
// Edwin Jahir Juanez Ayala.............(edinjuanez@unah.hn)
// Bayron Alberto Meraz Dubon...........(bayronmeraz@unah.hn)
// Catedratico:
// Lic. Karla Melisa Garcia Pineda 
// ---------------------------------------------------------------------
// Programa:         Modulo de Login
// Fecha:             23-febrero-2023
// Programador:       Elsy Maradiaga Y Gerson Garcia
// descripcion:      Modulo para iniciar sesion y recuperar contraseña


// Selector del botón que activa la animación de "flip"
$('.login-content [data-toggle="flip"]').click(function () {
	// Selecciona la caja de login y cambia su clase para activar la animación de "flip"
	$('.login-box').toggleClass('flipped');
	// Retorna "false" para evitar que la página se recargue al hacer clic en el botón
	return false;
	});
//seccion que se utiliza para ingresar al sistema mediante login
var divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function () {
	// Verificar si existe un elemento con el ID "formLogin"
	if (document.querySelector("#formLogin")) {
		// Obtener el elemento con el ID "formLogin" y asignarlo a la variable formLogin
		let formLogin = document.querySelector("#formLogin");
		// Asignar una función al evento de envío del formulario
		formLogin.onsubmit = function (e) {
			// Prevenir el comportamiento predeterminado del evento de envío del formulario
			e.preventDefault();

			    // Obtener los valores de los elementos de entrada con los IDs "txtUsername" y "txtPassword" y asignarlos a las variables strUsername y strPassword, respectivamente
				let strUsername = document.querySelector('#txtUsername').value;
				let strPassword = document.querySelector('#txtPassword').value;
			
				// Verificar si strUsername y strPassword están vacíos
				if (strUsername == "" || strPassword == "") {
					// Mostrar un mensaje de error utilizando la librería SweetAlert y prevenir el envío del formulario
					swal.fire("Por favor", "Escribe un usuario y una contraseña.", "error");
					return false;
				} else {
					// Mostrar un elemento con el ID "divLoading"
					divLoading.style.display = "flex";
					// Crear un objeto XMLHttpRequest y asignarlo a la variable request
					var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
					// Definir la URL de la solicitud utilizando la variable base_url y el controlador "loginUser"
					var ajaxUrl = base_url+'/Login/loginUser'; 
					// Crear un objeto FormData y asignarlo a la variable formData, utilizando el formulario formLogin como parámetro
					var formData = new FormData(formLogin);
					// Abrir una solicitud POST a ajaxUrl de manera asíncrona utilizando la variable request, y enviar formData como datos
					request.open("POST", ajaxUrl, true);
					request.send(formData);
					// Asignar una función al evento onreadystatechange de la variable request
					request.onreadystatechange = function() {
						// Si readyState no es 4 (solicitud completada), salir de la función
						if (request.readyState != 4) return;
						// Si el código de estado es 200 (éxito)
						if (request.status == 200) {
							// Convertir la respuesta de la solicitud a un objeto JSON y asignarlo a la variable objData
							var objData = JSON.parse(request.responseText);
							// Si la propiedad status de objData es verdadera
							if (objData.status) {
								// Redirigir a la página de dashboard utilizando la variable base_url
								window.location = base_url+'/dashboard';
							} else {
								// Mostrar un mensaje de error utilizando la librería SweetAlert y vaciar el valor de txtPassword
								swal("Atención", objData.msg, "error");
								document.querySelector('#txtPassword').value = "";
							}
						} else {
							// Mostrar un mensaje de error utilizando la librería SweetAlert
							swal.fire("Atención", "Error en el proceso", "error");
						}
						// Ocultar el elemento con el ID "divLoading" y prevenir el envío del formulario
						divLoading.style.display = "none";
						return false;
					}
				}
			}
			
	}
	//formato para el envio de recuperacion por correo
	if (document.querySelector("#formRecetPass")) {
		//Seleccionar el formulario y asignarlo a una variable
		let formRecetPass = document.querySelector("#formRecetPass");
		//Asignar evento de submit al formulario
		formRecetPass.onsubmit = function (e) {
		e.preventDefault();
					//Obtener el valor del input de email
		let strEmail = document.querySelector('#txtEmailReset').value;
		//Validar si el input está vacío
		if (strEmail == "") {
			swal.fire("Por favor", "Escribe tu correo electrónico.", "error");
			return false;
		} else {
			//Crear una instancia de XMLHttpRequest
			var request = (window.XMLHttpRequest) ?
				new XMLHttpRequest() :
				new ActiveXObject('Microsoft.XMLHTTP');
			//Definir la URL a la que se enviarán los datos
			var ajaxUrl = base_url + '/Login/resetPass';
			//Crear un objeto FormData con los datos del formulario
			var formData = new FormData(formRecetPass);
			//Abrir una conexión POST asincrónica hacia la URL definida anteriormente
			request.open("POST", ajaxUrl, true);
			//Enviar los datos del formulario en la solicitud
			request.send(formData);
			//Definir la función que se ejecutará cuando cambie el estado de la solicitud
			request.onreadystatechange = function () {
				//Si el estado no es 4, la solicitud no se ha completado todavía
				if (request.readyState != 4) return;
				//Si el estado es 200, la solicitud se ha completado correctamente
				if (request.status == 200) {
					//Analizar la respuesta JSON recibida del servidor
					var objData = JSON.parse(request.responseText);
					//Si la respuesta indica que se reseteó la contraseña correctamente
					if (objData.status) {
						//Mostrar un mensaje de éxito y redirigir al usuario a la página de inicio de sesión
						swal.fire({
							title: "",
							text: objData.msg,
							type: "success",
							confirmButtonText: "Aceptar",
							closeOnConfirm: false,
						}, function (isConfirm) {
							if (isConfirm) {
								window.location = base_url;
							}
						});
					} else {
						//Mostrar un mensaje de error si no se pudo resetear la contraseña
						swal.fire("Atención", objData.msg, "error");
					}
				} else {
					//Mostrar un mensaje de error si ocurrió un error durante el proceso
					swal.fire("Atención", "Error en el proceso", "error");
				}
				return false;
			}
		}
	}
}

	//seccion que restablece la contraseña anterior y pone una nueva 
	if (document.querySelector("#formCambiarPass")) {
		// Buscar y asignar el formulario de cambiar contraseña a la variable formCambiarPass
		let formCambiarPass = document.querySelector("#formCambiarPass");
		// Añadir un evento de envío al formulario
		formCambiarPass.onsubmit = function (e) {
		e.preventDefault();

					// Obtener los valores de la nueva contraseña, confirmación de contraseña e id de usuario
		let strPassword = document.querySelector('#txtPassword').value;
		let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
		let idUsuario = document.querySelector('#idUsuario').value;

		// Validar que se haya ingresado una nueva contraseña y una confirmación de contraseña
		if (strPassword == "" || strPasswordConfirm == "") {
			swal.fire("Por favor", "Escribe la nueva contraseña.", "error");
			return false;
		} else {
			// Validar que la nueva contraseña tenga al menos 5 caracteres
			if (strPassword.length < 5) {
				swal.fire("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "info");
				return false;
			}
			// Validar que la nueva contraseña y la confirmación de contraseña sean iguales
			if (strPassword != strPasswordConfirm) {
				swal.fire("Atención", "Las contraseñas no son iguales.", "error");
				return false;
			}

			// Crear una nueva solicitud de Ajax
			var request = (window.XMLHttpRequest) ?
				new XMLHttpRequest() :
				new ActiveXObject('Microsoft.XMLHTTP');
			// Asignar la URL de la solicitud de Ajax
			var ajaxUrl = base_url + '/Login/setPassword';
			// Crear un objeto FormData y asignar el formulario a él
			var formData = new FormData(formCambiarPass);
			// Abrir la solicitud de Ajax y enviar los datos del formulario
			request.open("POST", ajaxUrl, true);
			request.send(formData);
			// Escuchar el evento de cambio de estado de la solicitud de Ajax
			request.onreadystatechange = function () {
				// Validar que la solicitud de Ajax haya finalizado correctamente
				if (request.readyState != 4) return;
				// Validar que la respuesta de la solicitud de Ajax tenga un estado 200 (OK)
				if (request.status == 200) {
					// Convertir la respuesta en un objeto JSON
					var objData = JSON.parse(request.responseText);
					// Validar que el estado del objeto JSON sea verdadero
					if (objData.status) {
						// Mostrar una alerta de éxito y redirigir al usuario al inicio de sesión
						swal.fire({
							title: "",
							text: objData.msg,
							type: "success",
							confirmButtonText: "Iniciar sessión",
							closeOnConfirm: false,
						}, function (isConfirm) {
							if (isConfirm) {
								window.location = base_url + '/login';
							}
						});
					} else {
						// Mostrar una alerta de error con el mensaje del objeto JSON
						swal.fire("Atención", objData.msg, "error");
					}
				}
				// En caso de que la solicitud de Ajax haya fallado, mostrar una alerta de error
				else {
					swal.fire("Atención", "Error en el proceso", "error");
				}

			}
		}
	}
}


}, false);


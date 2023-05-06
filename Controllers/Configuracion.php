<?php
/* -----------------------------------------------------------------------
Universidad Nacional Autonoma de Honduras (UNAH)
	Facultad de Ciencias Economicas
Departamento de Informatica administrativa
	 Analisis, Programacion y Evaluacion de Sistemas
				Primer Periodo 2023


Equipo:
Gerson David Garcia Calderon ........( gerson.garcia@unah.hn)
Elsy Yohana Maradiaga Lazo...........( elsy.maradiaga@unah.hn)
Miguel Alejandro Cardenas Amaya......(mcardenasa@unah.hn)
Edwin Jahir Juanez Ayala.............(edinjuanez@unah.hn)
Bayron Alberto Meraz Dubon...........(bayronmeraz@unah.hn)



Catedratico:
Lic. Karla Melisa Garcia Pineda 

--------------------------------------------------------------------- */
/* -----------------------------------------------------------------------
---------------------------------------------------------------------

Programa:        Configuracion
Fecha:             23-febrero-2023
Programador:       Edwin Juanez
descripcion:      Registro para el cai de la empresa

-----------------------------------------------------------------------
--------------------------------------------------------------------- */
class Configuracion extends Controllers
{

	// -----------------------hola----------- CREADO POR EDWIN JUANEZ -------------HOLA--------------------
	// ---------------------------------- CONSTRUCTOR ---------------------------------

	public function __construct()
	{
		parent::__construct();
		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
		}
		getPermisos(20);
	}

	// ---------------------------------- CARGAR LA VISTA ---------------------------------

	public function Configuracion()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Configuracion";
		$data['page_title'] = "Configuracion";
		$data['page_name'] = "configuracion";
		$data['page_functions_js'] = "functions_configuracion.js";
		$this->views->getView($this, "configuracion", $data);
	}

	// ---------------------------------- MUESTRA LOS DATOS DE LA BASE DE DATOS ---------------------------------

	public function getConfiguracions()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectConfiguracions();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}


				
				if ($_SESSION['permisosMod']['u']) {
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['COD_REGIMEN'] . ')" title="Editar categoría"><i class="fas fa-pencil-alt"></i></button>';
				}
				if ($_SESSION['permisosMod']['d']) {
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['COD_REGIMEN'] . ')" title="Eliminar categoría"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	// ---------------------------------- ACTUALIZA E INSERTA DATOS EN LA TABLA ---------------------------------

	public function setConfiguracion()
	{
		if ($_POST) {
			if (empty($_POST['txtFechainicio']) || empty($_POST['txtFechaLimite']) || empty($_POST['txtCai']) || empty($_POST['txtRangodesde']) || empty($_POST['txtRangohasta']) || empty($_POST['listStatus'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {

				$intidConfiguracion = intval($_POST['idConfiguracion']);
				$intFECHA_INICIO =  intval($_POST['txtFechainicio']);
				$intFECHA_LIMITE = intval($_POST['txtFechaLimite']);
				$strRANGO_DESDE = strClean($_POST['txtRangodesde']);
				$strRANGO_HASTA = strClean($_POST['txtRangohasta']);
				$strCAI = strClean($_POST['txtCai']);
				$intStatus = intval($_POST['listStatus']);
				$request_configuracion = "";

				if ($intidConfiguracion == 0) {
					$option = 1;
					if ($_SESSION['permisosMod']['w']) {
						$request_configuracion = $this->model->insertConfiguracion(
							$intFECHA_INICIO,
							$intFECHA_LIMITE,
							$strRANGO_DESDE,
							$strRANGO_HASTA,
							$strCAI,
							$intStatus,
						);
					}
				} else {
					$option = 2;
					if ($_SESSION['permisosMod']['u']) {
						$request_configuracion = $this->model->updateConfiguracion(
							$intidConfiguracion,
							$intFECHA_INICIO,
							$intFECHA_LIMITE,
							$strRANGO_DESDE,
							$strRANGO_HASTA,
							$strCAI,
							$intStatus
						);
					}
				}
				if ($request_configuracion > 0) {
					if ($option == 1) {
						$arrResponse = array('status' => true, 'COD_REGIMEN' => $request_configuracion, 'msg' => 'Datos guardados correctamente.');
					} else {
						$arrResponse = array('status' => true, 'COD_REGIMEN' => $intidConfiguracion, 'msg' => 'Datos Actualizados correctamente.');
					}
				} else if ($request_configuracion == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe el CAI Ingresado.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getConfiguracion($idConfiguracion)
	{
		if ($_SESSION['permisosMod']['r']) {
			$intIdConfiguracion = intval($idConfiguracion);
			if ($intIdConfiguracion > 0) {
				$arrData = $this->model->selectConfiguracion($intIdConfiguracion);
				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				} else {
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	// ---------------------------------- PARA ELIMINAR ---------------------------------

	public function delConfiguracion()
	{
		if ($_POST) {

			$intIdConfiguracion = intval($_POST['idConfiguracion']);
			$requestDelete = $this->model->deleteConfiguracion($intIdConfiguracion);
			if ($requestDelete == 'ok') {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado');
			} else if ($requestDelete == 'exist') {
				$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar.');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}

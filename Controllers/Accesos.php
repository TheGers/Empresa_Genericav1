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

Programa:         Acceso
Fecha:            2023
Programador:       Gerson Garcia 
descripcion:       Acceso 

-----------------------------------------------------------------------
--------------------------------------------------------------------- */
class Accesos extends Controllers
{
	
	public function __construct()//constructor del controlador con funciones de validacion de login de usuario y permiso ortogado
	{
		parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(15);
	}

	public function Accesos()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Accesos"; // funcion que da funcion al titulo y mandando a llamar del ajax y vista
		$data['page_title'] = "Accesos";
		$data['page_name'] = "Accesos";
		$data['page_functions_js'] = "Accesos.js";
		$this->views->getView($this, "accesos", $data);
	}




    public function getAccesos()
    {
        if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->MostrarAccesos();
			for ($i = 0; $i < count($arrData); $i++) { //funcion que va al controlador y valida la traida de datos 
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';//manerda de mostrar el estado
				}


				
				if ($_SESSION['permisosMod']['u']) { //botones de ejecuciones
					//$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['COD_REGIMEN'] . ')" title="Editar categoría"><i class="fas fa-pencil-alt"></i></button>';
				}
				if ($_SESSION['permisosMod']['d']) {
					//$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['COD_REGIMEN'] . ')" title="Eliminar categoría"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
    }
}
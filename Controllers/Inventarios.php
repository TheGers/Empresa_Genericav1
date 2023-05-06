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

Programa:        Modulo de inventario
Fecha:             23-febrero-2023
Programador:       Edwin Juanez
descripcion:      Registro para lo de Inventario
-----------------------------------------------------------------------
--------------------------------------------------------------------- */
class Inventarios extends Controllers
{
	
	public function __construct()
	{
		parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(22);
	}

	public function Inventarios()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Inventarios";
		$data['page_title'] = "Inventarios";
		$data['page_name'] = "inventarios";
		$data['page_functions_js'] = "functions_inventarios.js";
		$this->views->getView($this, "inventarios", $data);
	}
	public function getInventario()
    {
        if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectInventario();
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
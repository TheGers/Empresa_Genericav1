<?php
class Historial extends Controllers
{
	
	public function __construct()
	{
		parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(17);
	}

	public function Historial()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Historial de Contraseña";
		$data['page_title'] = "Historial de Contraseña";
		$data['page_name'] = "Historial de Contraseña";
		$data['page_functions_js'] = "Historial.js";
		$this->views->getView($this, "historial", $data);
	}


    public function getHistorial()
    {
        if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectHistorial();
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
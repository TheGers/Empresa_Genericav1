<?php
class Accesos extends Controllers
{
	
	public function __construct()
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
		$data['page_tag'] = "Accesos";
		$data['page_title'] = "Accesos";
		$data['page_name'] = "Accesos";
		$data['page_functions_js'] = "Accesos.js";
		$this->views->getView($this, "accesos", $data);
	}




    public function getAccesos()
    {
        if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->MostrarAccesos();
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
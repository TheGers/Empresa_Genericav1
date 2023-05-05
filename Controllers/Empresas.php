<?php
class Empresas extends Controllers
{
	
	public function __construct()
	{
		parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(23);
	}

	public function Empresas()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Empresas";
		$data['page_title'] = "empresas";
		$data['page_name'] = "empresas";
		$data['page_functions_js'] = "empresa.js";
        $data['empresa'] = $this->model->getEmpresas();
		$this->views->getView($this,"empresas", $data);
       
	}


    public function setEmpresas(){
        $RTN = strClean($_POST['rtn']);
        $nombre = strClean($_POST['nombre']);
        $telefono = strClean($_POST['telefono']);
        $correo = strClean($_POST['correo']);
        $direccion = strClean($_POST['direccion']);
        $descripcion = strClean($_POST['descripcion']);
        $mensaje = strClean($_POST['mensaje']);
       
        $id = strClean($_POST['id']);
        $request_Empresa = "";
        if($id == 0)
        {
            //Crear
            if($_SESSION['permisosMod']['w']){
                $request_Empresa = $this->model->InsertarEmpresas($RTN, $nombre,$telefono,$correo, $direccion,$descripcion,$mensaje);
                $option = 1;
            }
        }else{
            //Actualizar
            if($_SESSION['permisosMod']['u']){
                $request_Empresa = $this->model->UptadeEmpresas($id,$RTN, $nombre,$telefono,$correo, $direccion,$descripcion,$mensaje);
                $option = 2;
            }		
        }

        if($request_Empresa > 0 )
        {
            if($option == 1)
            {
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
            }else{
                $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
            }
        }else if($request_Empresa == 'exist'){
            
            $arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
        }else{
            $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    die();
}



    
}
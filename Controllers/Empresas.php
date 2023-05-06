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

Programa:         Empresa
Fecha:            2023
Programador:       Gerson Garcia 
descripcion:       Datos de la Empresa 

-----------------------------------------------------------------------
--------------------------------------------------------------------- */
class Empresas extends Controllers
{
	
	public function __construct() //funcion del controlador que instancia las funciones, en la cual detecta la sesion del usuario
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
		$data['page_name'] = "empresas"; //determina los campos de la tabla de titular y relfleja que funcion de ajax necesita y el retorno de la vista
		$data['page_functions_js'] = "empresa.js";
        $data['empresa'] = $this->model->getEmpresas();
		$this->views->getView($this,"empresas", $data);
       
	}


    public function setEmpresas(){ //inserccion de nuevos datos a la informacion de la empresa
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
            if($_SESSION['permisosMod']['w']){ //envio de datos al modelo para ser insertados
                $request_Empresa = $this->model->InsertarEmpresas($RTN, $nombre,$telefono,$correo, $direccion,$descripcion,$mensaje);
                $option = 1;
            }
        }else{
            //Actualizar
            if($_SESSION['permisosMod']['u']){ //envio de datos al modelo para ser  actualizados
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
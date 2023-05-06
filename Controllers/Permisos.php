 <?php 
/*
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

---------------------------------------------------------------------

Programa:         Modulo de Permsiso
Fecha:             23-febrero-2023
Programador:       Miguel Cardenas 
descripcion:       Modulo que asigna los permisos para cada rol */
	class Permisos extends Controllers{
		//constructor del controlador con funciones de validacion de login de usuario
		public function __construct()
		{
			parent::__construct();
		}

		//Funcion que muestra los registros de la base de datos en la vista 
		public function getPermisosRol(int $idrol) 
		{
			$rolid = intval($idrol);
			if($rolid > 0)
			{
				$arrModulos = $this->model->selectModulos();
				$arrPermisosRol = $this->model->selectPermisosRol($rolid);
				$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
				$arrPermisoRol = array('idrol' => $rolid );

				if(empty($arrPermisosRol))
				{
					for ($i=0; $i < count($arrModulos) ; $i++) { 

						$arrModulos[$i]['permisos'] = $arrPermisos;
					}
				}else{
					for ($i=0; $i < count($arrModulos); $i++) {
						$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
						if(isset($arrPermisosRol[$i])){
							$arrPermisos = array('r' => $arrPermisosRol[$i]['r'], 
												 'w' => $arrPermisosRol[$i]['w'], 
												 'u' => $arrPermisosRol[$i]['u'], 
												 'd' => $arrPermisosRol[$i]['d'] 
												);
						}
						$arrModulos[$i]['permisos'] = $arrPermisos;
					}
				}
				$arrPermisoRol['modulos'] = $arrModulos;
				$html = getModal("modalPermisos",$arrPermisoRol);
				//dep($arrPermisoRol);

			}
			die();
		}

		//Funcion para asignar los permisos de cada modulo al usuarios
		public function setPermisos()
		{
			if($_POST)
			{
				$intIdrol = intval($_POST['idrol']);
				$modulos = $_POST['modulos'];

				$this->model->deletePermisos($intIdrol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['idmodulo'];
					$r = empty($modulo['r']) ? 0 : 1;
					$w = empty($modulo['w']) ? 0 : 1;
					$u = empty($modulo['u']) ? 0 : 1;
					$d = empty($modulo['d']) ? 0 : 1;
					$requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d);
				}
				if($requestPermiso > 0)
				{
					$arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>
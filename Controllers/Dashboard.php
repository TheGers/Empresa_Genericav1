<?php 
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
// Programa:         Dashboard
// Fecha:             25-Abril-2023
// Programador:       Elsy Maradiaga 
// descripcion:   Vista Principal  del panel de control

	class Dashboard extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(1);
		}

		public function dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard - Empresa Generica";
			$data['page_title'] = "Dashboard - Empresa Generica";
			$data['page_name'] = "dashboard";
			$data['page_functions_js'] = "functions_dashboard.js";
			$data['usuarios'] = $this->model->getTotales('tbl_ms_usuarios');// aqui mandamos a llamar el modelo para sumar el total de usuarios luego se manda a llamar directamente el nombre de la tabla 
			$data['productos'] = $this->model->getTotales('tbl_producto');
			$data['compras'] = $this->model->getTotales('tbl_compras');
			$data['ventas'] = $this->model->getTotales('tbl_ventas');
			$data['ventasT'] = $this->model->lastOrders('');
			
		
			$anio = date('Y');
			$mes = date('m');
			$dia = date('d');
			$data['productosT'] = $this->model->selectProductosT($anio,$mes,$dia);//se utilizara para que se muestre en la grafica los productos vendidos del dia 
			$data['ventasMDia'] = $this->model->selectVentasMes($anio,$mes);
			$data['ventasAnio'] = $this->model->selectVentasAnio($anio);
			$this->views->getView($this,"dashboard",$data);
		}

	//funcion que se utilizara para buscar en las graficas de ventas por mes 
		public function ventasMes(){
			if($_POST){
				$grafica = "ventasMes";//nombre de la grafica que se coloco en la vista de graficas
				$nFecha = str_replace(" ","",$_POST['fecha']);//se obtiene la fecha enviada a través de un formulario POST y se le quitan los espacios en blanco.
				$arrFecha = explode('-',$nFecha);//se separa la fecha en sus componentes (mes y año) utilizando el guión como separador y se almacenan en un array.
				$mes = $arrFecha[0];
				$anio = $arrFecha[1];
				$pagos = $this->model->selectVentasMes($anio,$mes);//se llama al método selectVentasMes() de un objeto modelo y se le pasan como parámetros el año y mes obtenidos anteriormente. El resultado se almacena en una variable llamada $pagos.
				$script = getFile("Template/Modals/graficas",$pagos);
				echo $script;
				die();
			}
		}
			//funcion que se utilizara para buscar en las graficas de ventas por año 
		public function ventasAnio(){
			if($_POST){
				$grafica = "ventasAnio";
				$anio = intval($_POST['anio']);
				$pagos = $this->model->selectVentasAnio($anio);
				$script = getFile("Template/Modals/graficas",$pagos);
				echo $script;
				die();
			}
		}

	}
 ?>
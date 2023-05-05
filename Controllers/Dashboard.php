<?php 

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
			$data['usuarios'] = $this->model->getTotales('tbl_ms_usuarios');
			$data['productos'] = $this->model->getTotales('tbl_producto');
			$data['compras'] = $this->model->getTotales('tbl_compras');
			$data['ventas'] = $this->model->getTotales('tbl_ventas');
			$data['ventasT'] = $this->model->lastOrders('');
			
		
			$anio = date('Y');
			$mes = date('m');
			$dia = date('d');
			$data['productosT'] = $this->model->selectProductosT($anio,$mes,$dia);
			$data['ventasMDia'] = $this->model->selectVentasMes($anio,$mes);
			$data['ventasAnio'] = $this->model->selectVentasAnio($anio);
			$this->views->getView($this,"dashboard",$data);
		}

	
		public function ventasMes(){
			if($_POST){
				$grafica = "ventasMes";
				$nFecha = str_replace(" ","",$_POST['fecha']);
				$arrFecha = explode('-',$nFecha);
				$mes = $arrFecha[0];
				$anio = $arrFecha[1];
				$pagos = $this->model->selectVentasMes($anio,$mes);
				$script = getFile("Template/Modals/graficas",$pagos);
				echo $script;
				die();
			}
		}
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
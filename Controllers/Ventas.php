<!-- -----------------------Controlador para las Ventas--------------------------->
<!-- -----------------------Creado por Edwin Juanez--------------------------->

<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

use function PHPSTORM_META\type;

class Ventas extends Controllers
{
	private $idPersona;
	// -----------------------------------------------------CONSTRUCTOR - EDWIN JUANEZ------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->idPersona = $_SESSION['userData']['nombres'];
		if (empty($_SESSION['login'])) {
			header('Location:' . base_url() . '/login');
		}
		getPermisos(6);
	}

	// -------------------------------------------------------MOSTRAR - EDWIN JUANEZ--------------------------------------------------------

	public function Ventas()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Ventas";
		$data['page_title'] = "Ventas";
		$data['page_name'] = "ventas";
		$data['page_functions_js'] = "functions_ventas.js";
		$this->views->getView($this, "ventas", $data);
	}

	// -------------------------------------------------------OBTENER - EDWIN JUANEZ--------------------------------------------------------

	public function getVentas()
{
    if ($_SESSION['permisosMod']['r']) {
        $arrData = $this->model->selectVentas();
        for ($i = 0; $i < count($arrData); $i++) {
			
				if ($arrData[$i]['status']== 1) {
					$arrData[$i]['options'] = '<div>
                	<a class="btn btn-danger btn-sm"  href="#" onClick="anularVenta(' . $arrData[$i]['COD_VENTA'] . ')" title="Anular"><i class="fa fa-remove"></i></a>
					<a class="btn btn-info btn-sm"  href="#" onclick=" verReporte('. $arrData[$i]['COD_VENTA'].') " title="Ver"><i class="far fa-eye"></i></a> 
                	</div>';
				} else {
					$arrData[$i]['options'] = '<div>
                	<span class="badge bg-info">Anulada</span>
					<a class="btn btn-info btn-sm"  href="#" onclick=" verReporte('. $arrData[$i]['COD_VENTA'].') " title="Ver"><i class="far fa-eye"></i></a> 
                	</div>';
				}
			    $arrData[$i]['TOTAL'] = SMONEY . ' ' . formatMoney($arrData[$i]['TOTAL']);
            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
            }
           
        }
        $jsonResponse = json_encode($arrData, JSON_UNESCAPED_UNICODE);
        echo $jsonResponse;
    }
    die();
}

	// -------------------------------------------------------ACTUALIZAR - EDWIN JUANEZ----------------------------------------------------------

	public function setVenta()
	{
		if ($_POST) {
			if (empty($_POST['listCliente']) || empty($_POST['txtNumerofactura']) || empty($_POST['txtDescripcion']) || empty($_POST['txtTotal']) || empty($_POST['listStatus'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$intCOD_VENTA = intval($_POST['COD_VENTA']);
				$intCOD_PERSONA = intval($_POST['listCliente']);
				$strNUMERO_FACTURA = strClean($_POST['txtNumerofactura']);
				$strDESCRIPCION = strClean($_POST['txtDescripcion']);
				$intTOTAL = intval($_POST['txtTotal']);
				$intstatus = intval($_POST['listStatus']);
				$request_venta = "";
				if ($intCOD_VENTA == 0) {
					$option = 1;
					if ($_SESSION['permisosMod']['w']) {
						$request_venta = $this->model->insertVentas(
							$intCOD_VENTA,
							$intCOD_PERSONA,
							$strNUMERO_FACTURA,
							$strDESCRIPCION,
							$intTOTAL,
							$intstatus,
						);
					}
				} else {
					$option = 2;
					if ($_SESSION['permisosMod']['u']) {
						$request_venta = $this->model->updateVentas(
							$intCOD_VENTA,
							$intCOD_PERSONA,
							$strNUMERO_FACTURA,
							$strDESCRIPCION,
							$intTOTAL,
							$intstatus,
						);
					}
				}
				if ($request_venta > 0) {
					if ($option == 1) {
						$arrResponse = array('status' => true, 'COD_VENTA' => $request_venta, 'msg' => 'Datos guardados correctamente.');
					} else {
						$arrResponse = array('status' => true, 'COD_VENTA' => $intCOD_VENTA, 'msg' => 'Datos Actualizados correctamente.');
					}
				} else if ($request_venta == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe el producto Ingresado.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	// -------------------------------------CARGAR UNA SOLA VENTYA - EDWIN JUANEZ--------------------------------------------------------------

	public function getventa($COD_VENTA)
	{
		if ($_SESSION['permisosMod']['r']) {
			$COD_VENTA = intval($COD_VENTA);
			if ($COD_VENTA > 0) {
				$arrData = $this->model->selectVenta($COD_VENTA);
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

	// ------------------------------------REGISTRA VENTAS - EDWIN JUANEZ------------------------------------------------------------------

	public function registraVenta()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json, true);
		$array['productos'] = array();
		$total = 0;
		$isv = 0;
		if (!empty($datos['productos'])) {
			$fecha = date('Y-m-d');
			$idCliente = $datos['idCliente'];
			$serie = $datos['serie'];
			if (empty($idCliente)) {
				$res = array('msg' => 'EL CLIENTE ES REQUERIDO', 'type' => 'warning');
			} else if (empty($serie)) {
				$res = array('msg' => 'EL NUMERO DE FACTURA ES REQUERIDO', 'type' => 'warning');
			} else {
				foreach ($datos['productos'] as $producto) {
					$result = $this->model->getProducto($producto['COD_PRODUCTO']);
					$data['COD_PRODUCTO'] = $result['COD_PRODUCTO'];
					$data['NOMBRE_PRODUCTO'] = $result['NOMBRE_PRODUCTO'];
					$data['PRECIO'] = $result['PRECIO'];
					$data['EXISTENCIA'] = $producto['EXISTENCIA'];
					$subTotal = $result['PRECIO']  * $producto['EXISTENCIA'];
					$isv = $subTotal * 0.15;
					array_push($array['productos'], $data);
					$total += $subTotal + $isv;
					// ACTUALIZAR EL INVENTARIO RESTANDO LA VENTA
					$nuevaCantidad = $result['EXISTENCIA'] - $producto['EXISTENCIA'];
					$this->model->actualizarStock($nuevaCantidad, $result['COD_PRODUCTO']);
				}
				$datosProductos = json_encode($array['productos']);
				$venta = $this->model->registraventa($idCliente, $serie, $datosProductos, $isv, $total, $this->idPersona, $fecha);
				if ($venta > 0) {
					
					$res = array('msg' => 'VENTA GENERADA', 'type' => 'success', 'COD_VENTA' => $venta);
				} else {
					$res = array('msg' => 'ERROR EN LA VENTA', 'type' => 'error');
				}
			}
		} else {
			$res = array('msg' => 'CARRITO VACIO', 'type' => 'warning');
		}

		echo json_encode($res);
		die();
	}

	//-------------------------------------REPORTE DE VENTAS - EDWIN JUANEZ-----------------------------------------------
	public function reporte($datos)
	{
		$array = explode(',', $datos);
		$tipo = $array[0];
		$COD_VENTA = $array[1];

		$data['title'] = 'Reporte';
		$data['regimen'] = $this->model->getRegimen();
		$data['empresa'] = $this->model->getEmpresa();
		$data['venta'] = $this->model->getVenta($COD_VENTA);
		if (empty($data['venta'])) {
			echo 'Pagina no encontrada';
			exit;
		}
		$this->views->getView('ventas', $tipo, $data);
		$html = ob_get_clean();
		$dompdf = new Dompdf();
		$options = $dompdf->getOptions();
		$options->set('isJavascriptEnabled', true);
		$options->set('isRemoteEnabled', true);
		$dompdf->setOptions($options);
		$dompdf->loadHtml($html);

		if ($tipo == 'ticked') {
			$dompdf->setPaper(array(0, 0, 222, 841), 'portrait');
		} else {
			$dompdf->setPaper('A4', 'vertical');
		}
		//render the HTML as PDF
		$dompdf->render();

		//Output the generated PDF to browser
		$dompdf->stream('Reporte_venta.pdf', array('Attachment' => false));
	}

	// /----------------------------ANULAR VENTA - EDWIN JUANEZ-----------------------------------------------
	public function anular($COD_VENTA){
	if (isset($_GET) && is_numeric($COD_VENTA)) {
		$data = $this->model->anular($COD_VENTA);
		$fecha = date('Y-m-d');
	if ($data == 1) {
		$resultVenta = $this->model->getVenta($COD_VENTA);
		$ventaProducto =json_decode($resultVenta['DESCRIPCION'], true);
		foreach ($ventaProducto as $producto) {
			$result = $this->model->getProducto($producto['COD_PRODUCTO']);
			$nuevaCantidad = $result['EXISTENCIA'] + $producto['EXISTENCIA'];
			$this->model->actualizarStock($nuevaCantidad, $producto['COD_PRODUCTO']);
			
		}
		$res = array('msg'=> 'VENTA ANULADA', 'type' => 'success');
	} else {
		$res = array('msg'=> 'ERROR AL ANULAR', 'type'=> 'error');
	}
	} else {
		$res = array('msg'=> 'ERROR DESCONOCIDO', 'type'=> 'error');
	}
	echo json_encode($res);
	die();
	}

	// -------------------------------------------Controlador para las ventas--------------------------------------------------
    // -------------------------------------------Creado por Edwin Juanez --------------------------------------------------
}
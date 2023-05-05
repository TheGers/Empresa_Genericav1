<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

use function PHPSTORM_META\type;

class Compras extends Controllers
{
	private $idPersona;
	// -----------------------------------------------------CONSTRUCTOR-------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->idPersona = $_SESSION['userData']['nombres'];
		if (empty($_SESSION['login'])) {
			header('Location:' . base_url() . '/login');
		}
		getPermisos(5);
	}

	// -------------------------------------------------------MOSTRAR---------------------------------------------------------

	public function Compras()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Compras";
		$data['page_title'] = "Compras";
		$data['page_name'] = "compras";
		$data['page_functions_js'] = "functions_compras.js";
		$this->views->getView($this, "compras", $data);
	}

	// -------------------------------------------------------OBTENER-----------------------------------------------------------

	public function getCompras()
{
    if ($_SESSION['permisosMod']['r']) {
        $arrData = $this->model->selectCompras();
        for ($i = 0; $i < count($arrData); $i++) {
			
				if ($arrData[$i]['status']== 1) {
					$arrData[$i]['options'] = '<div>
                	<a class="btn btn-danger btn-sm"  href="#" onClick="anularCompra(' . $arrData[$i]['COD_COMPRA'] . ')" title="Anular"><i class="fa fa-remove"></i></a>
					<a class="btn btn-info btn-sm"  href="#" onclick=" verReporte('. $arrData[$i]['COD_COMPRA'].') " title="Ver"><i class="far fa-eye"></i></a> 
                	</div>';
				} else {
					$arrData[$i]['options'] = '<div>
                	<span class="badge bg-info">Anulada</span>
					<a class="btn btn-info btn-sm"  href="/compras/reporte/factura/" onclick=" verReporte('. $arrData[$i]['COD_COMPRA'].') " title="Ver"><i class="far fa-eye"></i></a> 
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


	// ----------------------------------------------------ACTUALIZAR--------------------------------------------------------

	public function setCompra()
	{
		if ($_POST) {
			if (empty($_POST['listProveedor']) || empty($_POST['txtCai']) || empty($_POST['txtNumerofactura']) || empty($_POST['txtDescripcion']) || empty($_POST['txtSubtotal']) || empty($_POST['txtImpuesto']) || empty($_POST['txtDescuento']) || empty($_POST['txtTotal']) || empty($_POST['listStatus'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$intCOD_COMPRA = intval($_POST['COD_COMPRA']);
				$intCOD_PERSONA = intval($_POST['listProveedor']);
				$strCAI = strClean($_POST['txtCai']);
				$strNUMERO_FACTURA = strClean($_POST['txtNumerofactura']);
				$strDESCRIPCION = strClean($_POST['txtDescripcion']);
				$intSUBTOTAL = intval($_POST['txtSubtotal']);
				$intIMPUESTO = intval($_POST['txtImpuesto']);
				$intDESCUENTO = intval($_POST['txtDescuento']);
				$intTOTAL = intval($_POST['txtTotal']);
				$intstatus = intval($_POST['listStatus']);
				$request_compra = "";
				if ($intCOD_COMPRA == 0) {
					$option = 1;
					if ($_SESSION['permisosMod']['w']) {
						$request_compra = $this->model->insertCompras(
							$intCOD_COMPRA,
							$intCOD_PERSONA,
							$strCAI,
							$strNUMERO_FACTURA,
							$strDESCRIPCION,
							$intSUBTOTAL,
							$intIMPUESTO,
							$intDESCUENTO,
							$intTOTAL,
							$intstatus,
						);
					}
				} else {
					$option = 2;
					if ($_SESSION['permisosMod']['u']) {
						$request_compra = $this->model->updateCompras(
							$intCOD_COMPRA,
							$intCOD_PERSONA,
							$strCAI,
							$strNUMERO_FACTURA,
							$strDESCRIPCION,
							$intSUBTOTAL,
							$intIMPUESTO,
							$intDESCUENTO,
							$intTOTAL,
							$intstatus,
						);
					}
				}
				if ($request_compra > 0) {
					if ($option == 1) {
						$arrResponse = array('status' => true, 'COD_COMPRA' => $request_compra, 'msg' => 'Datos guardados correctamente.');
					} else {
						$arrResponse = array('status' => true, 'COD_COMPRA' => $intCOD_COMPRA, 'msg' => 'Datos Actualizados correctamente.');
					}
				} else if ($request_compra == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe el producto Ingresado.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	// -----------------------------------------------------------------------------------------------------------------------------

	public function getcompra($COD_COMPRA)
	{
		if ($_SESSION['permisosMod']['r']) {
			$COD_COMPRA = intval($COD_COMPRA);
			if ($COD_COMPRA > 0) {
				$arrData = $this->model->selectCompra($COD_COMPRA);
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

	// -----------------------------------------------------------------------------------------------------------------------------

	
		public function registraCompra()
{
    $json = file_get_contents('php://input');
    $datos = json_decode($json, true);
    $array['productos'] = array();
    $total = 0;
	$isv = 0;
    if (!empty($datos['productos'])) {
        $fecha = date('Y-m-d');
        $idProveedor = $datos['idProveedor'];
        $serie = $datos['serie'];
		$cai = $datos['cai'];
        if (empty($idProveedor)) {
            $res = array('msg' => 'EL PROVEEDOR ES REQUERIDO', 'type' => 'warning');
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
				$isv += $subTotal * 0.15;
                array_push($array['productos'], $data);
				$total += $subTotal + $isv;
                // ACTUALIZAR EL INVENTARIO SUMANDO LA COMPRA
                $nuevaCantidad = $result['EXISTENCIA'] + $producto['EXISTENCIA'];
                $this->model->actualizarStock($nuevaCantidad, $result['COD_PRODUCTO']);
            }
            $datosProductos = json_encode($array['productos']);
            $compra = $this->model->registraCompra($idProveedor, $serie, $datosProductos, $isv, $total, $cai, $this->idPersona, $fecha);
            if ($compra > 0) {
			
                $res = array('msg' => 'COMPRA GENERADA: TOTAL Lps.'.$total.' (incluyendo Lps.'.$isv.' de ISV)', 'type' => 'success', 'COD_COMPRA' => $compra);
            } else {
                $res = array('msg' => 'ERROR EN LA COMPRA', 'type' => 'error');
				}
			}
		} else {
			$res = array('msg' => 'CARRITO VACIO', 'type' => 'warning');
		}

		echo json_encode($res);
		die();
	}

	//------------------------------------------------Bayron-------------------------------------------------
	public function reporte($datos)
	{
		$array = explode(',', $datos);
		$tipo = $array[0];
		$COD_COMPRA = $array[1];
 
		$data['title'] = 'Reporte';
		$data['empresa'] = $this->model->getEmpresa();
		$data['compra'] = $this->model->getCompra($COD_COMPRA);
		if (empty($data['compra'])) {
			echo 'Pagina no encontrada';
			exit;
		}
		$this->views->getView('compras', $tipo, $data);
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
		$dompdf->stream('Reporte_compra.pdf', array('Attachment' => false));
	}


	//------------------------------------------------Bayron-------------------------------------------------
	public function anular($COD_COMPRA){
	if (isset($_GET) && is_numeric($COD_COMPRA)) {
		$data = $this->model->anular($COD_COMPRA);
		$fecha = date('Y-m-d');
	if ($data == 1) {
		$resultCompra = $this->model->getCompra($COD_COMPRA);
		$compraProducto =json_decode($resultCompra['DESCRIPCION'], true);
		
		$res = array('msg'=> 'COMPRA ANULADA', 'type' => 'success');
	} else {
		$res = array('msg'=> 'ERROR AL ANULAR', 'type'=> 'error');
	}
	} else {
		$res = array('msg'=> 'ERROR DESCONOCIDO', 'type'=> 'error');
	}
	echo json_encode($res);
	die();
	}
		
	
	
	
	
}


<?php
require 'vendor/autoload.php'; 

use Dompdf\Dompdf;

use function PHPSTORM_META\type;
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

Programa:        Modulo de Cotizaciones 
Fecha:             23-febrero-2023
Programador:       Edwin Juanez
descripcion:      Sirve para lña cotizacion de un producto que quiera saber el cliente

-----------------------------------------------------------------------
--------------------------------------------------------------------- */

class Cotizaciones extends Controllers
{
	private $idPersona;
	// ---------------------------------- CREADO POR EDWIN JUANEZ ---------------------------------
	// -----------------------------------------------------CONSTRUCTOR-------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		session_start();
		$this->idPersona = $_SESSION['userData']['nombres'];
		if (empty($_SESSION['login'])) {
			header('Location:' . base_url() . '/login');
		}
		getPermisos(21);
	}

	// -------------------------------------------------------MOSTRAR---------------------------------------------------------

	public function Cotizaciones()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Cotizaciones";
		$data['page_title'] = "Cotizaciones";
		$data['page_name'] = "cotizaciones";
		$data['page_functions_js'] = "functions_cotizaciones.js";
		$this->views->getView($this, "cotizaciones", $data);
	}

	// -------------------------------------------------------OBTENER DATOS EN LA TABLA-------------------------------------------------------

	public function getCotizaciones()
{
    if ($_SESSION['permisosMod']['r']) {
        $arrData = $this->model->selectCotizaciones();
        for ($i = 0; $i < count($arrData); $i++) {
			
				if ($arrData[$i]['status']== 1) {
					$arrData[$i]['options'] = '<div>
                	<a class="btn btn-danger btn-sm"  href="#" onClick="anularCotizacion(' . $arrData[$i]['COD_COTIZACION'] . ')" title="Anular"><i class="fa fa-remove"></i></a>
					<a class="btn btn-info btn-sm"  href="#" onclick=" verReporte('. $arrData[$i]['COD_COTIZACION'].') " title="Ver"><i class="far fa-eye"></i></a> 
                	</div>';
				} else {
					$arrData[$i]['options'] = '<div>
                	<span class="badge bg-info">Anulada</span>
					<a class="btn btn-info btn-sm"  href="#" onclick=" verReporte('. $arrData[$i]['COD_COTIZACION'].') " title="Ver"><i class="far fa-eye"></i></a> 
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

	// -------------------------------------------------------ACTUALIZAR-----------------------------------------------------------

	public function setCotizacion()
	{
		if ($_POST) {
			if (empty($_POST['listCliente']) || empty($_POST['txtNumerocotizacion']) || empty($_POST['txtDescripcion']) || empty($_POST['txtTotal']) || empty($_POST['listStatus'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$intCOD_COTIZACION = intval($_POST['COD_COTIZACION']);
				$intCOD_PERSONA = intval($_POST['listCliente']);
				$strNUMERO_COTIZACION = strClean($_POST['txtNumerocotizacion']);
				$strDESCRIPCION = strClean($_POST['txtDescripcion']);
				$intTOTAL = intval($_POST['txtTotal']);
				$intstatus = intval($_POST['listStatus']);
				$request_cotizacion = "";
				if ($intCOD_COTIZACION == 0) {
					$option = 1;
					if ($_SESSION['permisosMod']['w']) {
						$request_cotizacion = $this->model->insertCotizaciones(
							$intCOD_COTIZACION,
							$intCOD_PERSONA,
							$strNUMERO_COTIZACION,
							$strDESCRIPCION,
							$intTOTAL,
							$intstatus,
						);
					}
				} else {
					$option = 2;
					if ($_SESSION['permisosMod']['u']) {
						$request_cotizacion = $this->model->updateCotizaciones(
							$intCOD_COTIZACION,
							$intCOD_PERSONA,
							$strNUMERO_COTIZACION,
							$strDESCRIPCION,
							$intTOTAL,
							$intstatus,
						);
					}
				}
				if ($request_cotizacion > 0) {
					if ($option == 1) {
						$arrResponse = array('status' => true, 'COD_COTIZACION' => $request_cotizacion, 'msg' => 'Datos guardados correctamente.');
					} else {
						$arrResponse = array('status' => true, 'COD_COTIZACION' => $intCOD_COTIZACION, 'msg' => 'Datos Actualizados correctamente.');
					}
				} else if ($request_cotizacion == 'exist') {
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

	public function getcotizacion($COD_COTIZACION)
	{
		if ($_SESSION['permisosMod']['r']) {
			$COD_COTIZACION = intval($COD_COTIZACION);
			if ($COD_COTIZACION > 0) {
				$arrData = $this->model->selectCotizacion($COD_COTIZACION);
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

	// -------------------------------------------------------------REGISTRAR COTIZACION---------------------------------------------------------

	public function registraCotizacion()
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json, true);
		$array['productos'] = array();
		$total = 0;
		if (!empty($datos['productos'])) {
			$fecha = date('Y-m-d');
			$idCliente = $datos['idCliente'];
			$serie = $datos['serie'];
			if (empty($idCliente)) {
				$res = array('msg' => 'EL CLIENTE ES REQUERIDO', 'type' => 'warning');
			} else if (empty($serie)) {
				$res = array('msg' => 'EL NUMERO DE cotizacion ES REQUERIDO', 'type' => 'warning');
			} else {
				foreach ($datos['productos'] as $producto) {
					$result = $this->model->getProducto($producto['COD_PRODUCTO']);
					$data['COD_PRODUCTO'] = $result['COD_PRODUCTO'];
					$data['NOMBRE_PRODUCTO'] = $result['NOMBRE_PRODUCTO'];
					$data['PRECIO'] = $result['PRECIO'];
					$data['EXISTENCIA'] = $producto['EXISTENCIA'];
					$subTotal = $result['PRECIO']  * $producto['EXISTENCIA'];
					array_push($array['productos'], $data);
					$total += $subTotal;
					
				}
				$datosProductos = json_encode($array['productos']);
				$cotizacion = $this->model->registracotizacion($idCliente, $serie, $datosProductos, $total, $this->idPersona, $fecha);
				if ($cotizacion > 0) {
					$res = array('msg' => 'COTIZACION GENERADA', 'type' => 'success', 'COD_COTIZACION' => $cotizacion);
				} else {
					$res = array('msg' => 'ERROR EN LA COTIZACION', 'type' => 'error');
				}
			}
		} else {
			$res = array('msg' => 'CARRITO VACIO', 'type' => 'warning');
		}

		echo json_encode($res);
		die();
	}

	//---------------------------------------PARA EL PDF -------------------------------------------------
	public function reporte($datos)
	{
		$array = explode(',', $datos);
		$tipo = $array[0];
		$COD_COTIZACION = $array[1];

		$data['title'] = 'Reporte';
		// $data['regimen'] = $this->model->getRegimen();
		$data['empresa'] = $this->model->getEmpresa();
		$data['cotizacion'] = $this->model->getCotizacion($COD_COTIZACION);
		if (empty($data['cotizacion'])) {
			echo 'Pagina no encontrada';
			exit;
		}
		$this->views->getView('cotizaciones', $tipo, $data);
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
		$dompdf->stream('Reporte_cotizacion.pdf', array('Attachment' => false));
	}

	// /------------------------------------------------ANULAR LA COTIZACION-------------------------------------------------
	
	public function anular($COD_COTIZACION){
	if (isset($_GET) && is_numeric($COD_COTIZACION)) {
		$data = $this->model->anular($COD_COTIZACION);
	if ($data == 1) {
		$resultCotizacion = $this->model->getCotizacion($COD_COTIZACION);
		$cotizacionProducto =json_decode($resultCotizacion['DESCRIPCION'], true);
		foreach ($cotizacionProducto as $producto) {
			$result = $this->model->getProducto($producto['COD_PRODUCTO']);
			$nuevaCantidad = $result['EXISTENCIA'] + $producto['EXISTENCIA'];
			$this->model->actualizarStock($nuevaCantidad, $producto['COD_PRODUCTO']);
		}
		$res = array('msg'=> 'COTIZACION ANULADA', 'type' => 'success');
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
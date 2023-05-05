<?php
class Productos extends Controllers
{

	// -------------------------------------------------CONSTRUCTOR--------------------------------------------------------

	public function __construct() //funcion del controlador que instancia las funciones, en la cual detecta la sesion del usuario
	{
		parent::__construct();
		session_start();
		$this->idPersona = $_SESSION['userData']['nombres'];
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/login');
		}
		getPermisos(4);
	}

	// ---------------------------------------------------MOSTRAR----------------------------------------------------------

	public function Productos()
	{
		if (empty($_SESSION['permisosMod']['r'])) {
			header("Location:" . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Productos";
		$data['page_title'] = "Productos";
		$data['page_name'] = "productos";  //determina los campos de la tabla de titular y relfleja que funcion de ajax necesita y el retorno de la vista
		$data['page_functions_js'] = "functions_productos.js";
		$this->views->getView($this, "productos", $data);
	}

	// ---------------------------------------------------OBTENER-----------------------------------------------------------

	public function getProductos()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectProductos();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
 
				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}
				$arrData[$i]['PRECIO'] = SMONEY . ' ' . formatMoney($arrData[$i]['PRECIO']);
				$arrData[$i]['PrecioVenta'] = SMONEY . ' ' . formatMoney($arrData[$i]['PrecioVenta']);
				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['COD_PRODUCTO'] . ')" title="Ver "><i class="far fa-eye"></i></button>';
				}
				if ($_SESSION['permisosMod']['u']) {
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['COD_PRODUCTO'] . ')" title="Editar "><i class="fas fa-pencil-alt"></i></button>';
				}
				if ($_SESSION['permisosMod']['d']) {
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['COD_PRODUCTO'] . ')" title="Eliminar "><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	// -----------------------------------------------------ACTUALIZAR-------------------------------------------------

	public function setProducto()
	{
		if ($_POST) {

			if (empty($_POST['txtNombre']) || empty($_POST['txtBARCODIGO']) || empty($_POST['txtDescripcion']) || empty($_POST['txtPrecio']) || empty($_POST['txtPrecioVenta']) || empty($_POST['listStatus']) || empty($_POST['listCategoria'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$idProducto = intval($_POST['idProducto']);
				$strNOMBRE_PRODUCTO = strClean($_POST['txtNombre']);
				$strBarcodigo = intval($_POST['txtBARCODIGO']);
				$intCOD_CATEGORIA = intval($_POST['listCategoria']);
				$strDESCRIPCION = strClean($_POST['txtDescripcion']); //equivalencia de datos con el formulario html
				$intPRECIO = strClean($_POST['txtPrecio']);
				$intPRECIOVenta = strClean($_POST['txtPrecioVenta']);
				$intEXISTENCIA = intval($_POST['txtStock']);
				$intESTADO = intval($_POST['listStatus']);
				$FECHA_MODIFICADO =  date("d-m-Y (H:i:s)"); 
				$request_producto = "";

				if ($idProducto == 0) {
					$option = 1;
					if ($_SESSION['permisosMod']['w']) {
						$request_producto = $this->model->insertProducto( //envio de datos al modelo para ser insertados
							$strNOMBRE_PRODUCTO,
							$strBarcodigo,
							$intCOD_CATEGORIA,
							$strDESCRIPCION,
							$intPRECIO,
							$intPRECIOVenta,
							$intEXISTENCIA,
							$this->idPersona,
							$intESTADO
							
						);
					}
				} else {
					$option = 2;
					if ($_SESSION['permisosMod']['u']) {
						$request_producto = $this->model->updateProducto(//envio de datos al modelo para ser actualizados
							$idProducto, 
							$strBarcodigo,
							$strNOMBRE_PRODUCTO,
							$intCOD_CATEGORIA,
							$strDESCRIPCION,
							$intPRECIO,
							$intPRECIOVenta,
							$intEXISTENCIA,
							$this->idPersona,
							$FECHA_MODIFICADO,
							$intESTADO
						);
					}
				}
				if ($request_producto > 0) {
					if ($option == 1) {
						$arrResponse = array('status' => true, 'COD_PRODUCTO' => $request_producto, 'msg' => 'Datos guardados correctamente.');
					} else {
						$arrResponse = array('status' => true, 'COD_PRODUCTO' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
					}
				} else if ($request_producto == 'exist') {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe el producto Ingresado.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	// -------------------------------------------------------------------------------------------------------------------------

	public function delProducto()
	{
		if ($_POST) {
			if ($_SESSION['permisosMod']['d']) {
				$intCOD_PRODUCTO = intval($_POST['idProducto']);
				$requestDelete = $this->model->deleteProducto($intCOD_PRODUCTO);
				if ($requestDelete) {
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
				} else {
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	// -------------------------------------------------------------------------------------------------------------------------

	public function getProducto($COD_PRODUCTO)
	{
		if ($_SESSION['permisosMod']['r']) {
			$COD_PRODUCTO = intval($COD_PRODUCTO);
			if ($COD_PRODUCTO > 0) {
				$arrData = $this->model->selectProducto($COD_PRODUCTO);
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
	// -------------------------------------------------------------------------------------------------------------------------

	public function getSelectProductos()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectProductos();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['status'] == 1) {
					$htmlOptions .= '<option value="' . $arrData[$i]['COD_PRODUCTO'] . '">' . $arrData[$i]['NOMBRE_PRODUCTO'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	// ---------------------------------------BUSCAR PRODUCTO POR CODIGO - JAHIR----------------------------------------

	public function buscarPorCodigo($valor)
	{
		$data = $this->model->buscarPorCodigo($valor);
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die();
	}

	// ---------------------------------------BUSCAR PRODUCTO POR NOMBRE - JAHIR----------------------------------------

	public function buscarPorNombre()
	{
		$array = array();
		$valor = $_GET['term'];
		$data = $this->model->buscarPorNombre($valor);
		foreach ($data as $row) {
			$result['COD_PRODUCTO'] = $row['COD_PRODUCTO'];
			$result['label'] = $row['NOMBRE_PRODUCTO'];
			array_push($array, $result);
		}
		echo json_encode($array, JSON_UNESCAPED_UNICODE);
		die();
	}

	// ---------------------------------------BUSCAR PRODUCTO DESDE LOCAL STORAGE - JAHIR----------------------------------------
	public function mostrarDatos() //funcion que muestra los datos del producto en compra y cotizacion para el registro en ella
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json, true);
		$array['productos'] = array();
		$total = 0;
		$isv = 0;
		if (!empty($datos)) {
			foreach ($datos as $producto) {
				$result = $this->model->editar($producto['COD_PRODUCTO']);
				$data['COD_PRODUCTO'] = $result['COD_PRODUCTO'] ?? null;
				$data['BARCODIGO'] = $result['BARCODIGO'] ?? null;
				$data['NOMBRE_PRODUCTO'] = $result['NOMBRE_PRODUCTO'] ?? null;
				$data['PRECIO'] = number_format($result['PRECIO'] ?? null, 2);
				$data['EXISTENCIA'] = $producto['EXISTENCIA'] ?? null;
				$subTotal = ($result['PRECIO'] ?? 0) * ($producto['EXISTENCIA'] ?? 0);				
				$data['subTotal'] = number_format($subTotal, 2);
				$productoIsv = $subTotal * 0.15;
				$isv += $productoIsv;
				array_push($array['productos'], $data);
				$total += $subTotal;
			}
		}
		$array['isv'] = number_format($isv, 2);
		$array['total'] = number_format($total +$isv, 2);
		echo json_encode($array, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function mostrarDatosVentas() //funcion que muestra los datos del producto en ventas para el registro en ella
	{
		$json = file_get_contents('php://input');
		$datos = json_decode($json, true);
		$array['productos'] = array();
		$total = 0;
		$isv = 0;
		if (!empty($datos)) {
			foreach ($datos as $producto) {
				$result = $this->model->editar($producto['COD_PRODUCTO']);
				$data['COD_PRODUCTO'] = $result['COD_PRODUCTO'] ?? null;
				$data['BARCODIGO'] = $result['BARCODIGO'] ?? null;
				$data['NOMBRE_PRODUCTO'] = $result['NOMBRE_PRODUCTO'] ?? null;
				$data['PrecioVenta'] = number_format($result['PrecioVenta'] ?? null, 2);
				$data['EXISTENCIA'] = $producto['EXISTENCIA'] ?? null;
				$subTotal = ($result['PrecioVenta'] ?? 0) * ($producto['EXISTENCIA'] ?? 0);				
				$data['subTotal'] = number_format($subTotal, 2);
				$productoIsv = $subTotal * 0.15;
				$isv += $productoIsv;
				array_push($array['productos'], $data);
				$total += $subTotal;
			}
		}
		$array['isv'] = number_format($isv, 2);
		$array['total'] = number_format($total +$isv, 2);
		echo json_encode($array, JSON_UNESCAPED_UNICODE);
		die();
	}



	// public function mostrarDatos()
	// {
	// 	$json = file_get_contents('php://input');
	// 	$datos = json_decode($json, true);
	// 	$array['productos'] = array();
	// 	$total = 0;
	// 	if (!empty($datos)) {
	// 		foreach ($datos as $producto) {
	// 			$result = $this->model->editar($producto['COD_PRODUCTO']);
	// 			$data['COD_PRODUCTO'] = $result['COD_PRODUCTO'];
	// 			$data['NOMBRE_PRODUCTO'] = $result['NOMBRE_PRODUCTO'];
	// 			$data['PRECIO'] = $result['PRECIO'];
	// 			$data['EXISTENCIA'] = $producto['EXISTENCIA'];
	// 			$subTotal = $result['PRECIO'] * $producto['EXISTENCIA'];
	// 			$data['subTotal'] = number_format($subTotal, 2);
	// 			array_push($array['productos'], $data);
	// 			$total += $subTotal;
	// 		}
	// 		$array['total'] = number_format($total,2);
	// 		echo json_encode($array, JSON_UNESCAPED_UNICODE);
	// 		die();
	// 	}
	// }
}
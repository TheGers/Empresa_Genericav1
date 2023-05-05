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
// Fecha:             23-febrero-2023
// Programador:       Elsy Maradiaga 
// descripcion:   Dashboard

	class DashboardModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}	
        
    public function getTotales($table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE status = 1";
        return $this->select($sql);
    }

	public function lastOrders(){
		$sql = "SELECT p.COD_VENTA, CONCAT(pr.NOMBRE) as NOMBRE, p.TOTAL,p.NUMERO_FACTURA, p.status 
				FROM tbl_ventas p
				INNER JOIN tbl_personas pr
				ON p.COD_PERSONA = pr.COD_PERSONA
				ORDER BY p.COD_VENTA DESC LIMIT 10 ";
		$request = $this->select_all($sql);
		return $request;
	}
	public function selectProductosT(int $anio, int $mes, int $dia){
		
		$sql = "SELECT  p.NOMBRE_PRODUCTO, SUM(p.EXISTENCIA) as existencias 
		FROM tbl_producto p 
		WHERE DAY(p.FECHA_CREACION)=$dia AND MONTH(p.FECHA_CREACION)=$mes AND YEAR(p.FECHA_CREACION) =$anio 
		 GROUP BY p.NOMBRE_PRODUCTO";
		$pagos = $this->select_all($sql);
		$meses = Meses();
		$arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)],'dia' => $dia,  'Vendidos' => $pagos );
		return $arrData;
	}
	public function selectVentasMes(int $anio, int $mes){
		$totalVentasMes = 0;
		$arrVentaDias = array();
		$dias = cal_days_in_month(CAL_GREGORIAN,$mes, $anio);
		$n_dia = 1;
		for ($i=0; $i < $dias ; $i++) { 
			$date = date_create($anio."-".$mes."-".$n_dia);
			$fechaVenta = date_format($date,"Y-m-d");
			$sql = "SELECT DAY(FECHA_CREACION) as dia, COUNT(COD_VENTA)as cantidad, SUM(TOTAL) as total 
			FROM tbl_ventas 
			WHERE DATE(FECHA_CREACION) = '$fechaVenta' AND status='1'
			 ";
			$ventaDia = $this->select($sql);
			$ventaDia['dia'] = $n_dia;
			$ventaDia['total'] = $ventaDia['total'] == "" ? 0 : $ventaDia['total'];
			$totalVentasMes += $ventaDia['total'];
			array_push($arrVentaDias, $ventaDia);
			$n_dia++;
		}
		$meses = Meses();
		$arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'total' => $totalVentasMes,'ventas' => $arrVentaDias );
		return $arrData;
	}
	public function selectVentasAnio(int $anio){
		$arrMVentas = array();
		$arrMeses = Meses();
		for ($i=1; $i <= 12; $i++) { 
			$arrData = array('anio'=>'','no_mes'=>'','mes'=>'','venta'=>'');
			$sql = "SELECT $anio AS anio, $i AS mes, SUM(TOTAL) AS venta 
					FROM tbl_ventas 
					WHERE MONTH(FECHA_CREACION)= $i AND YEAR(FECHA_CREACION) = $anio AND status = '1' 
					GROUP BY MONTH(FECHA_CREACION) ";
			$ventaMes = $this->select($sql);
			$arrData['mes'] = $arrMeses[$i-1];
			if(empty($ventaMes)){
				$arrData['anio'] = $anio;
				$arrData['no_mes'] = $i;
				$arrData['venta'] = 0;
			}else{
				$arrData['anio'] = $ventaMes['anio'];
				$arrData['no_mes'] = $ventaMes['mes'];
				$arrData['venta'] = $ventaMes['venta'];
			}
			array_push($arrMVentas, $arrData);
			# code...
		}
		$arrVentas = array('anio' => $anio, 'meses' => $arrMVentas);
		return $arrVentas;
	}
    
	}
 ?>
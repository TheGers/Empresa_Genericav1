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
// Programa:         Modulo de Personas
// Fecha:             23-febrero-2023
// Programador:       Elsy Maradiaga 
// descripcion:      Modulo que registra los datos de las personas(Cliente y Proveedor) 
////MODULO PERSONAS--------ELSY YOHANA MARADIAGA 
	class PersonasModel extends Mysql
	{
       //Tabla de personas
        private $intCOD_PERSONA;
        private $intCOD_TIPO_PERSONA;
        private $strNOMBRE;
        private $intGENERO;
        private $intFECHA_NACIMIENTO;
        private $intCOD_TIPO_IDENTIFICACION;
        private $intIDENTIFICACION;
        //tabla de direcciones
        private $intCOD_DIRECCION;
        private $intCOD_TELEFONO;
        private $intESTADO;
        private $intCOD_TIPO_DIRECCION;
        private $strCIUDAD;
        private $strCALLE;
        private $strCASA;
        private $strCOLONIA;
        private $strAVENIDA;
        private $strDIRECCION1;
        private $strDIRECCION2;
        //tabla de telefonos
        private $intCOD_TIPO_TELEFONO;
        private $intTELEFONO;
        private $intEXTENSION;
        private$intCODIGO_AREA;
   
    
        public function __construct(){
            parent::__construct();
        }
    //atraer todos los registros
        public function selectPersonas(){
            $sql = "SELECT a.COD_PERSONA,
             a.COD_TIPO_PERSONA,
             p.TIPO_PERSONA as tbl_tipo_persona,
            a.NOMBRE,
            a.GENERO,
            a.FECHA_NACIMIENTO,
            a.COD_TIPO_IDENTIFICACION,
            t.TIPO_IDENTIFICACION as tbl_tipo_identificacion,
            a.IDENTIFICACION,
            a.status 
             FROM tbl_personas a 
              INNER JOIN tbl_tipo_persona p
              ON a.COD_TIPO_PERSONA = p.idTipo
              INNER JOIN tbl_tipo_identificacion t
               ON a.COD_TIPO_IDENTIFICACION = t.id
                WHERE a.status != 0 ";
                 $request = $this->select_all($sql);
                 return $request;
		}
		public function selectDirecciones(){
            $sql = "SELECT a.COD_DIRECCION,
            a.COD_PERSONA,
            p.NOMBRE as tbl_personas,
			a.COD_TIPO_DIRECCION,
           t.TIPO_DIRECCION as tbl_tipo_direccion,
           a.CIUDAD,
           a.CALLE,
           a.CASA,
           a.COLONIA,
           a.AVENIDA,
           a.DIRECCION1,
		   a.DIRECCION2,
           a.status 
            FROM tbl_direccion a 
            INNER JOIN tbl_personas p
            ON a.COD_PERSONA = p.COD_PERSONA
             INNER JOIN tbl_tipo_direccion t
             ON a.COD_TIPO_DIRECCION = t.id
             WHERE a.status != 0 ";
              $request = $this->select_all($sql);
              return $request;
		}
    	public function selectTelefonos(){
            $sql = "SELECT a.COD_TELEFONO,
            a.COD_PERSONA,
            p.NOMBRE as tbl_personas,
			a.COD_TIPO_TELEFONO,
           t.TIPO_TELEFONO as tbl_tipo_telefono,
           a.TELEFONO,
           a.CODIGO_AREA,
           a.status 
           FROM tbl_telefono a 
           INNER JOIN tbl_personas p
           ON a.COD_PERSONA = p.COD_PERSONA
            INNER JOIN tbl_tipo_telefono t
             ON a.COD_TIPO_TELEFONO = t.id
             WHERE a.status != 0 ";
             $request = $this->select_all($sql);
             return $request;
		}
    //Opcion de eliminar
        public function deletePersona(int $COD_PERSONA){
			$this->intCOD_PERSONA = $COD_PERSONA;
			$sql = "UPDATE tbl_personas SET status = ? WHERE COD_PERSONA = $this->intCOD_PERSONA ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}
        public function deleteDireccion(int $COD_DIRECCION){
            $this->intCOD_DIRECCION = $COD_DIRECCION;
            $sql = "DELETE FROM tbl_direccion WHERE COD_DIRECCION = $this->intCOD_DIRECCION";
            $request = $this->delete($sql);
            return $request;
			
		}
        public function deleteTelefono(int $COD_TELEFONO){
            $this->intCOD_TELEFONO = $COD_TELEFONO;
            $sql = "DELETE FROM tbl_telefono WHERE COD_TELEFONO = $this->intCOD_TELEFONO";
            $request = $this->delete($sql);
            return $request;
        }
        
     
         //Opcio pára insertar los registros
		public function insertPersona(string $NOMBRE,int $GENERO,string $FECHA_NACIMIENTO,
        int $COD_TIPO_IDENTIFICACION,  int $IDENTIFICACION,int $COD_TIPO_PERSONA, int $status){
           $this->strNOMBRE = $NOMBRE;
           $this->intGENERO = $GENERO;
           $this->intFECHA_NACIMIENTO = $FECHA_NACIMIENTO;
           $this->intCOD_TIPO_IDENTIFICACION = $COD_TIPO_IDENTIFICACION;
           $this->intIDENTIFICACION = $IDENTIFICACION;
           $this->intCOD_TIPO_PERSONA = $COD_TIPO_PERSONA;
           $this->intESTADO = $status;
          
           $return = 0;
           $sql = "SELECT * FROM tbl_personas WHERE NOMBRE = '{$this->strNOMBRE}'";
           $request = $this->select_all($sql);
           if(empty($request))
           {
               $query_insert  = "INSERT INTO tbl_personas (
                                                       NOMBRE,
                                                       GENERO,
                                                       FECHA_NACIMIENTO,
                                                       COD_TIPO_IDENTIFICACION,
                                                       IDENTIFICACION,
                                                       COD_TIPO_PERSONA,
                                                       status) 
                                 VALUES(?,?,?,?,?,?,?)";
               $arrData = array(
                               $this->strNOMBRE,
                               $this->intGENERO,
                               $this->intFECHA_NACIMIENTO,
                               $this->intCOD_TIPO_IDENTIFICACION,
                               $this->intIDENTIFICACION,
                               $this->intCOD_TIPO_PERSONA,
                               $this->intESTADO);
               $request_insert = $this->insert($query_insert,$arrData);
               $return = $request_insert;
           }else{
               $return = "exist";
           }
           return $return;
       }

		public function insertDireccion(int $COD_TIPO_DIRECCION,string $CIUDAD,string $CALLE,
        string $CASA,string $COLONIA,  string $AVENIDA, string $DIRECCION1,string $DIRECCION2,int $status){
			$this->intCOD_TIPO_DIRECCION = $COD_TIPO_DIRECCION;
			$this->strCIUDAD = $CIUDAD;
			$this->strCALLE = $CALLE;
			$this->strCASA = $CASA;
            $this->strCOLONIA = $COLONIA;
            $this->strAVENIDA = $AVENIDA;
			$this->strDIRECCION1 = $DIRECCION1;
			$this->strDIRECCION2 = $DIRECCION2;
			$this->intESTADO = $status;
			$return = 0;
               // Obtener el último valor de COD_PERSONA insertado en tbl_personas
                $this->intCOD_PERSONA = $this->get_last_insert_COD_PERSONA();
			$sql = "SELECT * FROM tbl_direccion WHERE CASA = '{$this->strCASA}' AND DIRECCION1 = '{$this->strDIRECCION1}' AND DIRECCION2 = '{$this->strDIRECCION2}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_direccion (COD_TIPO_DIRECCION,
				COD_PERSONA,
														CIUDAD,
														CALLE,
														CASA,
														COLONIA,
                                                        AVENIDA,
														DIRECCION1,
														DIRECCION2,
														status) 
								  VALUES(?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intCOD_TIPO_DIRECCION,
				$this->get_last_insert_COD_PERSONA(),
        						$this->strCIUDAD,
								$this->strCALLE,
        						$this->strCASA,
        						$this->strCOLONIA,
								$this->strAVENIDA,
								$this->strDIRECCION1,
                                $this->strDIRECCION2,
        						$this->intESTADO);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
            
                
                
			}
	        return $return;
		}
      //Funcion que añade el ultimo registro de personas
        public function get_last_insert_COD_PERSONA(){
            $sql = "SELECT MAX(COD_PERSONA) as last_insert_id FROM tbl_personas";
             $request = $this->select($sql);
             return $request['last_insert_id'];}

        public function insertTelefono(int $COD_TIPO_TELEFONO,int $TELEFONO,int $CODIGO_AREA,int $status){
			$this->intCOD_TIPO_TELEFONO = $COD_TIPO_TELEFONO;
			$this->intTELEFONO = $TELEFONO;
            $this->intCODIGO_AREA = $CODIGO_AREA;
			$this->intESTADO = $status;
			$return = 0;
            $this->intCOD_PERSONA = $this->get_last_insert_COD_PERSONA();
			$sql = "SELECT * FROM tbl_telefono WHERE TELEFONO = '{$this->intTELEFONO}' ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO tbl_telefono (
				COD_PERSONA,
                COD_TIPO_TELEFONO,
                TELEFONO,
                CODIGO_AREA,
														status) 
								  VALUES(?,?,?,?,?)";
	        	$arrData = array($this->get_last_insert_COD_PERSONA(),
				$this->intCOD_TIPO_TELEFONO,
        						$this->intTELEFONO,
        						$this->intCODIGO_AREA,
        						$this->intESTADO);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}
	        return $return;
		}
      //Opcion para ver uno
        public function selectPersona(int $COD_PERSONA){
			$this->intCOD_PERSONA = $COD_PERSONA;
			$sql = "SELECT a.COD_PERSONA,
            a.COD_TIPO_PERSONA,
            p.TIPO_PERSONA as tbl_tipo_persona,
           a.NOMBRE,
           a.GENERO,
           a.FECHA_NACIMIENTO,
           a.COD_TIPO_IDENTIFICACION,
           t.TIPO_IDENTIFICACION as tbl_tipo_identificacion,
           a.IDENTIFICACION,
           a.status 
           FROM tbl_personas a 
           INNER JOIN tbl_tipo_persona p
           ON a.COD_TIPO_PERSONA = p.idTipo
            INNER JOIN tbl_tipo_identificacion t
            ON a.COD_TIPO_IDENTIFICACION = t.id
					WHERE COD_PERSONA = $this->intCOD_PERSONA";
			$request = $this->select($sql);
			return $request;

		}

		public function selectDireccion(int $COD_DIRECCION){
            $this->intCOD_DIRECCION = $COD_DIRECCION;
            $sql = "SELECT t1.COD_DIRECCION,
                    t1.COD_PERSONA,
                    t2.NOMBRE as tbl_personas,
                    t1.COD_TIPO_DIRECCION,
                    t3.TIPO_DIRECCION as tbl_tipo_direccion,
                    t1.CIUDAD,
                    t1.CALLE,
                    t1.CASA,
                    t1.COLONIA,
                    t1.AVENIDA,
                    t1.DIRECCION1,
                    t1.DIRECCION2,
                    t1.status 
                    FROM tbl_direccion t1 
                    INNER JOIN tbl_personas t2
                    ON t1.COD_PERSONA = t2.COD_PERSONA
                    INNER JOIN tbl_tipo_direccion t3
                    ON t1.COD_TIPO_DIRECCION = t3.id
                    WHERE t1.COD_PERSONA = $this->intCOD_DIRECCION"; // Modifica la condición para validar por COD_PERSONA
            $request = $this->select_all($sql);
            return $request;
        }
        
        public function selectTelefono(int $COD_TELEFONO){
			$this->intCOD_TELEFONO = $COD_TELEFONO;
			$sql = "SELECT a1.COD_TELEFONO,
            a1.COD_PERSONA,
            pt.NOMBRE as tbl_personas,
            a1.COD_TIPO_TELEFONO,
           te.TIPO_TELEFONO as tbl_tipo_telefono,
           a1.TELEFONO,
           a1.CODIGO_AREA,
           a1.status 
           FROM tbl_telefono a1 
            INNER JOIN tbl_personas pt
            ON a1.COD_PERSONA = pt.COD_PERSONA
            INNER JOIN tbl_tipo_telefono te
            ON a1.COD_TIPO_TELEFONO = te.id
					WHERE a1.COD_PERSONA = $this->intCOD_TELEFONO";
			$request = $this->select_all($sql);
			return $request;

		}
        //Opcion para el boton de actualizar
        public function updatePersona(int $COD_PERSONA,string $NOMBRE,int $GENERO,string $FECHA_NACIMIENTO,
        int $COD_TIPO_IDENTIFICACION,  int $IDENTIFICACION, int $COD_TIPO_PERSONA, int $status){
           $this->intCOD_PERSONA = $COD_PERSONA;
           $this->strNOMBRE = $NOMBRE;
           $this->intGENERO = $GENERO;
           $this->intFECHA_NACIMIENTO = $FECHA_NACIMIENTO;
           $this->intCOD_TIPO_IDENTIFICACION = $COD_TIPO_IDENTIFICACION;
           $this->intIDENTIFICACION = $IDENTIFICACION;
           $this->intCOD_TIPO_PERSONA = $COD_TIPO_PERSONA;
           $this->intESTADO = $status;
           $return = 0;
           $sql = "SELECT * FROM tbl_personas WHERE NOMBRE = '{$this->strNOMBRE}' ";
           $request = $this->select_all($sql);
           if(empty($request))
           {
               $sql = "UPDATE tbl_personas 
                       SET 
                       NOMBRE=?,
                       GENERO=?,
                       FECHA_NACIMIENTO=?,
                       COD_TIPO_IDENTIFICACION=?,
                       IDENTIFICACION=?,
                       COD_TIPO_PERSONA=?,
                           status=? 
                       WHERE COD_PERSONA = $this->intCOD_PERSONA ";
               $arrData = array(
                               $this->strNOMBRE,
                               $this->intGENERO,
                               $this->intFECHA_NACIMIENTO,
                               $this->intCOD_TIPO_IDENTIFICACION,
                               $this->intIDENTIFICACION,
                               $this->intCOD_TIPO_PERSONA,
                               $this->intESTADO);

               $request = $this->update($sql,$arrData);
               $return = $request;
           }else{
               $return = "exist";
           }
           return $return;
       }
       public function updateDireccion(int $COD_DIRECCION, int $COD_TIPO_DIRECCION,int $COD_PERSONA,string $CIUDAD,string $CALLE,
       string $CASA,string $COLONIA,  string $AVENIDA, string $DIRECCION1,string $DIRECCION2,int $status){
          $this->intCOD_DIRECCION = $COD_DIRECCION;
          $this->intCOD_TIPO_DIRECCION = $COD_TIPO_DIRECCION;
          $this->intCOD_PERSONA = $COD_PERSONA;
          $this->strCIUDAD = $CIUDAD;
          $this->strCALLE = $CALLE;
          $this->strCASA = $CASA;
          $this->strCOLONIA = $COLONIA;
          $this->strAVENIDA = $AVENIDA;
          $this->strDIRECCION1 = $DIRECCION1;
          $this->strDIRECCION2 = $DIRECCION2;
          $this->intESTADO = $status;
          $return = 0;
          $sql = "SELECT * FROM tbl_direccion WHERE CIUDAD = '{$this->strCIUDAD}' ";
          $request = $this->select_all($sql);
          if(empty($request))
          {
              $sql = "UPDATE tbl_direccion 
                      SET COD_TIPO_DIRECCION=?,
                      COD_PERSONA=?,
                      CIUDAD=?,
                      CALLE=?
                      CASA=?
                      COLONIA=?
                      AVENIDA=?
                      DIRECCION1=?
                      DIRECCION2=?
                          status=? 
                      WHERE COD_DIRECCION = $this->intCOD_DIRECCION ";
              $arrData = array($this->intCOD_TIPO_DIRECCION,
                              $this->intCOD_PERSONA,
                              $this->strCIUDAD,
                              $this->strCALLE,
                              $this->strCASA,
                              $this->strCOLONIA,
                              $this->strAVENIDA,
                              $this->strDIRECCION1,
                              $this->strDIRECCION2,
                              $this->intESTADO);

              $request = $this->update($sql,$arrData);
              $return = $request;
          }else{
              $return = "exist";
          }
          return $return;
      }
      public function updateTelefono(int $COD_PERSONA,int $COD_TIPO_TELEFONO,int $TELEFONO, int $EXTENSION,int $CODIGO_AREA,int $status){
        $this->intCOD_PERSONA = $COD_PERSONA;
			$this->intCOD_TIPO_TELEFONO = $COD_TIPO_TELEFONO;
			$this->intTELEFONO = $TELEFONO;
			$this->intEXTENSION = $EXTENSION;
            $this->intCODIGO_AREA = $CODIGO_AREA;
			$this->intESTADO = $status;
         $return = 0;
         $sql = "SELECT * FROM tbl_telefono WHERE TELEFONO = '{$this->intTELEFONO}' ";
         $request = $this->select_all($sql);
         if(empty($request))
         {
             $sql = "UPDATE tbl_telefono 
                     SET COD_DIRECCION=?,
                     intCOD_TIPO_TELEFONO=?,
                     intTELEFONO=?,
                     intEXTENSION=?,
                     intCODIGO_AREA=?,
                         status=? 
                     WHERE COD_TELEFONO = $this->intCOD_TELEFONO ";
             $arrData = array($this->intCOD_PERSONA,
                             $this->intCOD_TIPO_TELEFONO,
                             $this->intTELEFONO,
                             $this->intEXTENSION,
                             $this->intCODIGO_AREA,
                             $this->intESTADO);

             $request = $this->update($sql,$arrData);
             $return = $request;
         }else{
             $return = "exist";
         }
         return $return;
     }
     
     public function buscarPorNombre($valor)
     {
         $sql = "SELECT p.COD_PERSONA, p.NOMBRE, d1.DIRECCION1 ,t1.TELEFONO
                 FROM tbl_personas p 
                 LEFT JOIN tbl_direccion d1 ON p.COD_PERSONA = d1.COD_PERSONA 
                 LEFT JOIN tbl_telefono t1 ON p.COD_PERSONA = t1.COD_PERSONA 
                 WHERE p.NOMBRE LIKE '%" . $valor . "%' 
                       AND (p.COD_TIPO_PERSONA = 2 )
                 LIMIT 10";
         return $this->select_all($sql);
     }

     public function buscarCliente($valor)
    {
        $sql = "SELECT p.COD_PERSONA, p.NOMBRE, d1.DIRECCION1 ,t1.TELEFONO
                FROM tbl_personas p 
                LEFT JOIN tbl_direccion d1 ON p.COD_PERSONA = d1.COD_PERSONA 
                LEFT JOIN tbl_telefono t1 ON p.COD_PERSONA = t1.COD_PERSONA 
                WHERE p.NOMBRE LIKE '%" . $valor . "%' 
                      AND (p.COD_TIPO_PERSONA = 1 )
                LIMIT 10";
        return $this->select_all($sql);
    }
	}
 ?>
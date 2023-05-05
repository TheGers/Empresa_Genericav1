<?php 

	class RecuperacionModel extends Mysql
	{
		private $intCOD_PRREGUNTA;
		private $intCOD_USUARIO;
		private $strPREGUNTA;
		private $strRESPUESTA;

		public function __construct()
		{
			parent::__construct();
		}	

		public function Reseteo(string $COD_USUARIO, string $PREGUNTA, string $RESPUESTA)
{
    $this->intCOD_USUARIO = $COD_USUARIO;
    $this->strPREGUNTA = $PREGUNTA;
    $this->strRESPUESTA = $RESPUESTA;
    $sql = "SELECT COD_USUARIO,status FROM tbl_ms_preguntas_por_usuario WHERE 
            COD_USUARIO = '$this->intCOD_USUARIO' and 
            PREGUNTA = $this->strPREGUNTA and 
            RESPUESTA = '$this->strRESPUESTA' and 
            status != 0 ";
    $request = $this->select($sql);
    return $request;
}


		

		
	}
 ?>
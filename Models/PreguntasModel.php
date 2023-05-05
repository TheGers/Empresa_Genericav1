<?php

class PreguntasModel extends Mysql
{
    private $listUsuario;
    private $strPregunta;
    private $strRespuesta;
    private $intidPregunta;
    private $intstatus;
    private $intCOD_PRREGUNTA;
   

    // ---------------------------------- CONSTRUCTOR ---------------------------------

    public function __construct()
    {
        parent::__construct();
    }



    //insaertar de preguntaa
    public function inserPregunta(string $COD_USUARIO , string $PREGUNTA, string $RESPUESTA, int $status){

        $return = 0;
        $this->listUsuario = $COD_USUARIO;
        $this->strPregunta = $PREGUNTA;
        $this->strRespuesta = $RESPUESTA;
        $this->intstatus = $status;

        $sql = "SELECT * FROM tbl_ms_preguntas_por_usuario WHERE PREGUNTA = '{$this->strPregunta}' ";
        $request = $this->select_all($sql); //instancia sql y ejecucion de la misma

        

        if(empty($request))
        {
            $query_insert  = "INSERT INTO tbl_ms_preguntas_por_usuario(COD_USUARIO,PREGUNTA,RESPUESTA,status) VALUES(?,?,?,?)";
            $arrData = array($this->listUsuario, 
                             $this->strPregunta,  //validacion de datos en que seran insertados en la isntancia sql
                             $this->strRespuesta, 
                             $this->intstatus);
            $request_insert = $this->insert($query_insert,$arrData);
            $return = $request_insert;
        }else{
            $return = "exist";
        }
        return $return;
    }


    ////////////////////////

    public function selectPreguntas()//funcion de seleccionar la ifnromaciuon
    {
        $sql = "SELECT  COD_PRREGUNTA,
                        COD_USUARIO ,
                        PREGUNTA,
                        status
            FROM tbl_ms_preguntas_por_usuario WHERE status!=0 "; //instancia sql que trae los datos a se mostrados
            $request = $this->select_all($sql);
        return $request;
    }


    //rertornar para el modal de uptade
    public function selectPregunta(int $COD_PRREGUNTA){
        $this->intCOD_PRREGUNTA = $COD_PRREGUNTA;
        $sql = "SELECT * FROM tbl_ms_preguntas_por_usuario
                WHERE COD_PRREGUNTA = $this->intCOD_PRREGUNTA";
        $request = $this->select($sql);
        return $request;
    }

    public function updatePregunta(int $COD_PRREGUNTA, string $COD_USUARIO, string $PREGUNTA, string $RESPUESTA, int $status){ //funcion de actualizacion de datos
        $this->intCOD_PRREGUNTA = $COD_PRREGUNTA;
        $this->listUsuario = $COD_USUARIO;
        $this->strPregunta = $PREGUNTA; //equivalerncia de datos con las variables generales
        $this->strRespuesta = $RESPUESTA;
        $this->intstatus = $status;

        $sql = "SELECT * FROM tbl_ms_preguntas_por_usuario WHERE PREGUNTA = '{$this->strPregunta}' AND COD_PRREGUNTA != $this->intCOD_PRREGUNTA";
        $request = $this->select_all($sql); //instancia de sql y ejecucion de la misma

        if(empty($request))
        {
            $sql = "UPDATE tbl_ms_preguntas_por_usuario SET COD_USUARIO = ?, PREGUNTA = ?, RESPUESTA = ?, status = ? WHERE COD_PRREGUNTA = $this->intCOD_PRREGUNTA ";
            $arrData = array($this->listUsuario, 
                             $this->strPregunta, 
                             $this->strRespuesta, 
                             $this->intstatus); //instancia de sql y ejecucion de la misma con el orden de los datos que seran insertados
            $request = $this->update($sql,$arrData);
        }else{
            $request = "exist";
        }
        return $request;			
    }

    public function deletePregunta(int $idPregunta) //funcion de eliminar productos
    {
        $this->intidPregunta = $idPregunta;
        $sql = "SELECT * FROM tbl_ms_preguntas_por_usuario WHERE COD_PRREGUNTA  = $this->intidPregunta";
        $request = $this->select_all($sql);
        if(empty($request))
        {
            $sql = "UPDATE tbl_ms_preguntas_por_usuario SET status = ? WHERE COD_PRREGUNTA = $this->intidPregunta ";
            $arrData = array(0);
            $request = $this->update($sql,$arrData);
            if($request)
            {
                $request = 'ok';	
            }else{
                $request = 'error';
            }
        }else{
            $request = 'exist';
        }
        return $request;
    }	
   



}
?>
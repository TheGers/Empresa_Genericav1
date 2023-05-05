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
        $request = $this->select_all($sql);

        

        if(empty($request))
        {
            $query_insert  = "INSERT INTO tbl_ms_preguntas_por_usuario(COD_USUARIO,PREGUNTA,RESPUESTA,status) VALUES(?,?,?,?)";
            $arrData = array($this->listUsuario, 
                             $this->strPregunta, 
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

    public function selectPreguntas()
    {
        $sql = "SELECT  COD_PRREGUNTA,
                        COD_USUARIO ,
                        PREGUNTA,
                        status
            FROM tbl_ms_preguntas_por_usuario WHERE status!=0 ";
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

    public function updatePregunta(int $COD_PRREGUNTA, string $COD_USUARIO, string $PREGUNTA, string $RESPUESTA, int $status){
        $this->intCOD_PRREGUNTA = $COD_PRREGUNTA;
        $this->listUsuario = $COD_USUARIO;
        $this->strPregunta = $PREGUNTA;
        $this->strRespuesta = $RESPUESTA;
        $this->intstatus = $status;

        $sql = "SELECT * FROM tbl_ms_preguntas_por_usuario WHERE PREGUNTA = '{$this->strPregunta}' AND COD_PRREGUNTA != $this->intCOD_PRREGUNTA";
        $request = $this->select_all($sql);

        if(empty($request))
        {
            $sql = "UPDATE tbl_ms_preguntas_por_usuario SET COD_USUARIO = ?, PREGUNTA = ?, RESPUESTA = ?, status = ? WHERE COD_PRREGUNTA = $this->intCOD_PRREGUNTA ";
            $arrData = array($this->listUsuario, 
                             $this->strPregunta, 
                             $this->strRespuesta, 
                             $this->intstatus);
            $request = $this->update($sql,$arrData);
        }else{
            $request = "exist";
        }
        return $request;			
    }

    public function deletePregunta(int $idPregunta)
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
<?php
class Compra{

    private $idcompra;
    private $cofecha;
    private $objusuario;
    private $colcompraitems;
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompra="";
        $this->cofecha="";
        $this->objusuario="";
        $this->colcompraitems="";
        $this->mensajeoperacion="";        
    }

    public function getIdcompra(){
        return $this->idcompra;
    }

    public function setIdcompra($idcompra){
        $this->idcompra = $idcompra;
    }

    public function getCofecha(){
        return $this->cofecha;
    }

    public function setCofecha($cofecha){
        $this->cofecha = $cofecha;
    }

    public function getObjusuario(){
        return $this->objusuario;
    }

    public function setObjusuario($objusuario){
        $this->objusuario = $objusuario;
    }

    public function getColcompraitems(){
        return $this->colcompraitems;
    }

    public function setColcompraitems($colcompraitems){
        $this->colcompraitems = $colcompraitems;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idcompra,$cofecha,$objusuario){
        $this->setIdcompra($idcompra);
        $this->setCofecha($cofecha);
        $this->setObjusuario($objusuario);
    }


    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compra WHERE idcompra = ".$this->getIdcompra();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $idusuario = new Usuario();
                    $idusuario->setIdusuario($row['idusuario']);
                    $idusuario->cargar();
                    $this->setear($row['idcompra'], $row['cofecha'], $idusuario);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion("compra->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compra(idcompra,cofecha,idusuario)
            VALUES('".$this->getIdcompra()."','".$this->getCofecha()."','".$this->getObjusuario()->getIdusuario()."')";
            if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
            
                $resp = true;
            } else {
                $this->setmensajeoperacion("compra->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("compra->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compra SET idcompra='".$this->getIdcompra()."',cofecha='".$this->getCofecha().
        "',idusuario='".$this->getObjusuario()->getIdusuario()."'
        WHERE idcompra='".$this->getIdcompra()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("compra->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("compra->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compra WHERE idcompra=".$this->getIdcompra();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("compra->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("compra->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compra ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Producto();
                    $idusuario = new Usuario();
                    $idusuario->setIdusuario($row['idusuario']);
                    $idusuario->cargar();
                    $obj->setear($row['idcompra'], $row['cofecha'], $idusuario);
                    array_push($arreglo, $obj);
                }
    
            }
            
        } else {
            $this->setmensajeoperacion("compra->listar: ".$base->getError());
        }
    
        return $arreglo;
    }


}

?>
<?php

class Rol{
private $idrol; 
private $rodescript; 
private $mensajeoperacion;

public function __construct(){
    $this->idrol="";
    $this->rodescript="";
    $this->mensajeoperacion="";
}


public function getIdrol(){
return $this->idrol;
}


public function setIdrol($idrol){
$this->idrol = $idrol;

}

public function getRodescript(){
return $this->rodescript;
}


public function setRodescript($rodescript){
$this->rodescript = $rodescript;

}

public function setear($idrol,$rodescript){
    $this->setIdrol($idrol);
    $this->setRodescript($rodescript);
}

public function getmensajeoperacion(){
    return $this->mensajeoperacion;
    
}
public function setmensajeoperacion($valor){
    $this->mensajeoperacion = $valor;
    
}


public function cargar(){
    $resp = false;
    $base=new BaseDatos();
    $sql="SELECT * FROM rol WHERE idrol = ".$this->getIdrol();
    if ($base->Iniciar()) {
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                $row = $base->Registro();
                $this->setear($row['idrol'], $row['rodescript']);
                $resp=true;
            }
        }
    } else {
        $this->setmensajeoperacion("Rol->listar: ".$base->getError());
    }
    return $resp;
  
}


public function insertar(){
    $resp = false;
    $base=new BaseDatos();
    $sql="INSERT INTO rol(idrol,rodescript)
        VALUES('".$this->getIdrol()."','".$this->getRodescript()."' )";
        if ($base->Iniciar()) {
        if ($base->Ejecutar($sql)) {
          
            $resp = true;
        } else {
           $this->setmensajeoperacion("Rol->insertar: ".$base->getError());
        }
    } else {
       $this->setmensajeoperacion("Rol->insertar: ".$base->getError());
    }
    return $resp;
}

public function modificar(){
    $resp = false;
    $base=new BaseDatos();
    $sql="UPDATE rol SET idrol='".$this->getIdrol()."',rodescript='".$this->getRodescript()."'
     WHERE idrol='".$this->getIdrol()."'";
    if ($base->Iniciar()) {
        if ($base->Ejecutar($sql)) {
            $resp = true;
        } else {
            $this->setmensajeoperacion("Rol->modificar: ".$base->getError());
        }
    } else {
        $this->setmensajeoperacion("Rol->modificar: ".$base->getError());
    }
    return $resp;
}


public function eliminar(){
    $resp = false;
    $base=new BaseDatos();
    $sql="DELETE FROM rol WHERE idrol=".$this->getIdrol();
    if ($base->Iniciar()) {
        if ($base->Ejecutar($sql)) {
            return true;
        } else {
            $this->setmensajeoperacion("Rol->eliminar: ".$base->getError());
        }
    } else {
        $this->setmensajeoperacion("Rol->eliminar: ".$base->getError());
    }
    return $resp;
}

public static function listar($parametro){
    $arreglo = array();
    $base=new BaseDatos();
    $sql="SELECT * FROM rol ";
    
    if ($parametro!="") {
        $sql.='WHERE '.$parametro;
    }
    $res = $base->Ejecutar($sql);
    if($res>-1){
        if($res>0){
            
            while ($row = $base->Registro()){
                $obj= new Rol();
                $obj->setear($row['idrol'], $row['rodescript']);
                array_push($arreglo, $obj);
            }

        }
        
    } else {
        //$this->setmensajeoperacion("Rol->listar: ".$base->getError());
    }

    return $arreglo;
}


}
?>
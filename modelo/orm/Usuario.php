<?php
class Usuario{

    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;
    private $mensajeoperacion;

    public function __construct(){
        $this->idusuario="";
        $this->usnombre="";
        $this->uspass="";
        $this->usmail="";
        $this->usdeshabilitado=null;
        $this->mensajeoperacion="";        
    }


   public function getIdusuario(){
        return $this->idusuario;
    }

    
    public function setIdusuario($idusuario){
        $this->idusuario = $idusuario;

    }

    public function getUsnombre(){
        return $this->usnombre;
    }

    public function setUsnombre($usnombre){
        $this->usnombre = $usnombre;

    }

    public function getUspass(){
        return $this->uspass;
    }

    public function setUspass($uspass){
        $this->uspass = $uspass;

    }

    public function getUsmail(){
        return $this->usmail;
    }

    
    public function setUsmail($usmail){
        $this->usmail = $usmail;

    }

  
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;

    }

    public function getUsdeshabilitado(){
        return $this->usdeshabilitado;
    }

    
    public function setUsdeshabilitado($usdeshabilitado){
        $this->usdeshabilitado = $usdeshabilitado;

    }

    public function setear($idusuario,$usnombre,$uspass,$usmail,$usdeshabilitado){
        $this->setIdusuario($idusuario);
        $this->setUsnombre($usnombre);
        $this->setUspass($uspass);
        $this->setUsmail($usmail);
        $this->setUsdeshabilitado($usdeshabilitado);

    }

 
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario WHERE idusuario = ".$this->getIdusuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'],$row['usdeshabilitado']);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion("Usuario->listar: ".$base->getError());
        }
        return $resp;
      
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuario(idusuario,usnombre,uspass,usmail)
            VALUES('".$this->getIdusuario()."','".$this->getUsnombre()."','".$this->getUspass()."','".$this->getUsmail()."' )";
            if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
              
                $resp = true;
            } else {
               $this->setmensajeoperacion("Usuario->insertar: ".$base->getError());
            }
        } else {
           $this->setmensajeoperacion("Usuario->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE usuario SET idusuario='".$this->getIdusuario()."',usnombre='".$this->getUsnombre().
        "',uspass='".$this->getUspass()."',usmail='".$this->getUsmail()."',usdeshabilitado='".$this->getUsdeshabilitado()."'
         WHERE idusuario='".$this->getIdusuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Usuario->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuario WHERE idusuario=".$this->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Usuario->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Usuario();
                    $obj->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'],$row['usdeshabilitado']);
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
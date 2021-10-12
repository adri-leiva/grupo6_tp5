<?php
class UsuarioRol{

    private $obj_usuario;
    private $obj_rol;
    private $mensajeoperacion;

    public function __construct(){
        $this->obj_usuario= new Usuario();
        $this->obj_rol= new Rol();
        $this->mensajeoperacion="";
    }


    public function getObj_usuario(){
        return $this->obj_usuario;
    }

   
    public function setObj_usuario($obj_usuario){
        $this->obj_usuario = $obj_usuario;

    }

    public function getObj_rol(){
        return $this->obj_rol;
    }

    
    public function setObj_rol($obj_rol){
        $this->obj_rol = $obj_rol;

    }

    
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

   
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($obj_usuario,$obj_rol){
        $this->setObj_usuario($obj_usuario);
        $this->setObj_rol($obj_rol);
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol WHERE idusuario = ".$this->getObj_usuario()->getIdusuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $idusuario= new Usuario();
                    $idusuario->setIdusuario($row['idusuario']);
                    $idusuario->cargar();
                    $idrol= new Rol();
                    $idrol->setIdrol($row['idrol']);
                    $idrol->cargar();
                    $this->setear($idusuario, $idrol);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->listar: ".$base->getError());
        }
        return $resp;
      
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuariorol(idusuario,idrol)
            VALUES('".$this->getObj_usuario()->getIdusuario()."','".$this->getObj_rol()->getIdrol()."')";
            if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
              
                $resp = true;
            } else {
               $this->setmensajeoperacion("UsuarioRol->insertar: ".$base->getError());
            }
        } else {
           $this->setmensajeoperacion("UsuarioRol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE usuariorol SET idusuario='".$this->getObj_usuario()->getIdusuario()."',idrol='".$this->getObj_rol()->getIdrol().
        "' WHERE idusuario='".$this->getObj_usuario()->getIdusuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("UsuarioRol->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuariorol WHERE idusuario=".$this->getObj_usuario()->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("UsuarioRol->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    
                    $obj= new UsuarioRol();
                    $idusuario= new Usuario();
                    $idusuario->setIdusuario($row['idusuario']);
                    $idusuario->cargar();
                    $idrol= new Rol();
                    $idrol->setIdrol($row['idrol']);
                    $idrol->cargar();
                    $obj->setear($idusuario, $idrol);
                    
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
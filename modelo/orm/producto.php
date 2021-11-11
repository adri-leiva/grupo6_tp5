<?php
class Producto{

    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $precio;
    private $mensajeoperacion;

    public function __construct(){
        $this->idproducto="";
        $this->pronombre="";
        $this->prodetalle="";
        $this->procantstock="";
        $this->precio="";
        $this->mensajeoperacion="";        
    }

    public function getIdproducto(){
        return $this->idproducto;
    }

    public function setIdproducto($idproducto){
        $this->idproducto = $idproducto;
    }

    public function getPronombre(){
        return $this->pronombre;
    }

    public function setPronombre($pronombre){
        $this->pronombre = $pronombre;
    }

    public function getProdetalle(){
        return $this->prodetalle;
    }

    public function setProdetalle($prodetalle){
        $this->prodetalle = $prodetalle;
    }

    public function getProcantstock(){
        return $this->procantstock;
    }

    public function setProcantstock($procantstock){
        $this->procantstock = $procantstock;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;

    }

    public function setear($idproducto,$pronombre,$prodetalle,$procantstock,$precio){
        $this->setIdproducto($idproducto);
        $this->setPronombre($pronombre);
        $this->setProdetalle($prodetalle);
        $this->setProcantstock($procantstock);
        $this->setPrecio($precio);

    }


    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM producto WHERE idproducto = ".$this->getIdproducto();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'],$row['precio']);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion("producto->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO producto(idproducto,pronombre,prodetalle,procantstock,precio)
            VALUES('".$this->getIdproducto()."','".$this->getPronombre()."','".$this->getProdetalle()."','".$this->getProcantstock()."','".$this->getPrecio()."')";
            if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
            
                $resp = true;
            } else {
                $this->setmensajeoperacion("producto->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("producto->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE producto SET idproducto='".$this->getIdproducto()."',pronombre='".$this->getPronombre().
        "',prodetalle='".$this->getProdetalle()."',procantstock='".$this->getProcantstock()."',precio='".$this->getPrecio()."'
        WHERE idproducto='".$this->getIdproducto()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("producto->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("producto->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM producto WHERE idproducto=".$this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("producto->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("producto->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM producto ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Producto();
                    $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'],$row['precio']);
                    array_push($arreglo, $obj);
                }
    
            }
            
        } else {
            $this->setmensajeoperacion("producto->listar: ".$base->getError());
        }
    
        return $arreglo;
    }

}

?>
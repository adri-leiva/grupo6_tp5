<?php
class Compraitem{

    private $idcompraitem;
    private $objproducto;
    private $objcompra;
    private $cicantidad;
    private $preciototal;
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompraitem="";
        $this->objproducto="";
        $this->objcompra="";
        $this->cicantidad="";
        $this->preciototal="";
        $this->mensajeoperacion="";        
    }

    public function getIdcompraitem(){
        return $this->idcompraitem;
    }

    public function setIdcompraitem($idcompraitem){
        $this->idcompraitem = $idcompraitem;
    }

    public function getObjproducto(){
        return $this->objproducto;
    }

    public function setObjproducto($objproducto){
        $this->objproducto = $objproducto;
    }

    public function getObjcompra(){
        return $this->objcompra;
    }

    public function setObjcompra($objcompra){
        $this->objcompra = $objcompra;
    }

    public function getCicantidad(){
        return $this->cicantidad;
    }

    public function setCicantidad($cicantidad){
        $this->cicantidad = $cicantidad;
    }

    public function getPreciototal(){
        return $this->preciototal;
    }

    public function setPreciototal($preciototal){
        $this->preciototal = $preciototal;
    }
    
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;

    }

    public function setear($idcompraitem,$objproducto,$objcompra,$cicantidad,$preciototal){
        $this->setIdcompraitem($idcompraitem);
        $this->setObjproducto($objproducto);
        $this->setObjcompra($objcompra);
        $this->setCicantidad($cicantidad);
        $this->setPrecioTotal($preciototal);

    }


    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem WHERE idcompraitem = ".$this->getIdcompraitem();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $idprodcuto = new Producto();
                    $idprodcuto->setIdproducto($row['idproducto']);
                    $idprodcuto->cargar();
                    $idcompra = new Compra();
                    $idcompra->setIdcompra($row['idcompra']);
                    $idcompra->cargar();
                    $this->setear($row['idcompraitem'], $idprodcuto, $idcompra, $row['cicantidad'],$row['preciototal']);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion("compraitem->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compra(idcompraitem,idproducto,idcompra,cicantidad,preciototal)
            VALUES('".$this->getIdcompraitem()."','".$this->getObjproducto()->getIdproducto()."','".$this->getObjcompra()->getIdcompra()."','".$this->getCicantidad()."','".$this->getPreciototal()."')";
            if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
            
                $resp = true;
            } else {
                $this->setmensajeoperacion("compraitem->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("compraitem->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compraitem SET idcompraitem='".$this->getIdcompraitem()."',idproducto='".$this->getObjproducto()->getIdproducto().
        "',idcompra='".$this->getObjcompra()->getIdcompra()."',cicantidad='".$this->getCicantidad()."',preciototal='".$this->getPreciototal()."'
        WHERE idcompraitem='".$this->getIdcompraitem()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("compraitem->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("compraitem->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraitem WHERE idcompraitem=".$this->getIdcompraitem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("compraitem->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("compraitem->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Compraitem();
                    $idprodcuto = new Producto();
                    $idprodcuto->setIdproducto($row['idproducto']);
                    $idprodcuto->cargar();
                    $idcompra = new Compra();
                    $idcompra->setIdcompra($row['idcompra']);
                    $idcompra->cargar();
                    $obj->setear($row['idcompraitem'], $idprodcuto, $idcompra, $row['cicantidad'],$row['preciototal']);
                    array_push($arreglo, $obj);
                }
    
            }
            
        } else {
            $this->setmensajeoperacion("compraitem->listar: ".$base->getError());
        }
    
        return $arreglo;
    }


}

?>
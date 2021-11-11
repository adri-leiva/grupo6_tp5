<?php

class Abmcompraitem{

    private function cargarObjeto($param){
        $obj = null;
        
        if( array_key_exists('idcompraitem', $param)
        and array_key_exists('idproducto',$param)
        and array_key_exists('idcompra',$param)
        and array_key_exists('cicantidad',$param)
        and array_key_exists('preciototal',$param)){
            $obj= new Compraitem();
            $idproducto= new Producto();
            $idproducto->setIdproducto($param['idproducto']);
            $idcompra= new Compra();
            $idcompra->setIdcompra($param['idcompra']);
            $obj->setear($param['idcompraitem'],$idproducto, $idcompra, $param['cicantidad'], $param['preciototal']);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres
     *  de las variables instancias del objeto que son claves
     * @param array $param
     * @return Compraitem
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idcompraitem']) ){
            $obj= new Compraitem();
            $obj->setear($param['idcompraitem'],null,null,null,null);
        }
        return $obj;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraitem']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $elObjURol = $this->cargarObjeto($param);
        if ($elObjURol!=null and $elObjURol->insertar()){
            $resp = true;
        }
        return $resp;
        
    }
    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjRol = $this->cargarObjetoConClave($param);
            if ($elObjRol!=null and $elObjRol->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjeto($param);
            if($elObjtTabla!=null and $elObjtTabla->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * permite buscar un objeto
     * @param array $param
     * @return 
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if(isset($param['idcompraitem']))
                $where.=" and idcompraitem =".$param['idcompraitem'];
            if(isset($param['idproducto']))
                $where.=" and idproducto =".$param['idproducto'];
            if(isset($param['idcompra']))
                $where.=" and idcompra =".$param['idcompra'];
            if(isset($param['cicantidad']))
                $where.=" and cicantidad =".$param['cicantidad'];
            if(isset($param['preciototal']))
                $where.=" and preciototal =".$param['preciototal'];
        }
        $arreglo = Compraitem::listar($where);
        return $arreglo;
    }

}


?>
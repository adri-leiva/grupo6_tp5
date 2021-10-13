<?php

class ABMUsuariorol{

    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idusuario', $param)
        and array_key_exists('idrol',$param)){
            $obj= new UsuarioRol();
            $idusuario= new Usuario();
            $idusuario->setIdusuario($param['idusuario']);
            $idrol= new Rol();
            $idrol->setIdrol($param['idrol']);
            $obj->setear($idusuario, $idrol);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres
     *  de las variables instancias del objeto que son claves
     * @param array $param
     * @return Tabla
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idusuario']) ){
            $obj= new UsuarioRol();
            $idusuario= new Usuario();
            $idusuario->setIdusuario($param['idusuario']);
            $obj->setear($idusuario,null);
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
        if (isset($param['idusuario'])&& isset($param['idrol']))
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
            if  (isset($param['idusuario']))
                $where.=" and idusuario =".$param['idusuario'];
            if  (isset($param['idrol']))
                 $where.=" and idrol ='".$param['idrol']."'";
           
        }
        $arreglo = UsuarioRol::listar($where);
        return $arreglo;
    }









}






?>
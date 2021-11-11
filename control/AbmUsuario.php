<?php
class AbmUsuario
{
    /**
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $param["idUsuario"]=null;
        $param["usDeshabilitado"]=null;
        $objUs = $this->cargarObjeto($param);
        
        if ($objUs != null and $objUs->insertar()) {
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
            $objUs = $this->cargarObjetoConClave($param);
            $abmUR=new AbmUsuarioRol();
            $arrR=$abmUR->buscar(["idUsuario"=>$param['idUsuario']]);
            foreach($arrR as $ur){
                $abmUR->baja(["idUsuario"=>$ur->getObjUsuario()->getIdUsuario(),"idRol"=>$ur->getObjRol()->getIdRol()]);
            }
            if ($objUs!=null and $objUs->eliminar()){
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
    public function modificacion($param)
    {
        $resp = false;
        
        if ($this->seteadosCamposClaves($param)) {
            $objUs = $this->cargarObjeto($param);
            if ($objUs != null and $objUs->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idUsuario']))
                $where .= " and idUsuario ='" . $param['idUsuario'] . "'";
            if (isset($param['usNombre']))
                $where .= " and usNombre ='" . $param['usNombre'] . "'";
            if (isset($param['usPass']))
                $where .= " and usPass ='" . $param['usPass'] . "'";
            if (isset($param['usMail']))
                $where .= " and usMail ='" . $param['usMail'] . "'";
            if (isset($param['usDeshabilitado']))
                $where .= " and usDeshabilitado ='" . $param['usDeshabilitado'] . "'";
        }
        // echo "<br>WHERE : " . $where."<br>";
        $arreglo = Usuario::listar($where);
        // print_r($arreglo);
        return $arreglo;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */
    public function cargarObjeto($param)
    {
        $obj = null;
        
        if (array_key_exists('idUsuario', $param) && array_key_exists('usNombre', $param)&& array_key_exists('usPass', $param)&& array_key_exists('usMail', $param)&& array_key_exists('usDeshabilitado', $param) ) {
                $obj = new Usuario();
                $obj->setear(["idUsuario" =>$param["idUsuario"], "usNombre" => $param["usNombre"], "usPass" => $param["usPass"], "usMail" => $param["usMail"], "usDeshabilitado" => $param["usDeshabilitado"]]);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idUsuario'])) {
            $obj = new Usuario();
            $obj->setear(["idUsuario" =>$param["idUsuario"], "usNombre" => null, "usPass" =>null, "usMail" =>null, "usDeshabilitado" => null]);
        }
        return $obj;
    }


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idUsuario']))
            $resp = true;
        return $resp;
    }
}

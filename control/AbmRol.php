<?php
class AbmRol
{
    /**
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $param["idRol"]=null;
        $objRol = $this->cargarObjeto($param);
        if ($objRol != null and $objRol->insertar()) {
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
            $objRol = $this->cargarObjetoConClave($param);
            $abmUR=new AbmUsuarioRol();
            $arrR=$abmUR->buscar(["idRol"=>$param['idRol']]);
            foreach($arrR as $ur){
                $abmUR->baja(["idUsuario"=>$ur->getObjUsuario()->getIdUsuario(),"idRol"=>$ur->getObjRol()->getIdRol()]);
            }
            if ($objRol!=null and $objRol->eliminar()){
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
            echo"<br>Campos clave seteados";
            $objRol = $this->cargarObjeto($param);
            echo"<br> objeto cargado";
            if ($objRol != null and $objRol->modificar()) {
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
            if (isset($param['idRol']))
                $where .= " and idRol ='" . $param['idRol'] . "'";
            if (isset($param['descripcionRol']))
                $where .= " and descripcionRol ='" . $param['descripcionRol'] . "'";
        }
        //echo "WHERE : " . $where;
        $arreglo = Rol::listar($where);
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
        if (array_key_exists('idRol', $param) && array_key_exists('descripcionRol', $param) ) {
                $obj = new Rol();
                $obj->setear(["idRol" =>$param["idRol"], "descripcionRol" => $param["descripcionRol"]]);
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
        if (isset($param['idRol'])) {
            $obj = new Rol();
            $obj->setear(["idRol" => $param["idRol"], "descripcionRol" => null]);
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
        if (isset($param['idRol']))
            $resp = true;
        return $resp;
    }
}

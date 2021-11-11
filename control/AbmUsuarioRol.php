<?php
class AbmUsuarioRol
{
    /**
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $objUR = $this->cargarObjeto($param);
        // echo"<br> param ".print_r($param);
        // echo"<br>".print_r($objUR);
        if ($objUR != null and $objUR->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objUR = $this->cargarObjetoConClave($param);
            if ($objUR != null and $objUR->eliminar()) {
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
            $objUR = $this->cargarObjeto($param);
            if ($objUR != null and $objUR->modificar()) {
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
            if (isset($param['idRol']))
                $where .= " and idRol ='" . $param['idRol'] . "'";
        }
        //echo "WHERE : " . $where;
        $arreglo = UsuarioRol::listar($where);
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
        if (array_key_exists('idUsuario', $param) and array_key_exists('idRol', $param) ) {
                $obj = new UsuarioRol();
                $abmUs=new AbmUsuario();
                $objUs=$abmUs->buscar(["idUsuario"=>$param["idUsuario"]]);
                $abmR=new AbmRol();
                $objR=$abmR->buscar(["idRol"=>$param["idRol"]]);
                $obj->setear(["objUsuario" => $objUs[0], "objRol" => $objR[0]]);
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
        if (isset($param['idUsuario']) && isset($param['idRol'])) {
            $obj = new UsuarioRol();
            $abmUs=new AbmUsuario();
                $objUs=$abmUs->buscar(["idUsuario"=>$param["idUsuario"]]);
                $abmR=new AbmRol();
                $objR=$abmR->buscar(["idRol"=>$param["idRol"]]);
                $obj->setear(["objUsuario" => $objUs[0], "objRol" => $objR[0]]);
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
        if (isset($param['idUsuario']) && isset($param['idRol']))
            $resp = true;
        return $resp;
    }
}

<?php
class Usuario
{
    //Atributos de clase
    /** 
     * @var int $idUsuario
     * @var string $usNombre
     * @var string $usPass   //CAMBIAR A STRING
     * @var string $usMail
     * @var DateTime $usDeshabilitado
     */

    private $idUsuario;
    private $usNombre;
    private $usPass;
    private $usMail;
    private $usDeshabilitado;
    private $mensajeoperacion;

    /** Constructor de la clase */
    public function __construct()
    {
        $this->idUsuario = 0;
        $this->usNombre = "";
        $this->usPass = 0;  
        $this->usMail = "";
        $this->usDeshabilitado=NULL;
    }

    /** 
     * Setea un on objeto
     * @param array
     */
    public function setear($datos)
    {
        $this->setIdUsuario($datos["idUsuario"]);
        $this->setUsNombre($datos["usNombre"]);
        $this->setUsPass($datos["usPass"]);
        $this->setUsMail($datos["usMail"]);
        $this->setUsDeshabilitado($datos["usDeshabilitado"]);
    }

    //METODOS DE ACCESO
    //Retornan el valor de los atributos de la clase 
    /** @return int */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    /** @return string*/
    public function getUsNombre()
    {
        return $this->usNombre;
    }
    /** @return string */
    public function getUsPass()
    {
        return $this->usPass;
    }
    /** @return string */
    public function getUsMail()
    {
        return $this->usMail;
    }
    /** @return DataTime */
    public function getUsDeshabilitado()
    {
        return $this->usDeshabilitado;
    }
    /** @return string  */
    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }

    //Modifican los atributos de clase
    /** @param int $idUs */
    public function setIdUsuario($idUs)
    {
        $this->idUsuario = $idUs;
    }
    /** @param string $usNom */
    public function setUsNombre($usNom)
    {
        $this->usNombre = $usNom;
    }
    /** @param string $usPas */
    public function setUsPass($usPas)
    {
        $this->usPass = $usPas;
    }
    /** @param string $usMl */
    public function setUsMail($usMl)
    {
        $this->usMail = $usMl;
    }
    /** @param string $usDes */
    public function setUsDeshabilitado($usDes)
    {
        $this->usDeshabilitado = $usDes;
    }
    /** @param string $menaje */
    public function setMensajeOperacion($menaje)
    {
        $this->mensajeoperacion = $menaje;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario WHERE idUsuario = " . $this->getIdUsuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear(["idUsuario" => $row["idUsuario"], "usNombre" => $row["usNombre"], "usPass" => $row["usPass"], "usMail" => $row["usMail"], "usDeshabilitado" => $row["usDeshabilitado"]]);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion( $base->getError());
        }
        return $resp;
    }

    /**
     * Inserta una funcion en la BD
     * @return boolean 
     */
    public function insertar()
    {
        /**
         * @var object $base
         * @var boolean $resp
         * @var string $sql
         */
        $base = new BaseDatos();
        $resp = false;
        $sql = "INSERT INTO usuario (usNombre, usPass ,usMail) 
				VALUES (" . "'" . $this->getUsNombre() . "','" . $this->getUsPass() . "','" . $this->getUsMail() . "')";
                // echo"<br> CONSULTA insert ".$sql;
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdUsuario($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    /**
     * Realiza una modificacion de un registro de la BD
     * @return boolean 
     */
    public function modificar()
    {
        /**
         * @var boolean $resp
         * @var object $base
         * @var string $sql
         */
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuario SET usNombre='" . $this->getUsNombre() . "',usPass='" . $this->getUsPass() . "'
                           ,usMail='" . $this->getUsMail() ."',usDeshabilitado='" . $this->getUsDeshabilitado() ."' WHERE idUsuario=" .  $this->getIdUsuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    /**
     * Elimina un registro de la BD
     * @return boolean 
     */
    public function eliminar()
    {
        /**
         * @var object $base
         * @var boolean $resp
         * @var string $sql
         */
        $base = new BaseDatos();
        $resp = false;
        $sql = "DELETE FROM usuario WHERE idUsuario='"  . $this->getIdUsuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }


    /**
     * Retorna un array de funciones que cumplan con una determinada condicion
     * @param string 
     * @return array
     */
    public static function listar($condicion = "")
    {
        /**
         * @var string $sql
         * @var object $base
         * @var array $arrU
         */
        $arrU = array();
        $base = new BaseDatos();
        $sql = "Select * from usuario";
        if ($condicion != "") {
            $sql = $sql . ' where ' . $condicion;
        }
        $sql .= " order by idUsuario ";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $base->Registro()) {
                        $obj = new Usuario();
                        $obj->setear(["idUsuario" => $row["idUsuario"], "usNombre" => $row["usNombre"], "usPass" => $row["usPass"], "usMail" => $row["usMail"],"usDeshabilitado" => $row["usDeshabilitado"]]);
                        array_push($arrU, $obj);
                    }
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arrU;
    }
}

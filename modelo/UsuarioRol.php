<?php
class UsuarioRol
{
    //Atributos de clase
    /** 
     * @var object $objUsuario
     * @var object $objRol
     */

    private $objUsuario;
    private $objRol;
    private $mensajeoperacion;

    /** Constructor de la clase */
    public function __construct()
    {
        $this->objUsuario = null;
        $this->objRol = null;
    }

    /** 
     * Setea un on objeto
     * @param array
     */
    public function setear($datos)
    {
        $this->setObjUsuario($datos["objUsuario"]);
        $this->setObjRol($datos["objRol"]);
    }

    //METODOS DE ACCESO
    //Retornan el valor de los atributos de la clase 
    /** @return object */
    public function getObjUsuario()
    {
        return $this->objUsuario;
    }
    /** @return object*/
    public function getObjRol()
    {
        return $this->objRol;
    }
    /** @return string  */
    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }

    //Modifican los atributos de clase
    /** @param object $usuario */
    public function setObjUsuario($usuario)
    {
        $this->objUsuario = $usuario;
    }
    /** @param object $rol */
    public function setObjRol($rol)
    {
        $this->objRol = $rol;
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
        $sql = "SELECT * FROM usuariorol WHERE idUsuario = " . $this->getObjUsuario()->getIdUsuario()." AND idRol=".$this->getObjRol()->getIdRol() ;
        // echo "<br>CONSULTA ".$sql."<br>";
        if ($base->Iniciar()) {
            // echo"Entro al INICIAR<br>";
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    // echo"Encontro registro <br>";
                    $row = $base->Registro();
                    $usuario=new Usuario();
                    $rol=new Rol();
                    $usuario->setIdUsuario($row["idUsuario"]);
                    $usuario->cargar();
                    $rol->setIdRol($row["idRol"]);
                    $rol->cargar();

                    $this->setear(["objUsuario" => $usuario, "objRol" => $rol]);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion( $base->getError());
        }
        // if($resp){
        //     echo"True";
        // }else{
        //     echo"False";
        // }
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
        $sql = "INSERT INTO usuariorol (idUsuario,idRol) 
				VALUES (" . $this->getObjUsuario()->getIdUsuario() . "," . $this->getObjRol()->getIdRol() . ")";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    // /**
    //  * Realiza una modificacion de un registro de la BD
    //  * @return boolean 
    //  */
    // public function modificar()
    // {
    //     /**
    //      * @var boolean $resp
    //      * @var object $base
    //      * @var string $sql
    //      */
    //     $resp = false;
    //     $base = new BaseDatos();
    //     $sql = "UPDATE usuario SET usNombre='" . $this->getUsNombre() . "',usPass=" . $this->getUsPass() . "
    //                        ,usMail='" . $this->getUsMail() ."',usDeshabilitado='" . $this->getUsDeshabilitado() ."' WHERE idUsuario=" .  $this->getIdUsuario();
    //    //echo "<br>CONSULTA ".$sql."<br>";
    //     if ($base->Iniciar()) {
    //         if ($base->Ejecutar($sql)) {
    //             $resp =  true;
    //         } else {
    //             $this->setmensajeoperacion($base->getError());
    //         }
    //     } else {
    //         $this->setmensajeoperacion($base->getError());
    //     }
    //     return $resp;
    // }

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
        $sql = "DELETE FROM usuariorol WHERE idUsuario="  . $this->getObjUsuario()->getIdUsuario()." AND idRol=".$this->getObjRol()->getIdRol() ;
        // echo"<br> Consulta Delete ".$sql;
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
         * @var array $arrUR
         */
        $arrUR = array();
        $base = new BaseDatos();
        $sql = "Select * from usuariorol";
        if ($condicion != "") {
            $sql = $sql . ' where ' . $condicion;
        }
        $sql .= " order by idUsuario ";
        // echo"<br>CONSULTA Select ".$sql;
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $base->Registro()) {
                        $objUR = new UsuarioRol();
                        $usuario=new Usuario();
                        $rol=new Rol();
                        $usuario->setIdUsuario($row["idUsuario"]);
                        $usuario->cargar();
                        $rol->setIdRol($row["idRol"]);
                        $rol->cargar();
                        $objUR->setear(["objUsuario" => $usuario, "objRol" => $rol]);
                        array_push($arrUR, $objUR);
                    }
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arrUR;
    }
}

<?php
class Producto
{
    //Atributos de clase
    /** 
     * @var int $compra
     * @var dateTime $cofecha
     * @var Usuario usuario
     */

    private $compra;
    private $cofecha;
    private $usuario;
    private $mensajeoperacion;

    /** Constructor de la clase */
    public function __construct()
    {
        $this->compra = 0;
        $this->cofecha = "";
    }

    /** 
     * Setea un on objeto
     * @param array
     */
    public function setear($datos)
    {
        $this->setcompra($datos["compra"]);
        $this->setcofecha($datos["cofecha"]);
    }

    //METODOS DE ACCESO
    //Retornan el valor de los atributos de la clase 
    /** @return int */
    public function getcompra()
    {
        return $this->compra;
    }
    /** @return string*/
    public function getcofecha()
    {
        return $this->cofecha;
    }
    /** @return string  */
    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }

    //Modifican los atributos de clase
    /** @param int $idR */
    public function setcompra($idR)
    {
        $this->compra = $idR;
    }
    /** @param string $desc */
    public function setcofecha($desc)
    {
        $this->cofecha = $desc;
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
        $sql = "SELECT * FROM rol WHERE compra = " . $this->getcompra();
        // echo "<br>CONSULTA ".$sql."<br>";
        if ($base->Iniciar()) {
            // echo"Entro al INICIAR<br>";
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    // echo"Encontro registro <br>";
                    $row = $base->Registro();
                    $this->setear(["compra" => $row["compra"], "cofecha" => $row["cofecha"]]);
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
        $sql = "INSERT INTO rol (cofecha) 
				VALUES (" . "'" . $this->getcofecha() . "')";
                //echo"<br> Consulta insertar ".$sql;
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setcompra($elid);
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
        $sql = "UPDATE rol SET cofecha='" . $this->getcofecha() ."' WHERE compra=" .  $this->getcompra();
       echo "<br>CONSULTA ".$sql."<br>";
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
        $sql = "DELETE FROM rol WHERE compra='"  . $this->getcompra()."'";
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
         * @var array $arrR
         */
        $arrR = array();
        $base = new BaseDatos();
        $sql = "Select * from rol";
        if ($condicion != "") {
            $sql = $sql . ' where ' . $condicion;
        }
        $sql .= " order by compra ";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $base->Registro()) {
                        $obj = new Rol();
                        $obj->setear(["compra" => $row["compra"], "cofecha" => $row["cofecha"]]);
                        array_push($arrR, $obj);
                    }
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arrR;
    }
}

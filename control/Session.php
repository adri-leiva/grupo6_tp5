<?php


class Session {

   
    private $BASEDATOS;
    private $ERROR;

    public function __construct() {
        session_start();
       
    }
    
    
    /**
     * Inicia una nueva sesion de usuario si el usuario y el Clave son correctos
     *
     * @param string $nombreUsuario
     * @param string $Clave
     */
    public function iniciar($nombreUsuario, $Clave) {
        $_SESSION['usnombre'] = $nombreUsuario;
        $_SESSION['uspass'] = md5($Clave);
        $_SESSION['activa'] = false;
    }

    /**
     * Valida que hay una sesion iniciada y es correcta
     *
     */
    public function validar() {
        if (isset($_SESSION['usnombre'])) {
            $nombreUsuario = $_SESSION['usnombre'];
        } else {
            $this->ERROR = 'no esta seteado el nombre de usuario';
            return false;
        }
        if (isset($_SESSION['uspass'])) {
            $Clave = $_SESSION['uspass'];
        } else {
            $this->ERROR = 'no esta seteada la clave';
            return false;
        }
        try {
            $this->BASEDATOS = new PDOConfig();
            /**
             * comentar esta linea para ver ejemplo inyección de código sql.
             */
            $nombreUsuario=$this->BASEDATOS->filtrar($nombreUsuario);
            $sql = "select Clave,Rol as Rol from Usuarios, Roles
				where Usuarios.idRol=Roles.idRol and NombreUsuario='".$nombreUsuario."'";
            if (!$resultado = $this->BASEDATOS->query($sql)) {
                $this->ERROR = 'Error Consulta Base de datos';
                return false;
            } else {
                if (!($row = $resultado->fetch(PDO::FETCH_ASSOC))) {
                    $this->ERROR = 'Usuario erroneo';
                    return false;
                } else {
                    if ($row['Clave'] != $Clave) {
                        $this->ERROR = 'Clave erronea';
                        return false;
                    } else {
                        $_SESSION['activa'] = true;
                        $_SESSION['Rol'] = $row['Rol'];
                        return true;
                    }
                }
            }
        } catch (Exception $e) {
            $this->ERROR = 'Error de Base de Datos ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Devuelve el verdadero si hay una sesión activa y falso en caso contrario
     * 
     * @return boolean activa y false si no está activa o no se encuetra seteado
     */
    public function activa() {
        if (isset($_SESSION['activa'])) {
            return $_SESSION['activa'];
        } else {
            $this->ERROR = 'No tiene sesión activa';
            return false;
        }
    }

    /**
     * Cierra la session actual
     *
     * @return boolean
     */
    public function cerrar() {
        if (!session_destroy()) {
            $this->ERROR = 'No se puede cerrar la sesion';
            return false;
        } else {
            return true;
        }
    }

    /**
     * Devuelve el mensaje de error
     *
     * @return string
     */
    public function getError() {
        return $this->ERROR;
    }

    /**
     * Devuelve el nombre de usuario de la sesión
     * 
     * @return string Nombre de usuario y false si no está activa o no se encuetra seteado
     */
    public function getNombreUsuario() {
        if ($this->activa()) {
            if (isset($_SESSION['nombreUsuario'])) {
                return $_SESSION['nombreUsuario'];
            } else {
                $this->ERROR = 'No está seteado el nombre de usuario';
                return false;
            }
        } else {
            $this->ERROR = 'No tiene una sección activa';
            return false;
        }
    }

    /**
     * Devuelve el Rol asignado al usuario de la sesión
     * 
     * @return string Rol y false si no está activa o no se encuetra seteado
     */
    public function getRol() {
        if ($this->activa()) {
            if (isset($_SESSION['Rol'])) {
                return $_SESSION['Rol'];
            } else {
                $this->ERROR = 'No está seteado el Rol';
                return false;
            }
        } else {
            $this->ERROR = 'No tiene una sección activa';
            return false;
        }
    }



}


?>
<?php


class Session {

   
  

    public function __construct() {
        session_start();
       
    }
        
    
    public function iniciar($nombreUsuario, $Clave) {
        $iniciar=array();
        if(isset($nombreUsuario) && isset($Clave)){
        $_SESSION['usnombre'] = $nombreUsuario;
        $_SESSION['uspass'] =md5($Clave);
        $iniciar=$_SESSION;
        
    }
    return $iniciar;
    }

    /**
     * Valida que hay una sesion iniciada y es correcta
     *
     */
    public function validar($param) {
        $iniciar=$this->iniciar($param['usnombre'],$param['uspass']);
        $validarSesion=false;
        $abmusuario= new ABMUsuario();
        $arregloObjUsuario= $abmusuario->buscar($iniciar);
            if(count($arregloObjUsuario)>0){
            if($arregloObjUsuario[0]->getUsdeshabilitado()==NULL || $arregloObjUsuario[0]->getUsdeshabilitado()=="0000-00-00 00:00:00"){
                $_SESSION['idusuario']=$arregloObjUsuario[0]->getIdusuario();
                $validarSesion=true;
            }

        }
     return $validarSesion;
        
    }

    /**
     * Devuelve el verdadero si hay una sesión activa y falso en caso contrario
     * 
     * @return boolean activa y false si no está activa o no se encuetra seteado
     */
    public function activa() {
        $retorno=false;
        if (isset($_SESSION['idusuario'])) {
            $retorno= true;
        } else {
            $this->ERROR = 'No tiene sesión activa';
            $retorno= false;
        }
        return $retorno;
    }

    /** devuelve el usuario logeado */

    public function getUsuario(){
        $Objusuario=null;
        $abmusuario=new ABMUsuario();
        $buscarusuario= $abmusuario->buscar(['idusuario'=>$_SESSION['idusuario']]);
        if(count($buscarusuario)){
            $Objusuario=$buscarusuario[0];
        }
        return $Objusuario;

    }

    /** devuelve una coleccion de arreglo de roles de usuario */
    public function getRol(){
        $idusuario=array();
        $idusuario['idusuario'] = $_SESSION['idusuario'];
        $abmusRol= new ABMUsuariorol();
        $roles= $abmusRol->buscar($idusuario);
        $rolesusuario=array();
        foreach($roles as $rolusuario){
            array_push($rolesusuario,$rolusuario->getObj_rol()->getRodescript());
        }

        return $rolesusuario;
    }



    /**
     * Cierra la session actual
     *
     * @return boolean
     */
    public function cerrar() {
        $sesion=true;
        if (!session_destroy()) {
            $this->ERROR = 'No se puede cerrar la sesion';
            $sesion=false;
        } 
        return $sesion;
    }

     


}


?>
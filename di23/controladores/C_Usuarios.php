<?php
    require_once 'controladores/Controlador.php';
    require_once 'vistas/Vista.php';
    require_once 'modelos/M_Usuarios.php';    

    class C_Usuarios extends Controlador{

        private $modelo;

        public function __construct(){
            parent::__construct();
            $this->modelo=new M_Usuarios();
        }

        public function validarUsuario($filtros){
            $valido = 'N';
            $usuario = $this->modelo->buscarUsuarios($filtros);
            if (!empty($usuario['usuarios'][0])) {
                $passwordGuardada = $usuario['usuarios'][0]['pass'];
                $passwordIngresada = $filtros['pass'];

                if ($passwordGuardada === md5($passwordIngresada)) {
                    $valido = 'S';
                    $_SESSION['usuario'] = $usuario['usuarios'][0]['login'];
                    $_SESSION['permisosUsuarios'] = $this->modelo->permisosUsuarios($usuario['usuarios'][0]['id_Usuario']);
                }
            }
            return $valido;
        }
        
        

        public function getVistaUsuarios($filtros=array()){
            $usuarios=$this->modelo->buscarUsuarios($filtros);
            Vista::render('vistas/Usuarios/V_Usuarios.php');
        }

        public function buscarUsuarios($filtros=array()){
            $datosUsuarios = $this->modelo->buscarUsuarios($filtros);
            $totalResultados = $datosUsuarios['totalResultados'];
            $totalPaginas = $datosUsuarios['totalPaginas'];
            Vista::render('vistas/Usuarios/V_Usuarios_Listado.php', [
                'usuarios' => $datosUsuarios['usuarios'],
                'totalResultados' => $totalResultados,
                'totalPaginas' => $totalPaginas
            ]);
        }

        
         public function insertarAndUpdaterUsuario($parametro=array()){
         $resultado = $this->modelo->insertarAndUpdaterUsuario($parametro);
         }
        
    }
?>


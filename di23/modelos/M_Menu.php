<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';

class M_Menu extends Modelo
{
    public $DAO;
    public function __construct()
    {
        parent::__construct();
        $this->DAO = new DAO();
    }

    public function sacarMenu($filtros = array())
    {
        $menuSQL = "SELECT * FROM MENU WHERE 1=1 ";
        $menu = $this->DAO->consultar($menuSQL);



        // Devolver ambos conjuntos de datos en un arreglo asociativo
        return array('menu' => $menu);
    }

    public function sacarRolesyUsuarios($filtros = array())
    {
        $SQL = "SELECT id_rol, rol FROM ROLES WHERE 1=1";
        $roles = $this->DAO->consultar($SQL);
        $SQL = "SELECT id_Usuario, nombre  FROM USUARIOS WHERE 1=1 ";
        $usuarios = $this->DAO->consultar($SQL);
        return array('roles' => $roles, 'usuarios' => $usuarios);
    }

    public function listaMenus($filtros = array())
    {
        $SQL = "SELECT * FROM MENU WHERE 1=1 ";
        $menu = $this->DAO->consultar($SQL);
        return $menu;
    }

    public function insertarAndUpdaterMenu($filtros = array())
    {
        var_dump($filtros);
        $SQL = "UPDATE MENU SET titulo ='" . $filtros['titulo'] . "' where id_menu = " . $filtros['id_menu'];
        $menu = $this->DAO->actualizar($SQL);
        return $menu;
    }
    public function getMenuId($filtros = array())
    {
        if (!empty ($filtros['id_menu'])) {
            $SQL = "SELECT * FROM MENU WHERE id_menu = " . $filtros['id_menu'];
            $menu = $this->DAO->consultar($SQL);
            return $menu;
        } else {
            return array();
        }
    }

    public function crearOpcionesMenu($filtros = array())
    {

        if (!empty ($filtros['id_menu'])) {

            $SQL = "SELECT MAX(orden) as maxOrden FROM MENU";
            $result = $this->DAO->consultar($SQL);


            $nextOrden = $result[0]['maxOrden'] + 1;


            $filtros['orden'] = $nextOrden;

            $menu = $this->getMenuId($filtros);
            return ['menu2' => $menu, 'nextOrden' => $nextOrden];
        } else {

            return array();
        }

    }

    public function insertarnuevaOpcionMenu($filtros = array())
    {
        $SQL = "INSERT INTO MENU (id_menu, titulo, id_padre, accion, orden, privado) VALUES (" . $filtros['id_menu'] . ", '" . $filtros['titulo'] . "', " . $filtros['id_padre'] . ", '" . addslashes($filtros['accion']) . "', " . $filtros['orden'] . ", '" . $filtros['privado'] . "')";
        $menu = $this->DAO->insertar($SQL);


        $permissions = ['Consultar', 'Editar', 'Crear', 'Modificar', 'Cambiar estadoy/o eliminar'];


        foreach ($permissions as $permission) {
            $SQL = "INSERT INTO PERMISOS (id_menu, codigos, permiso) VALUES (" . $filtros['id_menu'] . ", '" . $permission . "' , 'N')";
            $this->DAO->insertar($SQL);
        }

        return $menu;
    }

    public function borrarMenu($filtros = array())
    {
        $SQL = "DELETE FROM MENU WHERE id_menu = " . $filtros['id_menu'];
        $menu = $this->DAO->consultar($SQL);
        $SQL = "DELETE FROM PERMISOS WHERE id_menu = " . $filtros['id_menu'];
        $this->DAO->consultar($SQL);
        return $menu;
    }

    public function permisosMenu($filtros = array())
    {
        $SQL = "SELECT permisos.id_permiso, permisos.codigos, permisos.permiso
                FROM menu
                LEFT JOIN permisos ON menu.id_menu = permisos.id_menu
                WHERE menu.id_menu = " . $filtros['id_menu'];

        $menu = $this->DAO->consultar($SQL);

        return $menu;
    }

    public function editarPermisosMenu($filtros = array())
    {
        $SQL = "SELECT codigos, permiso FROM permisos WHERE id_permiso = " . $filtros['id_permiso'];
        $menu = $this->DAO->consultar($SQL);
        return ['permiso' => $menu];
    }

    public function eliminarPermisos($filtros = array())
    {
        $SQL = "DELETE FROM PERMISOS WHERE id_permiso = " . $filtros['id_permiso'];
        $menu = $this->DAO->insertar($SQL);
        return ['permiso' => $menu];
    }

    public function listaMenuRoles($filtros = array())
    {
        $SQL = "SELECT 
        pr.id_rol, 
        p.id_permiso, 
        p.codigos, 
        m.titulo
    FROM 
        permisosroles pr 
    right JOIN 
        permisos p ON pr.id_permiso = p.id_permiso 
    LEFT JOIN 
        menu m ON p.id_menu = m.id_menu
    WHERE 
        pr.id_rol = " . $filtros['id_rol'] . "  OR pr.id_rol is null";
        $menu = $this->DAO->consultar($SQL);
        return $menu;
    }

    public function getListaMenuUsuarios($filtros = array())
    {
        $SQL = "SELECT p.id_permiso, pu.id_usuario, p.codigos FROM permisosusuario pu 
        right JOIN permisos p ON pu.id_permiso = p.id_permiso WHERE pu.id_usuario = " . $filtros['id_usuario'] . " OR pu.id_usuario is null;";

        $menu = $this->DAO->consultar($SQL);
        return $menu;
    }

    public function getRolesUsers($filtros = array())
    {
        $SQL = "SELECT roles.rol , roles.id_rol from rolesusuarios, roles
         where rolesusuarios.id_rol = roles.id_rol and rolesusuarios.id_Usuarios = " . $filtros['id_usuario'] . "";
        $menu = $this->DAO->consultar($SQL);
        return $menu;

    }
    public function setPermisoRol($filtros = array())
    {

        if ($filtros['accion'] == 'true') {
            $SQL = "INSERT INTO PERMISOSROLES (id_permiso, id_rol) VALUES (" . $filtros['id_permiso'] . ", " . $filtros['id_rol'] . ")";
            $menu = $this->DAO->insertar($SQL);
        } else {
            $SQL = "DELETE FROM PERMISOSROLES WHERE id_permiso = " . $filtros['id_permiso'] . " AND id_rol = " . $filtros['id_rol'];
            $menu = $this->DAO->insertar($SQL);
        }
        return $menu;
    }

    public function setPermisoUsuario($filtros = array())
    {
        if ($filtros['accion'] == 'true') {
            $SQL = "INSERT INTO PERMISOSUSUARIO (id_permiso, id_usuario) VALUES (" . $filtros['id_permiso'] . ", " . $filtros['id_usuario'] . ")";
            $menu = $this->DAO->insertar($SQL);
        } else {
            $SQL = "DELETE FROM PERMISOSUSUARIO WHERE id_permiso = " . $filtros['id_permiso'] . " AND id_usuario = " . $filtros['id_usuario'];
            $menu = $this->DAO->insertar($SQL);
        }
        return $menu;
    }

    public function getListaMenuRolesUsuarios($filtros = array())
    {
        $SQL = "SELECT r.id_rol, ru.id_Usuarios, r.rol 
        FROM roles r 
        LEFT JOIN rolesusuarios ru ON r.id_rol = ru.id_rol AND ru.id_Usuarios = " . $filtros['id_usuario'] . "";
        $menu = $this->DAO->consultar($SQL);
        return $menu;
    }

    public function setPermisoUsuarioRol($filtros = array())
    {

        if ($filtros['accion'] == 'true') {
            $SQL = "INSERT INTO ROLESUSUARIOS (id_rol, id_Usuarios) VALUES (" . $filtros['id_rol'] . ", " . $filtros['id_usuario'] . ")";
            $menu = $this->DAO->insertar($SQL);
        } else {
            $SQL = "DELETE FROM ROLESUSUARIOS WHERE id_rol = " . $filtros['id_rol'] . " AND id_Usuarios = " . $filtros['id_usuario'];
            $menu = $this->DAO->insertar($SQL);
        }
        return $menu;
    }
}
?>
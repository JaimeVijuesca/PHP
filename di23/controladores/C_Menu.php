<?php
require_once 'controladores/Controlador.php';
require_once 'vistas/Vista.php';
require_once 'modelos/M_Menu.php';

class C_Menu extends Controlador
{
    private $modelo;

    public function __construct()
    {
        parent::__construct();
        $this->modelo = new M_Menu();
    }



    public function buscarMenu($filtros = array())
    {
        $menu = $this->modelo->sacarMenu($filtros);
        Vista::render(
            'vistas/Usuarios/V_Menu.php',
            array('menu' => $menu)
        );
    }

    public function getVistaMenu($filtros = array())
    {
        $rolesyUsuarios = $this->modelo->sacarRolesyUsuarios($filtros);
        Vista::render(
            'vistas/Menus/V_Menu.php',
            $rolesyUsuarios
        );
    }

    public function getListaMenu($filtros = array())
    {
        $cargarMenu = $this->modelo->listaMenus($filtros);
        Vista::render(
            'vistas/Menus/V_Menu_Listado.php',
            ['listaMenu' => $cargarMenu]
        );

    }

    public function insertarAndUpdaterMenu($filtros = array())
    {
        $insertarAndUpdaterMenu = $this->modelo->insertarAndUpdaterMenu($filtros);
    }

    public function getMenuId($filtros = array())
    {
        $data = $this->modelo->getMenuId($filtros);
        Vista::render(
            'vistas/Menus/V_Menu_prueba.php',
            ['menu' => $data]
        );
    }

    public function crearOpcionesMenu($filtros = array())
    {
        $crearOpcionesMenu = $this->modelo->crearOpcionesMenu($filtros);
        Vista::render(
            'vistas/Menus/V_Menu_Crear.php',
            $crearOpcionesMenu
        );
    }

    public function insertarnuevaOpcionMenu($filtros = array())
    {

        $insertarnuevaOpcionMenu = $this->modelo->insertarnuevaOpcionMenu($filtros);

    }

    public function borrarMenu($filtros = array())
    {
        $borrarMenu = $this->modelo->borrarMenu($filtros);
    }

    public function permisosMenu($filtros = array())
    {
        $permisosMenu = $this->modelo->permisosMenu($filtros);
        Vista::render(
            'vistas/Menus/V_Menu_Permisos.php',
            $permisosMenu
        );
    }

    public function editarPermisosMenu($filtros = array())
    {
        $editarPermisosMenu = $this->modelo->editarPermisosMenu($filtros);
        Vista::render(
            'vistas/Menus/V_Menu_PermisosEditar.php',
            $editarPermisosMenu
        );
    }

    public function eliminarPermisos($filtros = array())
    {
        $editarPermisosMenu = $this->modelo->eliminarPermisos($filtros);
    }

    public function getListaMenuRoles($filtros = array())
    {
        $listaMenuRoles = $this->modelo->listaMenuRoles($filtros);
        Vista::render(
            'vistas/Menus/V_Menu_Roles.php',
            ['listaMenuRoles' => $listaMenuRoles, 'id_rol' => $filtros['id_rol']]
        );
    }

    public function setPermisoRol($filtros = array())
    {
        $setPermisoRol = $this->modelo->setPermisoRol($filtros);
    }


}
?>
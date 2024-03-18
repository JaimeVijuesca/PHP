<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';

class M_Usuarios extends Modelo
{
  public $DAO;

  public function __construct()
  {
    parent::__construct(); // Ejecuta constructor del padre
    $this->DAO = new DAO();
  }

  public function permisosUsuarios($id_usuario)
  {
    $SQL = "SELECT ru.id_rol, ru.id_Usuarios, r.rol, r.id_rol, p.permiso , p.codigos, m.privado  
      FROM rolesusuarios AS ru 
      LEFT JOIN roles AS r ON ru.id_rol = r.id_rol 
      LEFT JOIN permisosusuario AS pu ON ru.id_Usuarios = pu.id_usuario 
      LEFT JOIN permisos AS p ON pu.id_permiso = p.id_permiso 
      LEFT JOIN menu AS m ON p.id_menu = m.id_menu 
      WHERE ru.id_Usuarios = $id_usuario";

    $permisos = $this->DAO->consultar($SQL);
    return $permisos;
  }

  public function buscarUsuarios($filtros = array())
  {
    $usuario = '';
    $pass = '';

    $pagina = 0;


    extract($filtros);

    $SQL = "SELECT * FROM usuarios WHERE 1=1 ";

    if ($usuario != '' && $pass != '') {
      $SQL .= " AND login = '$usuario' AND pass = MD5('$pass')";
    } else {
      if (!empty ($b_nombre)) {
        $aTexto = explode(' ', $b_nombre); //Dividir una cadena en un array
        $SQL .= "AND (";
        foreach ($aTexto as $index => $palabra) {
          if ($index > 0) {
            $SQL .= " OR ";
          }
          $SQL .= "nombre LIKE '$palabra%' ";
        }
        $SQL .= ")";
      }

      if (!empty ($b_apellido1)) {
        $SQL .= "AND apellido_1 LIKE '$b_apellido1%' ";
      }

      if (!empty ($b_apellido2)) {
        $SQL .= "AND apellido_2 LIKE '$b_apellido2%' ";
      }

      if (!empty ($b_sexo)) {
        $SQL .= "AND sexo = '$b_sexo%' ";
      }

      if (!empty ($b_mail)) {
        $SQL .= "AND mail LIKE '$b_mail%' ";
      }

      if (!empty ($b_movil)) {
        $SQL .= "AND movil LIKE '$b_movil%' ";
      }

      if (!empty ($b_login)) {
        $SQL .= "AND login LIKE '$b_login%' ";
      }

    }


    $usuarios = $this->DAO->consultar($SQL);
    $totalResultados = count($usuarios);
    if ($pagina != 'undefined' && $pagina != null) {
      $limite = intval($pagina) * 10;
      $inicio = ($limite - 1) - 9;
      $SQL .= " LIMIT $inicio, $limite";
    }

    $usuarios = $this->DAO->consultar($SQL);
    var_dump($SQL);
    $totalPaginas = ceil($totalResultados / 10);

    return ['usuarios' => $usuarios, 'totalResultados' => $totalResultados, 'totalPaginas' => $totalPaginas];
  }

  public function insertarAndUpdaterUsuario($filtros = array())
  {

    extract($filtros);
    if ($id_usuario != null) { // Si el id-usuario no es nulo se actualiza
      $SQL = "UPDATE USUARIOS SET nombre='" . $nombre . "', apellido_1='" . $apellido_1 . "', apellido_2='" . $apellido_2 . "', sexo='" . $sexo . "' , mail = '" . $mail . "' , 
        movil=" . $movil . ", login='" . $login . "', pass='" . md5($pass) . "', activo='" . $activo . "' WHERE id_Usuario = " . $id_usuario;
      $actualizar = $this->DAO->actualizar($SQL);
      if ($actualizar) {
        $mensaje = "Usuario actualizado correctamente.";
      } else {
        $mensaje = "Lo siento, el usuario no se actualizó con éxito.";
      }

    } else {
      $SQL = "INSERT INTO usuarios (nombre, apellido_1, apellido_2, sexo, mail, movil, login , pass , activo) VALUES(";

      if (!empty ($nombre)) {
        $SQL .= "'$nombre',";
      }
      if (!empty ($apellido_1)) {
        $SQL .= "'$apellido_1',";
      }
      if (!empty ($apellido_2)) {
        $SQL .= "'$apellido_2',";
      }
      if (!empty ($sexo)) {
        $SQL .= "'$sexo',";
      }
      if (!empty ($mail)) {
        $SQL .= "'$mail',";
      }
      if (!empty ($movil)) {
        $SQL .= "$movil,";
      }
      if (!empty ($login)) {
        $SQL .= "'$login',";
      }
      if (!empty ($pass)) {
        $SQL .= "MD5('$pass'),";
      }
      if (!empty ($activo)) {
        $SQL .= "'$activo')";
      }


      $insertar = $this->DAO->insertar($SQL);
      echo "Mirando ", $SQL;
      return $SQL;
      if ($insertar) {
        $mensaje = "Usuario nuevo creado correctamente";
      } else {
        $mensaje = "Lo siento no se ha podido crear el usuario";
      }

      // Devuelve el mensaje a javascript en json
      echo json_encode(array("mensaje" => $mensaje));

    }
  }
}

?>
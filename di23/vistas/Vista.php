<?php

class Vista
{
    static public function render($rutaVista, $datos = array())
    {
        // Extrae los datos del array para que puedas acceder a ellos como variables
        extract($datos);

        // Incluye la vista
        require_once($rutaVista);
    }
    
}
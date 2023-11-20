<?php

class InfoController
{

    // Muestra la página de contacto.
    public function contact()
    {
        include_once __DIR__ . '/../views/info/contact.php';
    }

    // Muestra la página de ayuda.
    public function help()
    {
        include_once __DIR__ . '/../views/info/help.php';
    }

    // Muestra la página de los términos de servicio.
    public function terms()
    {
        include_once __DIR__ . '/../views/info/terms.php';
    }

    // Muestra la página de la política de privacidad.
    public function privacy()
    {
        include_once __DIR__ . '/../views/info/privacy.php';
    }

}

?>
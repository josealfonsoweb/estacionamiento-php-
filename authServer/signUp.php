<?php

session_start();
//session_destroy();

require_once '../functions.php';

require_once 'functions.php';


//send(null,"Tu sesion ha expirado. Vuelve a loguearte","error");

$user=getData();

/*$resultado = session(array("admin", "simple"));

    if(!$resultado) 
    {
        send($resultado, "No tienes permiso ver esta pagina");
        
    }
*/
$result = signUp($user);

send($result);
       



?>
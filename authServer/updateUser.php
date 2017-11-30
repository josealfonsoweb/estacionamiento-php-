<?php

session_start();
//session_destroy();

require_once '../functions.php';

require_once 'functions.php';


// if(empty($_SESSION["email"])) {send(null,"Tu sesion ha expirado. Vuelve a loguearte","error");}{UpdateUserSession($_SESSION["email"]);}

$user=getData();

/*$resultado = session(array("admin", "simple"));

    if(!$resultado) 
    {
        send($resultado, "No tienes permiso ver esta pagina");
        
    }
*/
$result = updateUser($user);

send($result);
       



?>
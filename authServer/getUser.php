<?php

session_start();
//session_destroy();

require_once '../functions.php';

require_once 'functions.php';
//send(null,"Tu sesion ha expirado. Vuelve a loguearte","error");
$params=getData();
	
$result=getUser($params["field"], $params["userData"]);

send($result);


?>
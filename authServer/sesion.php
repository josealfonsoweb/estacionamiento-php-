<?php

session_start();

if(@$_GET["crear"]==1)
{
if(isset($_SESSION["id"]) and isset($_SESSION["nombre"]) and isset($_SESSION["nombre"]) and isset($_SESSION["privilegios"]))
{

$myArray["id"]=$_SESSION["id"];

$myArray["nombre"]=$_SESSION["nombre"];

$myArray["email"]=$_SESSION["email"];

$myArray["privilegios"]=$_SESSION["privilegios"];

}

if(!empty($myArray))
{
	echo json_encode($myArray);
}
else
{
    echo "null";
}  

}


if(@$_GET["salir"]==1)
{
	session_destroy(); 
	echo true;

}



?>
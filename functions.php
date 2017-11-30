<?php

error_reporting(E_ALL & ~E_NOTICE);

function privateFuntion()
{
	 if(empty($_SESSION["email"])) 
	 {
		 send(null,"Tu sesion ha expirado. Vuelve a loguearte","error");
	 }
	else
	{
		UpdateUserSession($_SESSION["email"]);
	}

}

function getData()
{
	$json = json_decode(file_get_contents('php://input'), true);

 return $json["data"];
}

function connect()
{ 
   
    $mysqli = new mysqli("localhost", "vnezuela_jose", "a4367433*", "vnezuela_estacionamiento");
    
     if ($mysqli->connect_errno) 
    {
        echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
    }
    else
    {
        if (!$mysqli->set_charset("utf8")) 
		{
   			printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->enlace->error);
		} 
		else 
		{
    	   	 return $mysqli;
		}
       
    }
    
    
    
}


function emailExists($email,$id=0)
{
    $mysqli = connect();
    
    if($id!=0)
    {
    $sql="SELECT * FROM users where email='".$email."' and id<>$id";
    }
    else
    {
     $sql="SELECT * FROM users where email='".$email."'";   
    }
	$myArray = array();

	if ($result = $mysqli->query($sql)) 
	{

		$numberRows=$result->num_rows;

		if($numberRows>0)
		{
		    $result = true;
		}
		else
		{
		    $result = false;
		}
    }
    
    $mysqli->close();

    return $result;
}



  

function send($data,$msj=false,$result="success")
{
    $myArray=array("data"=>$data, "msj"=>$msj, "result"=>$result);
   	echo json_encode($myArray);
   	exit();
   
}






?>
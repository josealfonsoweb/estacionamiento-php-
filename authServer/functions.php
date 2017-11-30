<?php
  
function signIn($email,$password)
{
    $mysqli = connect();
        
    $sql="SELECT * FROM users where email='".$email."' AND password='".$password."'";

    $myArray = array();

	if ($result = $mysqli->query($sql)) 
	{

		$num_rows=$result->num_rows;

		if($num_rows>0)
		{

				while($row = $result->fetch_array(MYSQLI_ASSOC)) 
				{

				$_SESSION["id"]=$row["id"];	

				$_SESSION["name"]=$row["name"];

				$_SESSION["email"]=$row["email"];

				$_SESSION["privileges"]=$row["privileges"];

				$myArray = $row;

   				}

		}

    
     

	}
	
    $mysqli->close();
    
    if(!empty($myArray))
    {
    	return $myArray;
   	}
    else
    {
        return false;
    }  

	
}




function session($supportedPrivileges)
{
    if (in_array($_SESSION["privileges"], $supportedPrivileges)) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

function getUser($field, $userData)
{
    
    $mysqli = connect();
    

    $sql="SELECT * FROM users WHERE $field='$userData'";
  
  
    $myArray = array();

    if ($result = $mysqli->query($sql)) {

     while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $myArray = $row;
    }
    
    if(!empty($myArray))
    {
     return $myArray;
    }
    else
    {
        return false;
    }   

}   
    
    $mysqli->close();
}


function generatePass($numberCharacters)
{
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $cad = "";
    for($i=0;$i<$numberCharacters;$i++) {
    $cad .= substr($str,rand(0,62),1);
    }
    
    $cad = substr($cad, 0, -1);
    $number=rand(0,9);
    $cad.=$number;
    return $cad;
}


function UpdateUserSession($email)
{
						 $user=getUser("email", $email);
             $_SESSION["name"] = $user['name'];
             $_SESSION["email"] = $user['email'];
             $_SESSION["privileges"] = $user['privileges'];
             
             return true;
}

function signUp($user)
{
     $mysqli = connect();
    
    if(emailExists($user['email']))
    {
        $result = false;
    }
    else
    {
        $sql="INSERT INTO users (name, lastName, email,  phone, dni, picture, password, privileges, verified) VALUES ('".$user['name']."', '".$user['lastName']."','".$user['email']."', '".$user['phone']."', '".$user['dni']."', '".$user['picture']."', '".$user['password']."', '".$user['privileges']."', '".$user['verified']."')";
        $result = $mysqli->query($sql);
			
			 $user["id"] = $mysqli->insert_id;
			
			$result=$user;
		  		
    }
	
    $mysqli->close();  
	
	   return $result;

}


function getUsersData($start, $numberRecords)
{
    
    $mysqli = connect();
    
    $sql="SELECT * FROM users ORDER BY users.id DESC limit $start,$numberRecords";

    $myArray = array();

    if ($result = $mysqli->query($sql)) 
    {

         while($row = $result->fetch_array(MYSQLI_ASSOC)) 
         {
        
               $myArray[] = $row;
        }
        
    }
    
     $mysqli->close();
        
        if(!empty($myArray))
        {
              return $myArray;
        }
        else
        {
            return false;
        }  

}



function deleteUser($id)
{
    session(array("admin"));
    
    $mysqli = connect();
    
    $sql="DELETE from users WHERE id='$id'";

    $result = $mysqli->query($sql);

    $mysqli->close();
    
    return $result;
}

function updateUser($user)
{
       
    $mysqli = connect();
    
    if(emailExists($user['email'], $user['id']))
    {
        $result = false;
    }
    else
    {
        $sql = "UPDATE users set name='".$user['name']."', lastName='".$user['lastName']."', email='".$user['email']."', password='".$user['password']."', privileges='".$user['privileges']."', phone='".$user['phone']."', picture='".$user['picture']."', dni='".$user['dni']."' where id='".$user['id']."'";
        $result = $mysqli->query($sql);
    }
    
    
    $mysqli->close();
    
    return $result;
}





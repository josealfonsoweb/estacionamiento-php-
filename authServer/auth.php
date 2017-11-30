<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

//echo json_encode($arr);

$json = json_decode(file_get_contents('php://input'), true);

$myArray = array();
$myArray['name'] = $json['name']; 
$myArray['age'] = $json['age'];
$myArray['status'] = 'success';
echo json_encode($myArray);
<?php 
require_once '../core/loader.php';

if(!isset($_POST['name']) || !isset($_POST['family']) ||!isset($_POST['phoneNumber']) || !isset($_POST['password'])){
    setJsonOutPut();
    echo json_encode(responseStd(400 , 'failed' , 'params is empty or no isset'));
    exit();
}

$name = $_POST['name'];
$family = $_POST['family'];
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];
$hashedPassword = setEncryptPass($password);

$response = UserModel::signup($name , $family , $phoneNumber , $hashedPassword);

echo json_encode($response);
exit();

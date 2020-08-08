<?php 
require_once '../core/loader.php';

if(!isset($_POST['number']) || !isset($_POST['password']) ){
    setJsonOutPut();
    echo json_encode(responseStd(400 , 'failed' , 'params is empty or no isset'));
    exit();
}

$number   = $_POST['number'];
$password = $_POST['password'];

// password_verify($password , $hash);

$response = UserModel::login($number , $password);

setJsonOutPut();
echo json_encode($response);
exit();

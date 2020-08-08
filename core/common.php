<?php
require_once 'loader.php';

function setJsonOutPut(){
 header('Content-Type:application/json');
}

function setTextOutPut(){
  header('Content-Type:text/html');
}

function setEncryptPass($pass){
  global $options;
  return password_hash($pass , PASSWORD_BCRYPT , [
      'cost' => 12
  ]);
}

function responseStd($code , $msg , $desc = 'No Description' , $user = null){
    return [
      'code' => $code,
      'msg' => $msg , 
      'desc' => $desc , 
      'user' => $user
    ];
}


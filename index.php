<?php 
require_once 'core/loader.php';

setJsonOutPut();
echo json_encode([
    'code' => 300 , 
    'status' => 'failed' , 
    'msg' => 'Enter Valid URL   '
]);
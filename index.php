<?php 
header('Content-Type:application/json');

echo json_encode([
    'code' => 300 , 
    'status' => 'failed' , 
    'msg' => 'Enter Valid URL'
]);
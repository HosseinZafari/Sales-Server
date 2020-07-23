<?php 
require_once '../core/loader.php';

class UserModel {

    public static function signUp($name , $family , $phoneNumber , $job , $password): array{
        global $connection;
        $res = $connection->query("select name from tb_user where phoneNumber='$phoneNumber'");
        if($res->rowCount() > 0){
            return responseStd(
                400 , 'failed', "you before singup in app"
            );
            exit();
        }
        try {
            global $connection;
            $command = $connection->prepare("INSERT INTO tb_user (name , family , phoneNumber , job , password) VALUES (:name , :family , :phoneNumber , :job , :password)");
            $command->bindParam(":name" , $name);
            $command->bindParam(":family" , $family);
            $command->bindParam(":phoneNumber" , $phoneNumber);
            $command->bindParam(":job" , $job);
            $command->bindParam(":password" , $password);
            $command->execute();
        
            return responseStd(
                200 , 'success', "you successfully singup"
            );
    } catch(PDOException $e){
            return responseStd(
                500 , 'Failed Request', "$e->getMessage()"
            );
        }
    }

    public static function login($phoneNumber , $password){
    
    }

}
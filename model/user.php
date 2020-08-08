<?php 
require_once '../core/loader.php';

class UserModel {
    
    public static function signUp($name , $family , $phoneNumber ,$job , $password): array{
        global $connection;
        $res = $connection->query("select name from tb_user where phoneNumber='$phoneNumber'");
        if($res->rowCount() > 0){
            return responseStd(
                401 , 'failed', "you before singup in app"
            );
            exit();
        }
       try {
	        global $connection;
	        $command = $connection->prepare("INSERT INTO tb_user (name , family , phoneNumber , job , password) VALUES (:name , :family , :phoneNumber , :job ,:password)");
	        $command->bindParam(":name" , $name);
	        $command->bindParam(":family" , $family);
	        $command->bindParam(":phoneNumber" , $phoneNumber);
			$command->bindParam(":job" , $job);
	        $command->bindParam(":password" , $password);
	        $command->execute();
	     
	        return responseStd(
	            200 , 'success', "شما با موفقیت ثبت نام شده اید."
	        );
  	    } catch(PDOException $e){
            return responseStd(
                500 , 'Failed Request', "$e->getMessage()"
            );
        }
    }

    public static function login($phoneNumber , $password){
 		
       try {
	   		global $connection;
	         
		    $command = $connection->prepare("select name , family , job , phoneNumber , password from tb_user where phoneNumber=:phoneNumber");
	        $command->bindParam(":phoneNumber" , $phoneNumber);
	        $command->execute();
			$row = $command->fetchAll();
			 
	       if(!$row){
	           return responseStd(
	               401 , 'failed', "حساب کاربری با این شماره همراه وجود ندارد."
	           );
	           exit();
	       }
	        
			
		  	if(password_verify($password , $row[0]['password'])) {
				return responseStd(
	               200 , 'success', "شما با موفقیت وارد شدید." , $row[0]
	           );
	           exit();
		  	}
		  	
			return responseStd(
	               402 , 'error', "رمز عبور شما صحیح نیست." , $row[0]
	           );
	           exit();
			 
  	    } catch(PDOException $e){
            return responseStd(
                500 , 'Failed Request', "$e->getMessage()"
            );
        }
    }

}
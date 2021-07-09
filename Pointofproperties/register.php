<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods:*');

header("Access-Control-Allow-Headers: *");

header('Content-Type: application/json');


   
    $entityBody = json_decode(file_get_contents('php://input'));
   
   

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "user";
    

  
    
    try 
    {
        $pdo = new PDO("mysql:host = localhost;
                          dbname=user", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) 
    {
        die("ERROR: Could not connect. ".$e->getMessage());
    }
    
    
   
    try {
      
            $mysqli = new mysqli($servername, $username, $password, $dbName);
      
            $email =  mysqli_real_escape_string($mysqli, $entityBody->reg_email);
            $pass = mysqli_real_escape_string($mysqli, $entityBody->reg_password);
            $phone = mysqli_real_escape_string($mysqli, $entityBody->reg_phone);
            $address = mysqli_real_escape_string($mysqli, $entityBody->reg_address);
            
            

            $ad_time=date("Y-m-d H:i:s");
            
           
    
                $mysql = "INSERT INTO user (user_email, user_password ,user_contact, user_address,user_role)
                VALUES ('$email', '$pass', '$phone','$address' , '1')";
                

                if ($mysqli->query($mysql) === TRUE) 
                {
                echo json_encode([
                    'status'=> 430,
                    'messege' => "Register Successfull",
                    "data" => [
                          
                    ]
                    
                    
                ]);
                
                
                
            }
                else 
                {
                    $error  = [
                        "status" => 403,
                        "message" => "Not Register",
                        "data" => null
                    ];
                        echo json_encode($error);
                }
            
    }
     catch (PDOException $e) 
     {
        die("ERROR: Could not able to execute $sql. " .$e->getMessage());
    }
        unset($pdo);
?>

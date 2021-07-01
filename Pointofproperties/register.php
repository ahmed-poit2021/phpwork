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
            
           
    
                $mysql = "INSERT INTO userinput (email, password, phone,address)
                VALUES ('$email', '$pass', '$phone','$address')";
                

                if ($mysqli->query($mysql) === TRUE) 
                {
                $authdata = [
                    'status'=> 430,
                    'email' => $email,
                    'pwd' => $pass,
                    'email' => $phone,
                    'address' => $address
                ];
                echo json_encode($authdata);
                
                }
                else 
                {
                    
                }
            
    }
     catch (PDOException $e) 
     {
        die("ERROR: Could not able to execute $sql. " .$e->getMessage());
    }
        unset($pdo);
?>

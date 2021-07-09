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
    

    // if($entityBody ->user_name == 'Admin' && $entityBody ->user_password == 'admin' )
    // {
    //     echo'{
    //     "user_id": "abcdef1234ghi",
    //     "name": "Mock Holliday",
    //     "email": "mock.holliday@example.com",
    //     "birthdate": "1971-08-01T00:00:00+00:00"
    // }';
    //
    // }
    // else
    // {
    //     echo '{"messege" : "Login failed"}';
    // }

    try {
        $pdo = new PDO("mysql:host = localhost;
                          dbname=user", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        die("ERROR: Could not connect. ".$e->getMessage());
    }
    
    try {
      
        $sql = "SELECT * FROM user WHERE user_email = '$entityBody->user_name' and user_password = '$entityBody->user_password' ";
        $result = $pdo->query($sql);
    // $_SESSION['username'] = $entityBody->user_name;
  	// $_SESSION['success'] = "You are now logged in";
  	//  header('location: index.php');
          


       
        if ($row = $result->fetch()) 
        {
          
            
            echo json_encode([
                "status" => 200,
                "message" => "Login Successful",
                "data" => $row
            ]);
            
           
        }
        else 
        {
            $asd  = [
                "status" => 403,
                "message" => "Not Found",
                "data" => null
            ];
                echo json_encode($asd);
        }

       
            
    }
        catch (PDOException $e) {
        die("ERROR: Could not able to execute $sql. " .$e->getMessage());
         }
   
?>



          
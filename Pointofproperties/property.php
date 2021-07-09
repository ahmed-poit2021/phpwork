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
  
        $propname =  mysqli_real_escape_string($mysqli, $entityBody->prop_name);
        $proplocation = mysqli_real_escape_string($mysqli, $entityBody->prop_location);
        $propprice = mysqli_real_escape_string($mysqli, $entityBody->prop_price);
        $propdescription = mysqli_real_escape_string($mysqli, $entityBody->prop_description);
        $proplength = mysqli_real_escape_string($mysqli, $entityBody->prop_area);
        $propcoordinate = mysqli_real_escape_string($mysqli, $entityBody->prop_coordinate);
        

        $ad_time=date("Y-m-d H:i:s");
        
       

            $mysql = "INSERT INTO properties ( property_name ,	property_location, property_price, property_description, property_legth, property_time,property_coordinate)
            VALUES ('$propname', '$proplocation', '$propprice','$propdescription' , '$proplength','$ad_time','$propcoordinate')";
            
            

            if ($mysqli->query($mysql) === TRUE) 
            {
            echo json_encode([
                'status'=> 430,
                'messege' => "Added Successful",
                "data" => [
                    'Property name' => $propname,
                    'Property Location' => $proplocation,
                    'Property Price' => $propprice,
                    'Property Description' => $propdescription,
                    'Property Area' => $proplength,
                    'Property Coordinates' => $propcoordinate

                ]
                
                
            ]);
            
            
            
        }
            else 
            {
                $error  = [
                    "status" => 403,
                    "message" => "Not Added successful",
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
<?php
function database(){
     $host = 'localhost';
     $user = 'root';
     $pass = '';
     $database = 'portfolio';
    
    // Method to establish a database connection
        $conn = mysqli_connect($host,$user,$pass,$database);

        // Check connection
        if(!$conn){
            echo 'database connection failed';
            return false;
        }else{
            return $conn; // Return the connection resource on success
        }
}

?>
<?php 
$servername = "localhost";
$username = "root";
$password = "Madhu@2003";
$daname = "mydatabase";


$conn = new mysqli($servername,$username,$password,$daname);

if($conn -> connect_error){
    die("DB connection failed... ERROR = ".$conn -> connect_error);
}


?>
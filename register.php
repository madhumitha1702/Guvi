<?php 

include('config.php');


// Get request data 

$FULLNAME = $_POST['FullName'];
$EMAIL = $_POST['Email'];
$PASSWORD = $_POST['Password'];

//Add user to DB

$query = "INSERT INTO  users (USERNAME,EMAIL,PASSWORD) VALUES ('$FULLNAME','$EMAIL','$PASSWORD')";

$result = mysqli_query($conn,$query);

if($result)
{

   //Fetch userId

   $query_for_fetch_userId = "SELECT USER_ID FROM users WHERE EMAIL = '$EMAIL'";

   $result = mysqli_query($conn,$query_for_fetch_userId);

   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

   session_start();

   $_SESSION["USERID"] = $row["USER_ID"];


   // SEND SUCCESS RESPONSE

   $response = ['status' => 'success'];
   echo json_encode($response);
}
else
{

    if(mysqli_errno($conn) == 1062)
    {
        // SEND ERROR RESPONSE 

        $response = ['status' => 'failed','error' => 'Email_already_taken'];
        echo json_encode($response);
    }
    else
    {
        // SEND ERROR RESPONSE 

        $response = ['status' => 'failed','error' => mysqli_error($conn)];
        echo json_encode($response);
    }
}


// ------------ //




?>
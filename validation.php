<?php 

include('config.php');

// Get Request data.......

$EMAIL = $_POST['Email'];

$PASSWORD = $_POST['Password'];



// Checking.........

$query = "SELECT USER_ID,EMAIL,PASSWORD FROM users WHERE EMAIL = '$EMAIL' && PASSWORD = '$PASSWORD'";

$result = mysqli_query($conn,$query);

if($result)
{
     $num = mysqli_num_rows($result);

     if($num == 1)
     {
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        session_start();
        $_SESSION["USERID"] = $row["USER_ID"];  

        
        $response = ['status' => 'success'];
        echo json_encode($response);
     }
     else
     {
        $response = ['status' => 'Invalid'];
        echo json_encode($response);
     }
}

else
{
    $response = ['status' => 'Error','Error' => mysqli_error($conn)];
    echo json_encode($response);
}

?>
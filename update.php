<?php 
include('config.php');
// Get request data 
$FULLNAME = $_POST['FullName'];
$EMAIL = $_POST['Email'];
$PASSWORD = $_POST['Password'];
$AGE = $_POST['Age'];
$DOB = $_POST['Dob'];
$GENDER = $_POST['Gender'];
$CONTACT = $_POST['Contact'];
$ADDRESS = $_POST['Address'];
$USER_ID = $_POST['UserId'];

if($DOB == '')
{
    $query = "UPDATE users SET USERNAME = '$FULLNAME',EMAIL='$EMAIL',PASSWORD='$PASSWORD',AGE='$AGE',GENDER='$GENDER',CONTACT='$CONTACT',ADDRESS='$ADDRESS' WHERE USER_ID = '$USER_ID'"; 
}
else
{
    $query = "UPDATE users SET USERNAME = '$FULLNAME',EMAIL='$EMAIL',PASSWORD='$PASSWORD',AGE='$AGE',GENDER='$GENDER',DOB='$DOB',CONTACT='$CONTACT',ADDRESS='$ADDRESS' WHERE USER_ID = '$USER_ID'"; 
}


$result = mysqli_query($conn,$query);

if($result)
{
    // Send response for update successfully
    
    $response = ['status' => 'success'];
    echo json_encode($response);
}
else
{
    // send response for found unexpected error

    $response = ['status' => 'failed','error' => mysqli_error($conn)];
    echo json_encode($response);
}

?>
<?php 

session_start();
$USERID = $_SESSION["USERID"];

if($USERID == '')
{
    session_destroy();

    header('location:index.php');
}

// Fetch User All data using USERID

include('config.php');

$query = "SELECT USERNAME,EMAIL,PASSWORD,AGE,GENDER,DOB,CONTACT,ADDRESS FROM users WHERE USER_ID = '$USERID'";

$result = mysqli_query($conn,$query);

if($result)
{

   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

   $USERNAME = $row["USERNAME"];
   $EMAIL = $row["EMAIL"];
   $PASSWORD = $row["PASSWORD"];
   $AGE = $row["AGE"];
   $GENDER = $row["GENDER"];
   $DOB = $row["DOB"];
   $CONTACT = $row["CONTACT"];
   $ADDRESS = $row["ADDRESS"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"href="profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
.box{
width: 1000px;
height: 50px;
border: 2px solid black;
}</style>
</head>
<body class="profile_body">
    <div class="Nav_all">
    <p class="welcome-message">Welcome to GUVI, <?php echo $USERNAME ?></p>
    <div class="navi_1" id="navibar">
    <button type="button" class="btn btn-link"><a href="logout.php">Logout</a></button>
    <!-- <button type="button" class="btn btn-link">Logout</button> -->
    </div>
    </div>
    <div class="profile_image" style="font-size: 30px;"> <!-- Adjust the font-size value as needed -->
    Profile
</div>
    <div class="profile_name">            
    <div class="update_form">
        
        <div class="box">
            <h4> Name:	<?php echo $USERNAME ?></h4>
        </div>
        <div class="box">
           <h4> Email:	<?php echo $EMAIL ?></h4>
        </div>
       <div class="box">
            <h4>Password:	<?php echo $PASSWORD ?></h4>
        </div>
         <div class="box">
            <h4> Age:	<?php echo $AGE ?></h4>
        </div>
        <div class="box">
           <h4> Gender:	<?php echo $GENDER ?></h4>
        </div>
       <div class="box">
            <h4>Date of Birth:	<?php echo $DOB ?></h4>
        </div>
<div class="box">
            <h4>Contact:	<?php echo $CONTACT ?></h4>
        </div>
<div class="box">
            <h4>Address:	<?php echo $ADDRESS ?></h4>
        </div>

        
    </div>
    </div>
</div>
<script>
    function Update(){

        var FullName = $("input[name=FullName]").val();
        var Email = $("input[name=Email]").val();
        var Password = $("input[name=Password]").val();
        var Age = $("input[name=Age]").val();
        var Dob = $("input[name=Dob]").val();
        var Gender = $("input[name=Gender]").val();
        var Contact = $("input[name=Contact]").val();
        var Address = $("input[name=Address]").val();

        var user_info = {
            FullName : FullName,
            Email:Email,
            Password:Password,
            Age:Age,
            Dob:Dob,
            Gender:Gender,
            Contact:Contact,
            Address:Address,
            UserId:<?php echo  $USERID; ?>
        }

        $.ajax({
                type: "POST",
                url: 'update.php',
                data: user_info,
                success: function(response)
                {
                    var response = JSON.parse(response);
                    if(response)
                    {
                        console.log(response.status);

                        if(response.status == 'success')
                        {
                                alert('The Record has been Updated.....');
                                location.reload();
                        }
                        else if(response.status == 'failed')
                        {
                                alert(response.error);
                        }
                    }
                    else
                    {
                        console.log('Error');
                    }
                }
        });
    }
</script>
</body>
</html>
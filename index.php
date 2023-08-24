<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Registration form</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
        body.main_form {
            background-image: url('https://img.freepik.com/free-vector/paper-style-dynamic-lines-background_23-2149008629.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="main_form">
<div class="Nav_index">
    <h1>GUVI</h1>
</div>
            <!-- welcome container -->

            <div class="welcome-container">
                <h1 class="welcome-heading"></h1>
                    
            </div>
            <!-- welcome container end  -->
<div class="body_index">
</div>
<div class="Register_form">
<div class="login-text">
        REGISTRATION PAGE
    </div>
    <div class="mb-3">
        <label for="FullName" class="form-label" style="color:white">Name</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="Name" placeholder="Enter your name">
    </div>
    <div class="mb-3">
        <label for="Email" class="form-label"style="color:white">Email</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" name="Email" placeholder="Enter Your MailId">
    </div>
    <div class="mb-3">
        <label for="Password" class="form-label" style="color:white">Password</label>
        <input type="password" class="form-control" id="exampleFormControlInput1" name="Password" placeholder="Enter Your password">
    </div>
    <button type="submit" class="btn btn-primary" onclick="Registration()">Register</button>
    <button type="button" class="btn btn-link" onclick="toggleTOLoginForm()">Login</button>
</div>
<div class="Login_form">
    <div class="login-text">
        DETAILS
    </div>
    <div class="mb-3">
        <label for="Email" class="form-label" style="color:white">Email</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" name="Login_Email" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="Password" class="form-label" style="color:white">Password</label>
        <input type="password" class="form-control" id="exampleFormControlInput1" name="Login_Password" placeholder="password">
    </div>
    <button type="submit" class="btn btn-primary" onclick="Login()">Login</button>
    <button type="button" class="btn btn-link" onclick="toggleToRegistrationForm()">Registration</button>
</div>
<script>


function Registration(){

    var FullName = $("input[name=FullName]").val();
    var Email = $("input[name=Email]").val();
    var Password = $("input[name=Password]").val();


    if(FullName == '' || Email == '' || Password == '')
    {
        alert('Please fill all the input box..');
    }
    else
    {

        var user_info = {
            FullName : FullName,
            Email:Email,
            Password:Password
        }

        $.ajax({
                type: "POST",
                url: 'register.php',
                data: user_info,
                success: function(response)
                {
                    var response = JSON.parse(response);
                    if(response)
                    {
                        console.log(response.status);

                        if(response.status == 'success')
                        {
                        // redirect to profiles
                        swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Login Successful'
                }).then(function() {
                window.location = "Home.php";
        });
    }
                        else if(response.status == 'failed' && response.error == 'Email_already_taken')
                        {
                            alert('Email Id is already taken. Try another one...');
                        }
                        else
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

}

function Login(){

var Email = $("input[name=Login_Email]").val();
var Password = $("input[name=Login_Password]").val();

var user_login_info = {

    Email:Email,
    Password:Password
}
$.ajax({
        type: "POST",
        url: 'validation.php',
        data: user_login_info,
        success: function(response)
        {
            var response = JSON.parse(response);
            if(response)
            {
                console.log(response.status);

                if(response.status == 'success')
                {

                    swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Login Successful'
                }).then(function() {
                window.location = "Home.php";
        });
                }
                else if(response.status == 'Invalid')
                {
                    alert('Invalid Email Id and Password..');
                }
                else if(response.status == 'Error')
                {
                    alert(response.Error);
                }
            }
            else
            {
                console.log('Error');
            }
       }
   });

}

function toggleTOLoginForm() {

    $(".Login_form").css("display","block");
    $(".Register_form").css("display","none");

}

function toggleToRegistrationForm(){

    $(".Login_form").css("display","none");
    $(".Register_form").css("display","block");

}
</script>
</body>
</html>
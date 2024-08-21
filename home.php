<?php
 require 'connect.php';
session_start();
if(isset($_GET['route']) && $_GET['route'] == 'studentSignUp'){
    header('Location: studentSignUp.php');
    exit();
}
if(isset($_GET['route']) && $_GET['route'] == 'studentSignIn'){
    header('Location: studentSignIn.php');
    exit();
}
if(isset($_GET['route']) && $_GET['route'] == 'home'){
    header('Location: home.php');
    exit();
}
if(isset($_GET['route']) && $_GET['route'] == 'contact'){
    header('Location: contact.php');
    exit();
} 
if(isset($_GET['route']) && $_GET['route'] == 'supervisorSignUp'){
    header('Location: supervisorSignUp.php');
    exit();  
}
if(isset($_GET['route']) && $_GET['route'] == 'student'){
    header('Location: student.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .l:hover {
            text-decoration: underline;
        }
        a{
            text-decoration: none;
        }
        .l{
            text-shadow: 1px 1px 0 #ff0000;
              font-size:25px
        }
        .m{
            position:relative;
            top: 5px;
        }
        .b{
            background-color:#666;
        }
    </style>
</head>
<body>
    <div class="mx-1 b">
        <div class='d-flex justify-content-between p-3'>
            <div class='d-flex gap-4 ms-3'>
                <h5><a href="?route=home" class='l'>Teeboy University</a></h5>
                <h5><a href="?route=contact" class='m'>Contact</a></h5>
                <h5><a href="?route=about" class='m'>About</a></h5>
                <h5><a href="?route=supervisorSignUp" class='m'>Professor</a></h5>
            </div>
            <div class='d-flex gap-4 ms-3'>
                <h5><a href="#" class='m'>Help</a></h5>
                <h5><a href="#" class='m'>Settings</a></h5>
                <h5><a href="?route=student" class='m'>Student</a></h5>
                <h5><a href="?route=studentSignUp" class='m'>SignUp</a></h5>
                <h5><a href="?route=studentSignIn" class='m'>SignIn</a></h5>
            </div>
        </div>
    </div>    


</body>
</html>
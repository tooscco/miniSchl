<?php 
session_start();
if(isset($_GET['route']) && $_GET['route'] == 'supervisorSignUp'){
    header('Location: supervisorSignUp.php');
    exit();
}
if(isset($_GET['route']) && $_GET['route'] == 'supervisorSignIn'){
    header('Location: supervisorSignIn.php');
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
    </style>
</head>
<body>
<div class="mx-1 shadow mb-4">
        <div class='d-flex justify-content-between p-3'>
            <div class='d-flex gap-4 ms-3'>
                <h5><a href="?route=home" class='l'>Teeboy University</a></h5>
                <h5><a href="?route=contact" class='m'>Contact</a></h5>
                <h5><a href="?route=about" class='m'>About</a></h5>
            </div>
            <div class='d-flex gap-4 ms-3'>
                <h5><a href="#" class='m'>Help</a></h5>
                <h5><a href="#" class='m'>Settings</a></h5>
                <h5><a href="?route=supervisorSignUp" class='m'>SignUp</a></h5>
                <h5><a href="?route=supervisorSignIn" class='m'>SignIn</a></h5>
            </div>
        </div>
    </div> 

    <div class="col-6 mx-auto shadow p-3">
        <div class="col-10 mx-auto">
            <h4 class="text-center text-primary">Professor Sign In Page</h4>
            <form action=" supervisorSignInPro.php" method="POST">
                <div class="my-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" class="form-control shadow-none my-1">
                </div>

                <div class="my-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" class="form-control shadow-none my-1">
                </div>

                <div class="mt-4 mb-3">
                    <input type="submit" name="supSignin" class="btn btn-outline-primary w-100">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
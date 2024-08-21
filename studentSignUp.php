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
if(isset($_GET['route']) && $_GET['route'] == 'student'){
    header('Location: student.php');
    exit();
}

if(isset($_POST['studentSignup'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $matric=$_POST['matricNo'];
    $course=$_POST['course'];
    $depart=$_POST['depart'];
    $faculty=$_POST['faculty'];
    $eamil=$_POST['email'];
    $password=$_POST['password'];
    $gender=$_POST['gender'];

    $query="SELECT * FROM `student_table` WHERE email=?";
    $dbmini =$minischl->prepare($query);
    $dbmini->bind_param('s', $eamil);
    $dbmini->execute();
    if($dbmini){
        $user=$dbmini->get_result();
        if($user->num_rows>0){
            $_SESSION['msg']='Email exists';
            header('location: studentSignUp.php');
        }
        else{
            $hashpass=password_hash($password, PASSWORD_DEFAULT);

            $query= "INSERT INTO `student_table`(`supervisor_id`,`firstname`, `lastname`, `matric_no`, `course`, `department`, `faculty`, `email`, `password`, `gender`) VALUES(?,?,?,?,?,?,?,?,?,?)";
            $dbminicon= $minischl->prepare($query);

            $supervisor_id=6;

            $dbminicon->bind_param('ississssss', $supervisor_id, $fname, $lname, $matric, $course, $depart, $faculty, $eamil, $hashpass, $gender);
            $dbminicon->execute();
            if($dbminicon){
                header('location: studentSignIn.php');
            }
            else{
                echo 'query not ran:'.$minischl->error;
            }
        }
    }
    else{
        echo 'query not ran';
    }
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
                <h5><a href="?route=student" class='m'>Student</a></h5>
                <h5><a href="?route=studentSignUp" class='m'>SignUp</a></h5>
                <h5><a href="?route=studentSignIn" class='m'>SignIn</a></h5>
            </div>
        </div>
    </div>
    
    <div class="col-6 mx-auto shadow p-3 mb-4">
        <h4 class="text-success text-center">Student Sign Up Page</h4>
        <div class="col-10 mx-auto">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method=POST>
                <div class="my-2 ">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" placeholder="First Name" class="form-control shadow-none my-1">
                </div>

                <div class="my-2 ">
                    <label for="lname">last Name</label>
                    <input type="text" name="lname" placeholder="last Name" class="form-control shadow-none my-1">
                </div>

                <div class="my-2 ">
                    <label for="matric">Matric Number</label>
                    <input type="number" name="matricNo" placeholder="Matric Number" class="form-control shadow-none my-1">
                </div>

                <div class="my-2 ">
                    <label for="course">Course</label>
                    <input type="text" name="course" placeholder="Course" class="form-control shadow-none my-1">
                </div>

                <div class="my-2 ">
                    <label for="depart">Department</label>
                    <input type="text" name="depart" placeholder="Department" class="form-control shadow-none my-1">
                </div>

                <div class="my-2 ">
                    <label for="faculty">Faculty</label>
                    <input type="text" name="faculty" placeholder="Faculty" class="form-control shadow-none my-1">
                </div>

                <div class="my-2 ">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" class="form-control shadow-none my-1">
                </div>

                <div class="my-2 ">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" class="form-control shadow-none my-1">
                </div>

                <div class="my-2 d-flex justify-content-between me-5">
                    <label for="gender">Gender:</label>
                    <div>
                        <label for="fmale">Female:</label>
                        <input type="radio" name="gender"class="my-1" value="Female">
                    </div>
                    <div>
                        <label for="male">Male:</label>
                        <input type="radio" name="gender" class="my-1" value="Male">
                    </div>
                </div>

                <div class="mt-4 mb-3">
                    <input type="submit" name="studentSignup" class="btn btn-outline-success w-100" value="Sign Up">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
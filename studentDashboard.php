<?php
require 'connect.php';
session_start();

if (isset($_GET['route'])) {
    switch ($_GET['route']) {
        case 'studentSignIn':
            header('Location: studentSignIn.php');
            exit();
        case 'home':
            header('Location: home.php');
            exit();
        case 'contact':
            header('Location: contact.php');
            exit();
    }
}

$id = $_SESSION['student_id'];


$query="SELECT student_table.firstname AS student_firstname,
        student_table.lastname AS student_lastname,
        student_table.email AS student_email,
        student_table.matric_no AS student_matric_no,
        supervisor_table.firstname AS supervisor_firstname,
        supervisor_table.lastname AS supervisor_lastname,
        supervisor_table.email AS supervisor_email 
        FROM student_table 
        LEFT JOIN supervisor_table 
        ON student_table.supervisor_id = supervisor_table.supervisor_id
        WHERE student_table.student_id = ?";

$dbquery=$minischl->prepare($query);
$dbquery->bind_param('i',$id);
$dbquery->execute();
$result=$dbquery->get_result();
$user=$result->fetch_assoc();

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
            color : #000000;
        }
        .n{
            font-size:17px;
        }
    </style>
</head>
<body>
<div class="mx-1 shadow mb-3">
        <div class='d-flex justify-content-between p-3'>
            <div class='d-flex gap-4 ms-3'>
                <h5><a href="?route=home" class='l'>Teeboy University</a></h5>
                <h5><a href="?route=contact" class='m'>Contact</a></h5>
                <h5><a href="?route=about" class='m'>About</a></h5>
            </div>
            <div class='d-flex gap-4 ms-3'>
                <h5><a href="#" class='m'>Course</a></h5>
                <h5><a href="?route=settings" class='m'>Settings</a></h5>
                <h5><a  class='m'>Eamil: <span class="n"><?php echo $user['student_email']?></span></a></h5>
                <h5><a href="?route=studentSignIn" class='m'>Logout</a></h5>
            </div>
        </div>
    </div> 
    <div class="d-flex justify-content-between mx-4">
        <h5><a  class='m'>Welcome: <span class="n"><?php echo $user['student_firstname']?></span> <span class="n"><?php echo $user['student_lastname']?></span></a></h5>

        <h5><a  class='m'>Supervisor Name: <span class="n"><?php echo $user['supervisor_firstname']?></span> <span class="n"><?php echo $user['supervisor_lastname']?></span></a></h5>
        
        <h5><a  class='m'>Matric: <span class="n"><?php echo $user['student_matric_no']?></span></a></h5>
    </div>
</body>
</html>
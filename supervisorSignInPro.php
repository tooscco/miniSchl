<?php
require 'connect.php';
session_start();

if(isset($_POST['supSignin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query ="SELECT * FROM supervisor_table WHERE email = ?";
    $dbconnect=$minischl->prepare($query);
    $dbconnect->bind_param('s', $email);
    $dbconnect->execute();
    $result=$dbconnect->get_result();
    print_r($result);
    if($result->num_rows>0){
        $user=$result->fetch_assoc();
        print_r($user);
        $hashed=$user['password'];
        $password_verify=password_verify($password, $hashed);
        if($password_verify){
            $_SESSION['supervisor_id']=$user['supervisor_id'];
            header('location: supervisorDashboard.php');
        }
        else{
            echo 'Incorrect email or password';
        }
    }
    else{
        echo 'Incorrect email or password';
    }
}
?>
<?php
require 'connect.php';
session_start();

if(isset($_POST['proSignup'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $depart=$_POST['depart'];
    $faculty=$_POST['faculty'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $gender=$_POST['gender'];

    $query= "SELECT * FROM `supervisor_table` WHERE email=?";
    $dbpro=$minischl->prepare($query);
    $dbpro->bind_param("s", $email);
    $dbpro->execute();
    if($dbpro){
        $user=$dbpro->get_result();
        if($user->num_rows>0){
            $_SESSION['msg']= 'Email exists';
            header('location: supervisorSignUp.php');
            exit();
        }
        else{
            $hashedpass=password_hash($password, PASSWORD_DEFAULT);
    
            $query = "INSERT INTO `supervisor_table` (`firstname`, `lastname`, `department`, `faculty`, `email`, `password`, `gender`) VALUES (?,?,?,?,?,?,?)";
            $dbprocon=$minischl->prepare($query);
            $dbprocon->bind_param("sssssss", $fname, $lname, $depart, $faculty, $email, $hashedpass, $gender);
            $dbprocon->execute();
            print_r($dbprocon);

            if($dbprocon){
                echo 'inserted';
                header('location: supervisorSignIn.php');
                exit();
            }
            else{
                echo 'query not ran:'.$minischl->error;
            }
            
            // if($dbprocon){
            //     $professor_id = $dbprocon->insert_id; 
            //     $updatequery = "UPDATE student_table SET professor_id = ? WHERE student_id = ? AND professor_id IS NULL";
            //     $dbprocon2=$minischl->prepare($updatequery);
            //     $dbprocon2-bind_param('ii', $professor_id, $student_id);

            //     if($dbprocon2->execute()){
            //         echo 'inserted';
            //         // header('location: professorSignIn.php');
            //         exit();
            //     }
            // }
            // else{
            //     echo 'query not ran:'.$minischl->error;
            // }
        }
    }
    else{
        echo 'query not ran:'.$minischl->error;
    }
}else{
    header('location: supervisorSignUp.php');
}
?>
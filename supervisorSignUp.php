<?php 
session_start();

// Handle routing based on GET parameters
if (isset($_GET['route'])) {
    switch ($_GET['route']) {
        case 'supervisorSignIn':
            header('Location: supervisorSignIn.php');
            exit();
        case 'supervisorSignUp':
            header('Location: supervisorSignUp.php');
            exit();
        case 'home':
            header('Location: home.php');
            exit();
        case 'contact':
            header('Location: contact.php');
            exit();
    }
}

// // Fetch available students
// $query = "SELECT student_id, firstname, lastname FROM student_table WHERE professor_id IS NULL";
// $result = $minischl->query($query);

// // Process form submission
// if (isset($_POST['proSignup'])) {
//     $fname = $_POST['fname'];
//     $lname = $_POST['lname'];
//     $depart = $_POST['depart'];
//     $faculty = $_POST['faculty'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $gender = $_POST['gender'];
//     $student_id = $_POST['student_id']; // Get student ID from form

//     // Check if the professor's email already exists
//     $query = "SELECT * FROM `professor_table` WHERE email=?";
//     $dbpro = $minischl->prepare($query);
//     $dbpro->bind_param("s", $email);
//     $dbpro->execute();

//     if ($dbpro) {
//         $user = $dbpro->get_result();
//         if ($user->num_rows > 0) {
//             $_SESSION['msg'] = 'Email exists';
//             header('Location: professorSignUp.php');
//             exit();
//         } else {
//             $hashedpass = password_hash($password, PASSWORD_DEFAULT);

//             // Insert new professor into the database along with student_id
//             $query = "INSERT INTO `professor_table` (`firstname`, `lastname`, `department`, `faculty`, `email`, `password`, `gender`, `student_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
//             $dbprocon = $minischl->prepare($query);
//             $dbprocon->bind_param("sssssssi", $fname, $lname, $depart, $faculty, $email, $hashedpass, $gender, $student_id);
//             $dbprocon->execute();

//             if ($dbprocon) {
//                 $professor_id = $dbprocon->insert_id;

//                 // Update the student_table with the selected professor_id
//                 $updatequery = "UPDATE student_table SET professor_id = ? WHERE student_id = ?";
//                 $dbprocon2 = $minischl->prepare($updatequery);
//                 $dbprocon2->bind_param('ii', $professor_id, $student_id);

//                 if ($dbprocon2->execute()) {
//                     // Redirect to sign-in page after successful registration and assignment
//                     header('Location: professorSignIn.php');
//                     exit();
//                 } else {
//                     echo 'Error assigning student: ' . $minischl->error;
//                 }
//             } else {
//                 echo 'Failed to insert professor: ' . $minischl->error;
//             }
//         }
//     } else {
//         echo 'Query failed: ' . $minischl->error;
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .l:hover {
            text-decoration: underline;
        }
        a {
            text-decoration: none;
        }
        .l {
            text-shadow: 1px 1px 0 #ff0000;
            font-size: 25px;
        }
        .m {
            position: relative;
            top: 5px;
        }
    </style>
</head>
<body>
<div class="mx-1">
    <div class='d-flex shadow justify-content-between mb-4 p-4'>
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
    <div class="col-6 mx-auto shadow p-3 mb-4">
        <h4 class="text-primary text-center">Professor Sign Up Page</h4>
        <div class="col-10 mx-auto">
            <form action="supervisorSignUpPro.php" method="POST">
                <div class="my-2">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" placeholder="First Name" class="form-control shadow-none my-1" required>
                </div>

                <div class="my-2">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" placeholder="Last Name" class="form-control shadow-none my-1" required>
                </div>

                <div class="my-2">
                    <label for="depart">Department</label>
                    <input type="text" name="depart" placeholder="Department" class="form-control shadow-none my-1" required>
                </div>

                <div class="my-2">
                    <label for="faculty">Faculty</label>
                    <input type="text" name="faculty" placeholder="Faculty" class="form-control shadow-none my-1" required>
                </div>

                <div class="my-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" class="form-control shadow-none my-1" required>
                </div>

                <div class="my-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" class="form-control shadow-none my-1" required>
                </div>

                <div class="my-2 d-flex justify-content-between me-5">
                    <label for="gender">Gender:</label>
                    <div>
                        <label for="female">Female:</label>
                        <input type="radio" name="gender" class="my-1" value="Female" required>
                    </div>
                    <div>
                        <label for="male">Male:</label>
                        <input type="radio" name="gender" class="my-1" value="Male" required>
                    </div>
                    </div>

                <div class="mt-4 mb-3">
                    <input type="submit" name="proSignup" class="btn btn-outline-primary w-100">
                </div>
            </form>
        </div>
    </div>
</body>
</html>

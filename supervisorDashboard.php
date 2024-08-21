<?php
require 'connect.php';
session_start();

if(isset($_GET['route'])){
    switch ($_GET['route']){
        case 'home':
            header('Location: home.php');
            exit();
        case 'contact':
            header('Location: contact.php');
            exit();
        case 'supervisorSignIn':
            header('Location: supervisorSignIn.php');
            exit();
    }
}

$sup=$_SESSION['supervisor_id'];
$id=$_SESSION['student_id'];
// print_r($id);

$query="SELECT * FROM student_table WHERE supervisor_id=?";
$dbsup=$minischl->prepare($query);
$dbsup->bind_param('i', $sup);
$dbsup->execute();
$result=$dbsup->get_result();
$users=$result->fetch_all(MYSQLI_ASSOC);

$querysec="SELECT * FROM supervisor_table WHERE supervisor_id=?";
$dbsupsec=$minischl->prepare($querysec);
$dbsupsec->bind_param('i', $sup);
$dbsupsec->execute();
$resultsec=$dbsupsec->get_result();
$usersec=$resultsec->fetch_assoc();

// foreach ($users as $user) {
//     echo $user['firstname'];
// }

if(isset($_POST['submit_del'])){
    $del = intval($_POST['student_id']);
    $query="DELETE FROM `student_table` WHERE `student_id`= $del  ";
    $dbcon=$minischl->query($query);
    if($dbcon){
        echo 'Note deleted successfully';
    }
    else{
        echo 'Failed to delete note:'.$connect->error;
    }
}

$editstu = [];

if(isset($_POST['submit_id'])){
    echo $_SESSION['student_id']= $_POST['student_id'];
    $edit=$_SESSION['student_id'];
    $query="SELECT * FROM student_table WHERE student_id =$edit ";
    $dbstudent=$minischl->query($query);
    // print_r($dbnote);
    if($dbstudent->num_rows>0){
        $editstu=$dbstudent->fetch_assoc();
        $showModal = true;
        // print_r($editnote);
    }
    else{
        echo "Data not found";
        $showModal = false;
    }

}

if(isset($_POST['submit_note'])){
    $edit=$_SESSION['student_id'];
    $fnamesec=$minischl->real_escape_string($_POST['firstnametwo']);
    $lname=$minischl->real_escape_string($_POST['lastnametwo']);
    $matric=$minischl->real_escape_string($_POST['matrictwo']);
    $department=$minischl->real_escape_string($_POST['departtwo']);
    $email=$minischl->real_escape_string($_POST['emailtwo']);

    $query="UPDATE `student_table` SET `firstname`= '$fnamesec' , `lastname`= '$lname', `matric_no`='$matric', `department`='$department', `email`='$email' WHERE `student_id` =$edit";
    $dbcon=$minischl->query($query);
    if($dbcon){
        echo 'working';
    }
    else{
        echo 'not working'.$minischl->error;
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
            color : #000000;
            font-size:20px;
            font-weight:bold;
        }
        .n{
            font-size:17px;
        }
        .b{
            background-color: #e1c8fe;
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
            </div>
            <div class='d-flex gap-4 ms-3'>
                <h5><a href="?route=settings" class='m'>Settings</a></h5>
                <h5><a  class='m'>Eamil: <span class="n"><?php echo $usersec['email']?></span></a></h5>
                <h5><a href="?route=supervisorSignIn" class='m'>Logout</a></h5>
            </div>
        </div>
    </div> 

    <!-- Modal -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content w-75 h-75">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Student Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" placeholder="Firstname" class="form-control mb-4 shadow-none" name="firstnametwo" value="<?php echo isset($editstu['firstname']) ? htmlspecialchars($editstu['firstname']) : ''; ?>" required>

                    <input placeholder="Lastname" name="lastnametwo" class="form-control shadow-none mb-3" value="<?php echo isset($editstu['lastname']) ? htmlspecialchars($editstu['lastname']) : ''; ?>" required>

                    <input placeholder="Lastname" name="matrictwo" class="form-control shadow-none mb-3" value="<?php echo isset($editstu['matric_no']) ? htmlspecialchars($editstu['matric_no']) : ''; ?>" required>
                    
                    <input placeholder="Lastname" name="departtwo" class="form-control shadow-none mb-3" value="<?php echo isset($editstu['department']) ? htmlspecialchars($editstu['department']) : ''; ?>" required>
                    
                    <input placeholder="Lastname" name="emailtwo" class="form-control shadow-none mb-3" value="<?php echo isset($editstu['email']) ? htmlspecialchars($editstu['email']) : ''; ?>" required>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit_note" class="btn btn-primary" value="Save changes">
                </div>
            </div>
        </div>
    </div>
</form>

<?php if (isset($showModal) && $showModal): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {});
            myModal.show();
        });
    </script>
<?php endif; ?>

    <div class="d-flex justify-content-between mx-4">
        <div>
            <p class="m">Welcome: <span class="n"><?php echo $usersec['firstname'];?></span> <span class="n"><?php echo $usersec['lastname'];?></span></p>
        </div>
        <div>
            <p class="m">Serial No: <span class="n"><?php echo $usersec['supervisor_id'];?></span></p>
        </div>
    </div>


    <div class="row ms-5 p-5">
        <div class="col-8">
        <div <?php if(count($users)<1):?> >
                <p>Empty list</p>
                <?php endif; ?>
            </div>
            <table class='table table-striped' <?php if(count($users)>0) ?> >
                <tr>
                    <th>S/N</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Matric No</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php foreach ($users as $index=> $user):?>
                 <tr>
                 <td><?php echo htmlspecialchars ($index+1) ; ?></td>
                 <td><?php echo htmlspecialchars ($user['firstname']); ?></td>
                 <td><?php echo htmlspecialchars ($user['lastname']); ?></td>
                 <td><?php echo htmlspecialchars ($user['matric_no']); ?></td>
                 <td><?php echo htmlspecialchars ($user['department']); ?></td>
                 <td><?php echo htmlspecialchars ($user['email']); ?></td>

                 <td><form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <input type="hidden" name="student_id" value="<?php echo $user['student_id'];?>">
                    <button type="submit" name="submit_id" class="btn btn-success">Edit</button>
                 </form>
                </td>

                 <td>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"       style="display:inline;">
                    <input type="hidden" name="student_id" value="<?php echo $user['student_id']; ?>">
                    <input type="submit" name="submit_del" value="Delete" class="btn btn-danger"       onclick="return confirm('Are you sure you want to delete this student from your project?');">
                </form>
                </td>
                 </tr>
                 <?php endforeach; ?>
            </table>   
        </div>
    </div>
</body>
</html>
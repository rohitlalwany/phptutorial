<?php
session_start();
if (!isset($_SESSION['user_id'])){ ?>
    <script>
    alert('Login First.');
    location.href = "index.php";
    </script>
<?php }
include('./includes/db.php');

include('./includes/navbar.php');

$userid = $_SESSION['user_id'];

if ((isset($_POST['currentpassword'])) AND (isset($_POST['newpassword'])) AND (isset($_POST['re_password']))){
    $currentpassword =  md5($_POST['currentpassword']);       
    $newpassword =  md5($_POST['newpassword']); 
    $re_password =  md5($_POST['re_password']); 
    if ($newpassword!=$re_password){
        echo "Both Passwords are not matched.";
     }
     else if (($_POST['currentpassword']=='') OR ($_POST['newpassword']=='') OR ($_POST['re_password']=='')){
        echo "Invalid Passwords, Please Retry";
     } else {
         $check = "SELECT * FROM users WHERE `password`='".$currentpassword."' AND id='".$userid."'";
         $result = $conn->query($check);
         $count = $result->num_rows;
         if ($count==1){
             $update = "UPDATE users SET `password`='".$newpassword."' WHERE `password`='".$currentpassword."' AND id='".$userid."'";
             if ($conn->query($update)){
                //Success
                echo "Password Updated Successfully.";    
             } else {
                 //error
                 echo "Error in Password Update.";
             }
         } else {
             echo "Invalid Current Password.";
         }
     }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h4>Change Password</h4>
                    <form action="changepassword.php" method="POST">
                        <div class="form-group">
                            <label for="currentpassword">Current Password</label>
                            <input type="password" class="form-control" id="currentpassword" name="currentpassword"> 
                        </div>
                        <div class="form-group">
                            <label for="newpassword">New Password</label>
                            <input type="password" class="form-control" id="newpassword" name="newpassword"> 
                        </div>

                        <div class="form-group">
                            <label for="re_password">Retype New Password</label>
                            <input type="password" class="form-control" id="re_password" name="re_password"> 
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
</div>
    
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>
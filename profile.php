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

if ((isset($_POST['name'])) AND (isset($_POST['email']))){
    $name =  $_POST['name'];       
    $email =  $_POST['email']; 
    
    if (($_POST['name']=='') OR ($_POST['email']=='')){
        echo "Invalid Data";
        exit;
     }
     if ((strlen($name)>20) OR (strlen($name)<3)){
        echo "Invalid Name";
        exit;
     }
     if ((strlen($email)>50) OR (strlen($email)<15)){
        echo "Invalid Email";
        exit;
     }

     $query = "UPDATE users SET `name`='$name', `email`='$email' WHERE id='$userid'";
        if($conn->query($query)){
            echo "Updated Successfully.";
        } else {
            echo "Error Occurred.";
        }

}

$query_fetch = "SELECT * FROM users WHERE id='$userid'";
$result = $conn->query($query_fetch);
$row = $result->fetch_assoc();
$storedname = $row['name'];
$storedemail = $row['email'];

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
                    <h4>Profile</h4>
                    <form action="profile.php" method="POST">
                        <div class="form-group">
                            <label for="inputname">Name</label>
                            <input type="text" class="form-control" id="inputname" name="name" value="<?php echo $storedname;?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $storedemail;?>">
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
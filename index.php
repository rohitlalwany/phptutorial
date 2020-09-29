<?php
include('./includes/db.php');

    if ((isset($_POST['name'])) AND (isset($_POST['email'])) AND (isset($_POST['password'])) AND (isset($_POST['re_password']))){
        $name =  $_POST['name'];       
        $email =  $_POST['email'];       
        $password =  md5($_POST['password']);       
        $re_password =  md5($_POST['re_password']);  
             //admin 
             if ($password!=$re_password){
                echo "Both Passwords are not matched.";
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
             if (($_POST['password']=='') OR ($_POST['re_password']=='')){
                echo "Invalid Passwords";
                exit;
             }
    //For check if user already registed.
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);
    $count = $result->num_rows;
    if ($count>0){
        echo "Already Registered.";
    } else {
        $store = "INSERT INTO users (`name`, `email`, `password`) VALUES ('$name','$email','$password')";
        if ($conn->query($store)){
            echo "Registration Successful.";
        } else {
            echo "Error Occurred.";
        }
    }                 


    }



    if ((isset($_POST['loginemail'])) AND (isset($_POST['loginpassword']))){
        $loginemail =  $_POST['loginemail'];       
        $loginpassword =  md5($_POST['loginpassword']); 
        
        
        if (($_POST['loginemail']=='') OR ($_POST['loginpassword']=='')){
            echo "Invalid Login";
            exit;
         }

        $query = "SELECT * FROM users WHERE `email`='$loginemail' AND `password`='$loginpassword'";
        $result = $conn->query($query);
        $count = $result->num_rows;
        if ($count>0){
            $row = $result->fetch_assoc();
            echo "Login Successful.";
                session_start();
                $_SESSION['user_id'] = $row['id'];
            ?>
            <script>
                location.href = "home.php";
            </script>
            <?php
        } else {
            echo "Invalid Login.";
        }
    

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Login</h4>
                    <form action="index.php" method="POST">
                        <div class="form-group">
                            <label for="loginemail">Email address</label>
                            <input type="email" class="form-control" id="loginemail" name="loginemail">
                        </div>
                        <div class="form-group">
                            <label for="loginpassword">Password</label>
                            <input type="password" class="form-control" id="loginpassword" name="loginpassword"> 
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>

                <div class="col-md-6">
                <h4>Register</h4>
                    <form action="index.php" method="POST">
                        <div class="form-group">
                            <label for="inputname">Name</label>
                            <input type="text" class="form-control" id="inputname" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Retype Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" name="re_password">
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>                
                </div>
            </div>
        </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>
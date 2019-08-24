<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

 <link href="css/main.css" rel="stylesheet"/>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <div>
                    <?php 
                    if($_POST){

                        $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
                        $email = trim($email);
                        $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
                        $password = trim($password);
                        $confirm_password = ((isset($_POST['confirm_password']))?sanitize($_POST['confirm_password']):'');
                        $confirm_password = trim($confirm_password);

                        $qryUser = $db->query("SELECT * FROM signup WHERE email = '$email'");
                        $userSignup = mysqli_fetch_assoc($qryUser);
                        $userCount = mysqli_num_rows($qryUser);
                        if($userCount > 0){
                            $errors[] = 'This email already exist in our database';
                        }
                        if($password != $confirm_password){
                            $errors[] = 'Password not matched';
                        }
                        if(!empty($errors)){
                            echo display_errors($errors);
                        }else {
                            $pass = password_hash($password,PASSWORD_DEFAULT);
                            $qryInsert = $db->query("INSERT INTO signup (email,password) VALUES ('$email','$pass')");
                            if ($qryInsert) {
                               echo "New record created successfully";
                               header('location:login.php');
                            } else {
                               echo "Error: " . $sql . "" . mysqli_error($conn);
                            }

                        }
                    }
                    ?>
                </div>
                <h3 class="title text-center">Create Account</h3><br>
                <img class="profile-img" src="BS3/assets/img/ietlogo.png" alt="">
                <form action="signup.php" class="form-signin" class="form-group" method="post" >
                    <input type="email" class="form-control" name="email" value="" placeholder="Email" required ><br>
                    <input type="password" class="form-control" name="password" value="" placeholder="Password" required><br>
                    <input type="text" class="form-control" name="confirm_password" value="" placeholder="Confirm Password" required ><br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>    
                </form>
                <br>
            </div>
            <a href="login.php" class="text-center new-account btn btn-default">Back to login </a>
        </div>
    </div>
</div>
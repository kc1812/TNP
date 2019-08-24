<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';

$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);

$errors = array();
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
                       
                        /*if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                            $errors[] = 'You must enter a valid email';
                        }*/
                        
                        $qryUser = $db->query("SELECT * FROM signup WHERE email = '$email'");
                        $user = mysqli_fetch_assoc($qryUser);
                        $userCount = mysqli_num_rows($qryUser);
                        if($userCount < 1){
                            $errors[] = 'That email doesn\'t exist in our database';
                        }
                        $hash = substr($user['password'], 0, 60);
                        
                        
                        if(!password_verify($password , $hash)){
                            $errors[] = 'The password doesnot match our records. Please try again';
                        }
                        if(!empty($errors)){
                            echo display_errors($errors);
                        }else {
                            if($user['admin'] == "no"){
                                /*$queryStud = $db->query("SELECT * FROM student WHERE email = '$email'"); 
                                $student = mysqli_fetch_assoc($queryStud);
                                $stud_id = $student['stud_id'];*/
                                
                                login($user['email']);
                                
                            }
                            else{
                                
                                login_admin($user['email']);
                            }
                        }
                    }
                    ?>
                </div>
                <h3 class="title text-center">Login</h3><br>
                <img class="profile-img" src="BS3/assets/img/ietlogo.png" alt="">
                <form class="form-signin" action="login.php" method="post" >
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" value="" placeholder="Email" autofocus required>
                        <input type="password" class="form-control" name="password" value="" placeholder="Password" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Sign in</button>
                        <label class="checkbox pull-left">
                            <input type="checkbox" name="remember_me" value="remember_me">
                            Remember me
                        </label>
                    </div>
                </form>
                <br>
            </div>
            <a href="signup.php" class="text-center new-account btn btn-default">New User? </a>
        </div>
    </div>
</div>

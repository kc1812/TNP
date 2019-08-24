<?php
include 'includes/header.php';
include 'includes/sidebar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';
if( !is_logged_in_admin()){
    login_error_redirect('../login.php');
}
$full_name = $email = $year_of_passing = $branch = $mobile_no = $board_10 = $perc_10  = $passing_year_10 = $board_12 = $perc_12  = $passing_year_12  = $perc_diploma = $passing_year_diploma = $perc_btech = $backlog_active = $roll_no = $countStudent = null ;


if(!empty($_POST)){ 
    $roll_no = $_POST['roll_no'] ;
    $qryStudent = $db->query("SELECT * FROM student WHERE roll_no = '$roll_no'");
    $resultStudent = mysqli_fetch_assoc($qryStudent);
    $countStudent = mysqli_num_rows($qryStudent);



    $full_name            = $resultStudent['full_name'] ;
    $email                = $resultStudent['email'];
    $year_of_passing      = $resultStudent['year_of_passing'] ;
    $branch               = $resultStudent['branch'] ;
    $mobile_no            = $resultStudent['mobile_no'] ;
    $board_10             = $resultStudent['10_board'] ;
    $perc_10              = $resultStudent['10_perc'] ;
    $passing_year_10      = $resultStudent['10_passing_year'] ;
    $board_12             = $resultStudent['12_board'] ;
    $perc_12              = (($resultStudent['12_perc'] != 0)? $resultStudent['12_perc'] :"") ;
    $passing_year_12      = $resultStudent['12_passing_year'] ;
    $perc_diploma         = (($resultStudent['diploma_perc'] != 0)? $resultStudent['diploma_perc'] :"") ;
    $passing_year_diploma = $resultStudent['diploma_passing_year'] ;
    $perc_btech           = $resultStudent['btech_perc'] ;
    $backlog_active       = $resultStudent['backlog_active'] ;
  
}


?>
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Welcome</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                       
                        <li>
                            <a href="logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-md-12">
                        <div class="card"> 
                            <div class="header">
                                <h4 class="title">Search Student</h4>
                            </div>
                            <div class="content">
                                <form action="view.php" method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>RollNo.</label>
                                                <input type="text" class="form-control" placeholder="RollNo" name="roll_no" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <br>
                                               <button type="submit" class="btn btn-info btn-fill">Search</button> 
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php if(!empty($_POST) && $countStudent==1) : ?>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Student Details</h4>
                            </div>
                            <div class="content">
                                 <ul>
                                    <li>
                                        <b>Full Name</b> : <?= $full_name  ;?>
                                    </li>
                                    <li>
                                        <b>Roll No </b> : <?= $roll_no  ;?>
                                    </li>
                                    <li>
                                        <b>Email</b> : <?= $email ;?>
                                    </li>
                                    <li>
                                        <b>Branch</b> : <?= $branch ;?>
                                    </li>
                                    <li>
                                        <b>Year of passing</b> : <?= $year_of_passing ;?>
                                    </li>
                                    <li>
                                        <b>Mobile No.</b> : <?= $mobile_no ;?>
                                    </li>
                                    <li>
                                        <b>10th board Name</b> : <?= $board_10  ;?>
                                    </li>
                                    <li>
                                        <b>10th %</b> : <?= $perc_10  ;?>
                                    </li>
                                    <li>
                                        <b>10th Passing year</b> : <?= $passing_year_10 ;?>
                                    </li>
                                    <li>
                                        <b>12th board Name</b> : <?= $board_12 ;?>
                                    </li>
                                    <li>
                                        <b>12th %</b> : <?= $perc_12 ;?>
                                    </li>
                                    <li>
                                        <b>12th Passing year</b> : <?= $passing_year_12 ;?>
                                    </li>
                                    <li>
                                        <b>Diploma %</b> : <?= $perc_diploma ;?>
                                    </li>
                                    <li>
                                        <b>Diploma Passing year</b> : <?= $passing_year_diploma ;?>
                                    </li>
                                    <li>
                                        <b>Btech %</b> : <?= $perc_btech ;?>
                                    </li>
                                    <li>
                                        <b>Active backlog</b> : <?= $backlog_active ;?>
                                    </li>
                                    
                                 </ul>
                            </div>
                            <?php endif ; ?>
                        </div>
                    </div>
                    

               </div>
            </div>
        </div>
<?php
include 'includes/footer.php';
?>     
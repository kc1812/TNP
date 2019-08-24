<?php
include 'includes/header.php';
include 'includes/sidebar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';
if( !is_logged_in()){
    login_error_redirect();
}

$email = $_SESSION['stud'] ;

if($_POST){
    $full_name = $_POST['full_name'] ;
    $roll_no  = $_POST['roll_no'] ;
    $year_of_passing = $_POST['year_of_passing'] ;
    $branch = $_POST['branch'] ;
    $mobile_no = $_POST['mobile_no'] ;
    $board_10 = $_POST['board_10'] ;
    $perc_10 = $_POST['perc_10'] ;
    $passing_year_10 = $_POST['passing_year_10'] ;
    $board_12 = $_POST['board_12']  ;
    $perc_12 = (($_POST['perc_12'] !="")? $_POST['perc_12'] : 0) ;
    $passing_year_12 = $_POST['passing_year_12']  ;
    $perc_diploma = (($_POST['perc_diploma'] !="")? $_POST['perc_diploma'] : 0) ;
    $passing_year_diploma = $_POST['passing_year_diploma'] ;
    $perc_btech = $_POST['perc_btech'] ;
    $backlog_active  = $_POST['backlog_active'] ;
        

    $qryCheck = $db->query("SELECT * FROM student WHERE email = '$email'");
    echo $studCheck = mysqli_num_rows($qryCheck);

    if($studCheck > 0) {

        $qryUpdate = $db->query("UPDATE student SET full_name = '$full_name', roll_no = '$roll_no', year_of_passing = '$year_of_passing' , branch = '$branch', mobile_no = '$mobile_no', 10_board = '$board_10', 10_perc = '$perc_10' , 10_passing_year = '$passing_year_10', 12_board = '$board_12', 12_perc = '$perc_12', 12_passing_year = '$passing_year_12', diploma_perc = '$perc_diploma', diploma_passing_year = '$passing_year_diploma', btech_perc = '$perc_btech', backlog_active = '$backlog_active'");
        
    }else {
        $qryInsert = $db->query("INSERT INTO student(full_name,email,roll_no,year_of_passing,branch,mobile_no,10_board,10_perc,10_passing_year,12_board,12_perc,12_passing_year,diploma_perc,diploma_passing_year,btech_perc,backlog_active) VALUES ( '$full_name', '$email','$roll_no','$year_of_passing' ,'$branch','$mobile_no','$board_10','$perc_10' ,'$passing_year_10','$board_12','$perc_12','$passing_year_12','$perc_diploma','$passing_year_diploma','$perc_btech','$backlog_active') ") ;

    }
}

$full_name = $roll_no =  $year_of_passing = $branch  = $mobile_no = $board_10 = $perc_10 = $passing_year_10 =     $board_12 = $perc_12 = $passing_year_12 = $perc_diploma = $passing_year_diploma = $perc_btech = $backlog_active = "";

$qryRead = $db->query("SELECT * FROM student WHERE email = '$email'");
$studData = mysqli_fetch_assoc($qryRead);
$studCount = mysqli_num_rows($qryRead);
if($studCount == 1){
    $full_name       = $studData['full_name'] ;
    $roll_no         = $studData['roll_no'] ;
    $email           = $studData['email'] ;
    $year_of_passing = $studData['year_of_passing'] ;
    $branch          = $studData['branch'] ;
    $mobile_no       = $studData['mobile_no'] ;
    $board_10        = $studData['10_board'] ;
    $perc_10         = $studData['10_perc'] ;
    $passing_year_10 = $studData['10_passing_year'] ;
    $board_12        = $studData['12_board'] ;
    $perc_12         = (($studData['12_perc'] != 0)? $studData['12_perc'] :"") ;
    $passing_year_12 = $studData['12_passing_year'] ;
    $perc_diploma    = (($studData['diploma_perc'] != 0)? $studData['diploma_perc'] :"") ;
    $passing_year_diploma = $studData['diploma_passing_year'] ;
    $perc_btech      = $studData['btech_perc'] ;
    $backlog_active  = $studData['backlog_active'] ;
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
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form action="profile.php" method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>FullName</label>
                                                <input type="text" class="form-control" placeholder="FirstName LastName" name="full_name" value="<?= $full_name;?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>RollNo.</label>
                                                <input type="text" class="form-control" placeholder="RollNo" name="roll_no" value="<?= $roll_no;?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $email;?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Year of passing</label>
                                                <input type="text" class="form-control" placeholder="Year" name="year_of_passing" value="<?= $year_of_passing;?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Branch</label>
                                                <input type="text" class="form-control" placeholder="Branch"  name="branch" value="<?= $branch;?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile No.</label>
                                                <input type="text" class="form-control" placeholder="Mobile" name="mobile_no" value="<?= $mobile_no;?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>10th Board</label>
                                                <input type="text" class="form-control" placeholder="Board Name" name="board_10" value="<?= $board_10;?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>10th %</label>
                                                <input type="text" class="form-control" placeholder="Percentage" name="perc_10" value="<?= $perc_10;?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Year of passing 10th</label>
                                                <input type="text" class="form-control" placeholder="year of passing 10th" name="passing_year_10" value="<?= $passing_year_10;?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>12th Board</label>
                                                <input type="text" class="form-control" placeholder="Board Name" name="board_12" value="<?= $board_12;?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>12th %</label>
                                                <input type="text" class="form-control" placeholder="Percentage" name="perc_12" value="<?= $perc_12;?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Year of passing 12th</label>
                                                <input type="text" class="form-control" placeholder="year of passing 12th" name="passing_year_12" value="<?= $passing_year_12;?>" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Diploma %</label>
                                                <input type="text" class="form-control" placeholder="Diploma %" name="perc_diploma" value="<?= $perc_diploma;?>"  >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Year of passing Diploma</label>
                                                <input type="text" class="form-control" placeholder="Year of passing Diploma" name="passing_year_diploma" value="<?= $passing_year_diploma;?>" >
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Btech %</label>
                                                <input type="text" class="form-control" placeholder="Btech %" name="perc_btech" value="<?= $perc_btech;?>" required >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Active Backlogs</label>
                                                <input type="text" class="form-control" placeholder="No. of Active Backlogs" name="backlog_active" value="<?= $backlog_active;?>" required>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

<?php
include 'includes/footer.php';
?>     
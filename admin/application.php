<?php
include 'includes/header.php';
include 'includes/sidebar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';
if( !is_logged_in_admin()){
    login_error_redirect('../login.php');
}

$queryComp = $db->query("SELECT * FROM company ORDER BY comp_id");
$qryApp = $comp_id =null;

if(isset($_POST['company_name'])  ){
    $company_name = $_POST['company_name'];
    $qryCompany = $db->query("SELECT * FROM company WHERE company_name = '$company_name'");
    $company   = mysqli_fetch_assoc($qryCompany);
    $comp_id   = $company['comp_id'];
    $qryApp = $db->query("SELECT * FROM student_company WHERE comp_id = '$comp_id'");
    
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
                    <a class="navbar-brand" href="#"><b>Application Status</b></a>
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
                            <?php if(!isset($_POST['company_name'])) : ?>
                            <div class="card"> 
                                <div class="header">
                                    <h4 class="title">Search</h4>
                                </div>
                                <div class="content">
                                    <form action="application.php" method="post">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="company_name">Company Name</label>
                                                    <select class="form-control" id="company_name" name="company_name">
                                                        <option value=""></option>
                                                        <?php while($resultCompany = mysqli_fetch_assoc($queryComp)) : ?>
                                                            <option value="<?=$resultCompany['company_name'];?>"><?=$resultCompany['company_name'] ;?></option>
                                                        <?php 
                                                       
                                                        endwhile ; ?>
                                                    </select>
                                                    
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
                            <?php endif ; ?>
                            <?php if(isset($_POST['company_name']) ) : 
                                 $i = 1;
                            ?>
                            <div class="card" style="overflow-y: scroll;overflow-x: scroll" >
                                <!-- style="overflow-y: scroll" -->
                                <div class="header">
                                    <h4 class="title"><b>Company name : <?= $company_name; ?></b></h4>
                                </div>                            
                                <div class="content">    
                                    <form action="application.php" method="post">
                                        <div class="table-full-width">
                                            <table id="table" class="table table-responsive table-bordered " >
                                                <!-- style="width:2000px;" -->
                                                <thead>
                                                    <th><b>S.No.</b></th>
                                                    <th><b>Student Name</b></th>
                                                    <th><b>Branch</b></th>
                                                    <th><b>Roll No</b></th>
                                                    <th><b>Email</b></th>
                                                    <th><b>Mobile No</b></th>
                                                    <th><b>10th Board Name</b></th>
                                                    <th><b>Percentage in 10th</b></th>
                                                    <th><b>10th Passing Year</b></th>
                                                    <th><b>12th Board Name</b></th>
                                                    <th><b>Percentage in 12th</b></th>
                                                    <th><b>12th Passing Year</b></th>
                                                    <th><b>Diploma percentage</b></th>
                                                    <th><b>Diploma Passing Year</b></th>
                                                    <th><b>Btech Percentage</b></th>
                                                    <th><b>Year of Passing Btech</b></th>
                                                    <th><b>No of Active backlogs</b></th>
                                                    <th><b>Job Position</b></th>
                                                    <!-- <th></th> -->
                                                </thead>
                                                <tbody> 
                                                    <?php while($resultApp = mysqli_fetch_assoc($qryApp)) : 
                                                        $stud_id = $resultApp['stud_id'];
                                                        $qryStud = $db->query("SELECT * FROM student WHERE stud_id = '$stud_id' ") ;
                                                        $resultStud = mysqli_fetch_assoc($qryStud);
                                                    ?>  
                                                    <tr>
                                                        <td><?= $i++ ;?></td>
                                                        <td><?=$resultStud['full_name']; ?></td>
                                                        <td><?=$resultStud['branch'] ;?></td>
                                                        <td><?=$resultStud['roll_no'] ;?></td>
                                                        <td><?=$resultStud['email'] ;?></td>
                                                        <td><?=$resultStud['mobile_no'] ;?></td>
                                                        <td><?=$resultStud['10_board'] ;?></td>
                                                        <td><?=$resultStud['10_perc'] ;?></td>
                                                        <td><?=$resultStud['10_passing_year'] ;?></td>
                                                        <td><?=$resultStud['12_board'] ;?></td>
                                                        <td><?=(($resultStud['12_perc'] != 0)? $resultStud['12_perc'] :" ") ;?></td>
                                                        <td><?=$resultStud['12_passing_year'] ;?></td>
                                                        <td><?=(($resultStud['diploma_perc'] != 0)? $resultStud['diploma_perc'] :" ") ;?></td>
                                                        <td><?=$resultStud['diploma_passing_year'] ;?></td>
                                                        <td><?=$resultStud['btech_perc'] ;?></td>
                                                        <td><?=$resultStud['year_of_passing'] ;?></td>
                                                        <td><?=$resultStud['backlog_active'] ;?></td>
                                                        <td><?= $company['job_position'] ?></td>
                                                       <!--  <td><input type="checkbox" name="checkbox[]" value="<?=$resultApp['id'];?>"></td> -->
                                                    </tr>
                                                    <?php endwhile ;?>                                     
                                                </tbody>
                                            </table>
                                        </div> 
                                     <!-- <button type="submit" id="create_excel" name="export" class="btn btn-success btn-fill">Export To Excel</button>  --> 
                                    </form>     
                                </div>                                                          
                            </div>
                            <?php endif ; ?>
                        </div>
                   </div>             
            </div>
        </div>
        <!-- for excel export -->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/FileSaver.min.js"></script>
        <script src="js/bootstrap.min_1.js"></script>
        <script src="js/tableexport.min.js"></script>
        <script>
            $('table').tableExport();
        </script>    
<?php
include 'includes/footer.php';
?>     
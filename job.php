<?php
include 'includes/header.php';
include 'includes/sidebar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';
if( !is_logged_in()){
    login_error_redirect();
}

$query1 = $db->query("SELECT * FROM company WHERE old = 0");

$student_email = $_SESSION['stud'];
$qryStud = $db->query( "SELECT * FROM student WHERE email = '$student_email'");
$resultStud = mysqli_fetch_assoc($qryStud);
$countStud = mysqli_num_rows($qryStud);
if($countStud == 0){
    echo "<p class='text-center text-danger'>update your profile first</p>";
}

if(!empty( $_POST)){
    $company_name = $_POST['submit'];
        $qryComp = $db->query( "SELECT * FROM company WHERE company_name = '$company_name'");
        $resultComp = mysqli_fetch_assoc($qryComp);

        $stud_id = $resultStud['stud_id'];
        $comp_id = $resultComp['comp_id'];
        $job_position = $resultComp['job_position'];
        $type_of_company = $resultComp['type_of_company'];

        $qryApplication = $db->query( "INSERT INTO student_company (stud_id, comp_id, job_position, type_of_company) VALUES ('$stud_id','$comp_id','$job_position','$type_of_company')"); 
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
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        
                                        <th>Name Of Company</th>
                                        <th>Job position</th>
                                        <th>Type Of Company</th>
                                    </thead>
                                    <tbody>
                                    <?php while($resultCompany = mysqli_fetch_assoc($query1)) : ?>
                                        <tr>
                                            <form action="job.php" method="post">
                                                <td><?= $resultCompany['company_name'] ;?></td>
                                                <td><?= $resultCompany['job_position'] ;?></td>
                                                <td><?= $resultCompany['type_of_company'] ;?></td>
                                                <?php 
                                                    if($countStud > 0 ) :
                                                        $stud_id = $resultStud['stud_id'];
                                                        $comp_id = $resultCompany['comp_id'];
                                                        $job_position = $resultCompany['job_position'];
                                                        $type_of_company = $resultCompany['type_of_company'];

                                                        $qryCheck = $db->query("SELECT * FROM student_company WHERE stud_id = '$stud_id' AND comp_id = '$comp_id'");
                                                        $studCheck = mysqli_num_rows($qryCheck);
                                                        if($studCheck > 0) : 
                                                        ?>
                                                        <td><button name="submit" value="" class="btn btn-success btn-fill pull-right" disabled>Already Applied</button></td>
                                                        <?php else : ?>
                                                        <td><button type="submit" name="submit" value="<?= $resultCompany['company_name'] ;?>" class="btn btn-info btn-fill pull-right">Apply Now</button></td>
                                                        <?php endif ;?>
                                                    <?php else : ?>
                                                        <td><button type="submit" name="submit" value="" class="btn btn-info btn-fill pull-right" disabled>Apply Now</button></td>
                                                    <?php endif ;?>
                                            </form>
                                        
                                        </tr>
                                     <?php endwhile; ?>      
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

               </div>
            </div>
        </div>
<?php
include 'includes/footer.php';
?>     
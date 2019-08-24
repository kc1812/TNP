<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';

if( !is_logged_in()){
    login_error_redirect();
}

$queryComp = $db->query("SELECT * FROM company ");
$qryPlaced = $comp_id = null;

if(!empty($_POST) ){
    $company_name = $_POST['company_name'];
    $qryCompany = $db->query("SELECT * FROM company WHERE company_name = '$company_name'");
    $company   = mysqli_fetch_assoc($qryCompany);
    $comp_id   = $company['comp_id'];
    $qryPlaced = $db->query("SELECT * FROM student_company WHERE comp_id = '$comp_id' AND selected = 'yes'");
    
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
                                <h4 class="title">Search</h4>
                            </div>
                            <div class="content">
                                <form action="results.php" method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="company_name">Company Name</label>
                                                <select class="form-control" id="company_name" name="company_name">
                                                    <option value=""></option>
                                                    <?php while($resultCompany = mysqli_fetch_assoc($queryComp)) : ?>
                                                        <option value="<?=$resultCompany['company_name'];?>"><?=$resultCompany['company_name'] ;?></option>
                                                    <?php endwhile ; ?>
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

                        <?php if(!empty($_POST) ) : 
                            $i =1;
                        ?>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Students Placed in <?= $company_name ;?></h4>
                            </div>                            
                            <div class="content">    
                                <form action="updateResult.php" method="post">
                                    <div class="table-full-width">
                                        <table class="table">
                                            <thead>
                                                <th>SNo.</th>
                                                <th>Student Name</th>
                                                <th>Roll No</th>
                                                <th>Job Position</th>
                                                <th>CTC
                                            </thead>
                                            <tbody> 
                                                <?php while($resultPlaced = mysqli_fetch_assoc($qryPlaced)) : 
                                                    $stud_id = $resultPlaced['stud_id'];
                                                    $qryStudent = $db->query("SELECT * FROM student WHERE stud_id = '$stud_id'");
                                                    $studentDetails = mysqli_fetch_assoc($qryStudent);

                                                ?>  
                                                <tr>
                                                    <td><?=$i++;?></td>
                                                    <td><?=$studentDetails['full_name'];?></td>
                                                    <td><?=$studentDetails['roll_no'];?></td>
                                                    <td><?=$resultPlaced['job_position'];?></td> 
                                                    <td><?=$company['ctc'];?></td>
                                                </tr>
                                                <?php endwhile ;?>                                     
                                            </tbody>
                                        </table>
                                    </div> 
                                </form>     
                            </div>                                                          
                        </div>
                        <?php endif ; ?>
                    </div>
               </div>
            </div>
        </div>
<?php
require_once 'includes/footer.php';
?>     
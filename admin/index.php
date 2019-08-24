<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';
if( !is_logged_in_admin()){
    login_error_redirect('../login.php');
}
if($_POST){
    $company_name  = $_POST['company_name'];
    $date_of_visit = $_POST['date_of_visit'];
    $date_of_closing = $_POST['date_of_closing'];
    /*$today = date("Y-m-d");
    if(strtotime($date_of_closing) >= strtotime($today) ){
        
    }*/
  
   $type_of_company = $_POST['type_of_company'];
   $ctc = $_POST['ctc'];
   $job_position = $_POST['job_position'];
   $details = $_POST['details'];

    $qryInsert = $db->query("INSERT INTO company (company_name, date_of_visit,date_of_closing, type_of_company, ctc, job_position, details) VALUES ('$company_name', '$date_of_visit','$date_of_closing', '$type_of_company', '$ctc', '$job_position', '$details')");
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
                    <a class="navbar-brand" href="#">Welcome Admin</a>
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
                                <h4 class="title">Add Company Details</h4>
                            </div>
                            <div class="content">
                                <form action="index.php" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <input type="text" class="form-control" placeholder="" name="company_name" value="" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                       <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Type of Company</label>
                                                <input type="text" class="form-control" placeholder="" name="type_of_company" value="" required>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>CTC</label>
                                                <input type="text" class="form-control" placeholder="" name="ctc" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Job Position</label>
                                                <input type="text" class="form-control" placeholder="" name="job_position" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                       <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date of Visit</label>
                                                <input type='date' class="form-control" name="date_of_visit" />   
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                       <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Closing Date for Job Opening</label>
                                                <input type='date' class="form-control" name="date_of_closing" />
                                            </div>
                                        </div> 
                                    </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Details</label>
                                                
                                                <textarea rows="5" class="form-control" placeholder="" name="details" value="Mike"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">ADD</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

               </div>
            </div>
        </div>
         <!-- date time -->
         <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        
        <script>
            $(document).ready(function(){
                 $('#datepicker').datepicker();
            });
        </script> -->
<?php
require_once 'includes/footer.php';
?>     

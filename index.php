<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/config.php';
require_once BASEURL.'includes/header.php';
require_once BASEURL.'includes/sidebar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';
if( !is_logged_in()){
    login_error_redirect();
}
$qryNews = $db->query("SELECT * FROM company ORDER BY date_of_visit");

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
                                <h4 class="title">News</h4>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                            <?php while ($result = mysqli_fetch_assoc($qryNews)) : ?>
                                            <tr>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <b>Company Name</b> : <?= $result['company_name'] ;?>
                                                        </li>
                                                        <li>
                                                            <b>Date of Vist</b> : <?= $result['date_of_visit'] ;?>
                                                        </li>
                                                        <li>
                                                            <b>Type of Company</b> : <?= $result['type_of_company'] ;?>
                                                        </li>
                                                        <li>
                                                            <b>CTC offered</b> : <?= $result['ctc'] ;?>
                                                        </li>
                                                        <li>
                                                            <b>Job Position</b> : <?= $result['job_position'] ;?>
                                                        </li>
                                                        <li>
                                                            <b>Details</b> : <?= $result['details'] ;?>       
                                                        </li>
                                                    </ul>
                                                </td>
                                                
                                            </tr>
                                             <?php endwhile ; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

               </div>
            </div>
        </div>
<?php
require_once BASEURL.'includes/footer.php';
?>     
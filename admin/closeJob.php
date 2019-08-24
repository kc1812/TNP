<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/core/init.php';
if( !is_logged_in_admin()){
    login_error_redirect('../login.php');
}
if( isset( $_GET['delete'] ) && !empty( $_GET['delete'] ) ) {
    $delete_id = (int)$_GET['delete'];
     $db->query( "UPDATE company SET old = 1 WHERE comp_id = '$delete_id'"  );
    header('Location: closeJob.php');
}

$qryJob = $db->query("SELECT * FROM company WHERE old = 0 ");
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
            			<div class="card ">
                            <div class="header">
                                <h4 class="title">Close Job Openings</h4>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                        	<?php while($resultCompany = mysqli_fetch_assoc($qryJob)) : ?>
	                                            <tr>
	                                            	<td class="td-actions">
	                                                    <!-- <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
	                                                        <i class="fa fa-edit"></i>
	                                                    </button> -->
	                                                    <a href="closeJob.php?delete=<?= $resultCompany['comp_id'] ;?>"><button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-lg">
	                                                        <i class="fa fa-times"></i>
	                                                    </button></a>
	                                                </td>
	                                                <td><?= $resultCompany['company_name'] ;?></td>
	                                                <td><?= $resultCompany['job_position'] ;?></td>
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
        </div>
        
<?php
require_once 'includes/footer.php';
?>
<?php 
$db = mysqli_connect('localhost','root','','batch_2017-18');
if(mysqli_connect_errno()){
	echo 'Database connection failed with following errors:'.mysqli_connect_error();
	die();
}

session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/tnp/config.php';
require_once BASEURL.'helpers/helpers.php';
 
/*if( isset($_SESSION['stud'])){
	$stud_id = $_SESSION['stud'];
	$query = $db->query("SELECT * FROM student WHERE $stud_id = '$stud_id'");
	$stud_data = mysqli_fetch_assoc( $query );
}*/

if( isset($_SESSION['error_flash'])){
	echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
	unset( $_SESSION['error_flash'] );
}
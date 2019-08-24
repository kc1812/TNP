<?php
function display_errors($errors){
	$display = '<ul class="bg-danger">';
	foreach ($errors as $error) {
		$display .= '<li class="text-danger">'.$error.'</li>';
	}
	$display .= '</ul>';
	return $display;
}

function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function login($stud_email){
	$_SESSION['stud'] = $stud_email;
	$_SESSION['success_flush'] = 'You are logged in!';
	header('Location: index.php');
}
function login_admin($admin_email){
	$_SESSION['admin'] = $admin_email;
	header('Location: admin/index.php');
}

function is_logged_in(){
 	if(isset($_SESSION['stud'])) {
 		return true;
 	}else {
 		return false;
 	}
 }
 function is_logged_in_admin(){
 	if(isset($_SESSION['admin'])) {
 		return true;
 	}else {
 		return false;
 	}
 }

function login_error_redirect( $url = 'login.php'){
	$_SESSION['error_flash'] = 'You must be logged in to access this page!';
	header('Location:'.$url);
}

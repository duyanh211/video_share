<?php
	include 'db_connect.php';
ob_start();

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		header('location:index.php');
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'save_upload'){
	$save = $crud->save_upload();
	if($save)
		echo $save;
}
if($action == 'delete_upload'){
	$id = $_POST['id'];
	$qryo = $conn->query("DELETE FROM `subcribe` WHERE id_channel = '$id'");
	$qryy = $conn->query("DELETE FROM `views` WHERE upload_id = '$id'");
	if($qryo && $qryy){
		$qry = $conn->query("DELETE FROM `video_uploads` WHERE id = '$id'");
		if($qry){
			echo "Delete success";
		}
	} else echo "Unsuccess delete";
}
ob_end_flush();
?>

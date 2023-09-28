<?php
session_start();
if(isset($_SESSION['bldgpermitAdmin'])) {
	include "../../includes/connect.php";
	$loginSession = $_SESSION['bldgpermitAdmin'];
	$sqlLoggedUser = "SELECT * FROM arta_registration WHERE loginSession = '$loginSession'";
	$resLoggedUser = mysqli_query($conn, $sqlLoggedUser);
	$rowLoggedUser = mysqli_fetch_assoc($resLoggedUser);
	$LoggedUserID = $rowLoggedUser['reg_id'];
	$LoggedUserName = $rowLoggedUser['reg_fname'] ." ". $rowLoggedUser['reg_lname'];
	$LoggedUserLevel = $rowLoggedUser['status'];
	date_default_timezone_set('Asia/Kuala_Lumpur');
} else {
	header('location: ../../../login');
}
?>
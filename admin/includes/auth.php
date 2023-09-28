<?php

session_start();

if(!isset($_SESSION['bldgpermitAdmin'])) {
	header('location: ../../login');
} else {
	include "../includes/connect.php";
	$loginSession = $_SESSION['bldgpermitAdmin'];
	$sqlLoggedUser = "SELECT * FROM arta_registration WHERE loginSession = '$loginSession'";
	$resLoggedUser = mysqli_query($conn, $sqlLoggedUser);
	$rowLoggedUser = mysqli_fetch_assoc($resLoggedUser);
	$LoggedUserID = $rowLoggedUser['reg_id'];
	$LoggedUserName = $rowLoggedUser['reg_fname'] ." ". $rowLoggedUser['reg_lname'];
	$LoggedUserLevel = $rowLoggedUser['status'];
	$LoggedOwner = $rowLoggedUser['owner'];
}

?>
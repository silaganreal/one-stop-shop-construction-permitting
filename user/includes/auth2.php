<?php

session_start();

if(!isset($_SESSION['bldgpermit'])) {
	header('location: ../../../login');
} else {
	include "../../includes/connect.php";
	$loginSession = $_SESSION['bldgpermit'];
	$sqlLoggedUser = "SELECT * FROM arta_registration WHERE loginSession = '$loginSession'";
	$resLoggedUser = mysqli_query($conn, $sqlLoggedUser);
	$rowLoggedUser = mysqli_fetch_assoc($resLoggedUser);
	$LoggedUserID = $rowLoggedUser['reg_id'];
	$LoggedUserName = $rowLoggedUser['reg_fname'] ." ". $rowLoggedUser['reg_lname'];
}

?>
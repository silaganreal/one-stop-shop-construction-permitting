<?php
session_start();
if(isset($_SESSION['bldgpermit'])) {
	header('location: document-verification');
	
} else {
	header('location: ../../../login');
}
?>
<?php
session_start();

if(isset($_SESSION['bldgpermitAdmin'])) {
	header('location: admin');
} else {
	header('location: login');
}

if(isset($_SESSION['bldgpermit'])) {
	header('location: user');
} else {
	header('location: login');
}

?>
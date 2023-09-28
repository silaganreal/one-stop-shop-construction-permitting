<?php
session_start();
include "includes/connect.php";

if( isset($_SESSION['bldgpermit']) ) {

  $loginSession = $_SESSION['bldgpermit'];
  $sql_user = "SELECT * FROM arta_registration WHERE loginSession = '$loginSession'";
  $res_user = mysqli_query($conn, $sql_user);
  $num_user = mysqli_num_rows($res_user);

  if($num_user == 1) {
    
    $row_user = mysqli_fetch_assoc($res_user);
    header('location: online-applications');

  } else {
    header('location: ../login');
  }

} else {
  header('location: ../login');
}

?>
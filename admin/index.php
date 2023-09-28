<?php
session_start();
include "includes/connect.php";

if( isset($_SESSION['bldgpermitAdmin']) ) {

  $loginSession = $_SESSION['bldgpermitAdmin'];
  $sql_user = "SELECT * FROM arta_registration WHERE loginSession = '$loginSession'";
  $res_user = mysqli_query($conn, $sql_user);
  $num_user = mysqli_num_rows($res_user);

  if($num_user == 1) {
    
    $row_user = mysqli_fetch_assoc($res_user);

    if($row_user['status'] == '1') {
      header('location: dashboard');
    } elseif($row_user['status'] == '3') {
      header('location: frontline');
    }

  } else {
    header('location: ../login');
  }

} else {
  header('location: ../login');
}

?>
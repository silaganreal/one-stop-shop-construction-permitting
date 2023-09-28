<?php
session_start();
unset($_SESSION['online_appointment']);

if( isset($_GET['account']) && isset($_GET['mobile']) ) {
  
  include "../admin/includes/connect.php";
  
  $accountID = $_GET['account'];
  $mobileNo = $_GET['mobile'];

  $sql = "SELECT * FROM arta_registration WHERE reg_id = '$accountID' AND reg_mobile = '$mobileNo'";
  $res = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($res);

  if($num === 1) {
    $row = mysqli_fetch_assoc($res);
  } else {
    echo "<script>alert('What are you doing here?!');window.location.href='../signup'</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Permit Application</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css"> 
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" action="action.php" method="post">

          <div id="login_form">
            <span class="login100-form-title p-b-26">
              One Stop Shop Construction Permitting
            </span>

            <div class="pb-5">
              <p><b>We sent you an OTP through this Mobile No.: <span style="color:#0066cc"><?php echo $mobileNo; ?></span></b></p>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Enter OTP">
              <input class="input100" type="number" name="otp" required>
              <span class="focus-input100" data-placeholder="OTP"></span>
            </div>

            <input type="hidden" name="reg_id" value="<?php echo $accountID; ?>">
            <input type="hidden" name="reg_mobile" value="<?php echo $mobileNo; ?>">
            <input type="hidden" name="loginSession" value="<?php echo $row['loginSession']; ?>">

            <div class="container-login100-form-btn">
              <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn" type="submit" name="verify">Verify</button>
              </div>
            </div><br>

            <div class="row">
              <div class="col-md-12">
                <!-- <center>Already have an Account?<a href="../login"> Log In</a></center> -->
                <!-- <center><a href="../forgot"> Forgot Password?</a></center> -->
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

  <div id="dropDownSelect1"></div>
  
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendor/animsition/js/animsition.min.js"></script>
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="vendor/select2/select2.min.js"></script>
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
  <script src="vendor/countdowntime/countdowntime.js"></script>
  <script src="js/main.js"></script>

</body>
</html>
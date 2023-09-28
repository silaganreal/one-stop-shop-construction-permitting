<?php
session_start();
unset($_SESSION['online_appointment']);
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

            <div class="row">
              <div class="col-md-6">
                <div class="wrap-input100 validate-input" data-validate = "Enter First Name">
                  <input class="input100" type="text" name="fname" autofocus>
                  <span class="focus-input100" data-placeholder="First Name"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="wrap-input100 validate-input" data-validate = "Enter Last Name">
                  <input class="input100" type="text" name="lname">
                  <span class="focus-input100" data-placeholder="Last Name"></span>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="wrap-input100 validate-input" data-validate = "Enter Mobile No.">
                  <input class="input100" type="number" name="mobile">
                  <span class="focus-input100" data-placeholder="Mobile No."></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="wrap-input100 validate-input" data-validate = "Enter Username">
                  <input class="input100" type="text" name="email">
                  <span class="focus-input100" data-placeholder="Username"></span>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="wrap-input100 validate-input" data-validate="Enter Password">
                  <span class="btn-show-pass">
                    <i class="zmdi zmdi-eye"></i>
                  </span>
                  <input class="input100" type="password" name="pass" id="pass" onkeyup="checkPass()">
                  <span class="focus-input100" data-placeholder="Password"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="wrap-input100 validate-input" data-validate="Re-Enter Password" style="margin-bottom:0px;">
                  <span class="btn-show-pass">
                    <i class="zmdi zmdi-eye"></i>
                  </span>
                  <input class="input100" type="password" name="pass2" id="pass2" onkeyup="checkPass()">
                  <span class="focus-input100" data-placeholder="Re-Password"></span>
                </div>
                <span id="pass_alert_success" class="text-success" style="display:none;">Password matched</span>
                <span id="pass_alert_danger" class="text-danger" style="display:none;">Password did not matched</span>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-check" style="margin-top:25px;margin-bottom:40px;">
                  <input type="checkbox" id="inp_chkbox" class="form-check-input" style="margin-left:0.75%;" onchange="notifyFB(this)">
                  <label class="form-check-label text-muted" style="margin-left:1%;" onclick="clickNotifyFB()">Notify using Facebook</label>
                </div>
              </div>
              <div class="col-md-8" id="div_notif" style="display:none;">
                <div class="form-group" style="margin-top:10px;">
                  <input type="text" name="fbID" id="fbID" class="form-control" placeholder="Facebook ID">
                </div>
              </div>
            </div>
            
            <div class="container-login100-form-btn">
              <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn" type="submit" name="signup">
                  Sign Up
                </button>
              </div>
            </div><br>

            <div class="row">
              <div class="col-md-12">
                <center>Already have an Account?<a href="../login"> Log In</a></center>
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
  <script type="text/javascript">
    function checkPass() {
      var pass = document.getElementById('pass').value;
      var pass2 = document.getElementById('pass2').value;
      var pass_alert_success = document.getElementById('pass_alert_success');
      var pass_alert_danger = document.getElementById('pass_alert_danger');

      if(pass == pass2) {
        pass_alert_success.style.display = '';
        pass_alert_danger.style.display = 'none';
      } else if(pass != pass2) {
        pass_alert_danger.style.display = '';
        pass_alert_success.style.display = 'none';
      }
    }

    function notifyFB(notif) {
      var div_notif = document.getElementById('div_notif');
      var fbID = document.getElementById('fbID');
      if(notif.checked == true) {
        div_notif.style.display = '';
        fbID.required = true;
      } else {
        div_notif.style.display = 'none';
        fbID.required = false;
      }
    }

    function clickNotifyFB() {
      var inp_chkbox = document.getElementById('inp_chkbox');
      var div_notif2 = document.getElementById('div_notif');
      var fbID2 = document.getElementById('fbID');
      if(inp_chkbox.checked == true) {
        inp_chkbox.checked = false;
        div_notif2.style.display = 'none';
        fbID2.required = true;
      } else {
        inp_chkbox.checked = true;
        div_notif2.style.display = '';
        fbID2.required = false;
      }
    }
  </script>

</body>
</html>
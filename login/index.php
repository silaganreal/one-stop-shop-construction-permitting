<?php
session_start();
unset($_SESSION['bldgpermit']);
unset($_SESSION['bldgpermitAdmin']);
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

  <div class="modal fade" id="trackApplication" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header alert alert-info">
          <h5 class="modal-title" id="exampleModalLabel">Track Application</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mb-5">
          <div class="col-md-12">
            <div class="row col-md-10">
              <div class="wrap-input100">
                <input class="input100" type="text" id="trackingNo" autofocus>
                <span class="focus-input100" data-placeholder="Traking No."></span>
              </div>
              <button class="btn btn-sm btn-primary" onclick="btnTrackApplication()">Track Application</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" action="action.php" method="post">
          <div id="login_form">
            <span class="login100-form-title p-b-26">
              One Stop Shop Construction Permitting
            </span>

            <div class="wrap-input100 validate-input" data-validate = "Enter username">
              <input class="input100" type="text" name="email" autofocus>
              <span class="focus-input100" data-placeholder="Username"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Enter password">
              <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
              </span>
              <input class="input100" type="password" name="pass">
              <span class="focus-input100" data-placeholder="Password"></span>
            </div>

            <div class="container-login100-form-btn">
              <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn" type="submit" name="login">
                  Login
                </button>
              </div>
            </div><br>

            <div class="row">
              <div class="col-md-12">
                <center>Don't have an account yet?<a href="../signup"> Sign Up</a></center>
                <!-- <center><a href="../forgot"> Forgot Password?</a></center> -->
                <center>
                  <a href="#" class="text-primary" data-toggle="modal" data-target="#trackApplication" data-backdrop="static">
                    Click here to Track your Application
                  </a>
                </center>
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
    function btnTrackApplication() {
      var applicationNo = document.getElementById('trackingNo').value;

      if(window.XMLHttpRequest) {
        xmlhttp3 = new XMLHttpRequest();
      } else {
        xmlhttp3 = new ActiveObject("Microsoft.XMLHTTP");
      }

      xmlhttp3.onreadystatechange = function() {
        if(xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
          document.getElementById("searchResult").innerHTML = xmlhttp3.responseText;
        }
      }

      var queryString = "?trackingNo=" + applicationNo;

      xmlhttp3.open("GET", "./getTracking.php" + queryString, true);
      xmlhttp3.send();
    }
  </script>

</body>
</html>

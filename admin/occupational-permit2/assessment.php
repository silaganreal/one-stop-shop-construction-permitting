<?php
if( isset($_GET['application']) && isset($_GET['user']) && isset($_GET['appID']) ) {

  include "../includes/auth.php";
  date_default_timezone_set('Asia/Kuala_Lumpur');

  $applicationID = $_GET['application'];
  $userID = $_GET['user'];
  $appID = $_GET['appID'];
  $currentArea = 'Assessment';
  $dateNow = date('Y-m-d');

  $sql = "SELECT * FROM userapplications WHERE id = '$appID'";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);

} else {
  header('location: ../../login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../includes/head.php"; ?>
  <title>Occupancy Permit Online</title>
  <style type="text/css">
    .comment-link {
      text-align:center;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-200">

  <?php

  include 'view_icons.php';

  $active_receiving = "";
  $link_receiving = "receiving.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  $active_docVerification = "";
  $link_docVerification = "document-verification.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  $active_planEvaluation = "";
  $link_planEvaluation = "plan-evaluation.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  $active_assessment = "bg-gradient-info";
  $link_assessment = "#";

  $active_releasing = "";
  $link_releasing = "releasing.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  include "../includes/aside2.php";
  ?>

  <div class="main-content position-relative max-height-vh-100 h-100">
    
    <?php include "../includes/navbar.php"; ?>

    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-100 border-radius-xl"></div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../assets/img/default1.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $row['projectTitle']; ?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                <?php echo $row['ownerApplicant']; ?>
              </p>
            </div>
          </div>
          <div class="col-auto" style="padding-left:50px;">
            <div class="h-100">
              <h3>Assessment Area</h3>
            </div>
          </div>
          <div class="col">
            <div class="float-end">
              <a href="../occupational-permit" class="btn btn-sm btn-warning">Back</a><br>
              <?php
              if($LoggedUserLevel == '1') {
                $sql2 = "SELECT * FROM tracking WHERE onlineappID = '$applicationID' AND area = '$currentArea'";
                $res2 = mysqli_query($conn, $sql2);
                while($row2 = mysqli_fetch_assoc($res2)) {
                  $id = $row2['id'];
                  if($row2['isCurrentArea'] == 'Y' && $row2['isFinished'] == 'N') {
                    ?><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateStage<?php echo $id; ?>">Update</button><?php
                    include 'modalUpdateArea.php';
                  }
                }
              }
              ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table class="table table-hovered">
                    <thead>
                      <tr>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Assessed Fees</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Amount Due</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Assessed By</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date & Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $totalAmout = 0;
                      $sql = "SELECT * FROM tracking_assessment WHERE onlineappID = '$applicationID'";
                      $res = mysqli_query($conn, $sql);
                      $num = mysqli_num_rows($res);
                      if($num > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                          $id = $row['id'];
                          $GLOBALS['totalAmout'] += intval($row['amountDue']);
                          $assessedFees = $row['assessedFees'];
                          ?>
                          <tr>
                            <td class="align-middle text-sm" style="padding-left:20px;width:150px;">
                              <a href="#"class="font-weight-bold mb-1 mt-1"data-bs-toggle="modal"data-bs-target="#editAssessment<?php echo $id; ?>">
                                <span class="text-warning"><?php echo $assessedFees; ?></span>
                              </a>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary font-weight-bold"><?php echo $row['amountDue']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['assessedBy']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['dateTime']; ?></span>
                            </td>
                          </tr>
                          <?php
                          include 'modalUpdateAssessment.php';
                        }
                        ?>
                        <tr>
                          <td class="align-middle text-sm" style="padding-left:20px;width:150px;">
                            <span class="text-secondary font-weight-bold" style="font-size:20px;">Total</span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-info font-weight-bold" style="font-size:20px;"><?php echo $totalAmout; ?></span>
                          </td>
                          <td></td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include "../includes/javascript.php"; ?>

</body>

</html>
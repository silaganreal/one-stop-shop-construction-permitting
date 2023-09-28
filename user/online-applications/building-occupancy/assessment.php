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
  <title>Building Permit Online</title>
  <style type="text/css">
    .comment-link {
      text-align:center;
    }
    .inp-amount {
      font-size:15px;
      font-weight:bold;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-200">

  <?php

  include 'includes/view_icons.php';

  $active_receiving = "";
  $link_receiving = "receiving.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  $active_docVerification = "";
  $link_docVerification = "document-verification.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  $active_planEvaluation = "";
  $link_planEvaluation = "plan-evaluation.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  $active_assessment = "bg-gradient-info";
  $link_assessment = "#";

  // $active_approval = "";
  // $link_approval = "approval.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  // $active_assessmentReleasing = "";
  // $link_assessmentReleasing = "assessment-releasing.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  // $active_payment = "";
  // $link_payment = "payment.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  $active_releasing = "";
  $link_releasing = "releasing.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  include "../includes/aside.php";
  ?>

  <div class="main-content position-relative max-height-vh-100 h-100">
    
    <?php include "../includes/navbar.php"; ?>

    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-100 border-radius-xl"></div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../../assets/img/default1.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
              <a href="../building-permit" class="btn btn-sm btn-warning">Back</a><br>
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

                <div class="table-responsive mb-5">
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
                      $subTotal = 0;
                      $sql = "SELECT * FROM tracking_assessment WHERE onlineappID = '$applicationID' AND assessedFees != 'Surcharges' AND assessedFees != 'Penalties' AND assessedFees != 'Project Cost' AND assessedFees != 'Labor Cost' AND assessedFees != 'Contractors Tax'";
                      $res = mysqli_query($conn, $sql);
                      $num = mysqli_num_rows($res);
                      if($num > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                          $id = $row['id'];
                          $GLOBALS['subTotal'] += intval($row['amountDue']);
                          $assessedFees = $row['assessedFees'];
                          ?>
                          <tr>
                            <td class="align-middle text-sm" style="padding-left:20px;width:150px;">
                              <span class="text-warning font-weight-bold"><?php echo $assessedFees; ?></span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary font-weight-bold"><?php echo number_format($row['amountDue'], 2, '.', ','); ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['assessedBy']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['dateTime']; ?></span>
                            </td>
                          </tr>
                          <?php
                        }
                      }
                      ?>
                      <tr>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary font-weight-bold" style="font-size:20px;">Sub-Total</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-info font-weight-bold" style="font-size:20px;"><?php echo number_format($subTotal, 2, '.', ','); ?></span>
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                      <?php
                      $check10 = '';
                      $check25 = '';
                      $check50 = '';
                      $check100 = '';
                      $percent = '';
                      $sql2 = "SELECT * FROM tracking_assessment WHERE onlineappID = '$applicationID' AND assessedFees = 'Surcharges'";
                      $res2 = mysqli_query($conn, $sql2);

                      if($num2 = mysqli_num_rows($res2) > 0) {
                        while($row2 = mysqli_fetch_assoc($res2)) {
                          if($row2['percentage'] != '') {
                            if($row2['percentage'] == '.10') {
                              $check10 = 'checked';
                              $percent = '10%';
                            }
                            if($row2['percentage'] == '.25') {
                              $check25 = 'checked';
                              $percent = '25%';
                            }
                            if($row2['percentage'] == '.50') {
                              $check50 = 'checked';
                              $percent = '50%';
                            }
                            if($row2['percentage'] == '1') {
                              $check100 = 'checked';
                              $percent = '100%';
                            }
                          }
                          ?>
                          <tr>
                            <td class="align-middle text-sm" style="padding-left:20px;width:150px;">
                              <span class="text-warning font-weight-bold"><?php echo $row2['assessedFees']; ?></span> (<?php echo $percent; ?>)
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary font-weight-bold"><?php echo $row2['amountDue']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row2['assessedBy']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row2['dateTime']; ?></span>
                            </td>
                          </tr>
                          <?php
                        }
                      }

                      $sql3 = "SELECT * FROM tracking_assessment WHERE onlineappID = '$applicationID' AND assessedFees = 'Penalties'";
                      $res3 = mysqli_query($conn, $sql3);
                      if($num3 = mysqli_num_rows($res3) > 0) {
                        while($row3 = mysqli_fetch_assoc($res3)) {
                          ?>
                          <tr>
                            <td class="align-middle text-sm" style="padding-left:20px;width:150px;">
                              <span class="text-warning font-weight-bold"><?php echo $row3['assessedFees']; ?></span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary font-weight-bold"><?php echo number_format($row3['amountDue'], 2, '.', ','); ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row3['assessedBy']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row3['dateTime']; ?></span>
                            </td>
                          </tr>
                          <?php
                        }
                      }

                      $totalAmount = 0;
                      $sqlTotal = "SELECT * FROM tracking_assessment WHERE onlineappID = '$applicationID' AND (assessedFees = 'Penalties' OR assessedFees = 'Surcharges')";
                      $resTotal = mysqli_query($conn, $sqlTotal);
                      $numTotal = mysqli_num_rows($resTotal);
                      if($numTotal > 0) {
                        while($rowTotal = mysqli_fetch_assoc($resTotal)) {
                          $GLOBALS['totalAmount'] += intval($rowTotal['amountDue']);
                        }
                        ?>
                        <tr>
                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary font-weight-bold" style="font-size:20px;">Total</span>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-info font-weight-bold" style="font-size:20px;"><?php echo number_format($totalAmount, 2, '.', ','); ?></span>
                          </td>
                          <td></td>
                          <td></td>
                        </tr>
                        <?php
                      }
                      ?>

                    </tbody>
                  </table>
                </div>

                <?php
                $sqlLaborCost = "SELECT * FROM tracking_assessment WHERE onlineappID = '$applicationID' AND (assessedFees = 'Project Cost' OR assessedFees = 'Labor Cost' OR assessedFees = 'Contractors Tax')";
                $resLaborCost = mysqli_query($conn, $sqlLaborCost);
                $numLaborCost = mysqli_num_rows($resLaborCost);

                if($numLaborCost > 0) {
                  ?><dl class="row"><?php
                  while($rowLaborCost = mysqli_fetch_assoc($resLaborCost)) {
                    $id = $rowLaborCost['id'];
                    if($rowLaborCost['assessedFees'] == 'Project Cost') {
                      $assessedFees = 'TOTAL PROJECT COST';
                    } elseif($rowLaborCost['assessedFees'] == 'Labor Cost') {
                      $assessedFees = 'TOTAL LABOR COST';
                    } elseif($rowLaborCost['assessedFees'] == 'Contractors Tax') {
                      $assessedFees = "CONTRACTOR'S TAX ON LABOR COST";
                    }
                    ?>
                    <dt class="col-sm-4 text-warning" style="font-size:14px;">
                      <?php echo $assessedFees; ?>
                    </dt>
                    <dd class="col-sm-8" style="font-size:14px;"><b><?php echo number_format($rowLaborCost['amountDue'], 2, '.', ','); ?></b></dd>
                    <?php
                    // include "modalUpdateLaborCost.php";
                  }
                  ?></dl><?php
                }

                $sqlGTotal = "SELECT * FROM tracking_assessment WHERE onlineappID = '$applicationID' AND assessedFees = 'Contractors Tax'";
                $resGTotal = mysqli_query($conn, $sqlGTotal);
                $numGTotal = mysqli_num_rows($resGTotal);

                if($numGTotal > 0) {
                  $rowGTotal = mysqli_fetch_assoc($resGTotal);
                  $gTotal = $rowGTotal['amountDue'] + $totalAmount;
                  ?>
                  <dl class="row">
                    <dt class="col-sm-4" style="font-size:20px;">TOTAL</dt>
                    <dd class="col-sm-8 text-info" style="font-size:20px;"><b><?php echo number_format($gTotal, 2, '.', ','); ?></b></dd>
                  </dl>
                  <?php
                }
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include "../includes/javascript.php"; ?>
  <script type="text/javascript">
    function updateSurcharge(num) {
      var inpTotal = parseFloat(document.getElementById('inpTotal').value);
      var totalAmount = (inpTotal * num) + inpTotal;
      document.getElementById('inpTotalAmount').value = totalAmount;
      document.getElementById('percentage').value = num;
    }
  </script>

</body>

</html>
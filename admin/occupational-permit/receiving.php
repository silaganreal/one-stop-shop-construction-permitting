<?php
if( isset($_GET['application']) && isset($_GET['user']) && isset($_GET['appID']) ) {

  include "../includes/auth.php";
  date_default_timezone_set('Asia/Kuala_Lumpur');

  $applicationID = $_GET['application'];
  $userID = $_GET['user'];
  $appID = $_GET['appID'];
  $currentArea = 'Receiving';
  $dateNow = date('Y-m-d h:i:s');

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

  $active_receiving = "bg-gradient-info";
  $link_receiving = "#";

  $active_docVerification = "";
  $link_docVerification = "document-verification.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  $active_planEvaluation = "";
  $link_planEvaluation = "plan-evaluation.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  $active_assessment = "";
  $link_assessment = "assessment.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  // $active_approval = "";
  // $link_approval = "approval.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  // $active_assessmentReleasing = "";
  // $link_assessmentReleasing = "assessment-releasing.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  // $active_payment = "";
  // $link_payment = "payment.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  $active_releasing = "";
  $link_releasing = "releasing.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

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
              <h3>Receiving Area</h3>
            </div>
          </div>
          <div class="col">
            <div class="float-end">
              <a href="../occupational-permit" class="btn btn-sm btn-warning">Back</a>
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
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Application Date</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Date - Received</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Date - Out</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">No. Days</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Remarks</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT * FROM tracking WHERE onlineappID = '$applicationID' AND area = '$currentArea'";
                      $res = mysqli_query($conn, $sql);
                      $num = mysqli_num_rows($res);
                      if($num > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                          $id = $row['id'];
                          $dateIn = $row['dateIn'];
                          $dateReceived = $row['dateReceived'];
                          $dateOut = $row['dateOut'];

                          if($dateIn != '' && $dateReceived == '' && $dateOut == '') {
                            $dateIn = date_create($dateIn);
                            $dateOut = date_create($dateNow);
                            $daysIn = date_diff($dateIn, $dateOut)->format('%dD - %hH - %iM');
                          } elseif($dateIn != '' && $dateReceived != '' && $dateOut == '') {
                            $dateIn = date_create($dateReceived);
                            $dateOut = date_create($dateNow);
                            $daysIn = date_diff($dateIn, $dateOut)->format('%dD - %hH - %iM');
                          } elseif($dateIn != '' && $dateReceived != '' && $dateOut != '') {
                            $dateIn = date_create($dateReceived);
                            $dateOut = date_create($dateOut);
                            $daysIn = date_diff($dateIn, $dateOut)->format('%dD - %hH - %iM');
                          } else {
                            $daysIn = '';
                          }
                          ?>
                          <tr>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['dateIn']; ?></span>
                            </td>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['dateReceived']; ?></span>
                            </td>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['dateOut']; ?></span>
                            </td>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $daysIn; ?></span>
                            </td>
                            <td class="align-middle text-sm">
                              <p class="text-xs font-weight-bold mb-0"><?php echo $row['remarks']; ?></p>
                            </td>
                            <td class="align-middle text-sm">
                              <?php
                              if ($row['isCurrentArea'] == 'Y' && $row['isFinished'] == 'N' && $LoggedUserLevel == '1' && $LoggedOwner == '0') { ?>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateStage<?php echo $id; ?>">
                                  Update
                                </button>
                              <?php }
                              ?>
                            </td>
                          </tr>
                          <?php
                          include 'modalUpdateArea.php';
                        }
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
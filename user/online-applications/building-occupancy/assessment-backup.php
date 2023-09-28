<?php
if( isset($_GET['application']) && isset($_GET['user']) && isset($_GET['appID']) ) {
  $applicationID = $_GET['application'];
  $userID = $_GET['user'];
  $appID = $_GET['appID'];
  include "../includes/auth.php";
  $dateNow = date('Y-m-d');
} else {
  header('location: ../../../login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../includes/head.php"; ?>
  <title>Padayon Tacloban</title>
</head>

<body class="g-sidenav-show  bg-gray-200">

  <?php
  include 'includes/view_icons.php';
  
  $active_receiving = "";
  $link_receiving = "receiving.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;
  
  $active_docverification = "";
  $link_docverification = "document-verification.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  $active_planevaluation = "";
  $link_planevaluation = "plan-evaluation.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  $active_assessment = "bg-gradient-info";
  $link_assessment = "#";

  // $active_approval = "";
  // $link_approval = "approval.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  // $active_assessmentrelease = "";
  // $link_assessmentrelease = "assessment-releasing.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  // $active_payment = "";
  // $link_payment = "payment.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  $active_releasing = "";
  $link_releasing = "releasing.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;
  
  include "../includes/aside.php";
  ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    <?php include "../includes/navbar.php"; ?>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                <div class="col-md-12 row">
                  <div class="col-sm-5">
                    <h6 class="text-white text-capitalize ps-3">Assessment Area</h6>
                  </div>
                  <div class="col-sm-7 px-3">
                    <div class="float-end"><a href="../applications.php?application=<?php echo $applicationID; ?>&user=<?php echo $userID; ?>" class="btn btn-sm btn-dark">Get Back</a></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body pb-2">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive p-0"> <!-- style="height:420px;overflow-y:scroll;" -->
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7" style="padding-left:20px;width:150px;">
                            Assessed Fees
                          </th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Amount Due</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Assessed By</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date & Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $totalAmout = 0;
                        $sql = "SELECT * FROM tracking_assessment WHERE onlineappID = '$appID'";
                        $res = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($res);
                        if($num > 0) {
                          while($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $GLOBALS['totalAmout'] += intval($row['amountDue']);
                            ?>
                            <tr>
                              <td class="align-middle text-sm" style="padding-left:20px;width:150px;">
                                <span class="text-warning text-xs font-weight-bold"><?php echo $row['assessedFees']; ?></span>
                              </td>
                              <td class="align-middle text-center text-sm">
                                <span class="text-secondary font-weight-bold" style="font-size:13px;"><?php echo $row['amountDue']; ?></span>
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
  </main>

  <?php include "../includes/javascript.php"; ?>

</body>

</html>
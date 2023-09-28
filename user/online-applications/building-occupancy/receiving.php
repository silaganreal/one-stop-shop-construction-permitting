<?php
if( isset($_GET['application']) && isset($_GET['user']) && isset($_GET['appID']) ) {
  $applicationID = $_GET['application'];
  $userID = $_GET['user'];
  $appID = $_GET['appID'];
  include "../includes/auth.php";
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $dateNow = date('Y-m-d h:i:s');
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

  $active_receiving = "bg-gradient-info";
  $link_receiving = "#";
  
  $active_docverification = "";
  $link_docverification = "document-verification.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  $active_planevaluation = "";
  $link_planevaluation = "plan-evaluation.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  $active_assessment = "";
  $link_assessment = "assessment.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

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
                    <h6 class="text-white text-capitalize ps-3">Receiving Area</h6>
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
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Application Date</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Date Received</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Date - Out</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">No. Days</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM tracking WHERE onlineappID = '$appID' AND area = 'Receiving'";
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
                              $dateIn = date_create($dateIn);
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
                              <td>
                                <div class="d-flex">
                                  <div class="d-flex flex-column justify-content-center">
                                    <span class="text-secondary text-xs font-weight-bold"><?php echo $row['dateIn']; ?></span>
                                  </div>
                                </div>
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
                            </tr>
                            <?php
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
  </main>

  <?php include "../includes/javascript.php"; ?>

</body>

</html>
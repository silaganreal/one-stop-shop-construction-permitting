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

  $active_planevaluation = "bg-gradient-info";
  $link_planevaluation = "#";

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
                    <h6 class="text-white text-capitalize ps-3">Plan Evaluation Area</h6>
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
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Area</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Incharge</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date In</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date Receive</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date Out</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM tracking_plan_evaluation WHERE onlineappID = '$appID'";
                        $res = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($res);
                        if($num > 0) {
                          while($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $dateIn = $row['dateIn'] .' '. $row['timeIn'];
                            $dateOut = $row['dateOut'] .' '. $row['timeOut'];
                            ?>
                            <tr>
                              <td class="text-sm align-middle">
                                <span class="text-danger text-xs font-weight-bold mb-1 mt-1"><?php echo $row['area']; ?></span>
                              </td>
                              <td class="text-sm text-warning align-middle" >
                                <p class="text-xs font-weight-bold mb-1 mt-1"><?php echo $row['incharge']; ?></p>
                              </td>
                              <td class="text-sm align-middle" >
                                <p class="text-xs font-weight-bold mb-1 mt-1"><?php echo $dateIn; ?></p>
                              </td>
                              <td class="text-sm align-middle" style="width:100px;">
                                <p class="text-xs font-weight-bold mb-1 mt-1"><?php echo $row['dateReceived']; ?></p>
                              </td>
                              <td class="text-sm align-middle" style="width:100px;">
                                <span class="text-xs font-weight-bold"><?php echo $dateOut; ?></span>
                                <!-- <p class="text-xs text-secondary mb-0"><?php //echo $dateOut; ?></p> -->
                              </td>
                              <td class="text-center align-middle">
                                <p class="text-xs font-weight-bold mb-1 mt-1"><?php echo $row['remarks']; ?></p>
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
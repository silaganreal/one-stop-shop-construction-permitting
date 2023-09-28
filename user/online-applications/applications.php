<?php
if( isset($_GET['application']) && isset($_GET['user']) ) {
  $applicationID = $_GET['application'];
  $userID = $_GET['user'];
  include "../includes/auth.php";
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $dateNow = date('Y-m-d h:i:s');
} else {
  header('location: ../../login');
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
  $active_forms = "";
  $link_forms = "forms.php?application=". $applicationID ."&user=". $userID;
  
  $active_applications = "bg-gradient-info";
  $link_applications = "#";
  
  include "../includes/aside2.php";
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
                  <div class="col-sm-3">
                    <h6 class="text-white text-capitalize ps-3">Online Applications</h6>
                  </div>
                  <div class="col-sm-2 px-3">
                    <a href="forms.php?application=<?php echo $applicationID; ?>&user=<?php echo $userID; ?>" class="btn btn-sm btn-success">Add New</a>
                  </div>
                  <div class="col-sm-7 px-3">
                    <div class="float-end"><a href="../online-applications" class="btn btn-sm btn-dark">Get Back</a></div>
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
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Owner/Applicant</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Contact</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date - In</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">No. of Days / Date - Out</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Area</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Latest Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // $sql = "SELECT * FROM onlineapplications WHERE userID = '$userID' AND userappID = '$applicationID'";
                        $sql = "SELECT a.id, a.userID, a.userappID, a.applicationType, a.applicationDate, a.applicationTime, a.currentArea, a.applicationStatus, a.applicationRemarks, a.applicationDateOut, a.slug, b.ownerApplicant, b.projectTitle, b.contactNo, b.emailAdd FROM onlineapplications AS a LEFT JOIN userapplications AS b ON a.userappID = b.id WHERE a.userID = '$userID' AND a.userappID = '$applicationID'";
                        $res = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($res);
                        if($num > 0) {
                          while($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $dateAppIn = $row['applicationDate'] .' '. $row['applicationTime'];
                            $dateAppOut = $row['applicationDateOut'];
                            $appStatus = $row['applicationStatus'];
                            $newDateIn = $dateAppIn;
                            $slug = $row['slug'];

                            if($dateAppOut == '') {
                              $dateIn = date_create($dateAppIn);
                              $dateOut = date_create($dateNow);
                              $daysIn = date_diff($dateIn, $dateOut)->format('%dD - %hH - %iM');
                            } elseif($dateAppOut != '') {
                              $dateIn = date_create($dateAppIn);
                              $dateOut = date_create($dateAppOut);
                              $daysIn = date_diff($dateIn, $dateOut)->format('%dD - %hH - %iM');
                            }

                            if($row['applicationType'] == 'BUILDING_PERMIT') {
                              $link = 'building-occupancy/receiving.php?application='.$applicationID.'&user='.$userID.'&appID='.$id;
                              $linkName = 'Building Permit';
                            }
                            if($row['applicationType'] == 'OCCUPANCY_PERMIT') {
                              $link = 'building-occupancy/receiving.php?application='.$applicationID.'&user='.$userID.'&appID='.$id;
                              $linkName = 'Occupancy Permit';
                            }
                            if($row['applicationType'] == 'LOCATIONAL_CLEARANCE') {
                              $link = 'locational-clearance/document-verification/?slug='.$slug;
                              $linkName = 'Locational Clearance';
                            }
                            ?>
                            <tr>
                              <td>
                                <div class="d-flex">
                                  <div class="d-flex flex-column justify-content-center">
                                    <a href="<?php echo $link; ?>"><h6 class="mb-0 text-sm text-warning"><?php echo $linkName; ?></h6></a>
                                    <p class="text-xs text-secondary mb-0"><?php echo $row['projectTitle']; ?></p>
                                  </div>
                                </div>
                              </td>
                              <td class="align-middle text-center">
                                <p class="text-xs font-weight-bold mb-0"><?php echo $row['contactNo']; ?></p>
                                <p class="text-xs text-secondary mb-0"><?php echo $row['emailAdd']; ?></p>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $newDateIn; ?></span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $daysIn; ?></span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs text-info font-weight-bold"><?php echo $row['currentArea']; ?></span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $row['applicationRemarks']; ?></span>
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
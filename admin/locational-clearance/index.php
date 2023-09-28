<?php
include "../includes/auth.php";
$dateNow = date('Y-m-d h:i:s');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../includes/head.php"; ?>
  <title>Occupancy Permit Online</title>
</head>

<body class="g-sidenav-show  bg-gray-200">

  <?php
  $active_dashboard = "";
  $link_dashboard = "../dashboard";

  $active_bldgpermit = "";
  $link_bldgpermit = "../building-permit";

  $active_occupancyPermit = "";
  $link_occupancyPermit = "../occupational-permit";

  $active_locationalClearance = "bg-gradient-info";
  $link_locationalClearance = "#";

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
                <h6 class="text-white text-capitalize ps-3">Locational Clearance Applications</h6>
              </div>
            </div>
            <div class="card-body pb-2">
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
                    $sql = "SELECT a.id, a.userID, a.userappID, a.applicationType, a.applicationDate, a.applicationTime, a.currentArea, a.applicationStatus, a.applicationRemarks, a.applicationDateOut, a.slug, b.ownerApplicant, b.projectTitle, b.contactNo, b.emailAdd FROM onlineapplications AS a LEFT JOIN userapplications AS b ON a.userappID = b.id WHERE a.applicationType = 'LOCATIONAL_CLEARANCE'";
                    $res = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($res)) {
                      $id = $row['id'];
                      $appID = $row['userappID'];
                      $dateIn = $row['applicationDate'] .' '. $row['applicationTime'];
                      $dateOut = $row['applicationDateOut'];
                      $newDateIn = $dateIn;

                      if($dateIn != '' && $dateOut == '') {
                        $dateIn = date_create($dateIn);
                        $dateOut = date_create($dateNow);
                        $daysIn = date_diff($dateIn, $dateOut)->format('%dD - %hH - %iM');
                      } elseif($dateIn != '' && $dateOut != '') {
                        $dateIn = date_create($dateIn);
                        $dateOut = date_create($dateOut);
                        $daysIn = date_diff($dateIn, $dateOut)->format('%dD - %hH - %iM');
                      } else {
                        $daysIn = '';
                      }
                      ?>
                      <tr>
                        <td class="align-middle">
                          <div class="d-flex">
                            <div class="d-flex flex-column justify-content-center">
                              <a href="document-verification/?slug=<?php echo $row['slug']; ?>">
                                <h6 class="mb-0 text-sm text-warning"><?php echo $row['ownerApplicant']; ?></h6>
                                <p class="text-xs text-secondary mb-0 font-weight-bold"><?php echo $row['projectTitle']; ?></p>
                              </a>
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
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php //include "../includes/footer.php"; ?>

    </div>
  </main>

  <?php //include "../includes/plugin.php"; ?>

  <?php include "../includes/javascript.php"; ?>

</body>

</html>
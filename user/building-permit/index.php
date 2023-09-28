<?php
include "../includes/auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../includes/head.php"; ?>
  <title>Padayon Tacloban</title>
</head>

<body class="g-sidenav-show  bg-gray-200">

  <?php
  $active_applications = "";
  $link_applications = "../dashboard";
  
  $active_bldgpermit = "bg-gradient-info";
  $link_bldgpermit = "#";
  
  $active_occupancypermit = "";
  $link_occupancypermit = "../occupancy-permit";

  $active_onlineapp = "";
  $link_onlineapp = "../online-applications";
  
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
                <h6 class="text-white text-capitalize ps-3">Building Permit Applications</h6>
              </div>
            </div>
            <div class="card-body pb-2">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Type of Application</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Status</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date</th>
                          <th class="text-secondary text-center opacity-7">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM onlineapplications WHERE userID = '$LoggedUserID' AND applicationType = 'BUILDING_PERMIT'";
                        $res = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($res)) {
                          ?>
                          <tr>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm"><?php echo $row['ownerApplicant']; ?></h6>
                                  <p class="text-xs text-secondary mb-0"><?php echo $row['contactNo']; ?></p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <p class="text-xs font-weight-bold mb-0"><?php echo $row['projectTitle']; ?></p>
                              <p class="text-xs text-secondary mb-0"><?php echo $row['emailAdd']; ?></p>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="badge badge-sm bg-gradient-warning"><?php echo $row['applicationStatus']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['applicationDate']; ?></span>
                            </td>
                            <td class="align-right text-center">
                              <a href="view.php?application=<?php echo $row['id']; ?>" class="text-warning font-weight-bold text-sm" data-toggle="tooltip" data-original-title="View application">
                                View
                              </a>
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
        </div>
      </div>

      <?php //include "../includes/footer.php"; ?>

    </div>
  </main>

  <?php //include "../includes/plugin.php"; ?>

  <?php include "../includes/javascript.php"; ?>

</body>

</html>
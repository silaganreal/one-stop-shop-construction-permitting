<?php
include "../includes/auth.php";
date_default_timezone_set('Asia/Kuala_Lumpur');
$dateNow = date('Y-m-d h:i:s');
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
  </style>
</head>

<body class="g-sidenav-show bg-gray-200">

  <?php
  $sqlNotif = "SELECT * FROM notifications WHERE status = 'N'";
  $resNotif = mysqli_query($conn, $sqlNotif);
  $numNotif = mysqli_num_rows($resNotif);

  include "../includes/aside3.php";
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
          <div class="col-auto mt-4">
            <div class="h-100">
              <h3>Notifications</h3>
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
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Project Title</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Area</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Date - In</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Remarks</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-end opacity-7">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT a.id, a.userappID, a.onlineappID, a.dateIn, b.ownerApplicant, b.projectTitle, c.applicationType, c.applicationRemarks, c.applicationStatus, c.currentArea FROM notifications AS a LEFT JOIN userapplications AS b ON a.userappID = b.id LEFT JOIN onlineapplications AS c ON a.onlineappID = c.id WHERE a.status = 'N' ORDER BY a.dateIn ASC";
                      $res = mysqli_query($conn, $sql);
                      $num = mysqli_num_rows($res);
                      if($num > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                          $notifID = $row['id'];
                          $onlineappID = $row['onlineappID'];
                          $cArea = $row['currentArea'];
                          $appType = $row['applicationType'];
                          $projectTitle = $row['projectTitle'];
                          ?>
                          <tr>
                            <td class="align-middle text-sm">
                              <span class="text-warning text-xs font-weight-bold"><?php echo $row['projectTitle']; ?></span>
                              <p class="text-xs text-info mb-0"><?php echo $row['ownerApplicant']; ?></p>
                            </td>
                            <td class="align-middle text-sm">
                              <span class="text-info text-xs font-weight-bold"><?php echo $cArea; ?></span>
                            </td>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['dateIn']; ?></span>
                            </td>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['applicationRemarks']; ?></span>
                            </td>
                            <td class="align-middle text-sm text-end">
                              <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateFront<?php echo $notifID; ?>">
                                Update
                              </button>
                            </td>
                          </tr>
                          <?php
                          require 'modalFront.php';
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
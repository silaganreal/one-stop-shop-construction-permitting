<?php
include "../includes/auth.php";
if(isset($_GET['application'])) {

  date_default_timezone_set("Asia/Kuala_Lumpur");
  $applicationID = $_GET['application'];

  $sql = "SELECT * FROM onlineapplications WHERE id = '$applicationID'";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);
  
  $appStatus = $row['applicationStatus'];

  if($appStatus == 'For Verification') {
    $color = '#ff661a';
  }
  if($appStatus == 'Verified') {
    $color = '#009900';
  }
  if($appStatus == 'Denied') {
    $color = '#e62e00';
  }

} else {
  header('location: ../login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../includes/head.php"; ?>
  <title>Padayon Tacloban</title>
</head>

<body class="g-sidenav-show bg-gray-200">

  <?php
  $link_applications = "../dashboard";
  $active_applications = "";

  $link_bldgpermit = "#";
  $active_bldgpermit = "bg-gradient-info";

  $active_occupancypermit = "";
  $link_occupancypermit = "../occupancy-permit";

  $active_onlineapp = "";
  $link_onlineapp = "../online-applications";

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
          <div class="col">
            <div class="float-end">
              <!-- <a href="../applications" class="btn btn-sm btn-warning">Back</a> -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-body p-3">
                <!-- <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6> -->
                <div class="table-responsive" style="height:410px;overflow-y:scroll;">
                  <table class="table table-hovered">
                    <thead>
                      <tr>
                        <th style="width:10%;">File</th>
                        <th style="width:10%;">Status</th>
                        <th style="text-align:center;">Remarks</th>
                        <th style="width:10%;">Date</th>
                        <th class="float-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql3 = "SELECT * FROM attachments WHERE applicationID = '$applicationID'";
                    $res3 = mysqli_query($conn, $sql3);
                    while($row3 = mysqli_fetch_assoc($res3)) {
                      $fileID = $row3['id'];
                      $file = $row3['file'];
                      $link = 'view_doc.php?id=' . $fileID . "&slug=" . $file;
                      
                      $status = $row3['status'];
                      if($status == 'For Verification') {
                        $textColor = 'text-warning';
                      }
                      if($status == 'Verified') {
                        $textColor = 'text-success';
                      }
                      if($status == 'Denied') {
                        $textColor = 'text-danger';
                      }
                      ?>
                      <tr>
                          <td>
                            <a href="#" onclick="OpenPopupCenter('<?php echo $link; ?>', 'RealVS', 1000, 650);">
                              <i class="text-success text-sm"><?php echo $row3['name']; ?></i>
                            </a>
                          </td>
                          <td class="text-dark">
                            <span class="<?php echo $textColor; ?>"><i><?php echo $row3['status']; ?></i></span>
                          </td>
                          <td class="text-dark" style="text-align:center;"><?php echo $row3['remarks']; ?></td>
                          <td class="text-dark"><?php echo $row3['date']; ?></td>
                          <td class="float-end">
                            <?php
                            if($status == 'Denied') { ?>
                              <a href="#" class="text-info" data-bs-toggle="modal" data-bs-target="#attach<?php echo $fileID; ?>">
                                <b>Edit</b>
                              </a>
                              <?php
                            }
                            ?>
                          </td>
                      </tr>
                      <?php
                      if($status == 'Denied') {
                        include "modalEdit.php";
                      }
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="col-md-3">
            <div class="card card-plain">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-0">Application Status</h6>
                  </div>
                </div>
              </div>
              <div class="card-body p-3">
                <ul class="list-group">
                  <li class="list-group-item border-0 ps-0 pt-3 text-sm">
                    <strong class="text-dark">Status : <i style="color: <?php echo $color; ?>"><?php echo $appStatus; ?></i></strong>
                  </li>
                  <?php
                  //if($appStatus == 'For Verification') {
                    ?>
                    <li class="list-group-item border-0 ps-0 text-sm mt-3">
                      <div class="row">
                        <div class="col-12">
                          <button class="btn btn-sm btn-success">Verify</button>
                          <button class="btn btn-sm btn-danger">Deny</button>
                        </div>
                      </div>
                    </li>
                    <?php
                  //} else {
                    ?>
                    <li class="list-group-item border-0 ps-0 text-sm">
                      <strong class="text-dark">Date : </strong><i><?php //echo $row['dateVerified']; ?></i>
                    </li>
                    <li class="list-group-item border-0 ps-0 text-sm">
                      <strong class="text-dark">Remarks : </strong><i><?php //echo $row['applicationRemarks']; ?></i>
                    </li>
                    <?php
                  //}
                  ?>
                </ul>
              </div>
            </div>
          </div> -->

        </div>
      </div>
    </div>

    <?php //include "../includes/footer.php"; ?>

  </div>

  <?php include "../includes/javascript.php"; ?>

  <script type="text/javascript">
    function OpenPopupCenter(pageURL, title, w, h) {
      var left = (screen.width - w) / 2;
      var top = (screen.height - h) / 4;
      var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
    function displayName(file1) {
      document.getElementById('fileDesc').outerHTML = '&nbsp;&nbsp;' + file1.files[0].name;
    }
  </script>

</body>

</html>
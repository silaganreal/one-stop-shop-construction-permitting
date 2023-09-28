<?php
include "../includes/auth.php";
if( isset($_GET['application']) && isset($_GET['user']) && isset($_GET['appID']) ) {

  date_default_timezone_set("Asia/Kuala_Lumpur");
  $applicationID = $_GET['application'];
  $userID = $_GET['user'];
  $appID = $_GET['appID'];
  $currentArea = 'Document Verification';

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

  $active_receiving = "";
  $link_receiving = "receiving.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  $active_docVerification = "bg-gradient-info";
  $link_docVerification = "#";

  $active_planEvaluation = "";
  $link_planEvaluation = "plan-evaluation.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  $active_assessment = "";
  $link_assessment = "assessment.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;

  $active_releasing = "";
  $link_releasing = "releasing.php?application=".$applicationID."&user=". $userID ."&appID=". $appID;
  
  include "../includes/aside2.php";
  ?>

  <div class="main-content position-relative max-height-vh-100 h-100">
    
    <?php include "../includes/navbar.php"; ?>

    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-100 border-radius-xl"></div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row">
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
              <h3>Document Verification Area</h3>
            </div>
          </div>
          <div class="col">
            <div class="float-end">
              <a href="../occupational-permit" class="btn btn-sm btn-warning">Back</a><br>
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
                <div class="table-responsive" style="height:410px;overflow-y:scroll;">
                  <table class="table table-hovered">
                    <thead>
                      <tr>
                        <th style="width:10%;">File</th>
                        <th style="width:10%;">Status</th>
                        <th style="text-align:center;">Remarks</th>
                        <th style="width:10%;">Date</th>
                        <th class="text-end">Action</th>
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
                      $linkComments = 'view_comments.php?attachment='. $fileID;
                      
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
                        <td class="text-sm align-middle">
                          <a href="#" class="text-xs font-weight-bold mb-1 mt-1" onclick="OpenPopupCenter('<?php echo $link; ?>', 'RealVS', 1000, 650);">
                            <i class="text-info"><?php echo $row3['name']; ?></i>
                          </a>
                        </td>
                        <td class="text-sm align-middle">
                          <span class="text-xs font-weight-bold mb-1 mt-1 <?php echo $textColor; ?>"><i><?php echo $row3['status']; ?></i></span>
                        </td>
                        <td class="text-sm align-middle comment-link">
                          <i class="text-warning text-xs font-weight-bold" onclick="openPopUpComment('<?php echo $linkComments; ?>','RealVS2',1000,650)">
                            <?php echo $row3['remarks']; ?>
                          </i>
                        </td>
                        <td class="text-sm align-middle">
                          <span class="text-success text-xs font-weight-bold"><?php echo $row3['date']; ?></span>
                        </td>
                        <td class="text-sm align-middle text-end">
                          <?php
                          if($LoggedUserLevel == '1') { ?>
                            <a href="verify.php?id=<?php echo $row3['id']; ?>&app=<?php echo $row3['applicationID']; ?>&appID=<?php echo $appID; ?>" class="text-xs font-weight-bold" onclick="return confirm('Confirm Verification?')">
                              <i class="text-success">VERIFY</i>
                            </a>/
                            <a href="#" class="text-xs font-weight-bold" data-bs-toggle="modal" data-bs-target="#deny<?php echo $fileID; ?>">
                              <i class="text-danger">DENY</i>
                            </a>
                          <?php }
                          ?>
                        </td>
                      </tr>
                      <?php
                      include "modalDeny.php";
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

  <script type="text/javascript">
    function OpenPopupCenter(pageURL, title, w, h) {
      var left = (screen.width - w) / 2;
      var top = (screen.height - h) / 4;
      var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
    function openPopUpComment(pageURL, title, w, h) {
      var left = (screen.width - w) / 2;
      var top = (screen.height - h) / 4;
      var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
    function displayName(file1) {
      document.getElementById('fileDesc').outerHTML = '&nbsp;&nbsp;' + file1.files[0].name;
    }
    // function selectAreaStatus(areaValue) {
    //   var areaPE = document.getElementById('areaPE');
    //   if(areaValue === 'YES') {
    //     areaPE.style.display = '';
    //     areaPE.required = true;
    //   } else {
    //     areaPE.style.display = 'none';
    //     areaPE.required = false;
    //   }
    // }
  </script>

</body>

</html>
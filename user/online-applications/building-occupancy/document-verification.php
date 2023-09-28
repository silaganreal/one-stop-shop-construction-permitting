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
  
  $active_docverification = "bg-gradient-info";
  $link_docverification = "#";

  $active_planevaluation = "";
  $link_planevaluation = "plan-evaluation.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

  $active_assessment = "";
  $link_assessment = "assessment.php?application=". $applicationID ."&user=". $userID ."&appID=". $appID;

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
                    <h6 class="text-white text-capitalize ps-3">Document Verification Area</h6>
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
                          <th style="width:10%;">File</th>
                          <th style="width:10%;">Status</th>
                          <th style="text-align:center;">Remarks</th>
                          <th style="width:10%;">Date</th>
                          <th class="text-end">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql3 = "SELECT * FROM attachments WHERE applicationID = '$appID'";
                        $res3 = mysqli_query($conn, $sql3);
                        while($row3 = mysqli_fetch_assoc($res3)) {
                          $fileID = $row3['id'];
                          $file = $row3['file'];
                          $link = 'includes/view_doc.php?id=' . $fileID . "&slug=" . $file;
                          $linkComments = 'includes/view_comments.php?attachment='. $fileID;
                          
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
                              <td class="text-dark comment-link text-center">
                                <i class="text-warning" onclick="openPopUpComment('<?php echo $linkComments; ?>','RealVS2',1000,650)">
                                  <?php echo $row3['remarks']; ?>
                                </i>
                              </td>
                              <td class="text-dark text-center"><?php echo $row3['date']; ?></td>
                              <td class="text-end">
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
                            include "includes/modalEdit.php";
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
  </script>

</body>

</html>
<?php

include "../../includes2/auth.php";

if(isset($_GET['attachment'])) {

	$attachmentID = $_GET['attachment'];
	
	$sql2 = "SELECT * FROM attachments WHERE id = '$attachmentID'";
	$res2 = mysqli_query($conn, $sql2);
	$row2 = mysqli_fetch_assoc($res2);

} else {
	header('location: ../../../login');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../../includes2/head.php"; ?>
  <title>Locational Clearance</title>
</head>

<body class="g-sidenav-show  bg-gray-200">

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><?php echo $row2['name']; ?></h6>
              </div>
            </div>
            <div class="card-body pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">File</th>
                      <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Remarks</th>
                      <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Person</th>
                      <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date/Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $a = 1;
                    $sql = "SELECT * FROM attachments_remarks WHERE attachmentID = '$attachmentID' ORDER BY id DESC";
                    $res = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($res)) {
                      $fileID2 = $row['id'];
                      $file2 = $row['file'];
                      $link2 = 'view_doc_comments.php?id=' . $fileID2 . "&slug=" . $file2;
                      ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo $a; ?></h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <a href="#" onclick="OpenPopupCenter('<?php echo $link2; ?>', 'RealVS3', 1000, 650);">
                            <i class="text-success text-sm"><?php echo $row['name']; ?></i>
                          </a>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?php echo $row['remarks']; ?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold"><?php echo $row['remarksBy']; ?></span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold"><?php echo $row['dateTime']; ?></span>
                        </td>
                      </tr>
                      <?php
                      $a++;
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
  </main>

  <?php include "../../includes2/javascript.php"; ?>

  <script type="text/javascript">
    function OpenPopupCenter(pageURL, title, w, h) {
      var left = (screen.width - w) / 2;
      var top = (screen.height - h) / 4;
      var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
  </script>

</body>

</html>
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
  // $active_applications = "";
  // $link_applications = "../dashboard";
  
  // $active_bldgpermit = "";
  // $link_bldgpermit = "../building-permit";
  
  // $active_occupancypermit = "";
  // $link_occupancypermit = "../occupancy-permit";

  $active_onlineapp = "bg-gradient-info";
  $link_onlineapp = "#";
  
  include "../includes/aside.php";
  ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    <?php include "../includes/navbar.php"; ?>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-1">
                <div class="col-md-12 row">
                  <div class="col-auto">
                    <h6 class="text-white text-capitalize ps-3">Online Applications</h6>
                  </div>
                  <div class="col-sm-2 px-4">
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addNewApplication">Add New</button>
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
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Project</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Mobile No.</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Email</th>
                          <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date In</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM userapplications WHERE userID = '$LoggedUserID'";
                        $res = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($res)) {
                          $id = $row['id'];
                          $dateIn = $row['regDate'] .' '. $row['regTime'];
                          ?>
                          <tr>
                            <td>
                              <div class="d-flex">
                                <div class="d-flex flex-column justify-content-center">
                                  <a href="applications.php?application=<?php echo $id; ?>&user=<?php echo $LoggedUserID; ?>"><h6 class="mb-0 text-sm text-warning"><?php echo $row['ownerApplicant']; ?></h6></a>
                                </div>
                              </div>
                            </td>
                            <td class="align-middle text-sm">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['projectTitle']; ?></span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <p class="text-xs font-weight-bold mb-0"><?php echo $row['contactNo']; ?></p>
                              <!-- <p class="text-xs text-secondary mb-0"><?php //echo $row['emailAdd']; ?></p> -->
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row['emailAdd']; ?></span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $dateIn; ?></span>
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

    </div>
  </main>

  <?php include "../includes/javascript.php"; ?>

  <script type="text/javascript">
    function searchTDN() {
      var tdn = document.getElementById('taxDeclaration').value;

      if(window.XMLHttpRequest) {
        xmlhttp3 = new XMLHttpRequest();
      } else {
        xmlhttp3 = new ActiveObject("Microsoft.XMLHTTP");
      }

      xmlhttp3.onreadystatechange=function() {
        if(xmlhttp3.readyState==4 && xmlhttp3.status==200) {
          document.getElementById("formSearchTDN").innerHTML=xmlhttp3.responseText;
        }
      }

      var queryString = "?tdn="+tdn;

      xmlhttp3.open("GET","../ajax/getTDN.php"+queryString,true);
      xmlhttp3.send();
    }
  </script>

</body>

</html>
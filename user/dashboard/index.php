<?php
include "../includes/auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../includes/head.php"; ?>
  <title>Padayon Tacloban</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <style type="text/css">
    .modal.fade {
      z-index: 10000000 !important;
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-200">

  <?php
  $active_applications = "bg-gradient-info";
  $link_applications = "#";
  
  $active_bldgpermit = "";
  $link_bldgpermit = "../building-permit";

  $active_occupancypermit = "";
  $link_occupancypermit = "../occupancy-permit";

  $active_onlineapp = "";
  $link_onlineapp = "../online-applications";

  include "../includes/aside.php";
  ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    <?php
    include "../includes/navbar.php";
    include "modal.php";
    include "modal_OccPermit.php";
    include "modal_locationalClearance.php";
    ?>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-default shadow-info border-radius-lg pt-2 pb-3" style="text-align: center;">
                <h5 style="color:#002080;">Online Application of Permits and Clearances</h5>
                <img src="../../img/Tacloban-Logo.png" style="height:150px;width:250px;">
              </div>
            </div>
            <div class="card-body mx-3 px-0 pb-2">
              <div class="col-md-12">
                <div class="row">

                  <div class="col-md-3 ml-2 mb-2">
                    <div class="card card-category">
                      <span class="mt-2"><i class="fas fa-city fa-5x"></i></span>
                      <div class="card-body">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#bldgPermit">Building Permit</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 ml-2 mb-2">
                    <div class="card card-category">
                      <span class="mt-2"><i class="fas fa-building fa-5x"></i></span>
                      <div class="card-body">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#OccPermit">Occupational Permit</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 ml-2 mb-2">
                    <div class="card card-category">
                      <span class="mt-2"><i class="fas fa-search-location fa-5x"></i></span>
                      <div class="card-body">
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#locationalClearance">Locational Clearance</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 ml-2 mb-2">
                    <div class="card card-category">
                      <span class="mt-2"><i class="fas fa-band-aid fa-5x"></i></span>
                      <div class="card-body">
                        <button class="btn btn-sm btn-info">Safe City</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 ml-2 mb-2">
                    <div class="card card-category">
                      <span class="mt-2"><i class="fas fa-briefcase fa-5x"></i></span>
                      <div class="card-body">
                        <button class="btn btn-sm btn-info">Business Portal</button>
                      </div>
                    </div>
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
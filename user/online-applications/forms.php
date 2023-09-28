<?php
if( isset($_GET['application']) && isset($_GET['user']) ) {
  $applicationID = $_GET['application'];
  $userID = $_GET['user'];
  include "../includes/auth.php";
} else {
  header('location: ../../login');
}
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
  $active_forms = "bg-gradient-info";
  $link_forms = "#";
  
  $active_applications = "";
  $link_applications = "applications.php?application=". $applicationID ."&user=". $userID;

  include "../includes/aside2.php";
  ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    <?php
    include "../includes/navbar.php";
    include "./files/modal_bldgpermit.php";
    include "./files/modal_occupancy.php";
    include "./files/modal_locational.php";
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
                      <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#OccupancyPermit">Occupancy Permit</button>
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
                <div class="col-md-12">
                  <div class="float-end">
                    <a href="../online-applications" class="btn btn-sm btn-dark">Get Back</a>
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
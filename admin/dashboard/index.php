<?php
include "../includes/auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../includes/head.php"; ?>
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body class="g-sidenav-show  bg-gray-200">

  <?php
  $active_dashboard = "bg-gradient-info";
  $link_dashboard = "#";
  
  $active_bldgpermit = "";
  $link_bldgpermit = "../building-permit";

  $active_occupancyPermit = "";
  $link_occupancyPermit = "../occupational-permit";

  $active_locationalClearance = "";
  $link_locationalClearance = "../locational-clearance";

  // $active_onlineapp = "";
  // $link_onlineapp = "../online-application";
  
  include "../includes/aside.php";
  ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    <?php include "../includes/navbar.php"; ?>

    <div class="container-fluid py-4" style="height:95vh;">
      
      <div class="card img-fluid">
        <img class="card-img-top img-fluid" src="../../img/Tacloban-Logo.png" alt="Card image" style="height:90vh;">
        <div class="card-img-overlay">
          <h4 class="card-title">CITY GOVERNMENT OF TACLOBAN</h4>
          <p class="card-text">
            A GLOBALLY COMPETITIVE, GREEN AND RESILIENT CITY, PROPELLED BY GOD-LOVING, GENDER RESPONSIVE LEADERS AND EMPOWERED CITIZENRY. Guided by this vision, the MISSIONS that the city is set to accomplish are:
            <ul>
              <li>1. To be an agri-industrial park and strategic hub for educational excellence in Eastern Visayas.</li>
              <li>2. To achieve competent human capital in a secured, well balanced environment.</li>
              <li>3. To preserve the cultural heritage and unique identity of the city.</li>
              <li>4. To ensure access to social services and economic opportunities.</li>
              <li>5. To attain a God-loving, healthy and empowered citizenry through a transparent, gender-responsive and inspiring governance.</li>
            </ul>
          </p>
        </div>
      </div>

      <?php //include "../includes/footer.php"; ?>

    </div>
  </main>

  <?php //include "../includes/plugin.php"; ?>

  <?php include "../includes/javascript.php"; ?>

</body>

</html>
<?php
require '../../includes2/auth.php';
if(isset($_SESSION['bldgpermit']) && isset($_GET['slug'])) {
	$slug = $_GET['slug'];
	$sql = "SELECT * FROM onlineapplications WHERE slug = '$slug'";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);
	$userappID = $row['userappID'];
	$onlineappID = $row['id'];
	$currentArea = 'Site Inspection';
} else {
	header('location: ../../../../login');
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php require '../../includes2/head.php'; ?>
	<title>Locational Clearance</title>
	<style type="text/css">
		.aleft { margin-right: 50%; }
	</style>
</head>
<body class="g-sidenav-show  bg-gray-200">

	<?php  
	include '../../includes2/view_icons.php';
  
  	$active_docverification = '';
  	$link_docverification = '../document-verification/?slug='. $slug;

  	$active_assessment = '';
  	$link_assessment = '../assessment/?slug='. $slug;

  	$active_receiving = '';
  	$link_receiving = '../receiving/?slug='. $slug;

  	$active_evaluation = '';
  	$link_evaluation = '../evaluation/?slug='. $slug;

  	$active_site_inspec = 'bg-gradient-info';
  	$link_site_inspec = '#';

  	$active_clearance_prep = '';
  	$link_clearance_prep = '../clearance-preparation/?slug='. $slug;

  	$active_approval = '';
  	$link_approval = '../approval/?slug='. $slug;

  	$active_releasing = '';
  	$link_releasing = '../releasing/?slug='. $slug;

	include "../../includes2/aside.php";
	?>

	<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    <?php include "../../includes2/navbar.php"; ?>

	<div class="container-fluid py-4">
		<div class="row">
        	<div class="col-md-12">
          		<div class="card my-4">
            		<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              			<div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                			<div class="col-md-12 row">
                  				<div class="col-sm-5">
                    				<h6 class="text-white text-capitalize ps-3">Site Inspection</h6>
                  				</div>
                  				<div class="col-sm-7 px-3">
                    				<div class="float-end">
                    					<a href="../../applications.php?application=<?php echo $userappID; ?>&user=<?php echo $LoggedUserID; ?>" class="btn btn-sm btn-dark">Get Back</a>
                    				</div>
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
                          						<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Date - In</th>
                          						<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Date Visited</th>
                          						<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">No. Days</th>
                          						<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7 text-end">
                          							<span class="aleft">Remarks</span>
                          						</th>
                        					</tr>
                      					</thead>
                      					<tbody>
                      						<?php
                      						$sql = "SELECT * FROM lc_tracking WHERE onlineappID = '$onlineappID' AND area = '$currentArea'";
                      						$res = mysqli_query($conn, $sql);
                      						$num = mysqli_num_rows($res);
                      						if($num > 0) {
                      							while($row = mysqli_fetch_assoc($res)) {
                      								$id = $row['id'];
                      								$dateIn = $row['dateIn'];
                      								$dateReceived = $row['dateReceived'];
                      								$dateOut = $row['dateOut'];

                      								if($dateIn != '' && $dateReceived == '' && $dateOut == '') {
                      									$dateIn = date_create($dateIn);
                      									$dateOut = date_create($dateNow);
                      									$daysIn = date_diff($dateIn, $dateOut)->format('%dD - %hH - %iM');
                      								} elseif($dateIn != '' && $dateReceived != '') {
                      									$dateIn = date_create($dateIn);
                      									$dateOut = date_create($dateReceived);
                      									$daysIn = date_diff($dateIn, $dateOut)->format('%dD - %hH - %iM');
                      								} else {
                      									$daysIn = '';
                      								}
	                      							?>
	                      							<tr>
	                      								<td class="align-middle text-sm td-100">
	                      									<span class="text-secondary text-xs font-weight-bold"><?php echo $row['dateIn']; ?></span>
	                      								</td>
	                      								<td class="align-middle text-sm td-100">
	                      									<span class="text-secondary text-xs font-weight-bold"><?php echo $row['dateReceived']; ?></span>
	                      								</td>
	                      								<td class="align-middle text-sm td-100">
	                      									<span class="text-secondary text-xs font-weight-bold"><?php echo $daysIn; ?></span>
	                      								</td>
	                      								<td class="align-middle text-sm text-center">
	                      									<p class="text-xs font-weight-bold mb-0"><?php echo $row['remarks']; ?></p>
	                      								</td>
	                      							</tr>
	                      							<?php
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

  <?php include "../../includes2/javascript.php"; ?>

</body>
</html>
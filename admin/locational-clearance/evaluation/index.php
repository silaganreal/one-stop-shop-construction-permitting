<?php
require '../../includes2/auth.php';
if(isset($_GET['slug'])) {
	$slug = $_GET['slug'];
	$sql = "SELECT * FROM onlineapplications WHERE slug = '$slug'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);
	if($num > 0) {
		$row = mysqli_fetch_assoc($res);
		$userappID = $row['userappID'];
		$onlineappID = $row['id'];
		$currentArea = 'Evaluation';
		$dateNow = date('Y-m-d h:i:s');
	} else {
		header('location: ../../../login');
	}
} else {
	header('location: ../../../login');
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php require '../../includes2/head.php'; ?>
	<title>Locational Clearance</title>
	<style type="text/css">
		.modal-backdrop { display: none; }
		.modal { background: rgba(0,0,0,0.5); }
	</style>
</head>
<body class="g-sidenav-show  bg-gray-200">

	<?php  
	include '../view_icons.php';
  
  	$active_docverification = '';
  	$link_docverification = '../document-verification/?slug='. $slug;

  	$active_assessment = '';
  	$link_assessment = '../assessment/?slug='. $slug;

  	$active_receiving = '';
  	$link_receiving = '../receiving/?slug='. $slug;

  	$active_evaluation = 'bg-gradient-info';
  	$link_evaluation = '#';

  	$active_site_inspec = '';
  	$link_site_inspec = '../site-inspection/?slug='. $slug;

  	$active_clearance_prep = '';
  	$link_clearance_prep = '../clearance-preparation/?slug='. $slug;

  	$active_approval = '';
  	$link_approval = '../approval/?slug='. $slug;

  	$active_releasing = '';
  	$link_releasing = '../releasing/?slug='. $slug;

	include "../aside.php";
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
                    				<h6 class="text-white text-capitalize ps-3">Evaluation</h6>
                  				</div>
                  				<div class="col-sm-7 px-3">
                    				<div class="float-end">
                    					<?php
                    					if($LoggedUserLevel == '1') {
                    						$sql2 = "SELECT * FROM lc_tracking WHERE onlineappID = '$onlineappID' AND area = '$currentArea'";
                    						$res2 = mysqli_query($conn, $sql2);
                    						while($row2 = mysqli_fetch_assoc($res2)) {
                    							$id = $row2['id'];
                    							if($row2['isCurrentArea'] == 'Y' && $row2['isFinished'] == 'N') {
                    								?><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateStage<?php echo $id; ?>">Update</button><?php
                    								include '../modalUpdateArea.php';
                    							}
                    						}
                    					}
                    					?>
                    					<a href="../" class="btn btn-sm btn-dark">Get Back</a>
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
                          						<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Area</th>
						                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Incharge</th>
						                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date Receive</th>
						                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date Out</th>
						                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Remarks</th>
                        					</tr>
                      					</thead>
                      					<tbody>
                      						<?php
                      						$sql = "SELECT * FROM lc_evaluation WHERE onlineappID = '$onlineappID'";
                      						$res = mysqli_query($conn, $sql);
                      						$num = mysqli_num_rows($res);
                      						if($num > 0) {
                      							while($row = mysqli_fetch_assoc($res)) {
                      								$evalID = $row['id'];
                      								$evalArea = $row['area'];
	                      							$dateIn = $row['dateReceive'];
	                      							$dateOut = $row['dateOut'];
	                      							?>
	                      							<tr>
	                      								<td class="text-sm align-middle" style="width:100px;">
	                      									<a href="#" class="text-xs font-weight-bold mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#editEvaluation<?php echo $evalID; ?>">
	                      										<span class="text-danger"><?php echo $row['area']; ?></span>
	                      									</a>
	                      								</td>
	                      								<td class="text-sm align-middle text-warning" style="width:100px;">
	                      									<p class="text-xs font-weight-bold mb-1 mt-1"><?php echo $row['incharge']; ?></p>
	                      								</td>
	                      								<td class="text-sm align-middle" style="width:100px;">
	                      									<p class="text-xs font-weight-bold mb-1 mt-1"><?php echo $dateIn; ?></p>
	                      								</td>
	                      								<td class="text-sm align-middle" style="width:100px;">
	                      									<span class="text-xs font-weight-bold"><?php echo $dateOut; ?></span>
	                      								</td>
	                      								<td class="text-sm align-middle text-center">
	                      									<p class="text-xs font-weight-bold mb-1 mt-1"><?php echo $row['remarks']; ?></p>
	                      								</td>
	                      							</tr>
	                      							<?php
	                      							include 'modalEditEvaluation.php';
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
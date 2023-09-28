<?php
require '../../includes2/auth.php';
if(isset($_SESSION['bldgpermit']) && isset($_GET['slug'])) {
	$slug = $_GET['slug'];
	$sql = "SELECT * FROM onlineapplications WHERE slug = '$slug'";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);
	$userappID = $row['userappID'];
	$onlineappID = $row['id'];
	$currentArea = 'Administrative Fine';
} else {
	header('location: ../../../../login');
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php require '../../includes2/head.php'; ?>
	<title>Locational Clearance</title>
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

  	$active_site_inspec = '';
  	$link_site_inspec = '../site-inspection/?slug='. $slug;

  	$active_clearance_prep = 'bg-gradient-info';
  	$link_clearance_prep = '#';

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
                    				<h6 class="text-white text-capitalize ps-3">Administrative Fine</h6>
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
                          						<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Assessed Fees</th>
                        						<th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Amount Due</th>
                        						<th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Assessed By</th>
                        						<th class="text-secondary text-uppercase text-xxs font-weight-bolder text-center opacity-7">Date & Time</th>
                        					</tr>
                      					</thead>
                      					<tbody>
                      						<?php
                      						$totalAmout = 0;
                      						$sql2 = "SELECT * FROM lc_assessment2 WHERE onlineappID = '$onlineappID'";
                      						$res2 = mysqli_query($conn, $sql2);
                      						$num2 = mysqli_num_rows($res2);
                      						if($num2 > 0) {
                      							while($row2 = mysqli_fetch_assoc($res2)) {
                      								$id = $row2['id'];
						                          $GLOBALS['totalAmout'] += intval($row2['amountDue']);
						                          $assessedFees = $row2['assessedFees'];
                      								?>
                      								<tr>
                      									<td class="align-middle text-sm" style="padding-left:20px;width:150px;">
                          								<a href="#" class="font-weight-bold mb-1 mt-1">
                            								<span class="text-warning"><?php echo $assessedFees; ?></span>
                          								</a>
							                            </td>
							                            <td class="align-middle text-center text-sm">
							                              <span class="text-secondary font-weight-bold"><?php echo $row2['amountDue']; ?></span>
							                            </td>
							                            <td class="align-middle text-center">
							                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row2['assessedBy']; ?></span>
							                            </td>
							                            <td class="align-middle text-center">
							                              <span class="text-secondary text-xs font-weight-bold"><?php echo $row2['dateTime']; ?></span>
							                            </td>
                      								</tr>
                      								<?php
                      							}
                      							?>
                      							<tr>
						                          <td class="align-middle text-sm" style="padding-left:20px;width:150px;">
						                            <span class="text-secondary font-weight-bold" style="font-size:20px;">Total</span>
						                          </td>
						                          <td class="align-middle text-center text-sm">
						                            <span class="text-info font-weight-bold" style="font-size:20px;"><?php echo $totalAmout; ?></span>
						                          </td>
						                          <td></td>
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

  <?php include "../../includes2/javascript.php"; ?>

</body>
</html>
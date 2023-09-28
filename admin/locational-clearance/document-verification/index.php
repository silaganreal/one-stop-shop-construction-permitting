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
		$currentArea = 'Document Verification';
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
		.th-10 { width: 10%; }
		.modal-backdrop { display: none; }
		.modal { background: rgba(0,0,0,0.5); }
	</style>
</head>
<body class="g-sidenav-show  bg-gray-200">

	<?php  
	include '../view_icons.php';
  
  	$active_docverification = 'bg-gradient-info';
  	$link_docverification = '#';

  	$active_assessment = '';
  	$link_assessment = '../assessment/?slug='. $slug;

  	$active_receiving = '';
  	$link_receiving = '../receiving/?slug='. $slug;

  	$active_evaluation = '';
  	$link_evaluation = '../evaluation/?slug='. $slug;

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
                    				<h6 class="text-white text-capitalize ps-3">Document Verification</h6>
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
                          						<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7 th-10">File</th>
                          						<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7 th-10">Status</th>
                          						<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7 th-10">Date</th>
                          					   	<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7 text-center">Remarks</th>
                          						<th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7 text-end">Action</th>
                        					</tr>
                      					</thead>
                      					<tbody>
                      						<?php
						                    $sql3 = "SELECT * FROM attachments WHERE applicationID = '$onlineappID'";
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
						                         		<span class="text-xs font-weight-bold mb-1 mt-1 <?php echo $textColor; ?>">
						                         			<i><?php echo $row3['status']; ?></i>
						                         		</span>
						                        	</td>
						                        	<td class="text-sm align-middle">
						                          		<span class="text-success text-xs font-weight-bold"><?php echo $row3['date']; ?></span>
						                        	</td>
						                        	<td class="text-sm align-middle text-center">
						                          		<i class="text-warning text-xs font-weight-bold" onclick="openPopUpComment('<?php echo $linkComments; ?>','RealVS2',1000,650)">
						                            		<?php echo $row3['remarks']; ?>
						                          		</i>
						                        	</td>
						                        	<td class="text-sm align-middle text-end">
						                          		<?php
						                          		if($LoggedUserLevel == '1') {
						                          			?>
						                            		<a href="verify.php?id=<?php echo $row3['id']; ?>&slug=<?php echo $slug; ?>" class="text-xs font-weight-bold" onclick="return confirm('Confirm Verification?')">
						                              			<i class="text-success">VERIFY</i>
						                            		</a>/
						                            		<a href="#" class="text-xs font-weight-bold" data-bs-toggle="modal" data-bs-target="#deny<?php echo $fileID; ?>">
						                              			<i class="text-danger">DENY</i>
						                            		</a>
						                          			<?php
						                          		}
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
	</main>
	
	<?php include "../../includes2/javascript.php"; ?>
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
    </script>

</body>
</html>
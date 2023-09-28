<?php
include "../includes/auth.php";
include "../includes/connect.php";
// Conn 2 -----------------------------------------------------------------------------------------------------------------
$serverName = "10.0.0.2"; 
$dbUsername = "sa"; 
$dbPassword = "@dm1n1str@t0r"; 
$dbName     = "Georecords"; 
 
// Create database connection 
try {   
   $conn2 = new PDO( "sqlsrv:Server=$serverName;Database=$dbName;TrustServerCertificate=true", $dbUsername, $dbPassword);    
   $conn2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
   // echo "SQL Server Connection Established <br><br>";
}
   
catch( PDOException $e ) {   
   die( "Error connecting to SQL Server: ".$e->getMessage() );    
}
// Conn 2 -----------------------------------------------------------------------------------------------------------------

if(isset($_GET['tdn'])) {

	$tdn = $_GET['tdn'];

	$sql = "SELECT * FROM PATAS.TDN WHERE TDN = '$tdn'";
	$query = $conn2->prepare($sql); 
	$query->execute(); 
	$members = $query->fetchAll(PDO::FETCH_ASSOC); 

	if(!empty($members)) {
		foreach($members as $row) {
			echo '
				<form action="./online-application/files/addNewApplication.php" method="post" enctype="multipart/form-data" id="formSearchTDN">
					<div class="input-group input-group-outline">
		              	<div class="row col-md-12">
							<div class="col-md-3 mt-2">
								<label>TDN</label>
							</div>
							<div class="col-md-5">
								<input type="text" name="taxDeclaration" id="taxDeclaration" class="form-control" value="'.$row['TDN'].'">
							</div>
							<div class="col-md-4 mt-1">
								<button type="button" class="btn btn-sm btn-primary" onclick="searchTDN()">Search TDN</button>
							</div>
						</div>
		           	</div>
					<div class="row mb-1" style="display:none;">
						<div class="input-group input-group-outline">
							<div class="col-md-3 mt-2">
								<label>Owner</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="ownerApplicant" class="form-control" value="'.$row['DisplayName'].'" required readonly>
							</div>
						</div>
					</div>
					<div class="row mb-1">
						<div class="input-group input-group-outline">
							<div class="col-md-3 mt-2"><label>Project Title</label></div>
							<div class="col-md-9"><input type="text" name="projectTitle" class="form-control" required></div>
						</div>
					</div>
					<div class="row mb-1">
						<div class="input-group input-group-outline">
							<div class="col-md-3 mt-2"><label>Applicant</label></div>
							<div class="col-md-9"><input type="text" name="applicantName" class="form-control" required></div>
						</div>
					</div>
					<div class="row mb-1">
						<div class="input-group input-group-outline">
							<div class="col-md-3 mt-2"><label>Contact No.</label></div>
							<div class="col-md-9"><input type="text" name="contactNo" class="form-control" required></div>
						</div>
					</div>
					<div class="row mb-1">
						<div class="input-group input-group-outline">
							<div class="col-md-3 mt-2"><label>Email</label></div>
							<div class="col-md-9"><input type="text" name="emailAdd" class="form-control" required></div>
						</div>
					</div><br>
					<input type="hidden" name="userID" value="'.$LoggedUserID.'">
					<div class="row">
						<div class="col-md-6">
							<button type="submit" name="addNewApplication" class="btn btn-sm btn-success">Submit</button>
						</div>
					</div>
		        </form>
			';
		}

	} else {
		echo '
			<form action="#" id="formSearchTDN">
				<div class="alert alert-danger" role="alert" style="color:white;">
				  Tax Declaration Not Found!
				</div>
				<div class="input-group input-group-outline">
	              	<div class="row col-md-12">
						<div class="col-md-2 mt-2">
							<label>TDN</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="taxDeclaration" id="taxDeclaration" class="form-control" value="'.$tdn.'" required>
						</div>
						<div class="col-md-4 mt-1">
							<button type="button" class="btn btn-sm btn-primary" onclick="searchTDN()">Search TDN</button>
						</div>
					</div>
	           	</div>
	        </form>
		';
	}

} else {
	echo "<script>alert('what are you doing here?');window.location.href='../'</script>";
}

?>
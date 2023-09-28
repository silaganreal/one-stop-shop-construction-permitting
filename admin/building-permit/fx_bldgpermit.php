<?php

function addNewApplication($userID, $appID, $applicationType, $regDate, $regTime, $currentArea, $appStatus, $slug) {
			
	include '../includes/connect.php';

	$sql2 = $conn->prepare("INSERT INTO onlineapplications(userID, userappID, applicationType, applicationDate, applicationTime, currentArea, applicationRemarks, slug) VALUES(?,?,?,?,?,?,?,?)");
	$sql2->bind_param("ssssssss", $userID, $appID, $applicationType, $regDate, $regTime, $currentArea, $appStatus, $slug);

	if($sql2->execute()) {

		$lastID = $conn->insert_id;
		$randomChar = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,3);
		$dateIn = $regDate .' '. $regTime;

		$sql_track = "INSERT INTO tracking(onlineappID, area, dateIn, isCurrentArea, isFinished) VALUES('$lastID','Receiving','$dateIn','Y','N');";
		$sql_track .= "INSERT INTO tracking(onlineappID, area) VALUES('$lastID','Document Verification');";
		$sql_track .= "INSERT INTO tracking(onlineappID, area) VALUES('$lastID','Plan Evaluation');";
		$sql_track .= "INSERT INTO tracking(onlineappID, area) VALUES('$lastID','Assessment');";
		$sql_track .= "INSERT INTO tracking(onlineappID, area) VALUES('$lastID','Approval');";
		$sql_track .= "INSERT INTO tracking(onlineappID, area) VALUES('$lastID','Assessment Releasing');";
		$sql_track .= "INSERT INTO tracking(onlineappID, area) VALUES('$lastID','Payment');";
		$sql_track .= "INSERT INTO tracking(onlineappID, area) VALUES('$lastID','Releasing')";

		if(mysqli_multi_query($conn, $sql_track)) {

			while(mysqli_next_result($conn)){;}

			$sql_trackplan = "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Land Use & Zoning','Engr. Simeon Gaduena','1','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Line & Grade','Engr. Arnel Brillo','2','','','','','');";
			
			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Architectural','Arch. Shekinah Marie Riveral','3','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Civil/Structural','Engr. Filemon Tandinco III','4','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Electrical','Engr. Roy Endriano','5','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Sanitary/Plumbing','Arch. John Oliver Millos','6','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Mechanical','Engr. Edgar Conise','7','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Electronics','Engr. Adonis Acuin','8','','','','','');";

			if(mysqli_multi_query($conn, $sql_trackplan)) {

				while(mysqli_next_result($conn)){;}

				$sql_trackassess = "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Land Use & Zoning');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Filing Fee');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Line & Grade');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Fencing');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Architectural');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Civil/Structural');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Electrical');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Mechanical');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Excavation');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Sanitary/Plumbing');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Electronics');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Interior');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Surcharges');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Penalties');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Project Cost');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Labor Cost');";
				$sql_trackassess .= "INSERT INTO tracking_assessment(onlineappID, assessedFees) VALUES('$lastID','Contractors Tax')";

				if(mysqli_multi_query($conn, $sql_trackassess)) {
					echo "<script>alert('New Record has been added!');window.location.href='../building-permit'</script>";

				} else {
					$error = "Error (Tracking: Assessment): ". mysqli_error($conn);
					$error_explode = explode("'", $error);
					$error_implode = implode("", $error_explode);
					echo "<script>alert('$error_implode');window.location.href='../building-permit'</script>";
				}

			} else {
				$error = "Error (Tracking: Planning Evaluation): ". mysqli_error($conn);
				$error_explode = explode("'", $error);
				$error_implode = implode("", $error_explode);
				echo "<script>alert('$error_implode');window.location.href='../building-permit'</script>";
			}
			
		} else {
			$error = "Error (Main Tracking): ". mysqli_error($conn);
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='../building-permit'</script>";
		}

		// $sql->close();
		$conn->close();
		
	}

}

?>
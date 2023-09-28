<?php

function addNewApplication($userID, $appID, $appType, $appDate, $appTime, $currentArea, $appStatus, $slug) {
			
	include '../../includes/connect.php';

	$sql2 = $conn->prepare("INSERT INTO onlineapplications(userID, userappID, applicationType, applicationDate, applicationTime, currentArea, applicationStatus, slug) VALUES(?,?,?,?,?,?,?,?)");
	$sql2->bind_param("ssssssss", $userID, $appID, $appType, $appDate, $appTime, $currentArea, $appStatus, $slug);

	if($sql2->execute()) {

		$lastID = $conn->insert_id;
		$randomChar = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,3);

		//directory---------------------------------------------------------------------------------------------------------
		$prefixLink = '../../../uploads/BUILDING_PERMIT/';
		$directory = $lastID ."_". $randomChar;
		$dirname = $prefixLink . $directory . "/";
		$fdir = 'BUILDING_PERMIT/'. $directory;
		$status = 'For Verification';
		$remarks = '';
		$dateIn = $appDate .' '. $appTime;

		if(!is_dir($dirname)) {
			mkdir($dirname, 0777);
		}
		//directory---------------------------------------------------------------------------------------------------------

		//attachement-------------------------------------------------------------------------------------------------------
		$brgyClearance = $_FILES['brgyClearance'];
		if( !empty($brgyClearance) ) {
			function reArrayFiles($file) {
			    $file_ary = array();
			    $file_count = count($file['name']);
			    $file_key = array_keys($file);
			   
			    for($i=0;$i<$file_count;$i++) {
			        foreach($file_key as $val) {
			            $file_ary[$i][$val] = $file[$val][$i];
			        }
			    }
			    return $file_ary;
			}
			$img_desc = reArrayFiles($brgyClearance);	
		    foreach($img_desc as $val) {
		        $brgyClearance_name = $val['name'];
				$brgyClearance_type = $val['type'];
				$brgyClearance_size = $val['size'];
				$brgyClearance_temp = $val['tmp_name'];
				$brgyClearance_exte = pathinfo($brgyClearance_name, PATHINFO_EXTENSION);

				$brgyClearance_fileName = "BRGY_CLEARANCE-". mt_rand();
				$brgyClearance_new_name = "BRGY_CLEARANCE-". mt_rand() .".". $brgyClearance_exte;
				$brgyClearance_destination = $dirname . "{$brgyClearance_new_name}";
				move_uploaded_file( $brgyClearance_temp, $brgyClearance_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $brgyClearance_fileName, $brgyClearance_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$drainageCert = $_FILES['drainageCert'];
		if( !empty($drainageCert) ) {
			function reArrayFiles2($file) {
				$file_ary = array();
				$file_count = count($file['name']);
				$file_key = array_keys($file);

				for($i=0;$i<$file_count;$i++) {
					foreach($file_key as $val) {
						$file_ary[$i][$val] = $file[$val][$i];
					}
				}
				return $file_ary;
			}
			$img_desc = reArrayFiles2($drainageCert);
			foreach($img_desc as $val) {
				$drainageCert_name = $val['name'];
				$drainageCert_type = $val['type'];
				$drainageCert_size = $val['size'];
				$drainageCert_temp = $val['tmp_name'];
				$drainageCert_exte = pathinfo($drainageCert_name, PATHINFO_EXTENSION);

				$drainageCert_fileName = "DRAINAGE_CERT-". mt_rand();
				$drainageCert_new_name = "DRAINAGE_CERT-". mt_rand() .".". $drainageCert_exte;
				$drainageCert_destination = $dirname . "{$drainageCert_new_name}";
				move_uploaded_file( $drainageCert_temp, $drainageCert_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $drainageCert_fileName, $drainageCert_new_name, $status, $remarks, $fdir);
				$sql->execute();
			}
		} else {
			$drainageCert_new_name = "";
		}

		$locationalClearance = $_FILES['locationalClearance'];
		if( !empty($locationalClearance) ) {
			function reArrayFiles3($file) {
				$file_ary = array();
				$file_count = count($file['name']);
				$file_key = array_keys($file);

				for($i=0;$i<$file_count;$i++) {
					foreach($file_key as $val) {
						$file_ary[$i][$val] = $file[$val][$i];
					}
				}
				return $file_ary;
			}
			$img_desc = reArrayFiles3($locationalClearance);
			foreach($img_desc as $val) {
				$locationalClearance_name = $val['name'];
				$locationalClearance_type = $val['type'];
				$locationalClearance_size = $val['size'];
				$locationalClearance_temp = $val['tmp_name'];
				$locationalClearance_exte = pathinfo($locationalClearance_name, PATHINFO_EXTENSION);

				$locationalClearance_fileName = "LOCATIONAL_CLEARANCE-". mt_rand();
				$locationalClearance_new_name = "LOCATIONAL_CLEARANCE-". mt_rand() .".". $locationalClearance_exte;
				$locationalClearance_destination = $dirname . "{$locationalClearance_new_name}";
				move_uploaded_file( $locationalClearance_temp, $locationalClearance_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $locationalClearance_fileName, $locationalClearance_new_name, $status, $remarks, $fdir);
				$sql->execute();
			}
		} else {
			$locationalClearance_new_name = "";
		}

		$taxDeclaration = $_FILES['taxDeclaration'];
		if( !empty($taxDeclaration) ) {
			function reArrayFiles4($file) {
				$file_ary = array();
				$file_count = count($file['name']);
				$file_key = array_keys($file);

				for($i=0;$i<$file_count;$i++) {
					foreach($file_key as $val) {
						$file_ary[$i][$val] = $file[$val][$i];
					}
				}
				return $file_ary;
			}
			$img_desc = reArrayFiles4($taxDeclaration);
			foreach($img_desc as $val) {
				$taxDeclaration_name = $val['name'];
				$taxDeclaration_type = $val['type'];
				$taxDeclaration_size = $val['size'];
				$taxDeclaration_temp = $val['tmp_name'];
				$taxDeclaration_exte = pathinfo($taxDeclaration_name, PATHINFO_EXTENSION);

				$taxDeclaration_fileName = "TAX_DECLARATION-". mt_rand();
				$taxDeclaration_new_name = "TAX_DECLARATION-". mt_rand() .".". $taxDeclaration_exte;
				$taxDeclaration_destination = $dirname . "{$taxDeclaration_new_name}";
				move_uploaded_file( $taxDeclaration_temp, $taxDeclaration_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $taxDeclaration_fileName, $taxDeclaration_new_name, $status, $remarks, $fdir);
				$sql->execute();
			}
		} else {
			$taxDeclaration_new_name = "";
		}

		$taxClearance = $_FILES['taxClearance'];
		if( !empty($taxClearance) ) {
			function reArrayFiles5($file) {
				$file_ary = array();
				$file_count = count($file['name']);
				$file_key = array_keys($file);

				for($i=0;$i<$file_count;$i++) {
					foreach($file_key as $val) {
						$file_ary[$i][$val] = $file[$val][$i];
					}
				}
				return $file_ary;
			}
			$img_desc = reArrayFiles5($taxClearance);
			foreach($img_desc as $val) {
				$taxClearance_name = $val['name'];
				$taxClearance_type = $val['type'];
				$taxClearance_size = $val['size'];
				$taxClearance_temp = $val['tmp_name'];
				$taxClearance_exte = pathinfo($taxClearance_name, PATHINFO_EXTENSION);

				$taxClearance_fileName = "TAX_CLEARANCE-". mt_rand();
				$taxClearance_new_name = "TAX_CLEARANCE-". mt_rand() .".". $taxClearance_exte;
				$taxClearance_destination = $dirname . "{$taxClearance_new_name}";
				move_uploaded_file( $taxClearance_temp, $taxClearance_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $taxClearance_fileName, $taxClearance_new_name, $status, $remarks, $fdir);
				$sql->execute();
			}
		} else {
			$taxClearance_new_name = "";
		}

		$titleOfProperty = $_FILES['titleOfProperty'];
		if( !empty($titleOfProperty) ) {
			function reArrayFiles6($file) {
				$file_ary = array();
				$file_count = count($file['name']);
				$file_key = array_keys($file);

				for($i=0;$i<$file_count;$i++) {
					foreach($file_key as $val) {
						$file_ary[$i][$val] = $file[$val][$i];
					}
				}
				return $file_ary;
			}
			$img_desc = reArrayFiles6($titleOfProperty);
			foreach($img_desc as $val) {
				$titleOfProperty_name = $val['name'];
				$titleOfProperty_type = $val['type'];
				$titleOfProperty_size = $val['size'];
				$titleOfProperty_temp = $val['tmp_name'];
				$titleOfProperty_exte = pathinfo($titleOfProperty_name, PATHINFO_EXTENSION);

				$titleOfProperty_fileName = "TITLE_OF_PROPERTY-". mt_rand();
				$titleOfProperty_new_name = "TITLE_OF_PROPERTY-". mt_rand() .".". $titleOfProperty_exte;
				$titleOfProperty_destination = $dirname . "{$titleOfProperty_new_name}";
				move_uploaded_file( $titleOfProperty_temp, $titleOfProperty_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $titleOfProperty_fileName, $titleOfProperty_new_name, $status, $remarks, $fdir);
				$sql->execute();
			}
		} else {
			$titleOfProperty_new_name = "";
		}

		$sketchPlan = $_FILES['sketchPlan'];
		if( !empty($sketchPlan) ) {
			function reArrayFiles7($file) {
				$file_ary = array();
				$file_count = count($file['name']);
				$file_key = array_keys($file);

				for($i=0;$i<$file_count;$i++) {
					foreach($file_key as $val) {
						$file_ary[$i][$val] = $file[$val][$i];
					}
				}
				return $file_ary;
			}
			$img_desc = reArrayFiles7($sketchPlan);
			foreach($img_desc as $val) {
				$sketchPlan_name = $val['name'];
				$sketchPlan_type = $val['type'];
				$sketchPlan_size = $val['size'];
				$sketchPlan_temp = $val['tmp_name'];
				$sketchPlan_exte = pathinfo($sketchPlan_name, PATHINFO_EXTENSION);

				$sketchPlan_fileName = "SKETCH_PLAN-". mt_rand();
				$sketchPlan_new_name = "SKETCH_PLAN-". mt_rand() .".". $sketchPlan_exte;
				$sketchPlan_destination = $dirname . "{$sketchPlan_new_name}";
				move_uploaded_file( $sketchPlan_temp, $sketchPlan_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $sketchPlan_fileName, $sketchPlan_new_name, $status, $remarks, $fdir);
				$sql->execute();
			}
		} else {
			$sketchPlan_new_name = "";
		}

		$subdivisionPlan = $_FILES['subdivisionPlan'];
		if( !empty($subdivisionPlan) ) {
			function reArrayFiles8($file) {
				$file_ary = array();
				$file_count = count($file['name']);
				$file_key = array_keys($file);

				for($i=0;$i<$file_count;$i++) {
					foreach($file_key as $val) {
						$file_ary[$i][$val] = $file[$val][$i];
					}
				}
				return $file_ary;
			}
			$img_desc = reArrayFiles8($subdivisionPlan);
			foreach($img_desc as $val) {
				$subdivisionPlan_name = $val['name'];
				$subdivisionPlan_type = $val['type'];
				$subdivisionPlan_size = $val['size'];
				$subdivisionPlan_temp = $val['tmp_name'];
				$subdivisionPlan_exte = pathinfo($subdivisionPlan_name, PATHINFO_EXTENSION);

				$subdivisionPlan_fileName = "SUBDIVISION_PLAN-". mt_rand();
				$subdivisionPlan_new_name = "SUBDIVISION_PLAN-". mt_rand() .".". $subdivisionPlan_exte;
				$subdivisionPlan_destination = $dirname . "{$subdivisionPlan_new_name}";
				move_uploaded_file( $subdivisionPlan_temp, $subdivisionPlan_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $subdivisionPlan_fileName, $subdivisionPlan_new_name, $status, $remarks, $fdir);
				$sql->execute();
			}
		}

		$prcLicense = $_FILES['prcLicense'];
		if( !empty($prcLicense) ) {
			function reArrayFiles9($file) {
				$file_ary = array();
				$file_count = count($file['name']);
				$file_key = array_keys($file);

				for($i=0;$i<$file_count;$i++) {
					foreach($file_key as $val) {
						$file_ary[$i][$val] = $file[$val][$i];
					}
				}
				return $file_ary;
			}
			$img_desc = reArrayFiles9($prcLicense);
			foreach($img_desc as $val) {
				$prcLicense_name = $val['name'];
				$prcLicense_type = $val['type'];
				$prcLicense_size = $val['size'];
				$prcLicense_temp = $val['tmp_name'];
				$prcLicense_exte = pathinfo($prcLicense_name, PATHINFO_EXTENSION);

				$prcLicense_fileName = "PRC_LICENSE-". mt_rand();
				$prcLicense_new_name = "PRC_LICENSE-". mt_rand() .".". $prcLicense_exte;
				$prcLicense_destination = $dirname . "{$prcLicense_new_name}";
				move_uploaded_file( $prcLicense_temp, $prcLicense_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $prcLicense_fileName, $prcLicense_new_name, $status, $remarks, $fdir);
				$sql->execute();
			}
		}
		//attachement-------------------------------------------------------------------------------------------------------

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

			$sql_trackplan = "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Land Use & Zoning','Engr. Simeon Gaduena','','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Line & Grade','Engr. Arnel Brillo','','','','','','');";
			
			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Architectural','Arch. Shekinah Marie Riveral','','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Civil/Structural','Engr. Filemon Tandinco III','','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Electrical','Engr. Roy Endriano','','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Sanitary/Plumbing','Arch. John Oliver Millos','','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Mechanical','Engr. Edgar Conise','','','','','','');";

			$sql_trackplan .= "INSERT INTO tracking_plan_evaluation(onlineappID, area, incharge, initial, timeIn, dateIn, timeOut, dateOut, remarks) VALUES('$lastID','Electronics','Engr. Adonis Acuin','','','','','','');";

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
					echo "<script>alert('New Record has been added!');window.location.href='../applications.php?application=$appID&user=$userID'</script>";
				} else {
					$error = "Error (Tracking: Assessment): ". mysqli_error($conn);
					$error_explode = explode("'", $error);
					$error_implode = implode("", $error_explode);
					echo "<script>alert('$error_implode');window.location.href='../applications.php?application=$appID&user=$userID'</script>";
				}

			} else {
				$error = "Error (Tracking: Planning Evaluation): ". mysqli_error($conn);
				$error_explode = explode("'", $error);
				$error_implode = implode("", $error_explode);
				echo "<script>alert('$error_implode');window.location.href='../applications.php?application=$appID&user=$userID'</script>";
			}
			
		} else {
			$error = "Error (Main Tracking): ". mysqli_error($conn);
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='../applications.php?application=$appID&user=$userID'</script>";
		}

		// $sql->close();
		$conn->close();
		
	}

}

?>
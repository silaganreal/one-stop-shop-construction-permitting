<?php

function addNewApplication($userID, $appID, $appType, $appDate, $appTime, $currentArea, $appStatus, $slug) {

	require '../../includes/connect.php';

	$sql2 = $conn->prepare("INSERT INTO onlineapplications(userID, userappID, applicationType, applicationDate, applicationTime, currentArea, applicationStatus, slug) VALUES(?,?,?,?,?,?,?,?)");
	$sql2->bind_param("ssssssss", $userID, $appID, $appType, $appDate, $appTime, $currentArea, $appStatus, $slug);

	if($sql2->execute()) {

		$lastID = $conn->insert_id;
		$randomChar = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,3);

		//directory---------------------------------------------------------------------------------------------------------
		$prefixLink = '../../../uploads/LOCATIONAL_CLEARANCE/';
		$directory = $lastID ."_". $randomChar;
		$dirname = $prefixLink . $directory . "/";
		$fdir = 'LOCATIONAL_CLEARANCE/'. $directory;
		$status = 'For Verification';
		$remarks = '';
		$dateIn = $appDate .' '. $appTime;

		if(!is_dir($dirname)) {
			mkdir($dirname, 0777);
		}
		//directory---------------------------------------------------------------------------------------------------------

		//attachement-------------------------------------------------------------------------------------------------------
		$applicationForm = $_FILES['applicationForm'];
		if( !empty($applicationForm) ) {
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
			$img_desc = reArrayFiles($applicationForm);	
		    foreach($img_desc as $val) {
		        $applicationForm_name = $val['name'];
				$applicationForm_type = $val['type'];
				$applicationForm_size = $val['size'];
				$applicationForm_temp = $val['tmp_name'];
				$applicationForm_exte = pathinfo($applicationForm_name, PATHINFO_EXTENSION);

				$applicationForm_fileName = "APPLICATION_FORM-". mt_rand();
				$applicationForm_new_name = "APPLICATION_FORM-". mt_rand() .".". $applicationForm_exte;
				$applicationForm_destination = $dirname . "{$applicationForm_new_name}";
				move_uploaded_file( $applicationForm_temp, $applicationForm_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $applicationForm_fileName, $applicationForm_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$CertOfTitle = $_FILES['CertOfTitle'];
		if( !empty($CertOfTitle) ) {
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
			$img_desc = reArrayFiles2($CertOfTitle);	
		    foreach($img_desc as $val) {
		        $CertOfTitle_name = $val['name'];
				$CertOfTitle_type = $val['type'];
				$CertOfTitle_size = $val['size'];
				$CertOfTitle_temp = $val['tmp_name'];
				$CertOfTitle_exte = pathinfo($CertOfTitle_name, PATHINFO_EXTENSION);

				$CertOfTitle_fileName = "CERTIFICATE_OF_TITLE-". mt_rand();
				$CertOfTitle_new_name = "CERTIFICATE_OF_TITLE-". mt_rand() .".". $CertOfTitle_exte;
				$CertOfTitle_destination = $dirname . "{$CertOfTitle_new_name}";
				move_uploaded_file( $CertOfTitle_temp, $CertOfTitle_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $CertOfTitle_fileName, $CertOfTitle_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$rptClearance = $_FILES['rptClearance'];
		if( !empty($rptClearance) ) {
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
			$img_desc = reArrayFiles3($rptClearance);	
		    foreach($img_desc as $val) {
		        $rptClearance_name = $val['name'];
				$rptClearance_type = $val['type'];
				$rptClearance_size = $val['size'];
				$rptClearance_temp = $val['tmp_name'];
				$rptClearance_exte = pathinfo($rptClearance_name, PATHINFO_EXTENSION);

				$rptClearance_fileName = "RPT_CLEARANCE-". mt_rand();
				$rptClearance_new_name = "RPT_CLEARANCE-". mt_rand() .".". $rptClearance_exte;
				$rptClearance_destination = $dirname . "{$rptClearance_new_name}";
				move_uploaded_file( $rptClearance_temp, $rptClearance_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $rptClearance_fileName, $rptClearance_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$projectCost = $_FILES['projectCost'];
		if( !empty($projectCost) ) {
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
			$img_desc = reArrayFiles4($projectCost);	
		    foreach($img_desc as $val) {
		        $projectCost_name = $val['name'];
				$projectCost_type = $val['type'];
				$projectCost_size = $val['size'];
				$projectCost_temp = $val['tmp_name'];
				$projectCost_exte = pathinfo($projectCost_name, PATHINFO_EXTENSION);

				$projectCost_fileName = "PROJECT_COST-". mt_rand();
				$projectCost_new_name = "PROJECT_COST-". mt_rand() .".". $projectCost_exte;
				$projectCost_destination = $dirname . "{$projectCost_new_name}";
				move_uploaded_file( $projectCost_temp, $projectCost_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $projectCost_fileName, $projectCost_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$sketchSubdivisionPlan = $_FILES['sketchSubdivisionPlan'];
		if( !empty($sketchSubdivisionPlan) ) {
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
			$img_desc = reArrayFiles5($sketchSubdivisionPlan);	
		    foreach($img_desc as $val) {
		        $sketchSubdivisionPlan_name = $val['name'];
				$sketchSubdivisionPlan_type = $val['type'];
				$sketchSubdivisionPlan_size = $val['size'];
				$sketchSubdivisionPlan_temp = $val['tmp_name'];
				$sketchSubdivisionPlan_exte = pathinfo($sketchSubdivisionPlan_name, PATHINFO_EXTENSION);

				$sketchSubdivisionPlan_fileName = "SKETCH_SUBDIVISION_PLAN-". mt_rand();
				$sketchSubdivisionPlan_new_name = "SKETCH_SUBDIVISION_PLAN-". mt_rand() .".". $sketchSubdivisionPlan_exte;
				$sketchSubdivisionPlan_destination = $dirname . "{$sketchSubdivisionPlan_new_name}";
				move_uploaded_file( $sketchSubdivisionPlan_temp, $sketchSubdivisionPlan_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $sketchSubdivisionPlan_fileName, $sketchSubdivisionPlan_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$floorPlan = $_FILES['floorPlan'];
		if( !empty($floorPlan) ) {
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
			$img_desc = reArrayFiles6($floorPlan);	
		    foreach($img_desc as $val) {
		        $floorPlan_name = $val['name'];
				$floorPlan_type = $val['type'];
				$floorPlan_size = $val['size'];
				$floorPlan_temp = $val['tmp_name'];
				$floorPlan_exte = pathinfo($floorPlan_name, PATHINFO_EXTENSION);

				$floorPlan_fileName = "FLOOR_PLAN-". mt_rand();
				$floorPlan_new_name = "FLOOR_PLAN-". mt_rand() .".". $floorPlan_exte;
				$floorPlan_destination = $dirname . "{$floorPlan_new_name}";
				move_uploaded_file( $floorPlan_temp, $floorPlan_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $floorPlan_fileName, $floorPlan_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$propertyAuth = $_FILES['propertyAuth'];
		if( !empty($propertyAuth) ) {
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
			$img_desc = reArrayFiles7($propertyAuth);	
		    foreach($img_desc as $val) {
		        $propertyAuth_name = $val['name'];
				$propertyAuth_type = $val['type'];
				$propertyAuth_size = $val['size'];
				$propertyAuth_temp = $val['tmp_name'];
				$propertyAuth_exte = pathinfo($propertyAuth_name, PATHINFO_EXTENSION);

				$propertyAuth_fileName = "PROPERTY_AUTHORIZATION-". mt_rand();
				$propertyAuth_new_name = "PROPERTY_AUTHORIZATION-". mt_rand() .".". $propertyAuth_exte;
				$propertyAuth_destination = $dirname . "{$propertyAuth_new_name}";
				move_uploaded_file( $propertyAuth_temp, $propertyAuth_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $propertyAuth_fileName, $propertyAuth_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$spAttorney = $_FILES['spAttorney'];
		if( !empty($spAttorney) ) {
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
			$img_desc = reArrayFiles8($spAttorney);	
		    foreach($img_desc as $val) {
		        $spAttorney_name = $val['name'];
				$spAttorney_type = $val['type'];
				$spAttorney_size = $val['size'];
				$spAttorney_temp = $val['tmp_name'];
				$spAttorney_exte = pathinfo($spAttorney_name, PATHINFO_EXTENSION);

				$spAttorney_fileName = "SPECIAL_POWER_OF_ATTY-". mt_rand();
				$spAttorney_new_name = "SPECIAL_POWER_OF_ATTY-". mt_rand() .".". $spAttorney_exte;
				$spAttorney_destination = $dirname . "{$spAttorney_new_name}";
				move_uploaded_file( $spAttorney_temp, $spAttorney_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $spAttorney_fileName, $spAttorney_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$cncStoreyName = $_FILES['cncStorey']['name'];
		if($cncStoreyName != '') {
			$cncStorey = $_FILES['cncStorey'];
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
			$img_desc = reArrayFiles9($cncStorey);	
		    foreach($img_desc as $val) {
		        $cncStorey_name = $val['name'];
				$cncStorey_type = $val['type'];
				$cncStorey_size = $val['size'];
				$cncStorey_temp = $val['tmp_name'];
				$cncStorey_exte = pathinfo($cncStorey_name, PATHINFO_EXTENSION);

				$cncStorey_fileName = "CNC_2_STOREY-". mt_rand();
				$cncStorey_new_name = "CNC_2_STOREY-". mt_rand() .".". $cncStorey_exte;
				$cncStorey_destination = $dirname . "{$cncStorey_new_name}";
				move_uploaded_file( $cncStorey_temp, $cncStorey_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $cncStorey_fileName, $cncStorey_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$cncCommercialName = $_FILES['cncCommercial']['name'];
		if($cncCommercialName != '') {
			$cncCommercial = $_FILES['cncCommercial'];
			function reArrayFiles10($file) {
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
			$img_desc = reArrayFiles10($cncCommercial);	
		    foreach($img_desc as $val) {
		        $cncCommercial_name = $val['name'];
				$cncCommercial_type = $val['type'];
				$cncCommercial_size = $val['size'];
				$cncCommercial_temp = $val['tmp_name'];
				$cncCommercial_exte = pathinfo($cncCommercial_name, PATHINFO_EXTENSION);

				$cncCommercial_fileName = "CNC_COMMERCIAL-". mt_rand();
				$cncCommercial_new_name = "CNC_COMMERCIAL-". mt_rand() .".". $cncCommercial_exte;
				$cncCommercial_destination = $dirname . "{$cncCommercial_new_name}";
				move_uploaded_file( $cncCommercial_temp, $cncCommercial_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $cncCommercial_fileName, $cncCommercial_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}

		$environmentComplianceName = $_FILES['environmentCompliance']['name'];
		if($environmentComplianceName != '') {
			$environmentCompliance = $_FILES['environmentCompliance'];
			function reArrayFiles11($file) {
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
			$img_desc = reArrayFiles11($environmentCompliance);	
		    foreach($img_desc as $val) {
		        $environmentCompliance_name = $val['name'];
				$environmentCompliance_type = $val['type'];
				$environmentCompliance_size = $val['size'];
				$environmentCompliance_temp = $val['tmp_name'];
				$environmentCompliance_exte = pathinfo($environmentCompliance_name, PATHINFO_EXTENSION);

				$environmentCompliance_fileName = "ENVIRONMENTAL_COMPLIANCE-". mt_rand();
				$environmentCompliance_new_name = "ENVIRONMENTAL_COMPLIANCE-". mt_rand() .".". $environmentCompliance_exte;
				$environmentCompliance_destination = $dirname . "{$environmentCompliance_new_name}";
				move_uploaded_file( $environmentCompliance_temp, $environmentCompliance_destination );

				$sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
				$sql->bind_param("sssssss", $userID, $lastID, $environmentCompliance_fileName, $environmentCompliance_new_name, $status, $remarks, $fdir);
				$sql->execute();
		    }
		}
		//attachement-------------------------------------------------------------------------------------------------------

		$sql_track = "INSERT INTO lc_tracking(onlineappID,area,dateIn,isCurrentArea,isFinished)VALUES('$lastID','Document Verification','$dateIn','Y','N');";
		$sql_track .= "INSERT INTO lc_tracking(onlineappID, area) VALUES('$lastID','Processing Fee');";
		$sql_track .= "INSERT INTO lc_tracking(onlineappID, area) VALUES('$lastID','Receiving');";
		$sql_track .= "INSERT INTO lc_tracking(onlineappID, area) VALUES('$lastID','Evaluation');";
		$sql_track .= "INSERT INTO lc_tracking(onlineappID, area) VALUES('$lastID','Site Inspection');";
		$sql_track .= "INSERT INTO lc_tracking(onlineappID, area) VALUES('$lastID','Administrative Fine');";
		$sql_track .= "INSERT INTO lc_tracking(onlineappID, area) VALUES('$lastID','Approval');";
		$sql_track .= "INSERT INTO lc_tracking(onlineappID, area) VALUES('$lastID','Releasing')";

		if(mysqli_multi_query($conn, $sql_track)) {
			while(mysqli_next_result($conn)){;}

			$sql_trackassess = "INSERT INTO lc_assessment(onlineappID, assessedFees) VALUES('$lastID','Single Residential Structure');";
			$sql_trackassess .= "INSERT INTO lc_assessment(onlineappID, assessedFees) VALUES('$lastID','Apartment/Townhouse');";
			$sql_trackassess .= "INSERT INTO lc_assessment(onlineappID, assessedFees) VALUES('$lastID','Dormitory');";
			$sql_trackassess .= "INSERT INTO lc_assessment(onlineappID, assessedFees) VALUES('$lastID','Institutional');";
			$sql_trackassess .= "INSERT INTO lc_assessment(onlineappID, assessedFees) VALUES('$lastID','Commercial, Industrial & Agro-Industrial');";
			$sql_trackassess .= "INSERT INTO lc_assessment(onlineappID, assessedFees) VALUES('$lastID','Special Uses/Special Project')";

			if(mysqli_multi_query($conn, $sql_trackassess)) {
				while(mysqli_next_result($conn)){;}

				$sql_evaluation = "INSERT INTO lc_evaluation(onlineappID, area, incharge) VALUES('$lastID','Land Use','');";
				$sql_evaluation .= "INSERT INTO lc_evaluation(onlineappID, area, incharge) VALUES('$lastID','Setback','');";
				$sql_evaluation .= "INSERT INTO lc_evaluation(onlineappID, area, incharge) VALUES('$lastID', 'Revision Plan & Site Development','')";

				if(mysqli_multi_query($conn, $sql_evaluation)) {
					echo "
						<script>
							alert('New Application has been saved!');
							window.location.href='../applications.php?application=$appID&user=$userID'
						</script>
					";
				} else {
					$error = "Error (LC: Evaluation): ". mysqli_error($conn);
					$error_explode = explode("'", $error);
					$error_implode = implode("", $error_explode);
					echo "<script>alert('$error_implode');window.location.href='applications.php?application=$appID&user=$userID'</script>";
				}
	
			} else {
				$error = "Error (LC: Assessment): ". mysqli_error($conn);
				$error_explode = explode("'", $error);
				$error_implode = implode("", $error_explode);
				echo "<script>alert('$error_implode');window.location.href='../applications.php?application=$appID&user=$userID'</script>";
			}

		} else {
			$error = "Error (LC: Tracking): ". mysqli_error($conn);
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='../applications.php?application=$appID&user=$userID'</script>";
		}

	} else {
		$error = "Error (LC: Online Application): ". mysqli_error($conn);
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../applications.php?application=$appID&user=$userID'</script>";
	}

	$conn->close();
}

?>
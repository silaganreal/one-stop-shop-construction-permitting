<?php

function addNewApplication($userID, $ownerApplicant, $projectTitle, $contactNo, $emailAdd, $appDate, $appTime, $applicationStatus, $applicationType) {
			
			include '../includes/connect.php';

			$sql2 = $conn->prepare("INSERT INTO onlineapplications(userID, applicationType, ownerApplicant, projectTitle, contactNo, emailAdd, applicationDate, applicationTime, applicationStatus) VALUES(?,?,?,?,?,?,?,?,?)");
			$sql2->bind_param("sssssssss", $userID, $applicationType, $ownerApplicant, $projectTitle, $contactNo, $emailAdd, $appDate, $appTime, $applicationStatus);

			if($sql2->execute()) {

				$lastID = $conn->insert_id;
				$randomChar = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,3);

				//directory---------------------------------------------------------------------------------------------------------
				// $newOwnerApplicant = str_replace('Ñ','N', $ownerApplicant);
				$prefixLink = '../../uploads/BUILDING_PERMIT/';
				$directory = $lastID . "_" . $randomChar;
				$dirname = $prefixLink . $directory . "/";
				$status = 'For Verification';
				$remarks = '';

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
						$sql->bind_param("sssssss", $userID, $lastID, $brgyClearance_fileName, $brgyClearance_new_name, $status, $remarks, $directory);
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
						$sql->bind_param("sssssss", $userID, $lastID, $drainageCert_fileName, $drainageCert_new_name, $status, $remarks, $directory);
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
						$sql->bind_param("sssssss", $userID, $lastID, $locationalClearance_fileName, $locationalClearance_new_name, $status, $remarks, $directory);
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
						$sql->bind_param("sssssss", $userID, $lastID, $taxDeclaration_fileName, $taxDeclaration_new_name, $status, $remarks, $directory);
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
						$sql->bind_param("sssssss", $userID, $lastID, $taxClearance_fileName, $taxClearance_new_name, $status, $remarks, $directory);
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
						$sql->bind_param("sssssss", $userID, $lastID, $titleOfProperty_fileName, $titleOfProperty_new_name, $status, $remarks, $directory);
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
						$sql->bind_param("sssssss", $userID, $lastID, $sketchPlan_fileName, $sketchPlan_new_name, $status, $remarks, $directory);
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
						$sql->bind_param("sssssss", $userID, $lastID, $subdivisionPlan_fileName, $subdivisionPlan_new_name, $status, $remarks, $directory);
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
						$sql->bind_param("sssssss", $userID, $lastID, $prcLicense_fileName, $prcLicense_new_name, $status, $remarks, $directory);
						$sql->execute();
					}
				}
				//attachement-------------------------------------------------------------------------------------------------------

				echo "<script>alert('New Record has been added!');window.location.href='../dashboard'</script>";

				// $sql->close();
				$conn->close();
				
			}

		}

?>
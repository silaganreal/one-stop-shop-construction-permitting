<?php

function addNewApplication($userID, $ownerApplicant, $projectTitle, $contactNo, $emailAdd, $appDate, $appTime, $applicationStatus, $applicationType) {

                        include '../includes/connect.php';

                        $sql2 = $conn->prepare("INSERT INTO onlineapplications(userID, ownerApplicant, projectTitle, contactNo, emailAdd, applicationDate, applicationTime, applicationStatus, applicationType) VALUES(?,?,?,?,?,?,?,?,?)");
                        $sql2->bind_param("sssssssss", $userID, $ownerApplicant, $projectTitle, $contactNo, $emailAdd, $appDate, $appTime, $applicationStatus, $applicationType);

                        if($sql2->execute()) {

                                $lastID = $conn->insert_id;
                                $randomChar = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,3);

                                //directory---------------------------------------------------------------------------------------------------------
                                // $newOwnerApplicant = str_replace('Ñ','N', $ownerApplicant);
                                $prefixLink = '../../uploads/OCCUPANCY_PERMIT/';
                                $directory = $lastID . "_" . $randomChar;
                                $dirname = $prefixLink . $directory . "/";
                                $status = 'For Verification';
                                $remarks = '';

                                if(!is_dir($dirname)) {
                                        mkdir($dirname, 0777);
                                }
                                //directory---------------------------------------------------------------------------------------------------------

                                //attachement-------------------------------------------------------------------------------------------------------
                                $OCC1 = $_FILES['OCC1']; //-----------------------
                                if( !empty($OCC1) ) {

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

                                        $img_desc = reArrayFiles($OCC1);

                                    foreach($img_desc as $val)
                                    {
                                                $OCC1_name = $val['name'];
                                                $OCC1_type = $val['type'];
                                                $OCC1_size = $val['size'];
                                                $OCC1_temp = $val['tmp_name'];
                                                $OCC1_exte = pathinfo($OCC1_name, PATHINFO_EXTENSION);

                                                $OCC1_fileName = "OCC1-". mt_rand();
                                                $OCC1_new_name = "OCC1-". mt_rand() .".". $OCC1_exte;
                                                $OCC1_destination = $dirname . "{$OCC1_new_name}";
                                                move_uploaded_file( $OCC1_temp, $OCC1_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC1_fileName, $OCC1_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                    }
                                }
                                //-------------------------------
                                //$OccCertEngr = $_FILES['OccCertEngr']; //-----------------------
                                $OCC2 = $_FILES['OCC2'];
                                if( !empty($OCC2) ) {
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
                                        $img_desc = reArrayFiles2($OCC2);
                                        foreach($img_desc as $val) {
                                                $OCC2_name = $val['name'];
                                                $OCC2_type = $val['type'];
                                                $OCC2_size = $val['size'];
                                                $OCC2_temp = $val['tmp_name'];
                                                $OCC2_exte = pathinfo($OCC2_name, PATHINFO_EXTENSION);

                                                $OCC2_fileName = "OCC2-". mt_rand();
                                                $OCC2_new_name = "OCC2-". mt_rand() .".". $OCC2_exte;
                                                $OCC2_destination = $dirname . "{$OCC2_new_name}";
                                                move_uploaded_file( $OCC2_temp, $OCC2_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC2_fileName, $OCC2_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                 //-------------------------------
                                $OCC3 = $_FILES['OCC3'];
                                if( !empty($OCC3) ) {
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
                                        $img_desc = reArrayFiles3($OCC3);
                                        foreach($img_desc as $val) {
                                                $OCC3_name = $val['name'];
                                                $OCC3_type = $val['type'];
                                                $OCC3_size = $val['size'];
                                                $OCC3_temp = $val['tmp_name'];
                                                $OCC3_exte = pathinfo($OCC3_name, PATHINFO_EXTENSION);

                                                $OCC3_fileName = "OCC3-". mt_rand();
                                                $OCC3_new_name = "OCC3-". mt_rand() .".". $OCC3_exte;
                                                $OCC3_destination = $dirname . "{$OCC3_new_name}";
                                                move_uploaded_file( $OCC3_temp, $OCC3_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC3_fileName, $OCC3_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                  //-------------------------------
                                $OCC4 = $_FILES['OCC4'];
                                if( !empty($OCC4) ) {
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
                                        $img_desc = reArrayFiles4($OCC4);
                                        foreach($img_desc as $val) {
                                                $OCC4_name = $val['name'];
                                                $OCC4_type = $val['type'];
                                                $OCC4_size = $val['size'];
                                                $OCC4_temp = $val['tmp_name'];
                                                $OCC4_exte = pathinfo($OCC4_name, PATHINFO_EXTENSION);

                                                $OCC4_fileName = "OCC4-". mt_rand();
                                                $OCC4_new_name = "OCC4-". mt_rand() .".". $OCC4_exte;
                                                $OCC4_destination = $dirname . "{$OCC4_new_name}";
                                                move_uploaded_file( $OCC4_temp, $OCC4_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC4_fileName, $OCC4_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                               //-------------------------------
                                $OCC5 = $_FILES['OCC5'];
                                if( !empty($OCC5) ) {
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
                                        $img_desc = reArrayFiles5($OCC5);
                                        foreach($img_desc as $val) {
                                                $OCC5_name = $val['name'];
                                                $OCC5_type = $val['type'];
                                                $OCC5_size = $val['size'];
                                                $OCC5_temp = $val['tmp_name'];
                                                $OCC5_exte = pathinfo($OCC5_name, PATHINFO_EXTENSION);

                                                $OCC5_fileName = "OCC5-". mt_rand();
                                                $OCC5_new_name = "OCC5-". mt_rand() .".". $OCC5_exte;
                                                $OCC5_destination = $dirname . "{$OCC5_new_name}";
                                                move_uploaded_file( $OCC5_temp, $OCC5_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC5_fileName, $OCC5_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                //-------------------------------
                                $OCC6 = $_FILES['OCC6'];
                                if( !empty($OCC6) ) {
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
                                        $img_desc = reArrayFiles6($OCC6);
                                        foreach($img_desc as $val) {
                                                $OCC6_name = $val['name'];
                                                $OCC6_type = $val['type'];
                                                $OCC6_size = $val['size'];
                                                $OCC6_temp = $val['tmp_name'];
                                                $OCC6_exte = pathinfo($OCC6_name, PATHINFO_EXTENSION);

                                                $OCC6_fileName = "OCC6-". mt_rand();
                                                $OCC6_new_name = "OCC6-". mt_rand() .".". $OCC6_exte;
                                                $OCC6_destination = $dirname . "{$OCC6_new_name}";
                                                move_uploaded_file( $OCC6_temp, $OCC6_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC6_fileName, $OCC6_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                //-------------------------------
                                $OCC7 = $_FILES['OCC7'];
                                if( !empty($OCC7) ) {
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
                                        $img_desc = reArrayFiles7($OCC7);
                                        foreach($img_desc as $val) {
                                                $OCC7_name = $val['name'];
                                                $OCC7_type = $val['type'];
                                                $OCC7_size = $val['size'];
                                                $OCC7_temp = $val['tmp_name'];
                                                $OCC7_exte = pathinfo($OCC7_name, PATHINFO_EXTENSION);

                                                $OCC7_fileName = "OCC7-". mt_rand();
                                                $OCC7_new_name = "OCC7-". mt_rand() .".". $OCC7_exte;
                                                $OCC7_destination = $dirname . "{$OCC7_new_name}";
                                                move_uploaded_file( $OCC7_temp, $OCC7_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC7_fileName, $OCC7_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                //-------------------------------
                                $OCC8 = $_FILES['OCC8'];
                                if( !empty($OCC8) ) {
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
                                        $img_desc = reArrayFiles8($OCC8);
                                        foreach($img_desc as $val) {
                                                $OCC8_name = $val['name'];
                                                $OCC8_type = $val['type'];
                                                $OCC8_size = $val['size'];
                                                $OCC8_temp = $val['tmp_name'];
                                                $OCC8_exte = pathinfo($OCC8_name, PATHINFO_EXTENSION);

                                                $OCC8_fileName = "OCC8-". mt_rand();
                                                $OCC8_new_name = "OCC8-". mt_rand() .".". $OCC8_exte;
                                                $OCC8_destination = $dirname . "{$OCC8_new_name}";
                                                move_uploaded_file( $OCC8_temp, $OCC8_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC8_fileName, $OCC8_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                 //-------------------------------
                                $OCC9 = $_FILES['OCC9'];
                                if( !empty($OCC9) ) {
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
                                        $img_desc = reArrayFiles9($OCC9);
                                        foreach($img_desc as $val) {
                                                $OCC9_name = $val['name'];
                                                $OCC9_type = $val['type'];
                                                $OCC9_size = $val['size'];
                                                $OCC9_temp = $val['tmp_name'];
                                                $OCC9_exte = pathinfo($OCC9_name, PATHINFO_EXTENSION);

                                                $OCC9_fileName = "OCC9-". mt_rand();
                                                $OCC9_new_name = "OCC9-". mt_rand() .".". $OCC9_exte;
                                                $OCC9_destination = $dirname . "{$OCC9_new_name}";
                                                move_uploaded_file( $OCC9_temp, $OCC9_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC9_fileName, $OCC9_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                 //-------------------------------
                                $OCC10 = $_FILES['OCC10'];
                                if( !empty($OCC10) ) {
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
                                        $img_desc = reArrayFiles10($OCC10);
                                        foreach($img_desc as $val) {
                                                $OCC10_name = $val['name'];
                                                $OCC10_type = $val['type'];
                                                $OCC10_size = $val['size'];
                                                $OCC10_temp = $val['tmp_name'];
                                                $OCC10_exte = pathinfo($OCC10_name, PATHINFO_EXTENSION);

                                                $OCC10_fileName = "OCC10-". mt_rand();
                                                $OCC10_new_name = "OCC10-". mt_rand() .".". $OCC10_exte;
                                                $OCC10_destination = $dirname . "{$OCC10_new_name}";
                                                move_uploaded_file( $OCC10_temp, $OCC10_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC10_fileName, $OCC10_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                //-------------------------------
                                $OCC11 = $_FILES['OCC11'];
                                if( !empty($OCC11) ) {
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
                                        $img_desc = reArrayFiles11($OCC11);
                                        foreach($img_desc as $val) {
                                                $OCC11_name = $val['name'];
                                                $OCC11_type = $val['type'];
                                                $OCC11_size = $val['size'];
                                                $OCC11_temp = $val['tmp_name'];
                                                $OCC11_exte = pathinfo($OCC11_name, PATHINFO_EXTENSION);

                                                $OCC11_fileName = "OCC11-". mt_rand();
                                                $OCC11_new_name = "OCC11-". mt_rand() .".". $OCC11_exte;
                                                $OCC11_destination = $dirname . "{$OCC11_new_name}";
                                                move_uploaded_file( $OCC11_temp, $OCC11_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC11_fileName, $OCC11_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                //-------------------------------
                                $OCC12 = $_FILES['OCC12'];
                                if( !empty($OCC12) ) {
                                        function reArrayFiles12($file) {
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
                                        $img_desc = reArrayFiles12($OCC12);
                                        foreach($img_desc as $val) {
                                                $OCC12_name = $val['name'];
                                                $OCC12_type = $val['type'];
                                                $OCC12_size = $val['size'];
                                                $OCC12_temp = $val['tmp_name'];
                                                $OCC12_exte = pathinfo($OCC12_name, PATHINFO_EXTENSION);

                                                $OCC12_fileName = "OCC12-". mt_rand();
                                                $OCC12_new_name = "OCC12-". mt_rand() .".". $OCC12_exte;
                                                $OCC12_destination = $dirname . "{$OCC12_new_name}";
                                                move_uploaded_file( $OCC12_temp, $OCC12_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC12_fileName, $OCC12_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                 //-------------------------------
                                $OCC13 = $_FILES['OCC13'];
                                if( !empty($OCC13) ) {
                                        function reArrayFiles13($file) {
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
                                        $img_desc = reArrayFiles13($OCC13);
                                        foreach($img_desc as $val) {
                                                $OCC13_name = $val['name'];
                                                $OCC13_type = $val['type'];
                                                $OCC13_size = $val['size'];
                                                $OCC13_temp = $val['tmp_name'];
                                                $OCC13_exte = pathinfo($OCC13_name, PATHINFO_EXTENSION);

                                                $OCC13_fileName = "OCC13-". mt_rand();
                                                $OCC13_new_name = "OCC13-". mt_rand() .".". $OCC13_exte;
                                                $OCC13_destination = $dirname . "{$OCC13_new_name}";
                                                move_uploaded_file( $OCC13_temp, $OCC13_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC13_fileName, $OCC13_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------
                                //-------------------------------
                                $OCC14 = $_FILES['OCC14'];
                                if( !empty($OCC14) ) {
                                        function reArrayFiles14($file) {
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
                                        $img_desc = reArrayFiles14($OCC14);
                                        foreach($img_desc as $val) {
                                                $OCC14_name = $val['name'];
                                                $OCC14_type = $val['type'];
                                                $OCC14_size = $val['size'];
                                                $OCC14_temp = $val['tmp_name'];
                                                $OCC14_exte = pathinfo($OCC14_name, PATHINFO_EXTENSION);

                                                $OCC14_fileName = "OCC14-". mt_rand();
                                                $OCC14_new_name = "OCC14-". mt_rand() .".". $OCC14_exte;
                                                $OCC14_destination = $dirname . "{$OCC14_new_name}";
                                                move_uploaded_file( $OCC14_temp, $OCC14_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OCC14_fileName, $OCC14_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                        }
                                }
                                //attachement-------------------------------------------------------------------------------------------------------

                                echo "<script>alert('New Record has been added!');window.location.href='../dashboard'</script>";
                                // echo "<script>alert('New Record has been added!');</script>";

                                // $sql->close();
                                $conn->close();

                        }

                }

?>
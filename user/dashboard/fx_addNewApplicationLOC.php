<?php

function addNewApplication($userID, $ownerApplicant, $projectTitle, $contactNo, $emailAdd, $dateTime, $applicationStatus) {

                        // include 'includes/connection.php';

                        // $servername = "10.0.14.117";
                        // $username = "usera2";
                        // $password = "passa2";
                        // $dbname = "arta_app_db";


                        $host = "localhost";
                        $user = "root";
                        $pass = "";
                        $data = "arta_app_db";


                        // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        // Check connection
                        if (!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }

                        $sql2 = $conn->prepare("INSERT INTO onlineapplications(userID, ownerApplicant, projectTitle, contactNo, emailAdd, applicationDate, applicationStatus) VALUES(?,?,?,?,?,?,?)");
                        $sql2->bind_param("sssssss", $userID, $ownerApplicant, $projectTitle, $contactNo, $emailAdd, $dateTime, $applicationStatus);

                        if($sql2->execute()) {

                                $lastID = $conn->insert_id;
                                $randomChar = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,3);

                                //directory---------------------------------------------------------------------------------------------------------
                                // $newOwnerApplicant = str_replace('Ñ','N', $ownerApplicant);
                                $prefixLink = '../../uploads/OCCPERMIT/';
                                $directory = $lastID . "_" . $randomChar;
                                $dirname = $prefixLink . $directory . "/";
                                $status = 'For Verification';
                                $remarks = '';

                                if(!is_dir($dirname)) {
                                        mkdir($dirname, 0777);
                                }
                                //directory---------------------------------------------------------------------------------------------------------

                                //attachement-------------------------------------------------------------------------------------------------------
                                $OccCert = $_FILES['OccCert'];
                                if( !empty($OccCert) ) {

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

                                        $img_desc = reArrayFiles($OccCert);

                                    foreach($img_desc as $val)
                                    {
                                        $OccCert_name = $val['name'];
                                                $OccCert_type = $val['type'];
                                                $OccCert_size = $val['size'];
                                                $OccCert_temp = $val['tmp_name'];
                                                $OccCert_exte = pathinfo($OccCert_name, PATHINFO_EXTENSION);

                                                $OccCert_fileName = "OccCert-". mt_rand();
                                                $OccCert_new_name = "OccCert-". mt_rand() .".". $brgyClearance_exte;
                                                $OccCert_destination = $dirname . "{$OccCert_new_name}";
                                                move_uploaded_file( $OccCert_temp, $OccCert_destination );

                                                $sql = $conn->prepare("INSERT INTO attachments(userID, applicationID, name, file, status, remarks, folderDirectory) VALUES(?,?,?,?,?,?,?)");
                                                $sql->bind_param("sssssss", $userID, $lastID, $OccCert_fileName, $OccCert_new_name, $status, $remarks, $directory);
                                                $sql->execute();
                                    }
                                }
                                //-------------------------------

                                //attachement-------------------------------------------------------------------------------------------------------

                                echo "<script>alert('New Record has been added!');window.location.href='../home'</script>";
                                // echo "<script>alert('New Record has been added!');</script>";

                                // $sql->close();
                                $conn->close();

                        }

                }

?>
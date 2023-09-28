<?php

include "../includes/auth.php";

if(isset($_POST['submitApplication'])) {

        //connection
        // include '../includes/connect.php';

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $dateTime = date('Y-m-d h:i:s');

        $ownerApplicant = $_POST['ownerApplicant'];
        $projectTitle = $_POST['projectTitle'];
        $contactNo = $_POST['contactNo'];
        $emailAdd = $_POST['emailAdd'];
        $userID = $_POST['userID'];

        $sql = "SELECT * FROM onlineapplications WHERE ownerApplicant LIKE '%$ownerApplicant%' AND projectTitle LIKE '%$projectTitle%' AND contactNo LIKE '%$contactNo%' AND emailAdd LIKE '%$emailAdd%'";
        $res = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($res);

        if($num == 0) {

                $applicationStatus = 'For Verification';
                include "fx_addNewApplicationOCC.php";
                addNewApplication($userID, $ownerApplicant, $projectTitle, $contactNo, $emailAdd, $dateTime, $applicationStatus);

        } else {
                $row = mysqli_fetch_assoc($res);
                if($row['applicationStatus'] != 'For Verification') {

                        $applicationStatus = 'For Verification';
                        include "fx_addNewApplicationOCC.php";
                        addNewApplication($userID, $ownerApplicant, $projectTitle, $contactNo, $emailAdd, $dateTime, $applicationStatus);

                } else {
                        echo "<script>alert('You still have an application that is still For Verification. Please wait patiently.');window.location.href='../home'</script>";
                }

        }

}

?>
<?php

include "../includes/auth.php";

if(isset($_POST['submitApplication'])) {

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $appDate = date('Y-m-d');
        $appTime = date('h:i:s');

        $ownerApplicant = $_POST['ownerApplicant2'];
        $projectTitle = $_POST['projectTitle2'];
        $contactNo = $_POST['contactNo2'];
        $emailAdd = $_POST['emailAdd2'];
        $userID = $_POST['userID2'];
        $applicationType = $_POST['applicationType2'];

        $sql = "SELECT * FROM onlineapplications WHERE ownerApplicant LIKE '%$ownerApplicant%' AND projectTitle LIKE '%$projectTitle%' AND contactNo LIKE '%$contactNo%' AND emailAdd LIKE '%$emailAdd%'";
        $res = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($res);

        if($num == 0) {
                $applicationStatus = 'For Verification';
                include "fx_addNewApplicationOCC.php";
                addNewApplication($userID, $ownerApplicant, $projectTitle, $contactNo, $emailAdd, $appDate, $appTime, $applicationStatus, $applicationType);
        } else {
                $row = mysqli_fetch_assoc($res);
                if($row['applicationStatus'] != 'For Verification') {

                        $applicationStatus = 'For Verification';
                        include "fx_addNewApplicationOCC.php";
                        addNewApplication($userID, $ownerApplicant, $projectTitle, $contactNo, $emailAdd, $appDate, $appTime, $applicationStatus, $applicationType);

                } else {
                        echo "<script>alert('You still have an application that is still For Verification. Please wait patiently.');window.location.href='../home'</script>";
                }

        }

}

?>
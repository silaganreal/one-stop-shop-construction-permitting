<?php

$sql2 = "SELECT * FROM lc_tracking WHERE onlineappID = '$onlineappID'";
  $res2 = mysqli_query($conn, $sql2);

  while($row2 = mysqli_fetch_assoc($res2)) {
    $rowArea = array($row2['area']);
    foreach($rowArea as $area) {
      switch($area) {

        case 'Document Verification':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'Y' && $ifn == 'N') {
            $icon_docVerification = 'east';
          } elseif($ica == 'Y' && $ifn == 'Y') {
            $icon_docVerification = 'done_outline';
          }
        break;
        case 'Processing Fee':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_assessment = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_assessment = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_assessment = 'done_outline';
          }
        break;
        case 'Receiving':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_receiving = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_receiving = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_receiving = 'done_outline';
          }
        break;
        case 'Evaluation':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_evaluation = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_evaluation = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_evaluation = 'done_outline';
          }
        break;
        case 'Site Inspection':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_site_inspec = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_site_inspec = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_site_inspec = 'done_outline';
          }
        break;
        case 'Administrative Fine':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_clearance_prep = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_clearance_prep = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_clearance_prep = 'done_outline';
          }
        break;
        case 'Approval':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_approval = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_approval = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_approval = 'done_outline';
          }
        break;
        case 'Releasing':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_releasing = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_releasing = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_releasing = 'done_outline';
          }
        break;

      }
    }
  }

?>
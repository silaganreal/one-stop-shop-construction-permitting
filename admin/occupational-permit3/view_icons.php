<?php
$modal_docVerification = '';

$sql2 = "SELECT * FROM tracking WHERE onlineappID = '$applicationID'";
  $res2 = mysqli_query($conn, $sql2);

  while($row2 = mysqli_fetch_assoc($res2)) {
    $rowArea = array($row2['area']);
    foreach($rowArea as $area) {
      switch($area) {

        case 'Receiving':
        $ica = $row2['isCurrentArea'];
        $ifn = $row2['isFinished'];
        if($ica == 'Y' && $ifn == 'N') {
          $icon_receiving = 'east';
        } elseif($ica == 'Y' && $ifn == 'Y') {
          $icon_receiving = 'done_outline';
        } else {
          $icon_receiving = 'do_not_disturb_on';
        }
        break;
        case 'Document Verification':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_docVerification = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_docVerification = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_docVerification = 'done_outline';
          }
        break;
        case 'Plan Evaluation':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_planEvaluation = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_planEvaluation = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_planEvaluation = 'done_outline';
          }
        break;
        case 'Assessment':
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
        case 'Assessment Releasing':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_assessmentReleasing = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_assessmentReleasing = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_assessmentReleasing = 'done_outline';
          }
        break;
        case 'Payment':
          $ica = $row2['isCurrentArea'];
          $ifn = $row2['isFinished'];
          if($ica == 'N' && $ifn == 'N') {
            $icon_payment = 'do_not_disturb_on';
          }
          if($ica == 'Y' && $ifn == 'N') {
            $icon_payment = 'east';
          }
          if($ica == 'Y' && $ifn == 'Y') {
            $icon_payment = 'done_outline';
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
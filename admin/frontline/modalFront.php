<div class="modal fade" id="updateFront<?php echo $notifID; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Update Status</h5>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="updateFront.php" method="post">
                  <div class="row">
                     <div class="col-md-12">
                        <label class="form-label">Action Taken</label>
                        <div class="input-group input-group-outline">
                           <select name="frontForwarded" class="form-control" style="border-color:green;" required autofocus>
                              <option selected disabled value="">-- Forward To --</option>
                              <?php
                              if($cArea == 'Returned') {
                                 ?><option value="Receiving">Receiving</option><?php
                              }
                              // if($cArea != 'Document Verification' && $cArea != 'Plan Evaluation' && $cArea != 'Assessment' && $cArea != 'Releasing' && $cArea != 'Released') {
                                 ?>
                                 <!-- <option value="Document Verification">Document Verification</option> -->
                                 <?php
                              // }
                              if($cArea != 'Assessment' && $cArea != 'Releasing' && $cArea != 'Released') {
                                 ?>
                                 <option disabled value="" style="background:#c9c9c9;font-size:0.1px;"></option>
                                 <optgroup label="Plan Evaluation">
                                    <?php
                                    $sqlAreaPE = "SELECT * FROM tracking_plan_evaluation WHERE onlineappID = '$onlineappID' AND timeIn = '' AND dateIn = ''";
                                    $resAreaPE = mysqli_query($conn, $sqlAreaPE);
                                    while($rowAreaPE = mysqli_fetch_assoc($resAreaPE)) {
                                       ?>
                                       <option value="<?php echo $rowAreaPE['id']; ?>"><?php echo $rowAreaPE['area'] .' - '. $rowAreaPE['incharge']; ?></option>
                                       <?php
                                    }
                                    ?>
                                 </optgroup>
                                 <?php
                              }
                              if($cArea != 'Assessment' && $cArea != 'Releasing' && $cArea != 'Released') {
                                 ?>
                                 <option disabled value="" style="background:#c9c9c9;font-size:0.1px;"></option>
                                 <option value="Assessment">Assessment</option>
                                 <?php
                              }
                              if($cArea != 'Releasing' && $cArea != 'Released') {
                                 ?>
                                 <option disabled value="" style="background:#c9c9c9;font-size:0.1px;"></option>
                                 <option value="Releasing">Releasing</option>
                                 <?php
                              }
                              if($cArea == 'Released') {
                                 ?>
                                 <option disabled value="" style="background:#c9c9c9;font-size:0.1px;"></option>
                                 <option value="Released">Release to Client</option>
                                 <?php
                              }
                              ?>
                              <option disabled value="" style="background:#c9c9c9;font-size:0.1px;"></option>
                              <option value="Returned">Return to Client</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <label class="form-label">Current Area</label>
                        <div class="input-group input-group-outline pb-2">
                           <input type="text" class="form-control" value="<?php echo $row['currentArea']; ?>" style="border-color:red;" readonly>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <label class="form-label">Owner / Applicant</label>
                        <div class="input-group input-group-outline pb-2">
                           <input type="text" class="form-control" value="<?php echo $row['ownerApplicant']; ?>" style="border-color:orange;" readonly>
                        </div>
                     </div>
                  </div>
                  <div class="row mb-2">
                     <div class="col-md-12">
                        <label class="form-label">Project Title</label>
                        <div class="input-group input-group-outline pb-2">
                           <input type="text" class="form-control" value="<?php echo $row['projectTitle']; ?>" style="border-color:orange;" readonly>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" name="frontNotifID" value="<?php echo $notifID; ?>" required>
                  <input type="hidden" name="frontOnlineappID" value="<?php echo $onlineappID; ?>" required>
                  <input type="hidden" name="frontAppType" value="<?php echo $appType; ?>" required>
                  <input type="hidden" name="frontProjectTitle" value="<?php echo $projectTitle; ?>">
                  <div class="row">
                    <div class="col-md-6">
                       <button type="submit" name="updateFront" class="btn btn-sm btn-success">Forward</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
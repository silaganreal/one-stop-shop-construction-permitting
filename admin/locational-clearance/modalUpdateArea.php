    <div class="modal fade" id="updateStage<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Update Status</h5>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="../updateArea.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="input-group input-group-outline pb-2">
                           <select name="areaStatus" class="form-control" required>
                              <option selected value="">-- Select Action Taken --</option>
                              <?php
                              if($currentArea == 'Site Inspection') {
                                ?><option value="NO">Visit</option><?php
                              } else {
                                ?><option value="NO">Receive</option><?php
                              }
                              if($currentArea == 'Releasing') {
                                ?><option value="YES">Release</option><?php
                              } else {
                                ?><option value="YES">Proceed to next step</option><?php
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="input-group input-group-outline pb-2">
                           <textarea name="areaRemarks" class="form-control" rows="2" placeholder="Enter Remarks" required></textarea>
                        </div>
                     </div>
                  </div>
                  <br>
                  <input type="hidden" name="trackID" value="<?php echo $id; ?>" required>
                  <input type="hidden" name="onlineappID" value="<?php echo $onlineappID; ?>" required>
                  <input type="hidden" name="currentArea" value="<?php echo $currentArea; ?>" required>
                  <input type="hidden" name="userappID" value="<?php echo $userappID ?>" required>
                  <input type="hidden" name="userSlug" value="<?php echo $slug; ?>">
                  <div class="row">
                    <div class="col-md-6">
                       <button type="submit" name="updateArea" class="btn btn-sm btn-primary">Update</button>
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
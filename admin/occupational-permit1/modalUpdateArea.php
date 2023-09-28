<div class="modal fade" id="updateStage<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Update Status</h5>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="updateArea.php" method="post" enctype="multipart/form-data">
                   <div class="row">
                      <div class="col-md-12">
                         <div class="input-group input-group-outline pb-2">
                            <textarea name="areaRemarks" class="form-control" rows="2" placeholder="Enter Remarks" required></textarea>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-md-12">
                         <div class="input-group input-group-outline pb-2">
                            <select name="areaStatus" class="form-control" required>
                               <option selected value="">Proceed to Next Step?</option>
                               <option value="YES">YES</option>
                               <option value="NO">NO</option>
                            </select>
                         </div>
                      </div>
                   </div><br>
                  <input type="hidden" name="trackID" value="<?php echo $id; ?>" required>
                  <input type="hidden" name="onlineappID" value="<?php echo $applicationID; ?>" required>
                  <input type="hidden" name="currentArea" value="<?php echo $currentArea; ?>" required>
                  <input type="hidden" name="userappID" value="<?php echo $appID ?>" required>
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
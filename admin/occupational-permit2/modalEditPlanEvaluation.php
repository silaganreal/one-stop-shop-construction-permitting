<div class="modal fade" id="editPlan<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit - <?php echo $row['area']; ?></h5>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="updatePlanEvaluation.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-12">
                      <label class="form-label">Status</label>
                      <div class="input-group input-group-outline mb-3">
                        <select name="peStatus" class="form-control" required>
                          <option selected value="">-- Select Action Taken --</option>
                          <option value="Receive">Receive</option>
                          <option value="Release">Release</option>
                        </select>
                      </div>
                      <label class="form-label">Remarks</label>
                      <div class="input-group input-group-outline mb-4">
                        <textarea name="peRemarks" class="form-control" rows="2" placeholder="Enter Remarks" required></textarea>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="peID" value="<?php echo $id; ?>">
                  <input type="hidden" name="application" value="<?php echo $applicationID; ?>">
                  <input type="hidden" name="user" value="<?php echo $userID; ?>">
                  <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                  <input type="hidden" name="tpeArea" value="<?php echo $tpeArea; ?>">
                  <div class="row">
                    <div class="col-md-6">
                       <button type="submit" name="updatePlanEvaluation" class="btn btn-sm btn-danger">Update</button>
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
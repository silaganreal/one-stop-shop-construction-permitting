<div class="modal fade" id="editAssessment<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit - <?php echo $assessedFees; ?></h5>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="updateAssessment.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-12">
                      <label class="form-label">Amount</label>
                      <div class="input-group input-group-outline mb-3">
                        <input type="number" name="assessAmount" class="form-control" placeholder="Amount" required>
                      </div>
                      <label class="form-label">Assessed By</label>
                      <div class="input-group input-group-outline mb-4">
                        <input type="text" name="assessBy" class="form-control" placeholder="Assessed By" required>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="assessID" value="<?php echo $id; ?>">
                  <input type="hidden" name="onlineappID" value="<?php echo $onlineappID; ?>">
                  <input type="hidden" name="loggedUser" value="<?php echo $LoggedUserID; ?>">
                  <input type="hidden" name="assessedFees" value="<?php echo $assessedFees; ?>">
                  <input type="hidden" name="assessSlug" value="<?php echo $slug; ?>">
                  <div class="row">
                    <div class="col-md-6">
                       <button type="submit" name="updateAssessment" class="btn btn-sm btn-warning">Update</button>
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
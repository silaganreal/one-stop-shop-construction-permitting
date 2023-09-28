    <div class="modal fade" id="editLaborCost<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit - <?php echo $rowLaborCost['assessedFees']; ?></h5>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="updateLaborCost.php" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <label class="form-label">Amount</label>
                      <div class="input-group input-group-outline mb-3">
                        <input type="number" name="assessAmount" class="form-control" placeholder="Amount" required>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="assID" value="<?php echo $id; ?>">
                  <input type="hidden" name="application" value="<?php echo $applicationID; ?>">
                  <input type="hidden" name="user" value="<?php echo $userID; ?>">
                  <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                  <input type="hidden" name="assessedFees" value="<?php echo $rowLaborCost['assessedFees']; ?>">
                  <div class="row">
                    <div class="col-md-6">
                       <button type="submit" name="updateLaborCost" class="btn btn-sm btn-warning">Update</button>
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
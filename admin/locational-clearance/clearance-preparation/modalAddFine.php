    <div class="modal fade" id="addFine" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Additional Fine</h5>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="addFine.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="input-group input-group-outline pb-2">
                           <input type="text" name="assessedFee" class="form-control" placeholder="Assessed Fee" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="input-group input-group-outline pb-2">
                           <input type="number" name="amountDue" class="form-control" placeholder="Amount Due" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="input-group input-group-outline pb-2">
                           <input type="text" name="assessedBy" class="form-control" placeholder="Assessed By" required>
                        </div>
                     </div>
                  </div><br>
                  <input type="hidden" name="onlineappID" value="<?php echo $onlineappID; ?>" required>
                  <input type="hidden" name="userSlug" value="<?php echo $slug; ?>">
                  <div class="row">
                    <div class="col-md-6">
                       <button type="submit" name="AddFine" class="btn btn-sm btn-danger">Add Fine</button>
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
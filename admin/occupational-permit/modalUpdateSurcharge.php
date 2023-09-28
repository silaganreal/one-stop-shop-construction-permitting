    <div class="modal fade" id="editSurcharge<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit - Surcharge</h5>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="updateSurcharge.php" method="post">
                  <div class="form-group mb-3">
                    <label><b>Total: </b></label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control inp-amount" value="<?php echo number_format($subTotal, 2, '.', ','); ?>" readonly>
                      <input type="hidden" id="inpTotal" value="<?php echo $subTotal; ?>">
                      <input type="hidden" name="percentage" id="percentage">
                      <input type="hidden" name="onlineappID" value="<?php echo $row2['onlineappID']; ?>">
                      <input type="hidden" name="assessID" value="<?php echo $row2['id']; ?>">
                      <input type="hidden" name="applicationID" value="<?php echo $applicationID; ?>">
                      <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                    </div>
                  </div>
                  <label><b>Surcharge: </b></label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="surchargeAss" id="flexRadioDefault1" <?php echo $check10; ?> onclick="updateSurcharge(.10)">
                    <label class="form-check-label" for="flexRadioDefault1">
                      <span style="font-weight:bold;font-size:18px;">10%</span>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="surchargeAss" id="flexRadioDefault2" <?php echo $check25; ?> onclick="updateSurcharge(.25)">
                    <label class="form-check-label" for="flexRadioDefault2">
                      <span style="font-weight:bold;font-size:18px;">25%</span>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="surchargeAss" id="flexRadioDefault3" <?php echo $check50; ?> onclick="updateSurcharge(.50)">
                    <label class="form-check-label" for="flexRadioDefault3">
                      <span style="font-weight:bold;font-size:18px;">50%</span>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="surchargeAss" id="flexRadioDefault4" <?php echo $check100; ?> onclick="updateSurcharge(1)">
                    <label class="form-check-label" for="flexRadioDefault4">
                      <span style="font-weight:bold;font-size:18px;">100%</span>
                    </label>
                  </div>
                  <div class="form-group mt-3">
                    <label><b>Total Amount: </b></label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control inp-amount" name="inpTotalAmount" id="inpTotalAmount" <?php if($row2['amountDue'] == '') { echo 'placeholder="Total Amount"'; } else { echo 'value="'.$row2['amountDue'].'"'; } ?> readonly>
                    </div>
                  </div>
                  <div class="form-group mt-3">
                    <button type="submit" name="btnSaveSurcharge" class="btn btn-sm btn-info">Save</button>
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
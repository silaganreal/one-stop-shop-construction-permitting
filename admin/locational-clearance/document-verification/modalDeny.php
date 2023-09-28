<div class="modal fade" id="deny<?php echo $fileID; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Deny Attachment - <?php echo $row3['name']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form action="editAttachment.php" method="post">
              <div class="input-group input-group-outline pb-2">
                <textarea name="denyReason" class="form-control" rows="3" placeholder="Reason"></textarea>
              </div>
              <input type="hidden" name="denyAttachID" value="<?php echo $fileID; ?>">
              <input type="hidden" name="denyAttachAppID" value="<?php echo $row3['applicationID']; ?>">
              <input type="hidden" name="denyResponsible" value="<?php echo $LoggedUserName; ?>">
              <input type="hidden" name="userappID" value="<?php echo $appID; ?>">
              <input type="hidden" name="denySlug" value="<?php echo $slug; ?>">
              <div class="float-start mt-4">
                <button type="submit" name="btnDenyAttachment" class="btn btn-sm btn-danger">Deny</button>
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
<div class="modal fade" id="attach<?php echo $fileID; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Attachment - <?php echo $row3['name']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form action="editAttachment.php" method="post" enctype="multipart/form-data">
              <div class="form-group mt-4">
                <button class="btn btn-sm btn-success" onclick="document.getElementById('newAttachment<?php echo $fileID; ?>').click()">
                  Select File &nbsp;<i class="fas fa-arrow-circle-up"></i>
                </button>
                <input type="file" name="newAttachment" onchange="displayName(this)" id="newAttachment<?php echo $fileID; ?>" style="display:none;" required>
                &nbsp;&nbsp;<span id="fileDesc">Upload File</span>
              </div>
              <input type="hidden" name="fileAttachID" value="<?php echo $row3['id']; ?>">
              <input type="hidden" name="fileAttachName" value="<?php echo $row3['name']; ?>">
              <input type="hidden" name="fileAttachDir" value="<?php echo $row3['folderDirectory']; ?>">
              <input type="hidden" name="fileAttachAppID" value="<?php echo $row3['applicationID']; ?>">
              <div class="float-start mt-4">
                <button type="submit" name="btnUpdateAttachment" class="btn btn-sm btn-info">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-sm btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>
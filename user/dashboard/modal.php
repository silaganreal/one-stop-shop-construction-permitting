<div class="modal fade" id="bldgPermit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Apply Online Building Permit</h5>
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form action="action.php" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-12">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Owner/Applicant</label>
                        <input type="text" name="ownerApplicant" class="form-control" required>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Project Title</label>
                        <input type="text" name="projectTitle" class="form-control" required>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Contact No.</label>
                        <input type="number" name="contactNo" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-7">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Email</label>
                        <input type="email" name="emailAdd" class="form-control" required>
                     </div>
                  </div>
               </div>
               <div class="row">
                <div class="col-md-6">
                   <div class="form-group pb-3">
                      <label>Brgy. Clearance for Bldg. Permit</label>
                      <input type="file" name="brgyClearance[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Brgy. Drainage Certificate</label>
                      <input type="file" name="drainageCert[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Locational Clearance from City Planning</label>
                      <input type="file" name="locationalClearance[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Latest Tax Declaration</label>
                      <input type="file" name="taxDeclaration[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Latest Tax Clearance</label>
                      <input type="file" name="taxClearance[]" multiple required>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group pb-3">
                      <label>Title of Property(Cert. True Copy by Reg. of Deeds)</label>
                      <input type="file" name="titleOfProperty[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Sketch Plan of Lot Duly Cert. by Geodetic Engr.</label>
                      <input type="file" name="sketchPlan[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Approved Subdivision Plan from DENR</label>
                      <input type="file" name="subdivisionPlan[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Photocopy of PRC License & PTR of Signing Prof.</label>
                      <input type="file" name="prcLicense[]" multiple required>
                   </div>
                </div>
              </div><br>
              <input type="hidden" name="userID" value="<?php echo $LoggedUserID; ?>">
              <input type="hidden" name="applicationType" value="BUILDING_PERMIT">
              <div class="row">
                <div class="col-md-6">
                   <button type="submit" name="submitApplication" class="btn btn-sm btn-success">Submit</button>
                </div>
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
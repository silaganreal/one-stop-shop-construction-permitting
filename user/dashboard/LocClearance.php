<div class="modal fade" id="LocClearance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Apply Online for Locational Clearance</h5>
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form action="actionLOC.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="input-group input-group-outline pb-2">
                  <label class="form-label">Owner/Applicant</label>
                  <input type="text" name="ownerApplicant" class="form-control" required>
                </div>
                <div class="input-group input-group-outline pb-2">
                  <label class="form-label">Project Title</label>
                  <input type="text" name="projectTitle" class="form-control" required>
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
              </div>
              <div class="row">
                <!-- start 1st columm -->
                <div class="col-md-6">
                   <div class="form-group pb-3">
                      <label>Application for certification for occupancy</label>
                      <input type="file" name="OccCert[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Duly accomplished certification form signed & sealed by Enrg./Arch with notarization.</label>
                      <input type="file" name="OccCertEngr[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Duly accomplished final electrical inspection form.</label>
                      <input type="file" name="OccElecForm[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Approved building permit.</label>
                      <input type="file" name="OccBlgdPermit[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>2 Pictures of Building (1 Front and 1 Side view).</label>
                      <input type="file" name="OccPic[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>2 Pictures of Building (1 Front and 1 Side view).</label>
                      <input type="file" name="OccPic[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>Recent tax clearance.</label>
                      <input type="file" name="OccTaxClearance[]" multiple required>
                   </div>



                 </div>

                 <div class="col-md-6">
                      <div class="form-group pb-3">
                      <label>Barangay clearance for electrical permit.</label>
                      <input type="file" name="OccBrgyClearanceElec[]" multiple required>
                      </div>

                      <div class="form-group pb-3">
                      <label>Sketch Plan/Locational Map.</label>
                      <input type="file" name="OccSketchPlan[]" multiple required>
                      </div>

                      <div class="form-group pb-3">
                      <label>As-Built electrical plan singed and sealed by professional electrical engineer.</label>
                      <input type="file" name="OccElecPlan[]" multiple required>
                      </div>

                      <div class="form-group pb-3">
                      <label>Three (3) sets of as-built plan (Arch., Civil, Plumbing, Mechanical, Electronics.</label>
                      <input type="file" name="OccAsBuiltPlan[]" multiple required>
                      </div>

                      <div class="form-group pb-3">
                      <label>Approved building plan.</label>
                      <input type="file" name="OccApprovedBldgPlan[]" multiple required>
                      </div>

                      <div class="form-group pb-3">
                      <label>Daily activity logbook.</label>
                      <input type="file" name="Occlogbook[]" multiple required>
                      </div>

                      <div class="form-group pb-3">
                      <label>Certificate of fire and safety inspection.</label>
                      <input type="file" name="OccCertFire[]" multiple required>
                      </div>

                  </div>

                 <!-- end 1st columm -->



              </div><br>
              <input type="hidden" name="userID" value="<?php echo $LoggedUserID; ?>">
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
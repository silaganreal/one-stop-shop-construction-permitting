<div class="modal fade" id="OccPermit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Apply Online for Occupational Permit</h5>
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form action="actionOCCPERMIT.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="input-group input-group-outline pb-2">
                  <label class="form-label">Owner/Applicant</label>
                  <input type="text" name="ownerApplicant2" class="form-control" required>
                </div>
                <div class="input-group input-group-outline pb-2">
                  <label class="form-label">Project Title</label>
                  <input type="text" name="projectTitle2" class="form-control" required>
                </div>
                <div class="row">
                  <div class="col-md-5">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Contact No.</label>
                        <input type="number" name="contactNo2" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-7">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Email</label>
                        <input type="email" name="emailAdd2" class="form-control" required>
                     </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- start 1st columm -->
                <div class="col-md-6">
                   <div class="form-group pb-3">
                      <label>1. Application for certification for occupancy</label>
                      <input type="file" name="OCC1[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>2. Duly accomplished certification form signed & sealed by Enrg./Arch with notarization.</label>
                      <input type="file" name="OCC2[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>3. Duly accomplished final electrical inspection form.</label>
                      <input type="file" name="OCC3[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>4. Approved building permit.</label>
                      <input type="file" name="OCC4[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>5. Two (2) Pictures of Building (1 Front and 1 Side view).</label>
                      <input type="file" name="OCC5[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>6. Two (2) Pictures of Building (1 Front and 1 Side view).</label>
                      <input type="file" name="OCC6[]" multiple required>
                   </div>
                   <div class="form-group pb-3">
                      <label>7. Recent tax clearance.</label>
                      <input type="file" name="OCC7[]" multiple required>
                   </div>
                 </div>

                 <div class="col-md-6">
                    <div class="form-group pb-3">
                    <label>8. Barangay clearance for electrical permit.</label>
                    <input type="file" name="OCC8[]" multiple required>
                    </div>

                    <div class="form-group pb-3">
                    <label>9. Sketch Plan/Locational Map.</label>
                    <input type="file" name="OCC9[]" multiple required>
                    </div>

                    <div class="form-group pb-3">
                    <label>10. As-Built electrical plan singed and sealed by professional electrical engineer.</label>
                    <input type="file" name="OCC10[]" multiple required>
                    </div>

                    <div class="form-group pb-3">
                    <label>11. Three (3) sets of as-built plan (Arch., Civil, Plumbing, Mechanical, Electronics.</label>
                    <input type="file" name="OCC11[]" multiple required>
                    </div>

                    <div class="form-group pb-3">
                    <label>12. Approved building plan.</label>
                    <input type="file" name="OCC12[]" multiple required>
                    </div>

                    <div class="form-group pb-3">
                    <label>13. Daily activity logbook.</label>
                    <input type="file" name="OCC13[]" multiple required>
                    </div>

                    <div class="form-group pb-3">
                    <label>14. Certificate of fire and safety inspection.</label>
                    <input type="file" name="OCC14[]" multiple required>
                    </div>
                  </div>
                 <!-- end 1st columm -->
              </div><br>
              <input type="hidden" name="userID2" value="<?php echo $LoggedUserID; ?>">
              <input type="hidden" name="applicationType2" value="OCCUPANCY_PERMIT">
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
      </div>
    </div>
  </div>
</div>
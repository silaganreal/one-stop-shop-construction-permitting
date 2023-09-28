<div class="modal fade" id="locationalClearance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Apply Online Locational Clearance</h5>
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form action="./files/action_locational.php" method="post" enctype="multipart/form-data">
               <div class="row pt-2">
                  <div class="col-md-6">
                     <h6>Initial Requirements</h6>
                     <div class="form-group pb-3">
                        <label>Duly accomplished & notarized <strong>Application Form</strong></label><br>
                        <input type="file" name="applicationForm[]" multiple required>
                     </div>
                     <div class="form-group pb-3">
                        <label>Certified true copy of <strong>Certificate of Title</strong>(Blue copy from Register of Deeds)</label><br>
                        <input type="file" name="CertOfTitle[]" multiple required>
                     </div>
                     <div class="form-group pb-3">
                        <label><strong>Real Property Tax Clearance</strong>(current yr) from City Treasurer's Office</label><br>
                        <input type="file" name="rptClearance[]" multiple required>
                     </div>
                     <div class="form-group pb-3">
                        <label><strong>Project Cost</strong>(including Bill of Materials & Machiniries/Capitalization)</label><br>
                        <input type="file" name="projectCost[]" multiple required>
                     </div>
                     <div class="form-group pb-3">
                        <label><strong>Sketch or Subdivision Plan</strong> in case the property is subdivided</label><br>
                        <input type="file" name="sketchSubdivisionPlan[]" multiple required>
                     </div>
                     <div class="form-group pb-3">
                        <label><strong>1st page of plan</strong>(Site Development & Vicinity Map) & <strong>Floor Plan</strong></label><br>
                        <input type="file" name="floorPlan[]" multiple required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <h6>Addtitional Requirements(as may be applicable)</h6>
                     <div class="form-group pb-3">
                        <label>If Property is not registered in the name of applicant, submit duly notarized <strong>Deed of Sale</strong> or <strong>Deed of Donation</strong> or <strong>Contract of Lease</strong> or <strong>Authorization allowing the use of property</strong></label><br>
                        <input type="file" name="propertyAuth[]" multiple>
                     </div>
                     <div class="form-group pb-3">
                        <label><strong>Special Power of Attorney</strong> for non-owner or representative</label><br>
                        <input type="file" name="spAttorney[]" multiple>
                     </div>
                     <div class="form-group pb-3">
                        <label><strong>Nationan Requirement</strong></label>
                        <ul>
                           <li class="pb-3">
                              <label><strong>Certificate of Non-Coverage</strong> from EMB-DENR for <strong>2-Storey with roofdeck or 3 or more storey buildings</strong></label><br>
                              <input type="file" name="cncStorey[]" multiple>
                           </li>
                           <li class="pb-3">
                              <label><strong>Certificate of Non-Coverage</strong> from EMB-DENR for <strong>commercial buildings</strong></label><br>
                              <input type="file" name="cncCommercial[]" multiple>
                           </li>
                           <li class="pb-3">
                              <label><strong>Environmental Compliance Certificate</strong> for projects such as <strong>gasoline stations, warehouses, hotels, etc</strong></label><br>
                              <input type="file" name="environmentCompliance[]" multiple>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div><br>
               <input type="hidden" name="userID" value="<?php echo $LoggedUserID; ?>">
               <input type="hidden" name="appID" value="<?php echo $applicationID; ?>">
               <input type="hidden" name="applicationType" value="LOCATIONAL_CLEARANCE">
               <div class="row">
                <div class="col-md-6">
                   <button type="submit" name="submitApplicationLC" class="btn btn-sm btn-success">Submit</button>
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
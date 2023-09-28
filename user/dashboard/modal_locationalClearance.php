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
            <form action="action.php" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-4">
                     <div class="input-group input-group-outline pb-1">
                        <label class="form-label">First Name</label>
                        <input type="text" name="lcFirstName" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="input-group input-group-outline pb-1">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="lcMiddleName" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="input-group input-group-outline pb-1">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lcLastName" class="form-control" required>
                     </div>
                  </div>
               </div>
               <div class="row pt-2">
                  <div class="col-md-6">
                     <div class="input-group input-group-outline pb-2">
                        <select name="lcBarangay" class="form-control" required>
                           <option selected value="">Select Barangay</option>
                           <?php
                           $sqlLcbrgy = "SELECT * FROM taclobanbarangays";
                           $resLcbrgy = mysqli_query($conn, $sqlLcbrgy);
                           while($rowLcbrgy = mysqli_fetch_assoc($resLcbrgy)) {
                              ?>
                              <option value="<?php echo $rowLcbrgy['barangay']; ?>"><?php echo $rowLcbrgy['barangay']; ?></option>
                              <?php
                           }
                           ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Street/District</label>
                        <input type="text" name="lcStreetDistrict" class="form-control" required>
                     </div>
                  </div>
               </div>
               <div class="row pt-2">
                  <div class="col-md-6">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Name of Corporation</label>
                        <input type="text" name="lcNameCorporation" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Address of Corporation</label>
                        <input type="text" name="lcAddressCorporation" class="form-control" required>
                     </div>
                  </div>
               </div>
               <div class="row pt-2">
                  <div class="col-md-6">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Name of Authorized Representative</label>
                        <input type="text" name="lcNameRepresentative" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Address of Authorized Representative</label>
                        <input type="text" name="lcAddressRepresentative" class="form-control" required>
                     </div>
                  </div>
               </div>
               <div class="row pt-2">
                  <div class="col-md-6">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Project Type</label>
                        <input type="text" name="lcProjectType" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-outline pb-2">
                        <select name="lcProjectNature" class="form-control" required>
                           <option selected value="">Project Nature</option>
                           <option value="New Development">New Development</option>
                           <option value="Improvement">Improvement</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row pt-2">
                  <label>Project Location</label>
                  <div class="col-md-4">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Lot No.</label>
                        <input type="text" name="lcplLotNo" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Street/District</label>
                        <input type="text" name="lcplStreetDistrict" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="input-group input-group-outline">
                        <select name="lcplBarangay" class="form-control" required>
                           <option selected value="">Select Barangay</option>
                           <?php
                           $sqlLcbrgy2 = "SELECT * FROM taclobanbarangays";
                           $resLcbrgy2 = mysqli_query($conn, $sqlLcbrgy2);
                           while($rowLcbrgy2 = mysqli_fetch_assoc($resLcbrgy2)) {
                              ?>
                              <option value="<?php echo $rowLcbrgy2['barangay']; ?>"><?php echo $rowLcbrgy2['barangay']; ?></option>
                              <?php
                           }
                           ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row pt-2">
                  <label>Project Area (in square meters)</label>
                  <div class="col-md-4">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Lot No.</label>
                        <input type="text" name="lcplLotNo" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Street/District</label>
                        <input type="text" name="lcplStreetDistrict" class="form-control" required>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="input-group input-group-outline">
                        <select name="lcplBarangay" class="form-control" required>
                           <option selected value="">Select Barangay</option>
                           <?php
                           $sqlLcbrgy2 = "SELECT * FROM taclobanbarangays";
                           $resLcbrgy2 = mysqli_query($conn, $sqlLcbrgy2);
                           while($rowLcbrgy2 = mysqli_fetch_assoc($resLcbrgy2)) {
                              ?>
                              <option value="<?php echo $rowLcbrgy2['barangay']; ?>"><?php echo $rowLcbrgy2['barangay']; ?></option>
                              <?php
                           }
                           ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row pt-2">
                  <div class="col-md-6">
                     <div class="input-group input-group-outline pb-2">
                        <select name="lcBarangay" class="form-control" required>
                           <option selected value="">Right Over Land</option>
                           <option value="Owner">Owner</option>
                           <option value="Lessee">Lessee</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Street/District</label>
                        <input type="text" name="lcStreetDistrict" class="form-control" required>
                     </div>
                  </div>
               </div>
               <div class="row pt-2">
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
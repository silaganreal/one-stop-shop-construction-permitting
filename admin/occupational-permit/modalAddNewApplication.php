    <div class="modal fade" id="addNewApplication" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Apply Online Occupancy Permit</h5>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="./addNewApplication.php" method="post" enctype="multipart/form-data" id="formSearchTDN">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="input-group input-group-outline pb-2">
                        <label class="form-label">Tax Declaration</label>
                        <input type="text" name="taxDeclaration" id="taxDeclaration" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-sm btn-primary mt-1" id="btnSearchTDN" onclick="searchTDN()">Search TDN</button>
                    </div>
                  </div>
                  <input type="hidden" name="applicationType" value="BUILDING_PERMIT">
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
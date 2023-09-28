    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <!-- <h6 class="font-weight-bolder mb-0">Tables</h6> -->
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline mt-2">
              <h7>Hello, <?php echo $LoggedUserName; ?></h7>
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item dropdown px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li>
                  <a class="dropdown-item border-radius-md" href="../../../login">
                    <div class="d-flex">
                      <div class="my-auto">
                        <img src="../../assets/img/team-2.jpg" class="avatar avatar-sm me-1 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mt-2">
                          <span class="font-weight-bold">Logout</span>
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="modal fade" id="addNewApplication" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Apply Online Building Permit</h5>
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="addNewApplication.php" method="post" enctype="multipart/form-data">
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
                      <div class="col-md-12">
                         <div class="input-group input-group-outline pb-2">
                            <label class="form-label">Contact No.</label>
                            <input type="number" name="contactNo" class="form-control" required>
                         </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                         <div class="input-group input-group-outline pb-2">
                            <label class="form-label">Email</label>
                            <input type="email" name="emailAdd" class="form-control" required>
                         </div>
                      </div>
                   </div><br>
                  <input type="hidden" name="userID" value="<?php echo $LoggedUserID; ?>">
                  <div class="row">
                    <div class="col-md-6">
                       <button type="submit" name="addNewApplication" class="btn btn-sm btn-success">Submit</button>
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
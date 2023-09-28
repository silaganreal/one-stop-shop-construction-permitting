<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <span class="ms-1 font-weight-bold text-white">Padayon Tacloban</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto max-height-vh-70" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white <?php echo $active_forms; ?>" href="<?php echo $link_forms; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Forms</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo $active_applications; ?>" href="<?php echo $link_applications; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
            </div>
            <span class="nav-link-text ms-1">Applications</span>
          </a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link text-white" href="#" role="button" data-bs-toggle="dropdown">
              <div class="text-white text-end me-2 d-flex">
                <i class="material-icons opacity-10">table_view</i>
              </div>
              <span class="nav-link-text ms-1">Released</span>
            </a>
            <ul class="dropdown-menu" style="margin-left:5%;margin-right:5%;">
              <li><a class="dropdown-item" href="#">Building Permit</a></li>
              <li><a class="dropdown-item" href="#">Occupancy Permit</a></li>
              <li><a class="dropdown-item" href="#">Locational Clearance</a></li>
            </ul>
          </div>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link text-white <?php //echo $active_occupancypermit; ?>" href="<?php //echo $link_occupancypermit; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Occupancy Permit</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="../pages/virtual-reality.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="../pages/rtl.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
            </div>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="../pages/notifications.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li> -->
        <!-- <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="../pages/profile.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="../pages/sign-in.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link text-white " href="../pages/sign-up.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li> -->
      </ul>
    </div>
  </aside>
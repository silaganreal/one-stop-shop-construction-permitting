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
          <a class="nav-link text-white <?php echo $active_receiving; ?>" href="<?php echo $link_receiving; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"><?php echo $icon_receiving; ?></i>
            </div>
            <span class="nav-link-text ms-1">Receiving</span>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link text-white <?php //echo $active_docVerification; ?>" href="<?php //echo $link_docVerification; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"><?php //echo $icon_docVerification; ?></i>
            </div>
            <span class="nav-link-text ms-1">Document Verification</span>
          </a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link text-white <?php echo $active_planEvaluation; ?>" href="<?php echo $link_planEvaluation; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"><?php echo $icon_planEvaluation; ?></i>
            </div>
            <span class="nav-link-text ms-1">Plan Evaluation</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo $active_assessment; ?>" href="<?php echo $link_assessment; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"><?php echo $icon_assessment; ?></i>
            </div>
            <span class="nav-link-text ms-1">Assessment</span>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link text-white <?php //echo $active_approval; ?>" href="<?php //echo $link_approval; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"><?php //echo $icon_approval; ?></i>
            </div>
            <span class="nav-link-text ms-1">Approval</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link text-white <?php //echo $active_assessmentReleasing; ?>" href="<?php //echo $link_assessmentReleasing; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"><?php //echo $icon_assessmentReleasing; ?></i>
            </div>
            <span class="nav-link-text ms-1">Assessment Releasing</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link text-white <?php //echo $active_payment; ?>" href="<?php //echo $link_payment; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"><?php //echo $icon_payment; ?></i>
            </div>
            <span class="nav-link-text ms-1">Payment</span>
          </a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link text-white <?php echo $active_releasing; ?>" href="<?php echo $link_releasing; ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"><?php echo $icon_releasing; ?></i>
            </div>
            <span class="nav-link-text ms-1">Releasing</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
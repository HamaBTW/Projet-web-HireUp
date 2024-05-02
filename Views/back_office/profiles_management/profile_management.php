<?php

require_once __DIR__ . '/../../../Controls/profileController.php';


// Create an instance of the EmployeC class
$profileController = new ProfileC();

//tset
$test = '624920';

// Call the method to fetch the employees' data
$profiles = $profileController->listProfile();
$Subs_options = $profileController->generateSubsOptions();
$subs = $profileController->generateSubsOptionsCheckbox();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>HireUp Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/HireUp_icon.ico" />
  <link rel="stylesheet" id="stylesheet" href="../assets/css/styles.min.css" />

  <link rel="stylesheet" href="../assets/css/phone.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

  <!-- Add the intlTelInput CSS -->
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

  <style>
    #scrollToTopBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    #addProfileForm #profileForm .mb-3>span {
      position: absolute;
      bottom: 8.5px;
      right: 8.5px;
      color: red;
      pointer-events: none;
      /* Ensure the span doesn't interfere with input events */
    }

    #addProfileForm #profileForm .mb-3 {
      position: relative;
    }

    #submit_error {
      color: red;
      font-size: medium;
      margin-left: 15px;
    }
  </style>

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a title="#" href="../index.html" class="text-nowrap logo-img">
            <img class="logo-img" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../index.html" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">MENU</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">User</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="profile_management.php" aria-expanded="false">
                <span>
                  <i class="ti ti-user-circle"></i>
                </span>
                <span class="hide-menu">Profile</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                <span>
                  <i class="ti ti-tie"></i>
                </span>
                <span class="hide-menu">Jobs</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                <span>
                  <i class="ti ti-message"></i>
                </span>
                <span class="hide-menu">Messages</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Article</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../interface/job_management.html" aria-expanded="false">
                <span>
                  <i class="ti ti-analyze"></i>
                </span>
                <span class="hide-menu">FeedBack</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../interface/authentication-login.html" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../interface/authentication-register.html" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Register</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a title="#" class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="#">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a title="#" class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

              <li class="nav-item dropdown">
                <a title="#" class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle" />
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="../../front_office/profiles_management/profile.php?profile_id=<?php echo $test ?>" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a class="d-flex align-items-center gap-2 dropdown-item" href="#">
                      <i class="ti ti-settings fs-6"></i>
                      <p class="mb-0 fs-3">Settings</p>
                    </a>
                    <a href="">
                      <label class="d-flex align-items-center gap-2 dropdown-item" for="darkModeToggle">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="darkModeToggle">
                        </div>
                        <p class="mb-0 fs-3">Appearance</p>
                      </label>
                    </a>
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title fw-semibold mb-4" style="font-size: xx-large;">Profile Management</h2>
              <hr><br>

              <!-- Button with an icon and a form below it -->
              <button id="toggleFormButton" class="btn btn-primary mb-3" style="font-size: large;">
                <i class="ti ti-user-plus me-2"></i>Add Profile
              </button>
              <a class="btn btn-primary mb-3 ms-3" href="./subscription/subscriptionMg.php?profile_id=<?php echo $test ?>" style="font-size: large;">
                <i class="ti ti-user-check me-2"></i>Subscriptions Management
              </a>
              <br>
              <hr>
              <div id="addProfileForm" style="display: none;">
                <!-- Form for adding new profile -->
                <form id="profileForm" action="addProfile.php" method="POST" enctype="multipart/form-data">
                  <!-- Login Information -->
                  <div class="mb-3">
                    <label for="firstName" class="form-label">First Name *</label>
                    <input type="text" class="form-control" onkeyup="validateFName()" id="profile_first_name" name="profile_first_name" placeholder="Enter first name" />
                    <span id="fname_error" class="fname_error"></span>
                  </div>
                  <div class="mb-3">
                    <label for="familyName" class="form-label">Family Name *</label>
                    <input type="text" class="form-control" onkeyup="validateLName()" id="profile_family_name" name="profile_family_name" placeholder="Enter family name" />
                    <span id="lname_error" class="lname_error"></span>
                  </div>

                  <div class="mb-3">
                    <div class="select-box">
                      <label for="phoneNumber" class="form-label">Phone Number</label>
                      <div class="selected-option">
                        <div id="selected-country">
                          <span class="iconify" data-icon="flag:tn-4x3"></span>
                          <strong>+216</strong>
                        </div>
                        <input type="tel" class="form-control" id="profile_phone_number" name="profile_phone_number" />
                      </div>
                      <div class="options">
                        <input type="text" id="search-box" name="search-box" class="form-control search-box" placeholder="Search Country Name">
                        <ol>

                          <!-- Add more country options as needed -->
                        </ol>
                      </div>
                    </div>
                  </div>



                  <div class="mb-3">
                    <label for="country" class="form-label">Country/Region</label>
                    <input type="text" class="form-control" onkeyup="validateRegion()" id="profile_region" name="profile_region" placeholder="Enter country/region" />
                    <span id="region_error" class="region_error"></span>
                  </div>
                  <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" onkeyup="validateCity()" id="profile_city" name="profile_city" placeholder="Enter city" />
                    <span id="city_error" class="city_error"></span>
                  </div>
                  <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea class="form-control" onkeyup="validateBio()" id="profile_bio" name="profile_bio" rows="3" placeholder="Enter bio"></textarea>
                    <span id="bio_error" class="bio_error"></span>
                  </div>
                  <div class="mb-3">
                    <label for="currentPosition" class="form-label">Current Position</label>
                    <input type="text" class="form-control" onkeyup="validatePos()" id="profile_current_position" name="profile_current_position" placeholder="Enter current position" />
                    <span id="pos_error" class="pos_error"></span>
                  </div>
                  <div class="mb-3">
                    <label for="education" class="form-label">Education</label>
                    <input type="text" class="form-control" onkeyup="validateEdu()" id="profile_education" name="profile_education" placeholder="Enter education" />
                    <span id="edu_error" class="edu_error"></span>
                  </div>
                  <div class="mb-3">
                    <label for="bday" class="form-label">Birthday</label>
                    <input type="date" onchange="validateBDay()" class="form-control" id="profile_bday" name="profile_bday" placeholder="Enter Birthday" />
                    <span id="bday_error" style="position: absolute;
                                                  bottom: 9px;
                                                  right: 40px;
                                                  color: red;                                                           
                                                  pointer-events: none;"><b class="text-primary">We only hire up to 18yo</b></span>
                  </div>
                  <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" onchange="validateGender()" id="profile_gender" name="profile_gender">
                      <option value="" selected disabled>Select Gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    <span id="gender_error" style="position: absolute;
                                                    bottom: 8.5px;
                                                    right: 35px;
                                                    color: red;
                                                    pointer-events: none;"></span>
                  </div>


                  <div class="mb-3">
                    <label for="plan_name" class="form-label">Subscription</label>

                    <select class="form-select" id="plan_name" name="plan_name">
                      <option value="" selected disabled>Select Subscription</option>
                      <?php echo $Subs_options; ?>
                    </select>
                    <div class="subs_error"></div>

                  </div>
                  <div class="mb-3">
                    <label for="authType" class="form-label">Authentication Type *</label>

                    <select class="form-select" id="profile_auth" name="profile_auth">
                      <option value="" selected disabled>Select verification Type</option>
                      <option value="Login Credentials">Login Credentials</option>
                      <option value="Social Login">Social Login</option>
                      <option value="Multi-Factor Authentication (MFA)">
                        Multi-Factor Authentication (MFA)
                      </option>
                    </select>
                    <span class="auth_error"></span>

                  </div>

                  <!-- Admin Information -->
                  <div class="mb-3">
                    <label for="accountVerification" class="form-label">Account Verification *</label>

                    <select class="form-select" id="profile_acc_verif" name="profile_acc_verif">
                      <option value="" selected disabled>Select verification status</option>
                      <option value="Verified">Verified</option>
                      <option value="Pending">Pending</option>
                      <option value="Rejected">Rejected</option>
                    </select>
                    <span class="verif_error"></span>

                  </div>

                  <!-- Profile Photo -->
                  <div class="mb-3">
                    <label for="profile_photo" class="form-label">Profile Photo</label>
                    <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*" />
                  </div>

                  <!-- Profile Cover Photo -->
                  <div class="mb-3">
                    <label for="profile_cover" class="form-label">Profile Cover Photo</label>
                    <input type="file" class="form-control" id="profile_cover" name="profile_cover" accept="image/*" />
                  </div><br>

                  <!-- Submit Button -->
                  <button onclick="return validateForm()" id="submit_button" class="btn btn-primary rounded-5" style="font-size: x-large;">
                    <i class="ti ti-plus text-white"></i>
                  </button>
                  <span id="submit_error" class="submit_error"></span>
                </form>
              </div>
            </div>
          </div>
        </div>

        <button type="button" class="btn btn-success btn-sm me-2" id="scrollToTopBtn" style="font-size: large;"><a class="ti ti-arrow-up text-white"></a></button>

        <div class="container-fluid">
          <div class="card">
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <!-- Search bar -->
                  <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search profile...">
                </div>
                <div class="col-md-6 text-end">
                  <!-- Filter button -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sortModal">Filter</button>
                </div>
              </div>
              <hr>

              <!-- Table for displaying existing profiles -->

              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Actions</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">ID</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">First Name</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Family Name</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Userid</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Phone Number</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Birthday</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Gender</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Region</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">City</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Bio</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Current Position</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Education</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Subscription</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Authentication Type</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Account Verification</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody id="profileTableBody">
                    <?php foreach ($profiles as $profile) : ?>
                      <tr>
                        <td class="border-bottom-0">
                          <button type="button" style="font-size: medium;" class="btn btn-primary btn-sm me-2" onclick="window.location.href='./updateProfile.php?profile_id=<?php echo $profile['profile_id']; ?>'"><a class="ti ti-edit text-white"></a></button>
                          <button type="button" style="font-size: medium;" class="btn btn-danger btn-sm" onclick="window.location.href='./deleteProfile.php?profile_id=<?php echo $profile['profile_id']; ?>'"><a class="ti ti-x text-white"></a></button>
                        </td>
                        <td><?php echo isset($profile['profile_id']) ? $profile['profile_id'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_first_name']) ? $profile['profile_first_name'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_family_name']) ? $profile['profile_family_name'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_userid']) ? $profile['profile_userid'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_phone_number']) ? $profile['profile_phone_number'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_bday']) ? $profile['profile_bday'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_gender']) ? $profile['profile_gender'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_region']) ? $profile['profile_region'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_city']) ? $profile['profile_city'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_bio']) ? $profile['profile_bio'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_current_position']) ? $profile['profile_current_position'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_education']) ? $profile['profile_education'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_subscription']) ? $profile['profile_subscription'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_auth']) ? $profile['profile_auth'] : ''; ?></td>
                        <td><?php echo isset($profile['profile_acc_verif']) ? $profile['profile_acc_verif'] : ''; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>

        <!-- Filter Modal -->
        <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="sortModalLabel">Filter Profiles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form id="filterForm" action="filtered_profiles.php" method="post"> <!-- Updated form element -->
                <div class="modal-body">
                  <!-- Subscription options -->
                  <div class="mb-3">
                    <h6>Subscription</h6>
                    <?php echo $subs; ?>
                  </div>
                  <!-- Authentication Type options -->
                  <div class="mb-3">
                    <h6>Authentication Type</h6>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="login" id="authTypeLogin">
                      <label class="form-check-label" for="authTypeLogin">
                        Login Credentials
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="social" id="authTypeSocial">
                      <label class="form-check-label" for="authTypeSocial">
                        Social Login
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="multi" id="authTypeMulti">
                      <label class="form-check-label" for="authTypeMulti">
                        Multi-Factor Authentication (MFA)
                      </label>
                    </div>
                  </div>
                  <!-- Account Verification options -->
                  <div class="mb-3">
                    <h6>Account Verification</h6>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="verified" id="accountVerified">
                      <label class="form-check-label" for="accountVerified">
                        Verified
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="notverified" id="accountNotVerified">
                      <label class="form-check-label" for="accountNotVerified">
                        Not Verified
                      </label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" id="applyFilter" class="btn btn-primary">Apply Filter</button> <!-- Submit button -->
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End -->

      </div>
    </div>
  </div>

  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/finition.js"></script>
  <script src="../assets/js/phone.js"></script>


  <script>
    document.getElementById('toggleFormButton').addEventListener('click', function() {
      var form = document.getElementById('addProfileForm');
      if (form.style.display === 'none') {
        form.style.display = 'block';
      } else {
        form.style.display = 'none';
      }
    });

    // Listen for changes in the filter form submission
    document.getElementById('filterForm').addEventListener('submit', function(event) {
      // Prevent the default form submission behavior
      event.preventDefault();

      // Get the selected subscription options
      var selectedSubscriptions = [];
      var subscriptionCheckboxes = document.querySelectorAll('input[name="subscription"]:checked');
      subscriptionCheckboxes.forEach(function(checkbox) {
        selectedSubscriptions.push(checkbox.value);
      });

      // Get the selected authentication type options
      var selectedAuthTypes = [];
      var authTypeCheckboxes = document.querySelectorAll('input[name="authType"]:checked');
      authTypeCheckboxes.forEach(function(checkbox) {
        selectedAuthTypes.push(checkbox.value);
      });

      // Get the selected account verification options
      var selectedAccountVerification = [];
      var accountVerificationCheckboxes = document.querySelectorAll('input[name="accountVerification"]:checked');
      accountVerificationCheckboxes.forEach(function(checkbox) {
        selectedAccountVerification.push(checkbox.value);
      });

      // Create a new XMLHttpRequest object
      var xhttp = new XMLHttpRequest();

      // Define the callback function to handle the response
      xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          // Update the table with the response
          document.getElementById('profileTableBody').innerHTML = this.responseText;
          // Close the modal after updating the table
          var modal = bootstrap.Modal.getInstance(document.getElementById('sortModal'));
          modal.hide();
        }
      };

      // Prepare the filter options as URL parameters
      var params = new URLSearchParams();
      params.append('subscriptions', selectedSubscriptions.join(','));
      params.append('authTypes', selectedAuthTypes.join(','));
      params.append('accountVerification', selectedAccountVerification.join(','));

      // Open a GET request to the filtered_profiles.php with query parameters
      xhttp.open('GET', 'filtered_profiles.php?' + params.toString(), true);
      xhttp.send();
    });





    // Listen for changes in the search input field
    document.getElementById('searchInput').addEventListener('input', function() {
      // Get the search query
      var query = this.value.trim();

      // Send the query to the server
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Update the table with the search results
          document.getElementById('profileTableBody').innerHTML = this.responseText;
        }
      };
      xhttp.open('GET', 'searchProfiles.php?query=' + query, true);
      xhttp.send();
    });


    // Function to enforce the format of phone number input
    function formatPhoneNumber(event) {
      // Get the input value and remove any non-digit characters
      var input = event.target;
      var phoneNumber = input.value.replace(/\D/g, '');

      // Format the phone number with the desired structure
      var formattedNumber = phoneNumber.match(/^(\d{3})(\d{2})(\d{3})$/);
      if (formattedNumber) {
        input.value = formattedNumber[1] + ' ' + formattedNumber[2] + ' ' + formattedNumber[3];
      }
    }

    // Add event listener to enforce the phone number format
    var phoneNumberInput = document.getElementById('profile_phone_number');
    phoneNumberInput.addEventListener('input', formatPhoneNumber);
  </script>


  <!-- input control part -->
  <script>
    var fnameError = document.getElementById("fname_error");
    var lnameError = document.getElementById("lname_error");
    var posError = document.getElementById("pos_error");
    var eduError = document.getElementById("edu_error");
    var regionError = document.getElementById("region_error");
    var cityError = document.getElementById("city_error");
    var genderError = document.getElementById("gender_error");
    var bdayError = document.getElementById("bday_error");
    var bioError = document.getElementById("bio_error");

    var submitError = document.getElementById("submit_error");

    function validateFName() {
      var fname = document.getElementById("profile_first_name").value;

      if (fname.length == 0) {
        fnameError.innerHTML = "First Name is required.";
        return false;
      }
      if (fname.length < 2) {
        fnameError.innerHTML = "First Name must be at least 2 characters.";
        return false;
      }
      if (!/^[a-zA-Z ]+$/.test(fname)) {
        fnameError.innerHTML = "First Name contain only alphabets.";
        return false;
      }
      fnameError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
      return true;
    }

    function validateLName() {
      var lname = document.getElementById("profile_family_name").value;

      if (lname.length == 0) {
        lnameError.innerHTML = "Family Name is required.";
        return false;
      }
      if (lname.length < 2) {
        lnameError.innerHTML = "Family Name must be at least 2 characters.";
        return false;
      }
      if (!/^[a-zA-Z ]+$/.test(lname)) {
        lnameError.innerHTML = "Family Name contain only alphabets.";
        return false;
      }
      lnameError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
      return true;
    }

    function validatePos() {
      var pos = document.getElementById("profile_current_position").value;

      if (pos.length == 0) {
        posError.innerHTML = "Current Position is required.";
        return false;
      }
      if (pos.length < 2) {
        posError.innerHTML = "Current Position must be at least 2 characters.";
        return false;
      }

      posError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
      return true;
    }

    function validateEdu() {
      var edu = document.getElementById("profile_education").value;

      if (edu.length == 0) {
        eduError.innerHTML = "Education is required.";
        return false;
      }
      if (edu.length < 2) {
        eduError.innerHTML = "Education must be at least 2 characters.";
        return false;
      }
      eduError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
      return true;
    }

    function validateRegion() {
      var region = document.getElementById("profile_region").value;

      if (region.length == 0) {
        regionError.innerHTML = "Region is required.";
        return false;
      }
      if (region.length < 2) {
        regionError.innerHTML = "Region must be at least 2 characters.";
        return false;
      }
      if (!/^[a-zA-Z ]+$/.test(region)) {
        regionError.innerHTML = "Region contain only alphabets.";
        return false;
      }
      regionError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
      return true;
    }

    function validateCity() {
      var city = document.getElementById("profile_city").value;

      if (city.length == 0) {
        cityError.innerHTML = "City is required.";
        return false;
      }
      if (city.length < 2) {
        cityError.innerHTML = "City must be at least 2 characters.";
        return false;
      }
      cityError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
      return true;
    }

    function validateBio() {
      var bio = document.getElementById("profile_bio").value;
      var maxLength = 150;
      var charactersRemaining = maxLength - bio.length;

      if (bio.length == 0) {
        bioError.innerHTML = "Bio is required.";
        return false;
      }
      if (bio.length < 2) {
        bioError.innerHTML = "Bio must be at least 2 characters.";
        return false;
      }
      if (charactersRemaining >= 0 && bio.length >= 2) {
        bioError.innerHTML = "<b class='text-primary'>" + charactersRemaining + " characters remaining</b>";
        return true;
      } else {
        bioError.innerHTML = "Profile Bio should not exceed 150 characters";
        return false;
      }
    }

    function validateBDay() {
      var bday = document.getElementById("profile_bday").value;

      // Check if a date is selected
      if (!bday || bday === 'mm/dd/yyyy') {
        bdayError.innerHTML = "Please select a Date of Birth.";
        return false;
      }

      // Validate the date format
      var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
      if (!dateRegex.test(bday)) {
        bdayError.innerHTML =
          "Invalid date format. (mm/dd/yyyy).";
        return false;
      }

      // Validate the date values
      var selectedDate = new Date(bday);
      var currentDate = new Date();
      var minDate = new Date("1900-01-01"); // Minimum allowed date
      var maxDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate()); // 18 years ago from the current date

      if (selectedDate < minDate || selectedDate > maxDate) {
        bdayError.innerHTML =
          "Please enter a date +18yo.";
        return false;
      }

      bdayError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
      return true;
    }

    function validateGender() {
      var gender = document.getElementById('profile_gender').value;

      // Check if gender is selected and not equal to "Select Gender"
      if (!gender || gender === "Select Gender") {
        genderError.innerHTML = 'Please select a gender.';
        return false;
      }

      genderError.innerHTML = '<i class="fas fa-check-circle text-success"></i>';
      return true;
    }

    function validateForm() {
      if (
        !validateFName() ||
        !validateLName() ||
        !validatePos() ||
        !validateEdu() ||
        !validateRegion() ||
        !validateCity() ||
        !validateBio() ||
        !validateBDay() || // corrected function name here
        !validateGender()
      ) {
        submitError.innerHTML = "Please fix errors to submit.";
        return false;
      }
    }
  </script>
  <!-- end -->
</body>

</html>
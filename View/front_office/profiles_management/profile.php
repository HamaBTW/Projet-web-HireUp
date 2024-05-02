<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

/*
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}*/

// Check if profile ID is provided in the URL
// if (!isset($_GET['profile_id'])) {
//   header('Location: ../pages/404.php');
//   exit();
// }

// Include database connection and profile controller
require_once __DIR__ . '/../../../Controller/profileController.php';
include_once __DIR__ . '/../../../Controller/user_con.php';
require_once __DIR__ . '/../../../Controller/friendshipsCon.php';


$userC = new userCon("user");

$friendshipC = new FriendshipCon("friendships");


if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Initialize profile controller
$profileController = new ProfileC();

$guesst = false;
$are_freinds = "";
$inv_sender = "";
$friendship_id = "";
$friend_requests = array();
$user_friends = array();
$profile_friends = array();

$user_friends_nb = 0;
$profile_friends_nb = 0;

$profile_id = '';

if (isset($_SESSION['user id'])) {

  $user_id = htmlspecialchars($_SESSION['user id']);

  $user_role = $userC->get_user_role_by_id($user_id);

  // Get profile ID from the URL
  $user_profile_id = $profileController->getProfileIdByUserId($user_id);

  //MARK: getting friend requests list
  $friend_requests = $friendshipC->getFriendRequests($user_profile_id);
  $user_friends = $friendshipC->getFriends($user_profile_id);
  $user_friends_nb = count($user_friends);

  if (isset($_GET['profile_id'])) {

    $profile_id = htmlspecialchars($_GET['profile_id']);

    $profile_friends = $friendshipC->getFriends($_GET['profile_id']);
    $profile_friends_nb = count($profile_friends);

    if ($_GET['profile_id'] != $user_profile_id) {
      $guesst = true;

      $are_freinds = $friendshipC->getFriendshipStatus($_GET['profile_id'], $user_profile_id);
      if ($friendshipC->getFriendshipSender($_GET['profile_id'], $user_profile_id) == $user_profile_id) {
        $inv_sender = 'you';
      }

      if ($are_freinds == 'pending' || $are_freinds == 'friends') {
        $friendship_id = $friendshipC->getFriendshipId($_GET['profile_id'], $user_profile_id);
      }
    }
  } else {
    $profile_id = $user_profile_id;
  }


}

// Initialize profile controller
$profileController = new ProfileC();


// Fetch profile data from the database
$profile = $profileController->getProfileById($profile_id);
$user_profile = $profileController->getProfileById($user_profile_id);

// Check if profile data is retrieved successfully
// if (!$profile) {
//   header('Location: ../pages/404.php');
//   exit();
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" type="image/png" href="./../../../front office assets\images\HireUp_icon.ico" />
  <title>HireUp Profile</title>

  <link rel="stylesheet" href="./assets/css/style.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/profile_style.css">
  <link rel="stylesheet" href="./assets/css/search_input.css">

</head>

<body>

  <?php
  $block_call_back = 'false';
  $access_level = "else";
  include ('./../../../View/callback.php');

  ?>
  <!-- Header Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand ms-4" href="../../../index.php">
        <img class="logo-img" alt="HireUp">
      </a>

      <form class="form me-auto">
        <label for="search">
          <input class="input" type="text" required="" placeholder="HireUp Search..." id="search">
          <div class="fancy-bg"></div>
          <div class="search">
            <svg viewBox="0 0 24 24" aria-hidden="true"
              class="r-14j79pv r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-4wgw6l r-f727ji r-bnwqim r-1plcrui r-lrvibr">
              <g>
                <path
                  d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                </path>
              </g>
            </svg>
          </div>
          <button class="close-btn" type="reset">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
          </button>
        </label>
      </form>

      <!-- Profile Dropdown -->
      <div class="dropdown d-flex align-items-center">

        <!-- Buttons Bar -->
        <div class="d-flex">
          <!-- Friend Requests Button -->
          <button class="btn rounded_button_bar me-3">
            <i class="fa fa-user-plus"></i>
          </button>
          <!-- Messaging Button -->
          <button class="btn rounded_button_bar me-3">
            <i class="fa fa-regular fa-comments"></i>
          </button>
          <!-- Notification Button -->
          <button class="btn rounded_button_bar me-3">
            <i class="fa fa-regular fa-bell"></i>
          </button>
        </div>

        <a href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false"
          class="d-flex align-items-center justify-content-center mx-3" style="height: 100%;">
          <img src="data:image/jpeg;base64,<?= base64_encode($user_profile['profile_photo']) ?>" alt="Profile Photo"
            class="rounded-circle" width="50" height="50">
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          <h5 class="dropdown-header">Account</h5>
          <li><a class="dropdown-item"
              href="./profile.php?profile_id=<?php echo $user_profile['profile_id'] ?>">Profile</a></li>

          <?php if ($user_id) {
            if ($user_role == 'admin') {
              ?>
              <li><a class="dropdown-item text-success" href="../../../View/back_office/main dashboard">Dashboard</a></li>
              <?php
            }
          }
          ?>

          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-header"
              href="./subscription/subscriptionCards.php?profile_id=<?php echo $profile['profile_id'] ?>">Try Premium for
              $0</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item"
              href="./profile-settings-privacy.php?profile_id=<?php echo $profile['profile_id'] ?>">Settings &
              Privacy</a></li>
          <li><a class="dropdown-item" href="#">Help</a></li>
          <li><a class="dropdown-item" href="#">Language</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <h5 class="dropdown-header">Manage</h5>
          <li><a class="dropdown-item" href="#">Posts & Activity</a></li>
          <li><a class="dropdown-item" href="#">Jobs</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="../../../View/front_office/Sign In & Sign Up/logout.php">Logout</a></li>
        </ul>
      </div>

    </div>
  </nav>
  <!-- End Header Navbar -->

  <div class="container">
    <div class="card overflow-hidden">
      <div class="card-body p-0">
        <!-- Profile cover photo -->
        <div class="profile-cover">
          <img src="data:image/jpeg;base64,<?= base64_encode($profile['profile_cover']) ?>" alt="Profile Cover">
        </div>
        <!-- -->

        <!-- Profile content -->
        <div class="container">
          <div class="row align-items-center">
            <!-- Profile social links -->
            <!-- Profile links and Add Story button -->
            <div class="col-lg-4 order-last d-flex align-items-center justify-content-center">
              <ul
                class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 gap-3">
                <!-- Profile links -->
                <li class="position-relative">
                  <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                    href="#" style="width: 48px; height: 48px; text-decoration: none;">
                    <i class="fab fa-facebook"></i>
                  </a>
                </li>
                <li class="position-relative">
                  <a class="text-white bg-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle"
                    href="#" style="width: 48px; height: 48px; text-decoration: none;">
                    <i class="fab fa-twitter"></i>
                  </a>
                </li>
                <li class="position-relative">
                  <a class="text-white bg-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle"
                    href="#" style="width: 48px; height: 48px; text-decoration: none;">
                    <i class="fab fa-instagram"></i>
                  </a>
                </li>
                <li class="position-relative">
                  <a class="text-white bg-danger d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle"
                    href="#" style="width: 48px; height: 48px; text-decoration: none;">
                    <i class="fab fa-youtube"></i>
                  </a>
                </li>

              </ul>
            </div>

            <div class="col-lg-4 mt-n5 order-lg-2 order-1 d-flex flex-column align-items-center justify-content-center">
              <!-- Profile photo -->
              <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle mb-3"
                style="width: 150px; height: 150px;">
                <div
                  class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden"
                  style="width: 140px; height: 140px;">
                  <img src="data:image/jpeg;base64,<?= base64_encode($profile['profile_photo']) ?>" alt="Profile Photo"
                    class="w-100 h-100">
                </div>
              </div>
              <!-- Profile name -->
              <div class="text-center">
                <!-- Profile first name + family name -->
                <h5 class="fs-5 mb-0 fw-bold"><?= $profile['profile_first_name'] ?>
                  <?= $profile['profile_family_name'] ?></h5>
                <!-- -->
                <!-- Profile current position -->
                <p class="mb-0 fs-4"><?= $profile['profile_current_position'] ?></p>
                <!-- -->
              </div>
            </div>


            <!-- Add Story button -->
            <?php
            if ($guesst) {
              ?>
              <div class="col-lg-4 order-last">
                <div class="text-center mt-3 mt-lg-0">
                  <?php
                  if ($are_freinds == 'friends') {
                    ?>
                    <button class="btn btn-secondary btn-sm rounded-pill px-4 py-2"
                      onclick="window.location.href = './../friendships/remove_friendship.php?profile_id=<?php echo $_GET['profile_id']; ?>&id=<?php echo $friendship_id; ?>';"><i
                        class="fa fa-check me-2"></i><b>Following</b></button>
                    <?php
                  } else if ($are_freinds == 'pending') {
                    ?>
                      <?php
                      if ($inv_sender == 'you') {
                        ?>
                        <button class="btn btn-primary btn-sm rounded-pill px-4 py-2"
                          onclick="window.location.href = './../friendships/remove_friendship.php?profile_id=<?php echo $_GET['profile_id']; ?>&id=<?php echo $friendship_id; ?>';"><i
                            class="fas me-2" style="font-size: 15px">&#xf110;</i><b>Pendding</b></button>
                      <?php
                      } else {
                        ?>
                        <button class="btn btn-accept-user btn-sm rounded-pill px-4 py-2"
                          onclick="window.location.href = './../friendships/accept_friendship.php?profile_id=<?php echo $_GET['profile_id']; ?>&id=<?php echo $friendship_id; ?>';"><i
                            class="fas me-2">&#xF055;</i><b>Accept</b></button>
                        <button class="btn btn-refuse-user btn-sm rounded-pill px-4 py-2"
                          onclick="window.location.href = './../friendships/remove_friendship.php?profile_id=<?php echo $_GET['profile_id']; ?>&id=<?php echo $friendship_id; ?>';"><i
                            class="fas me-2">&#xf057;</i><b>Refuse</b></button>
                      <?php
                      }
                      ?>
                    <?php
                  } else {
                    ?>
                      <button class="btn btn-primary btn-sm rounded-pill px-4 py-2"
                        onclick="window.location.href = './../friendships/add_friendship.php?profile_id=<?php echo $_GET['profile_id']; ?>';"><i
                          class="fa fa-plus me-2"></i><b>Follow</b></button>
                    <?php
                  }
                  ?>
                </div>
              </div>
          <?php
            }
            ?>
        </div>
      </div>


        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <ul class="nav nav-pills user-profile-tab justify-content-center mt-2 bg-light-info rounded-2"
                id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button
                    class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                    id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                    role="tab" aria-controls="pills-profile" aria-selected="true">
                    <i class="fas fa-user"></i>
                    <span class="d-none d-md-block ms-3">Profile</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                    id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button"
                    role="tab" aria-controls="pills-followers" aria-selected="false" tabindex="-1">
                    <i class="fas fa-heart"></i>
                    <span class="d-none d-md-block ms-3">Followers</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                    id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button"
                    role="tab" aria-controls="pills-friends" aria-selected="false" tabindex="-1">
                    <i class="fas fa-users"></i>
                    <span class="d-none d-md-block ms-3">Friends</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button
                    class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                    id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button"
                    role="tab" aria-controls="pills-gallery" aria-selected="false" tabindex="-1">
                    <i class="fas fa-photo"></i>
                    <span class="d-none d-md-block ms-3">Gallery</span>
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>







    <div class="tab-content">
      <!-- Profile Tab -->
      <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
        tabindex="0">
        <!-- Create Post Section -->
        <div class="row mb-3">
          <div class="col-md-8 offset-md-2">
            <div class="card">
              <div class="card-body">
                <!-- Post Form -->
                <form>
                  <div class="d-flex align-items-start">
                    <!-- Profile Picture -->
                    <img src="data:image/jpeg;base64,<?= base64_encode($profile['profile_photo']) ?>"
                      alt="Profile Picture" class="rounded-circle me-3" width="40" height="40">
                    <!-- Description Input -->
                    <div class="mb-3 flex-grow-1">
                      <input type="text" class="form-control button-like-input" id="createPostInput"
                        placeholder="Start a post" onclick="openCreatePostModal()">
                    </div>
                  </div>
                  <!-- Buttons -->
                  <div class="d-flex justify-content-between align-items-center">
                    <!-- Photo/Video Button -->
                    <button type="button" id="btn_outline_custom" class="flex-grow-1 me-1"><i
                        class="fa fa-regular fa-image text-black me-2"></i>Photo/Video</button>
                    <!-- Event Button -->
                    <button type="button" id="btn_outline_custom" class="flex-grow-1 me-1"><i
                        class="fa fa-regular fa-calendar text-success me-2"></i>Event</button>
                    <!-- Write Article Button -->
                    <button type="button" id="btn_outline_custom" class="flex-grow-1"><i
                        class="fa fa-regular fa-newspaper text-danger me-2"></i>Write Article</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

      <!-- Left column for Profile Posts -->
      <div class="col-lg-8">
        <!-- Profile Posts -->
        <div class="row">
          <!-- Profile Picture Post -->
          <div class="col-md-12">
            <!-- Sample post card -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <!-- Profile Picture -->
                  <a href="profile.php?profile_id=<?php echo $profile['profile_id'] ?>"><img
                      src="data:image/jpeg;base64,<?= base64_encode($profile['profile_photo']) ?>" alt="Profile picture"
                      class="profile-post-pic"></a>
                  <!-- Profile Name and Location -->
                  <div class="flex-fill ps-2">
                    <div class="fw-bold"><a href="profile.php?profile_id=<?php echo $profile['profile_id'] ?>"
                        class="text-decoration-none"><?= $profile['profile_first_name'] ?>
                        <?= $profile['profile_family_name'] ?></a></div>
                    <div class="small text-body text-opacity-50">April 15</div>
                  </div>
                </div>

                <!-- Post Content -->
                <p>Uploaded a new profile picture</p>
                <!-- Profile Picture Post -->
                <div class="profile-img-list">
                  <img src="data:image/jpeg;base64,<?= base64_encode($profile['profile_photo']) ?>"
                    class="card-img-top new-profile-pic" alt="Profile Picture">
                </div>


                <!-- Action Buttons -->
                <hr class="mb-1 opacity-1">
                <div class="row text-center fw-bold">
                  <div class="col">
                    <button class="like-button text-body text-opacity-50 text-decoration-none p-2">
                      <i class="far fa-thumbs-up me-1 d-block d-sm-inline" style="color: #40A2D8;"></i> Likes
                    </button>
                  </div>
                  <div class="col">
                    <button class="comment-button text-body text-opacity-50 text-decoration-none p-2"> <i
                        class="far fa-comment me-1 d-block d-sm-inline" style="color: #4CCD99;"></i> Comment </button>
                  </div>
                  <div class="col">
                    <button class="share-button text-body text-opacity-50 text-decoration-none p-2"> <i
                        class="fa fa-share me-1 d-block d-sm-inline" style="color: #FFC700;"></i> Share </button>
                  </div>
                </div>
                <hr class="mb-3 mt-1 opacity-1">

                <!-- Comment Input -->
                <div class="d-flex align-items-center">
                  <img src="data:image/jpeg;base64,<?= base64_encode($profile['profile_photo']) ?>"
                    alt="Profile Picture" class="profile-post-pic">
                  <div class="flex-fill ps-2">
                    <div class="position-relative d-flex align-items-center">
                      <input type="text" class="form-control rounded-pill bg-white bg-opacity-15"
                        style="padding-right: 120px;" placeholder="Write a comment...">
                      <div class="position-absolute end-0 text-center">
                        <a href="#" class="text-body text-opacity-50 me-2"><i class="fa fa-smile"></i></a>
                        <a href="#" class="text-body text-opacity-50 me-2"><i class="fa fa-camera"></i></a>
                        <a href="#" class="text-body text-opacity-50 me-2"><i class="fa fa-video"></i></a>
                        <a href="#" class="text-body text-opacity-50 me-3"><i class="fa fa-paw"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Add more post cards as needed -->
        </div>
      </div>
    



    <!-- Right column for Introduction, Friends, and People you may know -->
    <div class="col-lg-4">
      <!-- Introduction Section -->
      <div class="card mb-3">
        <div class="card-body">
          <!-- Profile Bio -->
          <h5 class="card-title">Profile Bio</h5>
          <p class="card-text"><?php echo $profile['profile_bio'] ?></p>
          <hr>

          <!-- Education -->
          <h5 class="card-title">Education</h5>
          <p class="card-text"><?php echo $profile['profile_education'] ?></p>
          <hr>

          <!-- Region/Country -->
          <h5 class="card-title">Region</h5>
          <p class="card-text"><?php echo $profile['profile_region'] ?></p>
          <hr>

          <!-- Ville -->
          <h5 class="card-title">Ville</h5>
          <p class="card-text"><?php echo $profile['profile_city'] ?></p>
          <hr>

          <!-- Edit Details Button -->
          <div>
            <a href="./profile_update.php?profile_id=<?php echo $profile['profile_id'] ?>"
              class="btn edit-details-button w-100"><strong>Edit Details</strong></a>
          </div>
        </div>
      </div>

      <!-- Friends Widget -->
      <div class="card mb-3">
        <div class="card-body">
          <!-- Friends Title -->
          <h5 class="card-title">Friends (<?php echo $profile_friends_nb; ?>)</h5>

          <!-- Friends Section -->
          <div class="friends-section">
            <hr>
            <!-- Sample Friend Item -->
            <?php echo $friendshipC->generateProfileFriendsHTML($profile_friends, 3); ?>
            <!-- Add more friend items as needed -->

            <!-- Show All Button (Only shown if number of friends is more than 4) -->
            <!-- You can use JavaScript to toggle visibility of this button based on the number of friends -->

            <div>
              <button class="btn show-all-button w-100"><strong>Show All</strong></button>
            </div>

          </div>
        </div>
      </div>


      <!-- People you may know -->
      <div class="card mb-3">
        <!-- People you may know content -->
      </div>
    </div>
  </div>


  <!-- Create Post Popup -->
  <div id="createPostModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <!-- Part 1: Profile Picture -->
        <img src="data:image/jpeg;base64,<?= base64_encode($profile['profile_photo']) ?>" class="rounded-circle mb-3"
          alt="Profile Picture" width="50" height="50">
        <span class="close mb-3" onclick="closeCreatePostModal()">&times;</span>
      </div>

      <div class="modal-body mt-3">
        <!-- Part 2: Description Textarea and Buttons -->
        <textarea id="postDescription" placeholder="What's on your mind?"></textarea>
        <div class="buttons">

          <button class="btn icon-btn rounded-5" title="Add Media"><i class="fa fa-camera"></i></button>
          <button class="btn icon-btn rounded-5" title="Create an Event"><i class="fa fa-calendar"></i></button>
          <button class="btn icon-btn rounded-5" title="Celebrate an Occasion"><i class="fa fa-gift"></i></button>
        </div>
      </div>

      <div class="modal-footer">
        <!-- Part 3: Post and Schedule Buttons -->
        <button class="btn schedule-btn rounded-5" id="clock" title="Schedule for Later"><i
            class="fa fa-clock-o"></i></button>
        <button class="btn post-btn rounded-5" id="post">Post</button>
      </div>
    </div>
  </div>


  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>

  <script>
    var dropdown = document.querySelector('.dropdown-toggle');
    var dropdownMenu = document.querySelector('.dropdown-menu');

    dropdown.addEventListener('click', function () {
      dropdownMenu.classList.toggle('show');
    });

    // Close the dropdown menu when clicking outside
    window.addEventListener('click', function (e) {
      if (!dropdown.contains(e.target)) {
        dropdownMenu.classList.remove('show');
      }
    });

    // Get the modal
    var modal = document.getElementById("createPostModal");

    // Get the input field
    var inputField = document.getElementById("createPostInput");

    // Function to open the create post modal
    function openCreatePostModal() {
      var modal = document.getElementById("createPostModal");
      modal.style.display = "block";
      document.body.style.overflow = "hidden"; // Disable scrolling
    }

    function closeCreatePostModal() {
      var modal = document.getElementById("createPostModal");
      modal.style.display = "none";
      document.body.style.overflow = "auto"; // Enable scrolling
    }


    // When the user clicks on the input field, open the modal
    inputField.onclick = function () {
      openCreatePostModal();
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>

</html>
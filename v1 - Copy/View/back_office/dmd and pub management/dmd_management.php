<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HireUp Dashboard</title>
    <link rel="shortcut icon" type="../../../assets/image/png" href="../../../assets/images/logos/HireUp_icon.ico" />
    <link rel="stylesheet" href="../../../assets/css/styles.min.css" />

    <link rel="stylesheet" href="../../../assets/css/search_bar_style.css" />

    <style>
        .logo-img {
            margin: 0 auto;
            /* Center the image horizontally */
            display: block;
            /* Ensure the link occupies full width */
            padding-top: 5%;
        }
    </style>
  

</head>

<?php

include '../../../Controller/dmd_con.php';
include '../../../Model/dmd.php';

// Création d'une instance du contrôleur des événements
$dmdd = new dmdCon("dmd");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['search_inp'])) {
    $keyword = trim($_GET['search_inp']);
    $search_by = trim($_GET['sl_search_type']);

    // Vérifier quel bouton a été cliqué
    if (isset($_GET['search_btn'])) {
        // Bouton de recherche cliqué
        if (str_replace(' ', '', $keyword) == '') {
            $dmds = $dmdd->listdmd();
        } else {
            $dmds = $dmdd->searchdmd($search_by, $keyword);
        }
    } elseif (isset($_GET['sort_btn'])) {
        // Bouton de tri cliqué
        if (str_replace(' ', '', $keyword) == '') {
            $dmds = $dmdd->listdmd();
        } else {
            $dmds = $dmdd->searchdmdSorted($search_by, $keyword);
        }
    } else {
        // Ni le bouton de recherche ni le bouton de tri n'ont été cliqués
        $dmds = $dmdd->listdmd();
    }
} else {
    $dmds = $dmdd->listdmd();
}





?>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <div id="div1"></div>
        <?php include('../../../View/back_office/dashboard_side_bar.php') ?>

        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">

                    <!--  login place -->
                 <?php// include('../../../View/back_office/header_bar.php') ?>  
            
                </nav>
            </header>
            <!--  Header End -->
            <div id="div2"></div>
            <div id="div3"></div>
            <div id="div4"></div>

            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">demande Management</h5>
                            <!-- Form for adding new job -->
                            <form action="./add_dmd.php" method="post" enctype="multipart/form-data">

                                <!-- job Information -->
                                <div class="mb-3">
                                    <label for="titre" class="form-label">titre</label>
                                    <input type="text" class="form-control" id="titre" name="titre"
                                        placeholder="Enter the titre" required>
                                    <div id="titre_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="contenu" class="form-label">contenu</label>
                                    <input type="text" class="form-control" id="contenu" name="contenu"
                                        placeholder="Enter the contenu" required>
                                    <div id="contenu_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="objectif" class="form-label">objectif</label>
                                    <input type="text" class="form-control" id="objectif" name="objectif" placeholder="Enter the objectif"
                                        required>
                                    <div id="objectif_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="dure" class="form-label">dure</label>
                                    <input type="text" class="form-control" id="dure" name="dure" placeholder="Enter the dure"
                                        required>
                                    <div id="dure_error" style="color: red;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="budget" class="form-label">budget</label>
                                    <input type="text" class="form-control" id="budget" name="budget" placeholder="Enter the budget"
                                        required>
                                    <div id="budget_error" style="color: red;"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="image_publication"><b>Image</b></label>
                                    <input type="file" class="form-control" id="image_publication" name="image_publication" accept="image/*"  require/>
                                    <div id="image_publicationError" style="color: red;"></div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary" onclick="return verif_pub_manaet_inputs()">Add demande</button>

                                <div class="mb-3" id="error_global" style="color: red; text-align: center;"></div>
                                <div class="mb-3" id="success_global" style="color: green; text-align: center;"></div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <!-- Table for displaying existing jobs -->
                            <div class="table-responsive">

                                <div>
                                    <form action="" method="">
                                        <div class="mb-3">
                                            
                                            <div class="search-container">
                                                <div class="search-by">
                                                    <label for="search_type">Search By:</label>
                                                    <select class="form-select" id="sl_search_type" name="sl_search_type">
                                                        <option value="everything">Everything</option>
                                                        <option value="iddemande">ID</option>
                                                        <option value="titre">titre</option>
                                                    </select>
                                                </div>
                                                <div class="search-input">
                                                    <label for="search_inp">Search:</label>
                                                    <input type="text" class="form-control" id="search_inp" name="search_inp" placeholder="Search">
                                                </div>

                                                <div>
                                                    <label for="search_btn"></label> <br>
                                                    <button type="submit" class="btn btn-primary" id="search_btn" name="search_btn" value="search">Search</button>
                                                    <button type="submit" class="btn btn-primary" id="sort_btn" name="sort_btn" value="sort">Sort</button>
                                                    
                                                </div>

                                            </div>

                                            <div id="search_error" style="color: red;"></div>

                                        </div>
                                </form>

                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">iddemande</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">titre</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">contenu</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">objectif</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">dure</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">budget</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">image</h6>
                                            </th>
                                           
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">status</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- job rows will be dynamically added here -->
                                        <!-- Example row (replace with dynamic data from database) -->
                                        <?php
                                            foreach ($dmds as $dmd) {
                                        ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $dmd['iddemande']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $dmd['titre']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $dmd['contenu']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $dmd['objectif']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $dmd['dure']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $dmd['budget']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <?php if (!empty($dmd['image'])): ?>
                                                    <h6 class="fw-semibold mb-0"><i class="fa-solid fa-circle-check" style="color: green;"></i></h6>
                                                <?php else: ?>
                                                    <h6 class="fw-semibold mb-0"><i class="fa-solid fa-circle-xmark" style="color: red;"></i></h6>
                                                <?php endif; ?>
                                            </td>
                                            <td class="border-bottom-0">
                                                <?php if ($dmd['status'] == 'accepted'): ?>
                                                    <h6 class="fw-semibold mb-0"><i class="fa-solid fa-circle-check" style="color: green;"></i></h6>
                                                <?php else: ?>
                                                    <h6 class="fw-semibold mb-0"><i class="fa-solid fa-circle-xmark" style="color: red;"></i></h6>
                                                <?php endif; ?>
                                            </td>
                                            

                                            <td class="border-bottom-0">
                                                
                                                <button type="button" class="btn btn-danger btn-sm me-2" onclick="window.location.href = './delete_dmd.php?id=<?= $dmd['iddemande']; ?>';">Delete</button>
                                                <button type="button" class="btn btn-warning btn-sm me-2" onclick="window.location.href = './update_dmd.php?id=<?= $dmd['iddemande']; ?>';">update</button>
                                                <button type="button" class="btn btn-primary btn-sm me-2" onclick="window.location.href = './generate_pdf.php?id=<?= $dmd['iddemande']; ?>';">PDF</button>
                                                <?php if ($dmd['status'] != 'accepted'){ ?>
                                                    <button type="button" class="btn btn-success btn-sm me-2" onclick="window.location.href = './accepter.php?id=<?= $dmd['iddemande']; ?>';">accepter</button>
                                                <?php }?>
                                                
                                                

                                            </td>
                                        </tr>

                                        <?php
                                            }
                                        ?>
                                        <!-- Add more rows dynamically here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
 </div>
    
    <script src="https://kit.fontawesome.com/86ecaa3fdb.js" crossorigin="anonymous"></script>
    <script src="../../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/sidebarmenu.js"></script>
    <script src="../../../assets/js/app.min.js"></script>
    <script src="../../../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../../../View/back_office/ads managment/dmd_management.js"></script>

    <!-- php error check -->
  <?php
    // Check if there's an error message in the URL
    // user name
    if (isset($_GET['error_user_name'])) {
        // Retrieve and sanitize the error message
        $error = htmlspecialchars($_GET['error_user_name']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('user_name_error').innerText = '$error';</script>");
    }

    // email
    if (isset($_GET['error_email'])) {
      // Retrieve and sanitize the error message
      $error = htmlspecialchars($_GET['error_email']);
      // Inject the error message into the div element
      echo "<script>document.getElementById('user_email_error').innerText = '$error';</script>";
    }

    // fill forms if data exists
    // user name
    if (isset($_GET['user_name'])) {
      // Retrieve and sanitize the error message
      $user_name = htmlspecialchars($_GET['user_name']);
      // Inject the error message into the div element
      echo ("<script>document.getElementById('user_name').value = '$user_name';</script>");
    }

    // email
    if (isset($_GET['email'])) {
      // Retrieve and sanitize the error message
      $email = htmlspecialchars($_GET['email']);
      // Inject the error message into the div element
      echo ("<script>document.getElementById('email').value = '$email';</script>");
    }

    //global error
    if (isset($_GET['error_global'])) {
        // Retrieve and sanitize the error message
        $error = htmlspecialchars($_GET['error_global']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('error_global').innerText = '$error';</script>");
    }
  
    //global success
    if (isset($_GET['success_global'])) {
        // Retrieve and sanitize the error message
        $error = htmlspecialchars($_GET['success_global']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('success_global').innerText = '$error';</script>");
    }

    // fill forms if data exists
    // search by
    if (isset($_GET['sl_search_type'])) {
        // Retrieve and sanitize the error message
        $search_by = htmlspecialchars($_GET['sl_search_type']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('sl_search_type').value = '$search_by';</script>");
      }
    
      // search inp
      if (isset($_GET['search_inp'])) {
        // Retrieve and sanitize the error message
        $keyword = htmlspecialchars($_GET['search_inp']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('search_inp').value = '$keyword';</script>");
      }
  
      // role
      if (isset($_GET['sl_role'])) {
        // Retrieve and sanitize the error message
        $role = htmlspecialchars($_GET['sl_role']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('sl_role').value = '$role';</script>");
      }

      // verified
      if (isset($_GET['sl_verified'])) {
        // Retrieve and sanitize the error message
        $verified = htmlspecialchars($_GET['sl_verified']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('sl_verified').value = '$verified';</script>");
      }

      // banned
      if (isset($_GET['sl_banned'])) {
        // Retrieve and sanitize the error message
        $banned = htmlspecialchars($_GET['sl_banned']);
        // Inject the error message into the div element
        echo ("<script>document.getElementById('sl_banned').value = '$banned';</script>");
      }

  ?>

</body>

</html>
<?php

require_once __DIR__ . "../../../controlleur/articleC.php";
$articleController = new ArticleC();


// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "add") {
        // Add new job
        $title = $_POST["article_title"];
        $content = $_POST["Contenu"];
        $author = $_POST["Auteur"];
        $date_art = $_POST["date_art"];
        $category = $_POST["category"];
        $id = $articleController->generateJobId(7);
        $result = $articleController->addArticle($id, $title, $content, $author, $date_art, $category, $article_image = "");
        if ($result !== false) {
            // Redirect to prevent form resubmission
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit;
        }
    } elseif ($_POST["action"] == "delete" && isset($_POST["article_id"])) {
        // Delete job
        $article_id = $_POST["article_id"];
        $deleted = $articleController->deleteArticle($article_id);
        if ($deleted) {
            echo "article deleted successfully.";
        } else {
            echo "Error deleting article.";
        }
    } elseif ($_POST["action"] == "update") {
        // Récupérer les données du formulaire
        $id = $_POST['article_id']; // Corrected variable name
        $title = $_POST['article_title']; // Corrected variable name
        $content = $_POST['Contenu']; // Corrected variable name
        $author = $_POST['Auteur']; // Corrected variable name
        $date_art = $_POST['date_art']; // Corrected variable name
        $category = $_POST['update_category']; // Corrected variable name

        $result = $articleController->updateArticle($id, $title, $content, $author, $date_art, $category);

        if ($result !== false) {
            // Redirect to prevent form resubmission
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit;
        }
    }
}

$articles = $articleController->listArticles();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HireUp Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="./assets/images/logos/HireUp_icon.ico" />
    <link rel="stylesheet" href="./assets/css/styles.min.css" />

    <style>
        /*
        .currency-input {
            position: relative;
            display: inline-block;
        }
        
        #currencySelect {
            position: absolute;
            top: 100%;
            left: 0;
            display: none;
            min-width: 150px;
            padding: 5px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-top: none;
        }
        
        #currencySelect.active {
            display: block;
        }
        */
        .logo-img {
            margin: 0 auto;
            /* Center the image horizontally */
            display: block;
            /* Ensure the link occupies full width */
            padding-top: 5%;
        }

        /* CSS for the popup form */
        .modal {
            display: none;
            /* Hide the modal by default */
            position: fixed;
            /* Stay in place */
            z-index: 1000;
            /* Ensure the modal appears above other elements */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scrolling if needed */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black with opacity */
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            max-width: 80%;
            /* Set a maximum width */
        }

        /* Media query for smaller screens */
        @media only screen and (max-width: 768px) {
            .modal-content {
                max-width: 90%;
                /* Adjust maximum width for smaller screens */
            }
        }


        /* Close button style */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Ensure the modal appears above the header */
        .app-header {
            z-index: 999;
            /* Ensure the header appears above the modal */
        }

        #scrollToTopBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }



        /* article IMAGE STYLESHEET */
        /* Style for article container */
        .article-img-container {
            width: 100%;
            height: 200px;
            /* Adjust height as needed */
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Shadow effect */
        }

        /* Style for article image */
        .article-img-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Style for article container */
        .hidden-article-img-container {
            width: 100%;
            height: 200px;
            /* Adjust height as needed */
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Shadow effect */
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
                    <a title="#" href="./index.php" class="text-nowrap logo-img">
                        <img src="./assets/images/logos/HireUp_lightMode.png" alt="" width="175" height="73">
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
                            <a class="sidebar-link" href="./index.html" aria-expanded="false">
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
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">User</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-circle"></i>
                                </span>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./article_management.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-tie"></i>
                                </span>
                                <span class="hide-menu">articles</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-message"></i>
                                </span>
                                <span class="hide-menu">Messages</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Article</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
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
                            <a class="sidebar-link" href="#" aria-expanded="false">
                                <span>
                                    <i class="ti ti-login"></i>
                                </span>
                                <span class="hide-menu">Login</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#" aria-expanded="false">
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
                                <a title="#" class="nav-link nav-icon-hover" href="#" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="./assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="../../../front_office/profiles_management/profile.php?profile_id=<?php echo $test ?>" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
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
                                        <a href="#" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
                            <h1>article Management</h1>
                            <hr> <br>
                            <h2>Add article</h2><br>
                            <!-- Form for adding new article -->
                            <form id="addarticleForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                <input type="hidden" name="action" value="add">
                                <div class="mb-3">
                                    <label for="article_title" class="form-label">Titre :</label>
                                    <input type="text" class="form-control" id="article_title" name="article_title" placeholder="Enter article Title">
                                    <span id="article_title_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="Contenu" class="form-label">Contenu :</label>
                                    <input type="text" class="form-control" id="Contenu" name="Contenu" placeholder="Enter Contenu">
                                    <span id="article_Contenu_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="Auteur" class="form-label">Auteur :</label>
                                    <input type="text" class="form-control" id="Auteur" name="Auteur" placeholder="Enter Auteur">
                                    <span id="article_Auteur_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="date_art" class="form-label">Date de publication : </label>
                                    <input type="date" class="form-control" id="date_art" name="date_art" placeholder="Enter date_article">
                                    <span id="article_date_art_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>

                                <div class="form-group">
                                    <label for="category"><i class="fas fa-tags mr-2"></i>Catégorie :</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="" disabled selected>Choisissez une catégorie</option>
                                        <option value="politique">Politique</option>
                                        <option value="informatique">Informatique</option>
                                        <option value="économie">Économie</option>
                                        <option value="santé">Santé</option>
                                        <option value="écologie">Écologie</option>
                                    </select>
                                    <span id="categorie_error" class="error-message"></span>
                                </div>


                                <button type="submit" class="btn btn-primary">Add article</button>
                            </form>
                        </div>
                    </div>


                    <!-- Popup Form for Updating article -->
                    <div id="updatearticleModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2><a class="ti ti-edit" style="color: white;"></a> Update article</h2>
                            <hr><br>
                            <form id="updatearticleForm" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="update">
                                <div class="mb-3">
                                    <label for="update_article_id" class="form-label">article ID *</label>
                                    <input type="text" class="form-control" id="update_article_id" name="article_id" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="update_article_title" class="form-label">article Title *</label>
                                    <input type="text" class="form-control" id="update_article_title" name="article_title" placeholder="Enter article Title">
                                    <span id="update_article_title_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="update_Contenu" class="form-label">Contenu</label>
                                    <input type="text" class="form-control" id="update_Contenu" name="Contenu" placeholder="Enter company">
                                    <span id="update_Contenu_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="update_Auteur" class="form-label">Auteur</label>
                                    <input type="text" class="form-control" id="update_Auteur" name="Auteur" placeholder="Enter location">
                                    <span id="update_Auteur_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="mb-3">
                                    <label for="update_date_art" class="form-label">Date de publication</label>
                                    <input type="date" class="form-control" id="update_date_art" name="date_art" >
                                    <span id="update_date_art_error" class="text-danger"></span> <!-- Error message placeholder -->
                                </div>
                                <div class="form-group">
                                    <label for="update_category"><i class="fas fa-tags mr-2"></i>Catégorie :</label>
                                    <select class="form-control" id="update_category" name="update_category">
                                        <option value="" disabled selected>Choisissez une catégorie</option>
                                        <option value="politique">Politique</option>
                                        <option value="informatique">Informatique</option>
                                        <option value="économie">Économie</option>
                                        <option value="santé">Santé</option>
                                        <option value="écologie">Écologie</option>
                                    </select>
                                    <span id="update_category_error" class="error-message"></span>
                                </div>

                                <button type="submit" class="btn btn-primary" id="updatearticleBtn">Update article</button>
                                <button type="button" class="btn btn-secondary cancel-btn" id="cancelUpdateBtn">Cancel</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>

            <button type="button" class="btn btn-success btn-sm me-2" id="scrollToTopBtn" style="font-size: large;"><a class="ti ti-arrow-up text-white"></a></button>

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 ">
                                <a class="btn btn-primary" href="./categorie.php"><i class="ti ti-pin text-white"></i>Category Management</a>
                            </div>

                        </div>
                        <!-- Table for displaying existing articles -->
                        <div class="table-responsive">
                            <!-- Table for displaying existing articles -->
                            <table class="table text-nowrap mb-0 align-middle" id="articles-table">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">ID</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Titre</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Contenu</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Auteur</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Date Article</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Catégorie </h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Actions </h6>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Les lignes seront ajoutées dynamiquement ici -->
                                    <!-- Exemple de ligne (à remplacer par des données dynamiques de la base de données) -->
                                    <?php foreach ($articles as $article) : ?>
                                        <tr>
                                            <td><?= $article['id']; ?></td>
                                            <td><?= $article['titre']; ?></td>
                                            <td><?= $article['contenu']; ?></td>
                                            <td><?= $article['auteur']; ?></td>
                                            <td><?= $article['date_art']; ?></td>
                                            <td><?= isset($article['categories']) ? $article['categories'] : 'N/A'; ?></td>

                                            <td>
                                                <button class="btn btn-warning btn-sm edit-btn" data-article-id="<?= $article['id']; ?>" data-article-title="<?= $article['titre']; ?>" data-article-content="<?= $article['contenu']; ?>" data-article-auteur="<?= $article['auteur']; ?>" data-article-date="<?= $article['date_art']; ?>" data-article-category="<?= $article['categories']  ?>">
                                                    Edit
                                                </button>
                                                <form method="post" style="display:inline;">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this job?')">Delete</button>
                                                </form>
                                            </td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="./assets/js/finition.js"></script>
   
    <!-- pop up JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the modal
            var modal = document.getElementById("updatearticleModal");

            // Get the close button
            var span = document.getElementsByClassName("close")[0];

            // Get all edit buttons
            var editButtons = document.querySelectorAll(".edit-btn");

            // Add event listener for edit button click
            editButtons.forEach(function(button) {
                button.onclick = function() {
                    // Get article details from data attributes
                    const articleId = this.getAttribute("data-article-id");
                    const articleTitle = this.getAttribute("data-article-title");
                    const articleContent = this.getAttribute("data-article-content");
                    const articleAuteur = this.getAttribute("data-article-auteur");
                    const articleDate = this.getAttribute("data-article-date");
                    const articleCategory = this.getAttribute("data-article-category");

                    // Populate update form inputs with article details
                    document.getElementById("update_article_id").value = articleId;
                    document.getElementById("update_article_title").value = articleTitle;
                    document.getElementById("update_Contenu").value = articleContent;
                    document.getElementById("update_Auteur").value = articleAuteur;
                    document.getElementById("update_date_art").value = articleDate;
                    document.getElementById("update_category").value = articleCategory;

                    // Show the update form modal
                    modal.style.display = "block";
                    modal.style.display = "flex";
                };
            });



            // Add event listener for close button click
            span.onclick = function() {
                modal.style.display = "none";
            };

            // Add event listener for clicking outside the modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        });
    </script>

<script>
    document.getElementById("addarticleForm").addEventListener("submit", function(event) {
        // Reset previous error messages
        document.getElementById("article_title_error").textContent = ""; // Reset error message for article title
        document.getElementById("article_Contenu_error").textContent = ""; // Reset error message for Contenu
        document.getElementById("article_Auteur_error").textContent = ""; // Reset error message for Auteur
        document.getElementById("article_date_art_error").textContent = ""; // Reset error message for date_art
        document.getElementById("categorie_error").textContent = ""; // Reset error message for category

        // Get input values
        var articleTitle = document.getElementById("article_title").value.trim();
        var Contenu = document.getElementById("Contenu").value.trim();
        var Auteur = document.getElementById("Auteur").value.trim();
        var date = document.getElementById("date_art").value.trim();
        var category = document.getElementById("category").value.trim();

        // Variable to store the common error message
        var errorMessage = "";

        // Validate article title (characters only)
        if (!/^[a-zA-Z\s]+$/.test(articleTitle)) {
            errorMessage = "article title must contain only characters."; // Set common error message
            displayError("article_title_error", errorMessage, true); // Display error message
        }

        // Check if any input field is empty
        if (articleTitle === "") {
            errorMessage = "article title is required."; // Set common error message
            displayError("article_title_error", errorMessage, true); // Display error message
        }

        // Check if any input field is empty
        if (Contenu === "") {
            errorMessage = "Contenu is required."; // Set common error message
            displayError("article_Contenu_error", errorMessage, true); // Display error message
        }

        // Check if any input field is empty
        if (Auteur === "") {
            errorMessage = "Auteur is required."; // Set common error message
            displayError("article_Auteur_error", errorMessage, true); // Display error message
        }

        // Check if any input field is empty
        if (date === "") {
            errorMessage = "date is required."; // Set common error message
            displayError("article_date_art_error", errorMessage, true); // Display error message
        }

        // Check if any input field is empty
        if (category === "") {
            errorMessage = "category is required."; // Set common error message
            displayError("categorie_error", errorMessage, true); // Display error message
        }

        // Prevent form submission if there's an error message
        if (errorMessage !== "") {
            event.preventDefault();
        }
    });

    // Listen for input event on article title field
    document.getElementById("article_title").addEventListener("input", function(event) {
        var articleTitle = this.value.trim(); // Get value of article title field
        var articleTitleError = document.getElementById("article_title_error"); // Get error message element

        // Validate article title format (characters only)
        if (articleTitle === "") {
            displayError("article_title_error", "Title is required.", true); // Display error message for empty article title
        } else if (/^[a-zA-Z\s]+$/.test(articleTitle)) {
            displayError("article_title_error", "Valid article Title", false); // Display valid message for article title
        } else {
            displayError("article_title_error", "article title must contain only characters.", true); // Display error message for invalid article title
        }
    });

    // Listen for input event on Contenu field
    document.getElementById("Contenu").addEventListener("input", function(event) {
        var Contenu = this.value.trim(); // Get value of Contenu field
        var ContenuError = document.getElementById("article_Contenu_error"); // Get error message element

        // Validate if Contenu is empty
        if (Contenu === "") {
            displayError("article_Contenu_error", "Contenu is required.", true); // Display error message for empty Contenu
        } else {
            displayError("article_Contenu_error", "Valid Contenu", false); // Display valid message for Contenu
        }
    });

    // Listen for input event on Auteur field
    document.getElementById("Auteur").addEventListener("input", function(event) {
        var Auteur = this.value.trim(); // Get value of Auteur field
        var AuteurError = document.getElementById("article_Auteur_error"); // Get error message element

        // Validate if Auteur is empty
        if (Auteur === "") {
            displayError("article_Auteur_error", "Auteur is required.", true); // Display error message for empty Auteur
        } else {
            displayError("article_Auteur_error", "Valid Auteur", false); // Display valid message for Auteur
        }
    });

    // Listen for input event on date_art field
    document.getElementById("date_art").addEventListener("input", function(event) {
        var date = this.value.trim(); // Get value of date_art field
        var dateError = document.getElementById("article_date_art_error"); // Get error message element

        // Validate if date_art is empty
        if (date === "") {
            displayError("article_date_art_error", "Date de publication is required.", true); // Display error message for empty date_art
        } else {
            displayError("article_date_art_error", "Valid date", false); // Display valid message for date_art
        }
    });

    // Listen for input event on category field
    document.getElementById("category").addEventListener("change", function(event) {
        var category = this.value.trim(); // Get value of category field

        // Validate if category is selected
        if (category === "") {
            displayError("categorie_error", "Category is required.", true); // Display error message for empty category
        } else {
            displayError("categorie_error", "Valid category", false); // Display valid message for category
        }
    });

    // Function to display error message
    function displayError(elementId, errorMessage, isError) {
        var errorElement = document.getElementById(elementId);
        errorElement.textContent = errorMessage;
        errorElement.classList.toggle("text-danger", isError);
        errorElement.classList.toggle("text-success", !isError);
    }
</script>


<script>
    document.getElementById("updatearticleForm").addEventListener("submit", function(event) {
        // Reset previous error messages
        document.getElementById("update_article_title_error").textContent = ""; // Reset error message for article title
        document.getElementById("update_Contenu_error").textContent = ""; // Reset error message for Contenu
        document.getElementById("update_Auteur_error").textContent = ""; // Reset error message for Auteur
        document.getElementById("update_date_art_error").textContent = ""; // Reset error message for date_art
        document.getElementById("update_category_error").textContent = ""; // Reset error message for category

        // Get input values
        var articleTitle = document.getElementById("update_article_title").value.trim();
        var Contenu = document.getElementById("update_Contenu").value.trim();
        var auteur = document.getElementById("update_Auteur").value.trim();
        var date = document.getElementById("update_date_art").value.trim();
        var category = document.getElementById("update_category").value.trim();

        // Variable to store the common error message
        var errorMessage = "";

        // Validate article title (characters only)
        if (!/^[a-zA-Z\s]+$/.test(articleTitle)) {
            errorMessage = "article title must contain only characters."; // Set common error message
            displayError("update_article_title_error", errorMessage, true); // Display error message
        }

        // Check if any input field is empty
        if (articleTitle === "") {
            errorMessage = "article title is required."; // Set common error message
            displayError("update_article_title_error", errorMessage, true); // Display error message
        }

        // Check if any input field is empty
        if (Contenu === "") {
            errorMessage = "Contenu is required."; // Set common error message
            displayError("update_Contenu_error", errorMessage, true); // Display error message
        }

        // Check if any input field is empty
        if (auteur === "") {
            errorMessage = "auteur is required."; // Set common error message
            displayError("update_Auteur_error", errorMessage, true); // Display error message
        }

        // Check if any input field is empty
        if (date === "") {
            errorMessage = "date is required."; // Set common error message
            displayError("update_date_art_error", errorMessage, true); // Display error message
        }

        // Check if any input field is empty
        if (category === "") {
            errorMessage = "category is required."; // Set common error message
            displayError("update_category_error", errorMessage, true); // Display error message
        }

        // Prevent form submission if there's an error message
        if (errorMessage !== "") {
            event.preventDefault();
        }
    });

    // Listen for input event on article title field
    document.getElementById("update_article_title").addEventListener("input", function(event) {
        var articleTitle = this.value.trim(); // Get value of article title field
        var articleTitleError = document.getElementById("update_article_title_error"); // Get error message element

        // Validate article title format (characters only)
        if (articleTitle === "") {
            displayError("update_article_title_error", "Title is required.", true); // Display error message for empty article title
        } else if (/^[a-zA-Z\s]+$/.test(articleTitle)) {
            displayError("update_article_title_error", "Valid article Title", false); // Display valid message for article title
        } else {
            displayError("update_article_title_error", "article title must contain only characters.", true); // Display error message for invalid article title
        }
    });

    // Listen for input event on Contenu field
    document.getElementById("update_Contenu").addEventListener("input", function(event) {
        var Contenu = this.value.trim(); // Get value of Contenu field
        var ContenuError = document.getElementById("update_Contenu_error"); // Get error message element

        // Validate if Contenu is empty
        if (Contenu === "") {
            displayError("update_Contenu_error", "Contenu is required.", true); // Display error message for empty Contenu
        } else {
            displayError("update_Contenu_error", "Valid Contenu", false); // Display valid message for Contenu
        }
    });

    // Listen for input event on Auteur field
    document.getElementById("update_Auteur").addEventListener("input", function(event) {
        var Auteur = this.value.trim(); // Get value of Auteur field
        var AuteurError = document.getElementById("update_Auteur_error"); // Get error message element

        // Validate if Auteur is empty
        if (Auteur === "") {
            displayError("update_Auteur_error", "Auteur is required.", true); // Display error message for empty Auteur
        } else {
            displayError("update_Auteur_error", "Valid Auteur", false); // Display valid message for Auteur
        }
    });

    // Listen for input event on date_art field
    document.getElementById("update_date_art").addEventListener("input", function(event) {
        var date = this.value.trim(); // Get value of date_art field
        var dateError = document.getElementById("update_date_art_error"); // Get error message element

        // Validate if date_art is empty
        if (date === "") {
            displayError("update_date_art_error", "Date de publication is required.", true); // Display error message for empty date_art
        } else {
            displayError("update_date_art_error", "Valid date", false); // Display valid message for date_art
        }
    });

    // Listen for input event on category field
    document.getElementById("update_category").addEventListener("change", function(event) {
        var category = this.value.trim(); // Get value of category field

        // Validate if category is selected
        if (category === "") {
            displayError("update_category_error", "Category is required.", true); // Display error message for empty category
        } else {
            displayError("update_category_error", "Valid category", false); // Display valid message for category
        }
    });

    // Function to display error message
    function displayError(elementId, errorMessage, isError) {
        var errorElement = document.getElementById(elementId);
        errorElement.textContent = errorMessage;
        errorElement.classList.toggle("text-danger", isError);
        errorElement.classList.toggle("text-success", !isError);
    }
</script>


</body>

</html>
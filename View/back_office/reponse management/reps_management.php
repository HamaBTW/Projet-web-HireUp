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

include '../../../Controller/reponse_con.php';
include '../../../Model/reponse.php';

// Création d'une instance du contrôleur des événements
$repC = new repCon("reponses");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['search_inp'])){
    $clickedBtn = $_GET['search_btn'];
    if ($clickedBtn == "search"){
        echo "no sort";
        $keyword = trim($_GET['search_inp']);
        $search_by = trim($_GET['sl_search_type']);
       

        // Récupération de la liste des événements
        if (str_replace(' ', '', $keyword) == '') {
            
            $recs = $repC->listRept();
        echo "not searching";

        }
        else{
            $recs = $repC->searchRep($search_by, $keyword);
        echo "im searching";

        }
    }
}
  /*  elseif ($clickedBtn == "sort"){
        echo "sort";
        $keyword = trim($_GET['search_inp']);
        $search_by = trim($_GET['sl_search_type']);
        $role = trim($_GET['sl_role']);
        $verified = trim($_GET['sl_verified']);
        $banned = trim($_GET['sl_banned']);
    
    
        // Récupération de la liste des événements
        if (str_replace(' ', '', $keyword) == '') {
            if ( ($role == "none") && ($verified == "none") && ($banned == "none")){
                $users = $userC->sortUser($search_by);
            }
            else{
                $users = $userC->searchUserSorted($search_by, $keyword, $role, $verified, $banned);
            }
        }
        else{
            $users = $userC->searchUserSorted($search_by, $keyword, $role, $verified, $banned);
        }
    }
    else{
        $users = $userC->listUsers();
    }
}*/
else{
    $reps = $repC->listRept();
    $id_recs_options = $repC->generateRecOptions();
    $id_user_recs_options = $repC->generateRecOptions();
}

?>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        
        <?php include('../../../View/back_office/dashboard_side_bar.php') ?>

        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">

                    <!--  login place -->
                    <?php #include('../../../View/back_office/header_bar.php') ?>
            
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Answers Management</h5>
                            <!-- Form for adding new job -->
                            <form action="./add_rep.php" method="post">
                                <!-- job Information -->
                                <div class="mb-3">
                                    <label for="contenu" class="form-label">Content</label>
                                    <input type="text" class="form-control" id="contenu" name="contenu"
                                        placeholder="Enter the content" required>
                                    <div id="content_error" style="color: red;"></div>
                                </div>
                               
                               

                        

                                <div class="mb-3">
                                    <label for="id_user" class="form-label">User ID</label>
                                    <input readonly type="text" class="form-control" id="id_user" name="id_user" placeholder="Enter the user id"
                                        required value=<?php echo $_GET['id_user'] ;?>>
                                    <div id="id_user_error" style="color: red;"></div>
                                </div>

                                
                                <div class="mb-3">
                                <label for="id_reclamation" class="form-label">ID Reclamation</label>
                                <input readonly type="text" class="form-control" id="id_reclamation" name="id_reclamation" placeholder="Enter the reclamation id"
                                        required  value=<?php echo $_GET['id'] ;?>>
                           
                                </div>   
                                <div id="id_reclamation_error" style="color: red;"></div>

                                <!-- Submit Button -->

                                <button type="submit" class="btn btn-primary" onclick="return verif_reponse_managemet_inputs()">Add Answer</button>

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
                                                        <option value="id">ID</option>
                                                        <option value="user_name">Username</option>
                                                        <option value="email">Email</option>
                                                    </select>
                                                </div>
                                                <div class="search-input">
                                                   
                                                </div>

                                                

                                            </div>

                                            <div id="search_error" style="color: red;"></div>
        
                                            </form>
                                        </div>
                                        <style>
                                                .container {
                                                    display: flex;
                                                    align-items: center; 
                                                }
                                                
                                                .container > * {
                                                    margin-right: 10px; 
                                                }
                                                </style>
                                        <div class="container">
                                            <label for="search_inp">Search:</label>
                                            <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                                            <button type="submit" class="btn btn-primary" id="search" name="search" value="search">Search</button>
                                            <button type="submit" class="btn btn-primary" id="sortAscButton" name="sortAscButton" >Sort</button>
                                            <button type="submit" class="btn btn-primary" id="resetButton" name="resetButton" >ress</button>
                                        </div>
                                
                                <script>
                                    document.getElementById("sortAscButton").addEventListener("click", function() {
                                        // Call your sorting function here
                                        // Example: sortTable();
                                    });

                                    // Your existing search functionality
                                    document.getElementById("search").addEventListener("input", function() {
                                        var input, filter, table, tr, td, i, txtValue;
                                        input = document.getElementById("search");
                                        filter = input.value.toUpperCase();
                                        table = document.getElementById("resultTable");
                                        tr = table.getElementsByTagName("tr");

                                        // Parcourt toutes les lignes et masque celles qui ne correspondent pas à la recherche
                                        for (i = 0; i < tr.length; i++) {
                                            td = tr[i].getElementsByTagName("td")[0]; // Colonne ID
                                            if (td) {
                                                txtValue = td.textContent || td.innerText;
                                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                    tr[i].style.display = "";
                                                } else {
                                                    tr[i].style.display = "none";
                                                }
                                            }
                                        }
                                    });
                                    </script>
                                <table id="resultTablem"  class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" id="sortdate" class="sort" onclick="sortTable(0)">
                                                <h6 class="fw-semibold mb-0" >ID</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Content</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Answer Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">User ID</h6>
                                            </th>
                                            
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Reclamation ID</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Actions</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- job rows will be dynamically added here -->
                                        <!-- Example row (replace with dynamic data from database) -->
                                        <?php
                                            foreach ($reps as $rep) {
                                        ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $rep['id']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $rep['contenu']; ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $rep['date_reponse']; ?></h6>
                                            </td>
                                            
                                           
                                            
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $rep['id_user']; ?></h6>
                                            </td>
                                            
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $rep['id_reclamation']; ?></h6>
                                            </td>
                                            
                                            <td class="border-bottom-0">
                                                <button type="button" class="btn btn-primary btn-sm me-2" onclick="window.location.href = './update_rep.php?id=<?= $rep['id']; ?>';">Update</button>
                                                <button type="button" class="btn btn-danger btn-sm me-2" onclick="window.location.href = './delete_rep.php?id=<?= $rep['id']; ?>';">Delete</button>
                                                <button type="button" class="btn btn-danger btn-sm me-2" onclick="window.location.href = './generate_pdf.php?id=<?= $rep['id']; ?>';">PDF</button>
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
    <script>var originalRows; // Pour stocker les lignes originales du tableau

function sortTable(column, ascending) {
    var table = document.getElementById("resultTablem").getElementsByTagName('tbody')[0];
    var rows = Array.from(table.rows);

    rows.sort(function(a, b) {
        var valueA = parseInt(a.cells[column].textContent);
        var valueB = parseInt(b.cells[column].textContent);
        
        return ascending ? valueA - valueB : valueB - valueA;
    });

    for (var i = 0; i < rows.length; i++) {
        table.appendChild(rows[i]);
    }
}

document.getElementById("sortAscButton").addEventListener("click", function() {
    sortTable(0, true); // Tri ascendant par la colonne 'note' (index 2)
});
document.getElementById("resetButton").addEventListener("click", function() {
    var table = document.getElementById("resultTablem").getElementsByTagName('tbody')[0];
    table.innerHTML = ""; // Efface le contenu du tbody
    originalRows.forEach(function(row) {
        table.appendChild(row);
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var table = document.getElementById("resultTablem").getElementsByTagName('tbody')[0];
    originalRows = Array.from(table.rows);
});</script>

    <script src="https://kit.fontawesome.com/86ecaa3fdb.js" crossorigin="anonymous"></script>
    <script src="../../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/js/sidebarmenu.js"></script>
    <script src="../../../assets/js/app.min.js"></script>
    <script src="../../../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="./reps_management_js.js"></script>

    <!-- php error check -->
  <?php

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

   
  
     

  ?>

</body>

</html>
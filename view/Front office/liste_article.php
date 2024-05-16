
<?php
include "../../controlleur/articleC.php";

$articleController = new ArticleC();
$articles = $articleController->listArticles();

// Vérifier si l'identifiant de l'article à supprimer est passé dans l'URL
if(isset($_GET['id'])) {
    // Supprimer l'article avec l'identifiant passé dans l'URL
    $articleController->deleteArticle($_GET["id"]);
    // Rediriger vers cette même page après la suppression
    header('Location: liste_article.php');
    exit(); // Terminer le script après la redirection
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>HireUp</title>
    <meta charset="utf-8" />

    <meta name="description" content="" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/animations.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/main.css" class="color-switcher-link" />
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>

    <link href="images/HireUp_icon.ico" rel="icon">

  </head>

  <body>
    <div class="preloader">
      <div class="preloader_image"></div>
    </div>

    <!-- search modal -->
    <div
      class="modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="search_modal"
      id="search_modal"
    >
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
      >
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="widget widget_search">
        <form
          method="get"
          class="searchform search-form"
          action="http://webdesign-finder.com/"
        >
          <div class="form-group">
            <input
              type="text"
              value=""
              name="search"
              class="form-control"
              placeholder="Search keyword"
              id="modal-search-input"
            />
          </div>
          <button type="submit" class="btn">Search</button>
        </form>
      </div>
    </div>

    <!-- wrappers for visual page editor and boxed version of template -->
    <div id="canvas">
      <div id="box_wrapper">
        <!-- template sections -->

        <!--eof topline-->

        <section class="page_toplogo ls s-py-15 text-center">
          <div class="container-fluid">
            <div class="row align-items-center">
              <div class="col-lg-4">
                <div
                  class="d-lg-flex justify-content-lg-end align-items-lg-center"
                >
                  <span class="social-icons top">
                    <a
                      href="https://www.facebook.com/profile.php?id=61557532202485"
                      class="fa fa-facebook"
                      title="facebook"
                    ></a>
                    <a
                      href="https://www.instagram.com/hire.up.tn/"
                      class="fa fa-instagram"
                      title="instagram"
                    ></a>
                    <a href="#" class="fa fa-google" title="google"></a>
                    <a href="#" class="fa fa-linkedin" title="linkedin"></a>
                    <a href="#" class="fa fa-pinterest-p" title="linkedin"></a>
                  </span>
                </div>
              </div>
              <div class="col-lg-4 text-center">
                <div class="text-center">
                  <div class="header_logo_center">
                    <a href="index.html" class="logo">
                      <span class="logo_text">Hire</span>
                      <img src="images\HireUp_logo.png" alt="" />
                      <span class="logo_subtext">Up</span>
                    </a>
                  </div>
                  <!-- eof .header_left_logo -->
                </div>
              </div>
              <div class="col-lg-4">
                <button class="btn-outline-darkgrey d-none d-lg-block">
                  Looking for Staff?
                </button>
              </div>
            </div>
          </div>
        </section>

        <!-- header with single Bootstrap column only for navigation and includes. Used with topline and toplogo sections. Menu toggler must be in toplogo section -->
        <header
          class="page_header ls s-bordertop nav-narrow justify-nav-center text-center"
        >
          <div class="container-fluid">
            <div class="row align-items-center">
              <div class="col-xl-12">
                <div class="nav-wrap">
                  <!-- main nav start -->
                  <nav class="top-nav">
                    <ul class="nav sf-menu">
                      <li class="active">
                        <a href="index.html">Homepage</a>
                        <ul>
                          <li>
                            <a href="index.html">Homepage</a>
                          </li>
                          <li>
                            <a href="#">Static Page</a>
                          </li>
                          <li>
                            <a href="#">Single Page</a>
                          </li>
                        </ul>
                      </li>

                      <li>
                        <a href="about.html">Pages</a>
                        <ul>
                          <li>
                            <a href="faq.html">FAQ</a>
                          </li>
                          <li>
                            <a href="team.html">Team</a>
                            <ul>
                              <li>
                                <a href="team-single.html">Team Member</a>
                              </li>
                            </ul>
                          </li>

                          <li>
                            <a href="#">Shop</a>
                            <ul>
                              <li>
                                <a href="#">Shop</a>
                              </li>
                              <li>
                                <a href="#">Single Product</a>
                              </li>
                              <li>
                                <a href="#">Shop Cart</a>
                              </li>
                              <li>
                                <a href="#">Shop Checkout</a>
                              </li>
                              <li>
                                <a href="#">Order Received</a>
                              </li>
                            </ul>
                          </li>

                          <li>
                            <a href="services2.html">Services</a>
                            <ul>
                              <li>
                                <a href="#">Services 1</a>
                              </li>
                              <li>
                                <a href="services2.html">Services 2</a>
                              </li>
                              <li>
                                <a href="#">Services 3</a>
                              </li>
                              <li>
                                <a href="service-single.html">Single Service</a>
                              </li>
                            </ul>
                          </li>

                          <!-- shop -->

                          <!-- features -->
                          <li>
                            <a href="#">Shortcodes</a>
                            <ul>
                              <li>
                                <a href="#">Typography</a>
                              </li>
                              <li>
                                <a href="#">Buttons</a>
                              </li>
                              <li>
                                <a href="#">Icon Boxes</a>
                              </li>
                              <li>
                                <a href="#">Progress</a>
                              </li>
                              <li>
                                <a href="#">Tabs &amp; Collapse</a>
                              </li>
                              <li>
                                <a href="#">Bootstrap Elements</a>
                              </li>
                              <li>
                                <a href="#">Animation</a>
                              </li>
                              <li>
                                <a href="#">Template Icons</a>
                              </li>
                              <li>
                                <a href="#">Social Icons</a>
                              </li>
                            </ul>
                          </li>
                          <!-- eof shortcodes -->

                          <!-- events -->
                          <li>
                            <a href="events-left.html">Events</a>
                            <ul>
                              <li>
                                <a href="events-left.html">Left Sidebar</a>
                              </li>
                              <li>
                                <a href="#">Right Sidebar</a>
                              </li>
                              <li>
                                <a href="#">Full Width</a>
                              </li>
                              <li>
                                <a href="event-single-left.html"
                                  >Single Event</a
                                >
                                <ul>
                                  <li>
                                    <a href="event-single-left.html"
                                      >Left Sidebar</a
                                    >
                                  </li>
                                  <li>
                                    <a href="#">Right Sidebar</a>
                                  </li>
                                  <li>
                                    <a href="#">Full Width</a>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                          <!-- eof events -->

                          <li>
                            <a href="comingsoon.html">Comingsoon</a>
                          </li>

                          <li>
                            <a href="404.html">404</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof pages -->

                      <li>
                        <a href="../add_article.php">Add Article</a>
                      </li>

                      <li>
                        <a href="emloyers.html">Emloyers</a>
                      </li>

                      <li>
                        <a href="candidates.html">Candidates</a>
                      </li>

                      <!-- blog -->
                      <li>
                        <a href="blog-left.html">Blog</a>
                        <ul>
                          <li>
                            <a href="./../add_article.php">Article</a>
                          </li>
                          
                          <li>
                            <a href="#">Post</a>
                            <ul>
                              <li>
                                <a href="#">Right Sidebar</a>
                              </li>
                              <li>
                                <a href="blog-single-left.html">Left Sidebar</a>
                              </li>
                              <li>
                                <a href="#">No Sidebar</a>
                              </li>
                            </ul>
                          </li>

                          <li>
                            <a href="#">Video Post</a>
                            <ul>
                              <li>
                                <a href="#">Right Sidebar</a>
                              </li>
                              <li>
                                <a href="blog-single-video-left.html"
                                  >Left Sidebar</a
                                >
                              </li>
                              <li>
                                <a href="#">No Sidebar</a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <!-- eof blog -->

                      <li>
                        <a href="#">Features</a>
                        <div class="mega-menu">
                          <ul class="mega-menu-row">
                            <li class="mega-menu-col">
                              <a href="#">Headers</a>
                              <ul>
                                <li>
                                  <a href="header1.html">Header Type 1</a>
                                </li>
                                <li>
                                  <a href="#">Header Type 2</a>
                                </li>
                                <li>
                                  <a href="#">Header Type 3</a>
                                </li>
                                <li>
                                  <a href="#">Header Type 4</a>
                                </li>
                                <li>
                                  <a href="#">Header Type 5</a>
                                </li>
                                <li>
                                  <a href="#">Header Type 6</a>
                                </li>
                              </ul>
                            </li>
                            <li class="mega-menu-col">
                              <a href="#">Side Menus</a>
                              <ul>
                                <li>
                                  <a href="#">Push Left</a>
                                </li>
                                <li>
                                  <a href="#">Push Right</a>
                                </li>
                                <li>
                                  <a href="#">Slide Left</a>
                                </li>
                                <li>
                                  <a href="#">Slide Right</a>
                                </li>
                                <li>
                                  <a href="#">Sticked Left</a>
                                </li>
                                <li>
                                  <a href="#">Sticked Right</a>
                                </li>
                              </ul>
                            </li>
                            <li class="mega-menu-col">
                              <a href="title1.html">Title Sections</a>
                              <ul>
                                <li>
                                  <a href="title1.html">Title section 1</a>
                                </li>
                                <li>
                                  <a href="#">Title section 2</a>
                                </li>
                                <li>
                                  <a href="#">Title section 3</a>
                                </li>
                                <li>
                                  <a href="#">Title section 4</a>
                                </li>
                                <li>
                                  <a href="#">Title section 5</a>
                                </li>
                                <li>
                                  <a href="#">Title section 6</a>
                                </li>
                              </ul>
                            </li>
                            <li class="mega-menu-col">
                              <a href="footer1.html">Footers</a>
                              <ul>
                                <li>
                                  <a href="footer1.html">Footer Type 1</a>
                                </li>
                                <li>
                                  <a href="#">Footer Type 2</a>
                                </li>
                                <li>
                                  <a href="#">Footer Type 3</a>
                                </li>
                                <li>
                                  <a href="#">Footer Type 4</a>
                                </li>
                                <li>
                                  <a href="#">Footer Type 5</a>
                                </li>
                                <li>
                                  <a href="#">Footer Type 6</a>
                                </li>
                              </ul>
                            </li>
                            <li class="mega-menu-col">
                              <a href="copyright4.html">Copyright</a>

                              <ul>
                                <li>
                                  <a href="#">Copyright 1</a>
                                </li>
                                <li>
                                  <a href="#">Copyright 2</a>
                                </li>
                                <li>
                                  <a href="#">Copyright 3</a>
                                </li>
                                <li>
                                  <a href="copyright4.html">Copyright 4</a>
                                </li>
                                <li>
                                  <a href="#">Copyright 5</a>
                                </li>
                                <li>
                                  <a href="#">Copyright 6</a>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <!-- eof features -->

                      <!-- gallery -->
                      <li>
                        <a href="#">Gallery</a>
                        <ul>
                          <li>
                            <a href="#">Gallery Regular</a>
                            <ul>
                              <li>
                                <a href="#">2 columns</a>
                              </li>
                              <li>
                                <a href="gallery-regular-3-cols.html"
                                  >3 columns</a
                                >
                              </li>
                              <li>
                                <a href="#">4 columns fullwidth</a>
                              </li>
                            </ul>
                          </li>

                          <li>
                            <a href="#">Gallery Extended</a>
                            <ul>
                              <li>
                                <a href="#">2 columns</a>
                              </li>
                              <li>
                                <a href="gallery-excerpt-3-cols.html"
                                  >3 column</a
                                >
                              </li>
                              <li>
                                <a href="#">4 columns fullwdith</a>
                              </li>
                            </ul>
                          </li>

                          <li>
                            <a href="#">Tiled Gallery</a>
                          </li>

                          <li>
                            <a href="#">Gallery Item</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof Gallery -->

                      <!-- contacts -->
                      <li>
                        <a href="contact2.html">Contacts</a>
                        <ul>
                          <li>
                            <a href="contact2.html">Contact 1</a>
                          </li>
                          <li>
                            <a href="#">Contact 2</a>
                          </li>
                          <li>
                            <a href="#">Contact 3</a>
                          </li>
                          <li>
                            <a href="#">Contact 4</a>
                          </li>
                        </ul>
                      </li>
                      <!-- eof contacts -->
                    </ul>
                  </nav>
                  <!-- eof main nav -->
                </div>
              </div>
            </div>
          </div>

          <!-- header toggler -->

          <span class="toggle_menu">
            <span></span>
          </span>
        </header>

        <section class="page_slider">
          <div class="flexslider" data-nav="true" data-dots="false">
            <ul class="slides">
              <li class="ds text-center">
                <img src="images/slide01.jpg" alt="" />
                <div class="container">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="intro_layers_wrapper">
                        <div class="intro_layers">
                          <div class="intro_layer" data-animation="fadeInLeft">
                            <h3 class="intro_before_featured_word">
                            </h3>
                          </div>
                          <div class="intro_layer" data-animation="fadeInRight">
                            <h2 class="text-uppercase intro_featured_word">
                              LIST
                              <br />
                              ARTICLE
                            </h2>
                          </div>
                          <div class="intro_layer" data-animation="fadeIn">
                            <div class="d-inline-block">
                              <button
                                type="button"
                                class="btn btn-outline-maincolor center-block"
                                data-animation="fadeIn"
                              >
                                Subsctibe to Newsletter
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- eof .intro_layers -->
                      </div>
                      <!-- eof .intro_layers_wrapper -->
                    </div>
                    <!-- eof .col-* -->
                  </div>
                  <!-- eof .row -->
                </div>
                <!-- eof .container -->
              </li>
              <li class="ds text-center">
                <img src="images/slide02.jpg" alt="" />
                <div class="container">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="intro_layers_wrapper">
                        <div class="intro_layers">
                          <div class="intro_layer" data-animation="pullUp">
                            <h3 class="intro_before_featured_word">
                              Stuck in a 'career rut'?
                            </h3>
                          </div>
                          <div class="intro_layer" data-animation="pullDown">
                            <h2 class="text-uppercase intro_featured_word">
                              Help us match to
                              <br />
                              Your hr role
                            </h2>
                          </div>
                          <div class="intro_layer" data-animation="fadeIn">
                            <div class="d-inline-block">
                              <button
                                type="button"
                                class="btn btn-outline-maincolor center-block"
                                data-animation="fadeIn"
                              >
                                Subsctibe to Newsletter
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- eof .intro_layers -->
                      </div>
                      <!-- eof .intro_layers_wrapper -->
                    </div>
                    <!-- eof .col-* -->
                  </div>
                  <!-- eof .row -->
                </div>
                <!-- eof .container -->
              </li>
              <li class="ds text-center">
                <img src="images/slide03.jpg" alt="" />
                <div class="container">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="intro_layers_wrapper">
                        <div class="intro_layers">
                          <div class="intro_layer" data-animation="pullDown">
                            <h3 class="intro_before_featured_word">
                              Launch Your recruitment career
                            </h3>
                          </div>
                          <div class="intro_layer" data-animation="pullUp">
                            <h2 class="text-uppercase intro_featured_word">
                              With innovate
                              <br />
                              Consultancy
                            </h2>
                          </div>
                          <div class="intro_layer" data-animation="fadeIn">
                            <div class="d-inline-block">
                              <button
                                type="button"
                                class="btn btn-outline-maincolor center-block"
                              >
                                Join Our HU
                              </button>
                            </div>
                          </div>
                        </div>
                        <!-- eof .intro_layers -->
                      </div>
                      <!-- eof .intro_layers_wrapper -->
                    </div>
                    <!-- eof .col-* -->
                  </div>
                  <!-- eof .row -->
                </div>
                <!-- eof .container -->
              </li>
            </ul>
            <ul class="flex-direction-nav">
              <li class="flex-nav-prev">
                <a class="flex-prev" href="#">&gt;</a>
              </li>
              <li class="flex-nav-next">
                <a class="flex-next" href="#">&lt;</a>
              </li>
            </ul>
          </div>
          <!-- eof flexslider -->
        </section>


        <section class="ls about s-pt-25">
          <div class="container">
            <div class="row">
              <div
                class="col-md-12 col-lg-6 animate"
                data-animation="slideInLeft"
              >
                <div class="container">
 <div class="container">
    <h1 class="text-center mb-4">Liste des articles</h1>
    <!-- Bouton "Ajouter un article" -->
    <div class="text-center mb-3">
        <a href="add_article.php" class="btn btn-primary">Ajouter un article</a>
    </div>
    <div class="row">
      <?php foreach ($articles as $article): ?>
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <!-- Ajout des données de l'article -->
            <h5 class="card-title"><?php echo $article['titre']; ?></h5>
            <p class="card-text"><strong>Contenu:</strong> <?php echo $article['contenu']; ?></p>
            <p class="card-text"><strong>Auteur:</strong> <?php echo $article['auteur']; ?></p>
            <p class="card-text"><strong>Date de publication:</strong> <?php echo $article['date_art']; ?></p>
            <p class="card-text"><strong>Catégorie:</strong> <?php echo $article['categories']; ?></p>
            <img src="<?php echo $article['imageArticle']; ?>" class="card-img-top" alt="...">
            <form action="shareArticle.php" method="POST">
            <div class="form-group">
              <label for="recipient-email">Recipient Email:</label>
            <input type="email" name="email" required placeholder="Enter email">
          </div>
          <input type="hidden" name="titre" value="<?= htmlspecialchars($article["titre"]); ?>">
          <input type="hidden" name="contenu" value="<?= htmlspecialchars($article["contenu"]); ?>">
          <input type="hidden" name="auteur" value="<?= htmlspecialchars($article["auteur"]); ?>">
          <input type="hidden" name="date_art" value="<?= htmlspecialchars($article["date_art"]); ?>">
          <input type="hidden" name="categories" value="<?= htmlspecialchars($article["categories"]); ?>">
          <input type="hidden" name="imageArticle" value="<?= htmlspecialchars($article["imageArticle"]); ?>">
          <input type="hidden" id="article-content">
          <button type="submit" class="btn btn-primary">Share Article</button>
        </form>
            <!-- Boutons Modifier et Supprimer -->
            <div class="d-flex justify-content-center">
              <div class="btn-group">
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script>
    function confirmDelete(articleId) {
      if (confirm("Êtes-vous sûr de vouloir supprimer cet article ?")) {
        window.location.href = "liste_article.php?id=" + articleId;
      }
    }
  </script>
                  <!-- STARTHERE -->

              <div
                class="col-md-12 col-lg-6 animate"
                data-animation="slideInRight"
              >
              </div>
            </div>
          </div>
        </section>

        <section
          class="icon-boxed teaser-box ls s-py-lg-130 c-my-lg-10 s-parallax"
        >
          <div class="container">
            <div class="row">
              <div class="col-lg-4">
                <div class="icon-box text-center hero-bg box-shadow">
                  <div class="teaser-icon icon-styled bg-maincolor3">
                    <i class="fa fa-unlock-alt"></i>
                  </div>
                  <h3>
                    <a href="#">Highly Secure</a>
                  </h3>
                  <p>
                    Cloud-based services can offer our customers single tenant
                    dedicated environments
                  </p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="icon-box text-center hero-bg box-shadow">
                  <div class="teaser-icon icon-styled bg-maincolor3">
                    <i class="fa fa-cloud"></i>
                  </div>
                  <h3>
                    <a href="#">True Cloud Scal</a>
                  </h3>
                  <p>
                    Working with customers making 100-40,000 hires per annum
                  </p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="icon-box text-center hero-bg box-shadow">
                  <div class="teaser-icon icon-styled bg-maincolor3">
                    <i class="fa fa-database"></i>
                  </div>
                  <h3>
                    <a href="#">Accurate Data</a>
                  </h3>
                  <p>
                    All of our customers' data is validated. We build accurate
                    data banks for reporting
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="pt-20 pb-10 s-py-lg-130 main_contact_form">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 contact-header heading text-center">
                <h5>Submit</h5>
                <h4>Candidate CV</h4>
              </div>
              <div class="px-30 ds-form">
                <form class="ds contact-form c-mb-20">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="col-c-mb-60 form-group has-placeholder">
                        <label for="name"
                          >Full Name
                          <span class="required">*</span>
                        </label>
                        <input
                          type="text"
                          aria-required="true"
                          size="200"
                          value=""
                          name="your-name"
                          id="name"
                          class="form-control"
                          placeholder="Full Name"
                        />
                      </div>
                      <div class="col-c-mb-60 form-group has-placeholder">
                        <label for="text"
                          >Phone number
                          <span class="required">*</span>
                        </label>
                        <input
                          type="text"
                          aria-required="true"
                          size="200"
                          value=""
                          name="text"
                          id="text"
                          class="form-control"
                          placeholder="Phone number"
                        />
                      </div>
                      <div class="col-c-mb-60 form-group has-placeholder">
                        <label for="email"
                          >Email address
                          <span class="required">*</span>
                        </label>
                        <input
                          type="email"
                          aria-required="true"
                          size="200"
                          value=""
                          name="your-email"
                          id="email"
                          class="form-control"
                          placeholder="Email address"
                        />
                      </div>
                      <div class="col-c-mb-60 form-group has-placeholder">
                        <label for="text"
                          >Job sector
                          <span class="required">*</span>
                        </label>
                        <input
                          type="text"
                          aria-required="true"
                          size="200"
                          value=""
                          name="text"
                          id="text"
                          class="form-control"
                          placeholder="Job sector"
                        />
                      </div>
                      <div class="col-c-mb-60 form-group">
                        <input
                          type="file"
                          class="custom-file-input button"
                          id="validatedCustomFile"
                        />
                        <label
                          class="custom-file-label"
                          for="validatedCustomFile"
                          >Attach CV</label
                        >
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group has-placeholder">
                        <label for="message">Comment</label>
                        <textarea
                          aria-required="true"
                          rows="6"
                          cols="40"
                          name="message"
                          id="message"
                          class="form-control"
                          placeholder="comment"
                        ></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group text-center">
                      <button
                        type="submit"
                        id="contact_form_submit"
                        name="contact_submit"
                        class="button"
                      >
                        Submit CV
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>

        <section class="ls s-py-lg-130 s-pt-30 s-pb-30 pt-20 main_blog">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="contact-header text-center">
                  <h5>Our</h5>
                  <h4>Blog Posts</h4>
                </div>
                <div
                  class="owl-carousel pt-30"
                  data-responsive-lg="3"
                  data-responsive-md="2"
                  data-responsive-sm="2"
                  data-nav="false"
                  data-dots="false"
                >
                  <article
                    class="box vertical-item text-center content-padding padding-small bordered post type-post status-publish format-standard has-post-thumbnail"
                  >
                    <div class="item-media post-thumbnail">
                      <a href="#" title="#" rel="#">
                        <img src="images/img_01.jpg" alt="" />
                      </a>
                    </div>
                    <!-- .post-thumbnail -->
                    <div class="item-content">
                      <header class="blog-header">
                        <a href="#" rel="bookmark">
                          <h4>Modernising our Talent Programmes</h4>
                        </a>
                      </header>
                      <!-- .entry-header -->
                      <div class="entry-content ls">
                        <p>
                          The world of work has changed and the appetite for
                          spending long periods of time…
                        </p>
                      </div>
                      <!-- .entry-content -->
                      <div class="blog-item-icons">
                        <div class="col-sm-4">
                          <i class="color-main fa fa-user"></i>
                          <a href="#"> Emma </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-calendar"></i>
                          <a href="#"> August 11, 2017 </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-tag"></i>
                          <a href="#"> Post </a>
                        </div>
                      </div>
                    </div>
                    <!-- .item-content -->
                  </article>
                  <!-- #post-## -->
                  <article
                    class="box vertical-item text-center content-padding padding-small bordered post type-post status-publish format-standard has-post-thumbnail"
                  >
                    <div class="item-media post-thumbnail">
                      <a title="#" href="#">
                        <img src="images/blog-1.jpg" alt="" />
                      </a>
                    </div>
                    <!-- .post-thumbnail -->
                    <div class="item-content">
                      <header class="blog-header">
                        <a href="#" rel="bookmark">
                          <h4>Franki goes to… The Philippines & Indonesia</h4>
                        </a>
                      </header>
                      <!-- .entry-header -->
                      <div class="entry-content ls">
                        <p>
                          In this blog series titled ‘Franki goes to…’ we follow
                          her travels around the world…
                        </p>
                      </div>
                      <!-- .entry-content -->
                      <div class="blog-item-icons">
                        <div class="col-sm-4">
                          <i class="color-main fa fa-user"></i>
                          <a href="#"> Emma </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-calendar"></i>
                          <a href="#"> August 7, 2017 </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-tag"></i>
                          <a href="#"> Post </a>
                        </div>
                      </div>
                    </div>
                    <!-- .item-content -->
                  </article>
                  <!-- #post-## -->
                  <article
                    class="box vertical-item text-center content-padding padding-small bordered post type-post status-publish format-standard has-post-thumbnail"
                  >
                    <div class="item-media post-thumbnail">
                      <a title="#" href="#">
                        <img src="images/blog-2.jpg" alt="" />
                      </a>
                    </div>
                    <!-- .post-thumbnail -->
                    <div class="item-content">
                      <header class="blog-header">
                        <a href="#" rel="bookmark">
                          <h4>Getting More For Your Money</h4>
                        </a>
                      </header>
                      <!-- .entry-header -->
                      <div class="entry-content ls">
                        <p>
                          The majority of businesses will have a degree of
                          reliance on recruitment suppliers…
                        </p>
                      </div>
                      <!-- .entry-content -->
                      <div class="blog-item-icons">
                        <div class="col-sm-4">
                          <i class="color-main fa fa-user"></i>
                          <a href="#"> Emma </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-calendar"></i>
                          <a href="#"> August 6, 2017 </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-tag"></i>
                          <a href="#"> Post </a>
                        </div>
                      </div>
                    </div>
                    <!-- .item-content -->
                  </article>
                  <!-- #post-## -->
                  <article
                    class="box vertical-item text-center content-padding padding-small bordered post type-post status-publish format-standard has-post-thumbnail"
                  >
                    <div class="item-media post-thumbnail">
                      <a title="#" href="#">
                        <img src="images/blog-3.jpg" alt="" />
                      </a>
                    </div>
                    <!-- .post-thumbnail -->
                    <div class="item-content">
                      <header class="blog-header">
                        <a href="#" rel="bookmark">
                          <h4>
                            Post With Youtube
                            <br />
                            Video
                          </h4>
                        </a>
                      </header>
                      <!-- .entry-header -->
                      <div class="entry-content ls">
                        <p>
                          Ribeye cupim jerky ham. Fatback sausage shoulder,
                          bresaola boudin hamburger pork turkey
                        </p>
                      </div>
                      <!-- .entry-content -->
                      <div class="blog-item-icons">
                        <div class="col-sm-4">
                          <i class="color-main fa fa-user"></i>
                          <a href="#"> Emma </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-calendar"></i>
                          <a href="#"> June 10, 2017 </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-tag"></i>
                          <a href="#"> Post </a>
                        </div>
                      </div>
                    </div>
                    <!-- .item-content -->
                  </article>
                  <!-- #post-## -->
                  <article
                    class="box vertical-item text-center content-padding padding-small bordered post type-post status-publish format-standard has-post-thumbnail"
                  >
                    <div class="item-media post-thumbnail">
                      <a title="#" href="#">
                        <img src="images/blog-4.jpg" alt="" />
                      </a>
                    </div>
                    <!-- .post-thumbnail -->
                    <div class="item-content">
                      <header class="blog-header">
                        <a href="#" rel="bookmark">
                          <h4>
                            Post format:
                            <br />
                            Image
                          </h4>
                        </a>
                      </header>
                      <!-- .entry-header -->
                      <div class="entry-content ls">
                        <p>
                          Beef beef ribs pancetta sirloin tail brisket strip
                          steak chuck swine frankfurter ham hock kielbasa
                        </p>
                      </div>
                      <!-- .entry-content -->
                      <div class="blog-item-icons">
                        <div class="col-sm-4">
                          <i class="color-main fa fa-user"></i>
                          <a href="#"> Emma </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-calendar"></i>
                          <a href="#"> June 8, 2017 </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-tag"></i>
                          <a href="#"> Post </a>
                        </div>
                      </div>
                    </div>
                    <!-- .item-content -->
                  </article>
                  <!-- #post-## -->
                  <article
                    class="box vertical-item text-center content-padding padding-small bordered post type-post status-publish format-standard has-post-thumbnail"
                  >
                    <div class="item-media post-thumbnail">
                      <a title="#" href="#">
                        <img src="images/blog-1.jpg" alt="" />
                      </a>
                    </div>
                    <!-- .post-thumbnail -->
                    <div class="item-content">
                      <header class="blog-header">
                        <a href="#" rel="bookmark">
                          <h4>
                            Post With Carousel
                            <br />
                          </h4>
                        </a>
                      </header>
                      <!-- .entry-header -->
                      <div class="entry-content ls">
                        <p>
                          Beef beef ribs pancetta sirloin tail brisket strip
                          steak chuck swine frankfurter ham hock kielbasa
                        </p>
                      </div>
                      <!-- .entry-content -->
                      <div class="blog-item-icons">
                        <div class="col-sm-4">
                          <i class="color-main fa fa-user"></i>
                          <a href="#"> Emma </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-calendar"></i>
                          <a href="#"> june 7, 2017 </a>
                        </div>
                        <div class="col-sm-4">
                          <i class="color-main fa fa-tag"></i>
                          <a href="#"> Post </a>
                        </div>
                      </div>
                    </div>
                    <!-- .item-content -->
                  </article>
                  <!-- #post-## -->
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="ds half-section collapse-section">
          <div class="row">
            <div class="col-lg-6">
              <div class="image_cover image_cover_left half-image"></div>
            </div>
            <div class="col-lg-6 collapse-table">
              <div class="contact-header collapse-header heading pt-30">
                <h5>Receiving</h5>
                <h4>A job offer</h4>
              </div>
              <div id="accordion01" role="tablist" aria-multiselectable="true">
                <div class="card">
                  <div class="card-header" role="tab" id="collapse01_header">
                    <h5 class="mb-0">
                      <a data-toggle="collapse" href="#collapse01" aria-expanded="true" aria-controls="collapse01">
                        Be decisive
                      </a>
                    </h5>
                  </div>
                  <div id="collapse01" class="collapse show" role="tabpanel" aria-labelledby="collapse01_header" data-parent="#accordion01">
                    <div class="card-body">
                      Confirming your acceptance guarantees the job is yours. Usually, there are other candidates in the process at this point, so ensure you are committed.
                    </div>
                  </div>
                </div>
              
                <div class="card">
                  <div class="card-header" role="tab" id="collapse02_header">
                    <h5 class="mb-0">
                      <a class="collapsed" data-toggle="collapse" href="#collapse02" aria-expanded="false" aria-controls="collapse02">
                        Or take your time
                      </a>
                    </h5>
                  </div>
                  <div id="collapse02" class="collapse" role="tabpanel" aria-labelledby="collapse02_header" data-parent="#accordion01">
                    <div class="card-body">
                      Confirming your acceptance guarantees the job is yours. Usually, there are other candidates in the process at this point, so ensure you are committed.
                    </div>
                  </div>
                </div>
              
                <div class="card">
                  <div class="card-header" role="tab" id="collapse03_header">
                    <h5 class="mb-0">
                      <a class="collapsed" data-toggle="collapse" href="#collapse03" aria-expanded="false" aria-controls="collapse03">
                        Resign
                      </a>
                    </h5>
                  </div>
                  <div id="collapse03" class="collapse" role="tabpanel" aria-labelledby="collapse03_header" data-parent="#accordion01">
                    <div class="card-body">
                      Confirming your acceptance guarantees the job is yours. Usually, there are other candidates in the process at this point, so ensure you are committed.
                    </div>
                  </div>
                </div>
              
                <div class="card">
                  <div class="card-header" role="tab" id="collapse04_header">
                    <h5 class="mb-0">
                      <a class="collapsed" data-toggle="collapse" href="#collapse04" aria-expanded="false" aria-controls="collapse04">
                        Counter offers
                      </a>
                    </h5>
                  </div>
                  <div id="collapse04" class="collapse" role="tabpanel" aria-labelledby="collapse04_header" data-parent="#accordion01">
                    <div class="card-body">
                      Confirming your acceptance guarantees the job is yours. Usually, there are other candidates in the process at this point, so ensure you are committed.
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </section>

        <section id="testimonials" class="s-pt-75 s-pb-50">
          <div class="container">
            <div class="row">
              <div class="divider-50 d-none d-lg-block"></div>

              <div class="col-md-12">
                <div
                  class="testimonials-slider owl-carousel"
                  data-autoplay="true"
                  data-responsive-lg="1"
                  data-responsive-md="1"
                  data-responsive-sm="1"
                  data-nav="false"
                  data-dots="true"
                >
                  <div class="quote-item">
                    <div class="quote-image">
                      <img src="images/team/testimonials_01.jpg" alt="" />
                    </div>
                    <p class="small-text color-darkgrey">
                      Jessica J.
                      <br />
                      <span>Aumiller</span>
                    </p>
                    <p class="testimonials">
                      <em class="big text-muted">
                        Working with HR Invenir has already allowed us to
                        challenge some existing assumptions internally, right
                        from the first data collection. The dashboards have been
                        able to provide us with some validated external insight.
                      </em>
                    </p>
                  </div>
                  <div class="quote-item">
                    <div class="quote-image">
                      <img src="images/team/testimonials_02.jpg" alt="" />
                    </div>
                    <p class="small-text color-darkgrey">
                      Michael J.
                      <span>Carter</span>
                    </p>
                    <p class="testimonials">
                      <em class="big text-muted">
                        That is always so powerful in evaluating performance and
                        setting future direction. The data collection itself was
                        straightforward, and Nicky and Jeremy have been a
                        pleasure to work with
                      </em>
                    </p>
                  </div>

                  <div class="quote-item">
                    <div class="quote-image">
                      <img src="images/team/testimonials_03.jpg" alt="" />
                    </div>
                    <p class="small-text color-darkgrey">
                      Sammy
                      <span>Winchell</span>
                    </p>
                    <p class="testimonials">
                      <em class="big text-muted">
                        Duis autem vel eum iriure dolor in hendrerit in
                        vulputate velit esse molestie consequat, vel illum
                        dolore eu feugiat nulla facilisis at vero eros et
                        accumsan et iusto odio dignissim qui blandit praesent.
                      </em>
                    </p>
                  </div>
                </div>
                <!-- .testimonials-slider -->
              </div>

              <div class="divider-50 d-none d-lg-block"></div>
            </div>
          </div>
        </section>

        <section class="ds section_gradient gradient-background py-50">
          <div class="container">
            <div class="row">
              <div class="col-md-4 text-center animate" data-animation="pullUp">
                <div class="info-block">
                  <p>Call Us 24/7</p>
                  <h3>+123-456-7890</h3>
                </div>
              </div>
              <div class="col-md-4 text-center animate" data-animation="pullUp">
                <div class="info-block">
                  <p>Email Address</p>
                  <h3>example@example.com</h3>
                </div>
              </div>
              <div class="col-md-4 text-center animate" data-animation="pullUp">
                <div class="info-block">
                  <p>Open Hours</p>
                  <h3>Daily 9:00-20:00</h3>
                </div>
              </div>
            </div>
          </div>
        </section>

        <div
          class="ls ms page_map"
          data-draggable="true"
          data-scrollwheel="true"
        >
          <div class="marker">
            <div class="marker-address">
              sydney, australia, Liverpool street, 66
            </div>
            <div class="marker-title">First Marker</div>
            <div class="marker-description">
              <ul class="list-unstyled">
                <li>
                  <span class="icon-inline">
                    <span class="icon-styled color-main">
                      <i class="fa fa-map-marker"></i>
                    </span>
                    <span> Sydney, Australia, Liverpool street, 66 </span>
                  </span>
                </li>
                <li>
                  <span class="icon-inline">
                    <span class="icon-styled color-main">
                      <i class="fa fa-phone"></i>
                    </span>
                    <span> 1 (800) 123-45-67 </span>
                  </span>
                </li>
                <li>
                  <span class="icon-inline">
                    <span class="icon-styled color-main">
                      <i class="fa fa-envelope"></i>
                    </span>
                    <span> mail@example.com </span>
                  </span>
                </li>
              </ul>
            </div>
            <img class="marker-icon" src="images/map_marker_icon.png" alt="" />
          </div>
          <!-- .marker -->
        </div>

        <footer
          class="page_footer ds s-py-sm-20 s-pt-md-75 s-pb-md-50 s-py-lg-130 c-gutter-60 pb-20 half-section"
        >
          <div class="container">
            <div class="row">
              <div
                class="footer col-md-4 text-center animate"
                data-animation="fadeInUp"
              >
                <div class="footer widget text-center">
                  <h3 class="widget-title title-menu">Explore</h3>
                  <ul class="footer-menu">
                    <li>
                      <a href="#">Job Search</a>
                    </li>
                    <li class="menu1">
                      <a>Consultants</a>
                    </li>
                    <li>
                      <a href="#">Reviews</a>
                    </li>
                    <li class="menu1">
                      <a>Insights</a>
                    </li>
                    <li>
                      <a href="#">Survey</a>
                    </li>
                    <li class="menu1">
                      <a>Careers</a>
                    </li>
                    <li class="border-bottom-0">
                      <a href="#">Contact</a>
                    </li>
                    <li class="menu1 border-bottom-0">
                      <a>About</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div
                class="footer col-md-4 text-center animate"
                data-animation="fadeInUp"
              >
                <div class="text-center">
                  <div class="header_logo_center footer-logo-ds">
                    <a href="index.html" class="logo">
                      <span class="logo_text">Hire</span>
                      <img src="images/light_logo.png" alt="" />
                      <span class="logo_subtext">Up</span>
                    </a>
                  </div>
                  <!-- eof .header_left_logo -->
                </div>
                <div class="widget pt-20">
                  Duis autem vel eum iriure dolor in hendrerit in vulputate
                  velit esse molestie consequat, vel illum dolore eu feugiat
                  nulla.
                </div>
                <div class="widget">
                  <div class="media">
                    <i class="mx-10 color-main fa fa-map-marker"></i>
                    4518 Spirit Drive, Deland, FL 32720
                  </div>

                  <div class="media">
                    <i class="mx-10 color-main fa fa-phone"></i>
                    101 123 456 789
                  </div>

                  <div class="media text-center link">
                    <i class="mx-10 text-center color-main fa fa-envelope"></i>
                    <a href="#">example@example.com</a>
                  </div>
                </div>

                <div class="author-social">
                  <a
                    title="#"
                    href="https://www.facebook.com/profile.php?id=61557532202485"
                    class="fa fa-facebook color-bg-icon rounded-icon"
                  ></a>
                  <a
                    title="#"
                    href="https://www.instagram.com/hire.up.tn/"
                    class="fa fa-twitter color-bg-icon rounded-icon"
                  ></a>
                  <a
                    title="#"
                    href="https://www.instagram.com/hire.up.tn/"
                    class="fa fa-google color-bg-icon rounded-icon"
                  ></a>
                </div>
              </div>
              <div
                class="footer col-md-4 text-center animate"
                data-animation="fadeInUp"
              >
                <div class="widget widget_mailchimp">
                  <h3 class="widget-title">Newsletter</h3>

                  <p>
                    Enter your email address here always to be updated. We
                    promise not to spam!
                  </p>

                  <form class="signup">
                    <label for="mailchimp_email">
                      <span class="screen-reader-text">Subscribe:</span>
                    </label>

                    <input
                      id="mailchimp_email"
                      name="email"
                      type="email"
                      class="form-control mailchimp_email"
                      placeholder="Email Address"
                    />

                    <button type="submit" class="search-submit">
                      Subscribe
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </footer>

        <section class="page_copyright ds s-py-30">
          <div class="container">
            <div class="row align-items-center">
              <div class="divider-20 d-none d-lg-block"></div>
              <div class="col-md-12 text-center">
                <p>
                  &copy; Copyright <span class="copyright_year">2024</span> All
                  Rights Reserved
                </p>
              </div>
              <div class="divider-20 d-none d-lg-block"></div>
            </div>
          </div>
        </section>
      </div>
      <!-- eof #box_wrapper -->
    </div>
    <!-- eof #canvas -->

    <script src="js/compressed.js"></script>
    <script src="js/main.js"></script>
    <!-- <script src="js/switcher.js"></script> -->

    <!-- Google Map Script -->
    <script
      type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?"
    ></script>
    
  </body>
</html>

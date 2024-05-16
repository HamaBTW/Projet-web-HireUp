<?php
include '../../controlleur/articleC.php';

$articleC = new ArticleC();
$articleC->deleteArticle($_GET["id_article"]);
header('Location:liste_article.php');
?>
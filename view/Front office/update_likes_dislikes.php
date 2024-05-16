<?php
include "../../controlleur/commentaireC.php";

$commentaireController = new CommentaireC();

if (isset($_POST['comment_id']) && isset($_POST['type'])) {
    $comment_id = intval($_POST['comment_id']);
    $type = $_POST['type'];

    if ($type == 'like') {
        $commentaireController->incrementLikes($comment_id);
    } elseif ($type == 'dislike') {
        $commentaireController->incrementDislikes($comment_id);
    }

    // Return the new counts as a JSON response
    $newCounts = $commentaireController->getCommentLikesDislikes($comment_id);
    echo json_encode($newCounts);
}
?>

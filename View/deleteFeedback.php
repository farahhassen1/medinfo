<?php
include '../Controller/FeedbackC.php';
$feedbackC = new feedbackC();
$feedbackC->deleteFeedback($_GET["id"]);
header('Location:listFeedback.php');
?>
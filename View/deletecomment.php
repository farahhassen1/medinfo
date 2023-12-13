<?php
include '../controller/ArticleC.php';
$clientC = new commentC();
$clientC->deletecomment($_GET["idcomment"]);
header('Location:articlesdb.php');
?>
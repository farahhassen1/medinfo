<?php
include '../controller/ArticleC.php';
$clientC = new ArticleC();
$clientC->deleteArticle($_GET["idarticle"]);
header('Location:articlesdb.php');
?>
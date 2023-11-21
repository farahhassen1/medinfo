<?php
include "../controller/ArticleC.php";

$c = new articleC();
$tab = $c->listArticle();

?>
<link rel="stylesheet" href="listart.css">
<link rel="stylesheet" href="displycss.css">

<center>
    <h1>List of Articles</h1>
    <h2>
        <a href="addArticle.php">Add Article</a>
    </h2>
    <a href="displayArticles.php" class="button">Display Articles</a>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id Article</th>
        <th>datepubliarticle</th>
        <th>titrearticle</th>
        <th>contenuarticle</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $article) {
    ?>

        <tr>
            <td><?= $article['idarticle']; ?></td>
            <td><?= $article['datepubliarticle']; ?></td>
            <td><?= $article['titrearticle']; ?></td>
            <td><?= $article['contenuarticle']; ?></td>
            <td align="center">
                <form method="POST" action="updateArticle.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $article['idarticle']; ?> name="idarticle">
                </form>
            </td>
            <td>
                <a href="deleteArticle.php?idarticle=<?php echo $article['idarticle']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
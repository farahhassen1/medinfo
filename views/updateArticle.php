<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../controller/ArticleC.php';
include '../model/Article.php';

$error = "";
$article = null;
$articleC = new ArticleC();

if (isset($_POST["titrearticle"]) && isset($_POST["contenuarticle"]) && isset($_POST["datepubliarticle"])) {
    if (!empty($_POST['titrearticle']) && !empty($_POST["contenuarticle"]) && !empty($_POST["datepubliarticle"])) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }

        // Make sure idarticle is set, default to null if not
        $idarticle = isset($_POST['idarticle']) ? $_POST['idarticle'] : null;

        $article = new Article(
            $idarticle,
            $_POST['titrearticle'],
            $_POST['contenuarticle'],
            $_POST['datepubliarticle']
        );

        var_dump($article);

        if (!empty($idarticle)) {
            $articleC->updateArticle($article, $idarticle);
            header('Location: articlesdb.php');
            exit();
        } else {
            $error = "Missing article ID";
        }
    } else {
        $error = "Missing information";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update</title>
    <link rel="stylesheet" href="addart.css">
</head>

<body>
    <style>
        .error-message {
            font-size: 14px;
            margin-top: 5px;
        }

        .error-message-red {
            color: red;
        }
    </style>
    <button><a href="articlesdb.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (!empty($_POST['idarticle'])) {
        $article = $articleC->showArticle($_POST['idarticle']);
    ?>

        <form action="updateArticle.php" method="POST" onsubmit="return validateForm2();">

            <label for="titrearticle">Article Title:</label>
            <input type="text" id="titrearticle" name="titrearticle" placeholder="Enter Article Title" value="<?php echo $article["titrearticle"] ?>">
            <div id="titrearticle-error" class="error-message error-message-red"></div>

            <label for="contenuarticle">Article Contenu:</label>
            <input id="contenuarticle" name="contenuarticle" type="text" placeholder="Enter Article Content" value="<?php echo $article['contenuarticle'] ?>">
            <div id="contenuarticle-error" class="error-message error-message-red"></div>

            <label for="datepubliarticle">Date de publication:</label>
            <input type="date" id="datepubliarticle" name="datepubliarticle" placeholder="Select Date of Publication" value="<?php echo $article['datepubliarticle'] ?>">
            <div id="datepubliarticle-error" class="error-message error-message-red"></div>

            <!-- Add a hidden input for idarticle -->
            <input type="hidden" name="idarticle" value="<?php echo $_POST['idarticle']; ?>">

            <input type="submit" value="save">
            <input type="submit" value="reset">

            <div id="article-container"></div>

        </form>
    <?php
    }
    ?>
    <script>
        function validateForm2() {
            var title = document.getElementById('titrearticle').value;
            var content = document.getElementById('contenuarticle').value;
            var date = document.getElementById('datepubliarticle').value;

            var titleRegex = /^[a-zA-Z0-9\s]+$/; // Alphanumeric characters and spaces
            var contentRegex = /^[a-zA-Z0-9\s]{1,2000}$/; // Alphanumeric characters and spaces

            var isValid = true;

            if (!title.match(titleRegex)) {
                document.getElementById('titrearticle-error').innerHTML = 'Title can only contain letters, numbers, and spaces and cant be empty';
                isValid = false;
            } else {
                document.getElementById('titrearticle-error').innerHTML = 'Done!';
            }

            if (!content.match(contentRegex)) {
                document.getElementById('contenuarticle-error').innerHTML = 'Content can only contain letters, numbers, and spaces and cant be empty';
                isValid = false;
            } else {
                document.getElementById('contenuarticle-error').innerHTML = 'Done!';
            }

            if (date.trim() === "") {
                document.getElementById('datepubliarticle-error').innerHTML = 'Date is required';
                isValid = false;
            } else {
                document.getElementById('datepubliarticle-error').innerHTML = 'Done!';
            }

            return isValid;
        }
    </script>
</body>

</html>

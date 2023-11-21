<?php

include '../controller/ArticleC.php';
include '../model/Article.php';

$error = "";

// create client
$article = null;

// create an instance of the controller
$ArticleC = new ArticleC();
if (
    isset($_POST["titrearticle"]) &&
    isset($_POST["contenuarticle"])&&
    isset($_POST["datepubliarticle"]) 
) {
    if (
        !empty($_POST["titrearticle"]) &&
        !empty($_POST["contenuarticle"])&&
        !empty($_POST["datepubliarticle"]) 

    ) {
        $article = new article(
            null,
            $_POST['titrearticle'],
            $_POST['contenuarticle'],
            $_POST['datepubliarticle']

        );
        $ArticleC->addArticle($article);
        
        header('Location:displayArticles.php');
    } else
        $error = "You Didnt add the Article Information!";
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article </title>
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

    <a href="articlesdb.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

   
    <form action="addArticle.php" method="POST" onsubmit="return validateForm()">

        <div>
            <label for="titrearticle">Article Title:</label>
            <input type="text" id="titrearticle" name="titrearticle" placeholder="Enter Article Title">
            <div id="titrearticle-error" class="error-message error-message-red"></div>

            <label for="contenuarticle">Article Contenu:</label>
            <textarea id="contenuarticle" name="contenuarticle" rows="4" cols="50" placeholder="Enter Article Content"></textarea>
            <div id="contenuarticle-error" class="error-message error-message-red"></div>

            <label for="datepubliarticle">Date de publication:</label>
            <input type="date" id="datepubliarticle" name="datepubliarticle" placeholder="Select Date of Publication" value="<?php echo date('Y-m-d'); ?>">
            <div id="datepubliarticle-error" class="error-message error-message-red"></div>

            <button type="submit">Submit Article</button>

        </div>

        <div id="article-container"></div>
    </form>

    <script>
         function validateForm() {
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

        var currentDate = new Date();
        var selectedDate = new Date(date);

        if (date.trim() === "") {
            document.getElementById('datepubliarticle-error').innerHTML = 'Date is required';
            isValid = false;
        } else if (selectedDate.toISOString().split('T')[0] !== currentDate.toISOString().split('T')[0]) {
            document.getElementById('datepubliarticle-error').innerHTML = 'Please select the current date';
            isValid = false;
        } else {
            document.getElementById('datepubliarticle-error').innerHTML = 'Done!';
        }

        return isValid;
    }
    </script>
</body>

</html>
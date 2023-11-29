<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../controller/ArticleC.php';
include '../model/Article.php';

$error2 = "";

// create client
$comment = null;

// create an instance of the controller
$commentC = new commentC();
if (
    isset($_POST["contenucomment"])&&
    isset($_POST["datepublicomment"])&& 
	isset($_POST["idarticle"])
) {
    if (
        !empty($_POST["contenucomment"])&&
        !empty($_POST["datepublicomment"]) &&
		!empty($_POST["idarticle"])


    ) {
        $comment = new comment(
            null,
            $_POST['contenucomment'],
            $_POST['datepublicomment'],
			$_POST["idarticle"]

        );

        var_dump($comment);

        if (!empty($idcomment)) {
            $commentC->updatecomment($comment, $idcomment);
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
    if (!empty($_POST['idcomment'])) {
        $comment = $commentC->showcomment($_POST['idcomment']);
    ?>

<div class="comments-container" id="comments<?= $article['idarticle']; ?>">
            <h3>Comments</h3>
            <!-- Add your PHP code here to fetch and display comments for the article -->
            <!-- For demonstration purposes, a simple form is provided for adding comments -->
            <form action="#" method="post">
                <input type="hidden" name="idarticle" value="<?= $article['idarticle']; ?>">
                <textarea class="comment-input" name="contenucomment" placeholder="Add your comment..." required></textarea>
				<?php $comment["idarticle"]=$article["idarticle"];?>
				<label for="datepubliarticle">Date de publication:</label>
<input type="text" id="datepubliarticle" name="datepublicomment" value="<?php echo date('Y-m-d'); ?>" readonly>
<div id="datepubliarticle-error" class="error-message error-message-red"></div>
<?php $comment["datepublicomment"]=$article["datepubliarticle"];?>
                <input type="submit" class="comment-button" value="Add Comment">
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

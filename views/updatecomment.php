<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../controller/ArticleC.php';
include '../model/Comment.php';

$error = "";

// create client
$comment = null;

// create an instance of the controller
$commentC = new commentC();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["idcomment"])) {
    $idcomment = $_POST['idcomment']; // Retrieve comment ID
    $comment = $commentC->showcomment($idcomment);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["contenucomment"]) && isset($_POST["datepublicomment"]) && isset($_POST["idarticle"])) {
    if (!empty($_POST["contenucomment"]) && !empty($_POST["datepublicomment"]) && !empty($_POST["idarticle"])) {
        $idcomment = isset($_POST['idcomment']) ? $_POST['idcomment'] : null; // Retrieve comment ID

        $comment = new comment(
            $idcomment,
            $_POST['contenucomment'],
            $_POST['datepublicomment'],
            $_POST["idarticle"]
        );

        if (!empty($idcomment)) {
            $commentC->updatecomment($comment, $idcomment);
            // header('Location: articlesdb.php'); // Remove this line
            exit();
        } else {
            $error = "Missing comment ID";
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
        html, body {
            margin: 0;
            padding: 0;
        }

        .error-message {
            font-size: 14px;
            margin-top: 5px;
        }

        .error-message-red {
            color: red;
        }
    </style>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <div class="comments-container" style="display: block;">
        <h3>Comments</h3>
        <form action="" method="post">
            <input type="hidden" name="idcomment" value="<?php echo isset($comment["idcomment"]) ? $comment["idcomment"] : ''; ?>">
            <textarea class="comment-input" name="contenucomment" placeholder="Add your comment..."><?php echo isset($comment["contenucomment"]) ? htmlspecialchars($comment["contenucomment"]) : ''; ?></textarea>

            <label for="datepubliarticle">Date de publication:</label>
            <input type="text" id="datepubliarticle" name="datepublicomment" value="<?php echo isset($comment["datepublicomment"]) ? $comment["datepublicomment"] : date('Y-m-d'); ?>" readonly>
            <div id="datepubliarticle-error" class="error-message error-message-red"></div>

            <input type="submit" class="comment-button" value="Update Comment">
        </form>
    </div>

    <script>
        // Add any necessary JavaScript here
    </script>
</body>

</html>

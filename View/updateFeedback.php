<?php

include '../Controller/FeedbackC.php';
include '../Model/Feedback.php';

$error = "";

// create client
$feedback= null;
// create an instance of the controller
$feedbackC = new feedbackC();

if (isset($_POST["date"])  && isset($_POST["commentaire"]))
 {
    if (!empty($_POST['date']) && !empty($_POST["commentaire"]))
     {
        /*foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }*/
        $feedback = new feedback( null, $_POST['date'], $_POST['commentaire']);
        //var_dump($rdv);
        $feedbackC->updateFeedback($feedback, $_POST['idFeedback']);
        header('Location:listFeedback.php');
    } else
        $error = "Missing information";
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <button><a href="listFeedback.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idFeedback'])) {
        $feedback= $feedbackC->showFeedback($_POST['idFeedback']);  
    ?>

        <form action="" method="POST">
            <table>
            <tr>
                    <td><label for="nom">IdFeedback :</label></td>
                    <td>
                        <input type="text" id="idFeedback" name="idFeedback" value="<?php echo $_POST['idFeedback'] ?>" readonly />
                        <span id="erreurIdfeedback" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date">Date :</label></td>
                    <td>
                        <input type="date" id="date" name="date" value="<?php echo $feedback['date'] ?>" />
                        <span id="erreurDate" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="commentaire">feedback:</label></td>
                    <td>
                        <input type="text" id="commentaire" name="commentaire" value="<?php echo $feedback['commentaire'] ?>" />
                        <span id="erreurCommentaire" style="color: red"></span>
                    </td>
                </tr>
                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
</body>

</html>
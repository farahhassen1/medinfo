<?php

include '../Controller/FeedbackC.php';
include '../Model/Feedback.php';
$error = "";

// create client
$feedback= null;

// create an instance of the controller
$feedbackC = new feedbackC();
if (isset($_POST["date"]) && isset($_POST["commentaire"]))
 {
    if (!empty($_POST['date']) && !empty($_POST["commentaire"]))
     {
        $feedback= new feedback( null, $_POST['date'], $_POST['commentaire']);
        $feedbackC->addFeedback($feedback);
        header('Location:listFeedback.php');
    } else
        $error = "Missing information";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {background-color: #f9f8f8; }
        img {border-radius: 8px;}
        .intro{ width:300px;margin:0 auto;}
  </style>
    <title>feedback</title>
</head>

<body>
    <a href="listFeedback.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>
    <h2 style="color:darkblue">Give us your feedback</h2>
    <div>
        <form action="" method="POST">
            <table align="center">
                <tr>
                    <td><label for="date">date :</label></td>
                    <td>
                        <input type="date" id="date" name="date" required/>
                        <span id="erreurdate" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="commentaire">feedback:</label></td>
                    <td>
                        <input type="text" id="commentaire" name="commentaire" />
                        <span id="erreurcommentaire" style="color: red"></span>
                    </td>
                </tr>
            
                <td>
                    <input id="validerButton" type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>
        </form>
    </div>
    <script src="index.js"> </script>
</body>

</html>

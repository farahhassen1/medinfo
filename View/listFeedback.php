<?php
include "../Controller/FeedbackC.php";

$c=new feedbackC();
$tab=$c->listFeedback();
?>

<center>
    <h1>List of feedback</h1>
    <h2>
        <a href="addFeedback.php">Add feedback</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id feedback</th>
        <th>date</th>
        <th>Commentaire</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $feedback) {
    ?>

        <tr>
            <td><?= $feedback['idFeedback']; ?></td>
            <td><?= $feedback['date']; ?></td>
            <td><?= $feedback['commentaire']; ?></td>
            <td align="center">
                <form method="POST" action="updateFeedback.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $feedback['idFeedback']; ?> name="idFeedback">
                </form>
            </td>
            <td>
                <a href="deleteFeedback.php?id=<?php echo $feedback['idFeedback']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
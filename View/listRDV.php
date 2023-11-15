<?php
include "../controller/RDVC.php";

$c = new rdvC();
$tab = $c->listRDV();

?>

<center>
    <h1>List of RDV</h1>
    <h2>
        <a href="addRDV.php">Add rdv</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id rdv</th>
        <th>date</th>
        <th>heure</th>
        <th>Commentaire</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>


    <?php
    foreach ($tab as $rdv) {
    ?>

        <tr>
            <td><?= $rdv['idRDV']; ?></td>
            <td><?= $rdv['date']; ?></td>
            <td><?= $rdv['heure']; ?></td>
            <td><?= $rdv['commentaire']; ?></td>
            <td align="center">
                <form method="POST" action="updateRDV.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $rdv['idRDV']; ?> name="idRDV">
                </form>
            </td>
            <td>
                <a href="deleteRDV.php?id=<?php echo $rdv['idRDV']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
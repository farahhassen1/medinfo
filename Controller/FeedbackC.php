<?php
require '../config.php';
class feedbackC
{
    public function listFeedback()
    {
        $sql = "SELECT * FROM feedback";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    } 
    function deleteFeedback($ide)
    {
        $sql = "DELETE FROM feedback WHERE idFeedback = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function addFeedback($feedback)
    {
        $sql = "INSERT INTO  feedback VALUES (NULL,:date,:commentaire,:rdv)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'date' => $feedback->getDate(),
                'commentaire' => $feedback->getCommentaire(), 
                'rdv' => $feedback->getRDV(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function showFeedback($id)
    {
        $sql = "SELECT * from feedback where idFeedback = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $feedback = $query->fetch();
            return $feedback;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateFeedback($feedback,$id)
    {   
        try {
            $sql ='UPDATE feedback SET date = :date, commentaire = :commentaire ,rdv=:rdv WHERE idFeedback= :id';
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'date' => $feedback->getDate(),
                'commentaire' => $feedback->getCommentaire(),
                'rdv' => $feedback->getRDV(),
            ]); 
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
   
}
?>
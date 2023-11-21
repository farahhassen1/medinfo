<?php

require '../config.php';

class articleC
{

    public function listArticle()
    {
        $sql = "SELECT * FROM article";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteArticle($ide)
    {
        $sql = "DELETE FROM article WHERE idarticle = :idarticle";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idarticle', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addArticle($article)
    {
        $sql = "INSERT INTO article  VALUES (NULL, :datepubliarticle,:titrearticle, :contenuarticle)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'datepubliarticle' => $article->getdatepubliarticle(),
                'titrearticle' => $article->gettitrearticle(),
                'contenuarticle' => $article->getcontenuarticle()
        
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showArticle($idarticle)
    {
        $sql = "SELECT * from article where idarticle = $idarticle";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $article = $query->fetch();
            return $article;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateArticle($article, $idarticle)
    {
        $sql = "UPDATE article SET
                datepubliarticle = :datepubliarticle,
                titrearticle = :titrearticle,
                contenuarticle = :contenuarticle
 
                WHERE idarticle = :idarticle";

        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'datepubliarticle' => $article->getdatepubliarticle(),
                'titrearticle' => $article->gettitrearticle(),
                'contenuarticle' => $article->getcontenuarticle(),

                'idarticle' => $idarticle
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

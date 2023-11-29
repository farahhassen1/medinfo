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

class commentC
{
 
    public function listcomment()
    {
        $sql = "SELECT * FROM comment";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletecomment($ide)
    {
        $sql = "DELETE FROM comment WHERE idcomment = :idcomment";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idcomment', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addcomment($comment)
    {
        $sql = "INSERT INTO comment  VALUES (NULL, :datepublicomment, :contenucomment, :idarticle)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'datepublicomment' => $comment->getdatepublicomment(),
                'contenucomment' => $comment->getcontenucomment(),
                'idarticle' => $comment->getidarticle()
        
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showcomment($idcomment)
    {
        $sql = "SELECT * from comment where idcomment = $idcomment";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $comment = $query->fetch();
            return $comment;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updatecomment($comment, $idcomment)
    {
        $sql = "UPDATE article SET
                datepublicomment = :datepublicomment,
                contenucomment = :contenucomment
 
                WHERE idcomment = :idcomment";

        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'datepublicomment' => $comment->getdatepublicomment(),
                'contenucomment' => $comment->getcontenucomment(),

                'idcomment' => $idcomment
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
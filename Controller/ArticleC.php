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
        $sql = "INSERT INTO article  VALUES (NULL, :datepubliarticle,:titrearticle, :contenuarticle, :id_user)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'datepubliarticle' => $article->getdatepubliarticle(),
                'titrearticle' => $article->gettitrearticle(),
                'contenuarticle' => $article->getcontenuarticle(),
                'id_user' => $article->getiduser()

        
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function name($id)
    {
        $sql = "SELECT * from users where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $reponse = $query->fetch();
            return $reponse;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
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

                'idarticle' => $idarticle->getidarticle()
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

    function name2($id)
    {
        $sql = "SELECT * from users where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $reponse = $query->fetch();
            return $reponse;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
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
        $sql = "SELECT * FROM comment WHERE idcomment = $idcomment";
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $commentData = $query->fetch(PDO::FETCH_ASSOC);
    
            
    
            if ($commentData) {
                return new comment(
                    $commentData['idcomment'],
                    $commentData['contenucomment'],
                    $commentData['datepublicomment'],
                    $commentData['idarticle']
                );
            } else {
                return null;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    public function updatecomment($comment, $idcomment)
    {
        $sql = "UPDATE comment SET
                datepublicomment = :datepublicomment,
                contenucomment = :contenucomment,
                idarticle = :idarticle
                WHERE idcomment = :idcomment";
    
        $db = Config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'datepublicomment' => $comment->getdatepublicomment(),
                'contenucomment' => $comment->getcontenucomment(),
                'idarticle' => $comment->getidarticle(),
                'idcomment' => $idcomment
            ]);
        } catch (Exception $e) {
            echo 'Database Error: ' . $e->getMessage();
        }
    }
    
}
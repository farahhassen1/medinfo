<?php
include_once '../model/comment.php';
include_once "../controller/ArticleC.php";
include_once '../model/Article.php';

$error = "";
$comment = null;
$commentC = new commentC();
$c = new ArticleC();
$tab = $c->listArticle();

if (isset($_GET['idcomment'])) {
    $commentData = $commentC->showcomment($_GET['idcomment']);
    if ($commentData) {
        $comment = new comment(
            $commentData['idcomment'],
            $commentData['contenucomment'],
            $commentData['datepublicomment'],
            $commentData['idarticle']
        );
    } else {
        echo "<p>Comment not found</p>";
    }
}

if (
    isset($_POST["datepublicomment"]) &&
    isset($_POST["contenucomment"]) &&
    isset($_POST["idarticle"]) &&
    isset($_POST["idcomment"])
) {
    if (
        !empty($_POST['datepublicomment']) &&
        !empty($_POST['contenucomment']) &&
        !empty($_POST['idarticle']) &&
        !empty($_POST['idcomment'])
    ) {
        $idcomment = $_POST['idcomment'];
        $comment = $commentC->showcomment($idcomment);

        if (!$comment) {
            echo "Comment not found";
        } else {
            $comment->setdatepublicomment(date('Y-m-d H:i:s', strtotime($_POST['datepublicomment'])));
            $comment->setcontenucomment($_POST['contenucomment']);
            $comment->setidarticle($_POST['idarticle']);

            $commentC->updatecomment($comment, $idcomment);
            header('Location: displayArticles.php');
        }
    } else {
        $error = "Missing information";
    }
}


?>


<html
  lang="en"
  >


  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Update Comment</title>

   


  
  </head>



  <body>

  <style>
      

      .container-form {
          max-width: 600px; /* Set the maximum width of the form container */
          margin: auto; /* Center the container */
          padding: 20px; /* Add some padding for better visual */
          background-color: #fff; /* Set a background color */
          border-radius: 10px; /* Add rounded corners */
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
      }
      #error {
          color: #ff5555; /* Bright red color */
          font-weight: bold;
          margin-bottom: 10px;
          position: fixed;
          top: 0;
          left: 50%;
          transform: translateX(-50%);
          animation: slideInDown 0.5s ease;
      }
      
      form {
          max-width: 600px;
          margin: 20px auto;
          padding: 20px;
          background: rgba(255, 255, 255, 0.9); /* Slightly transparent white background */
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          border-radius: 8px;
          position: relative;
          animation: fadeIn 0.5s ease;
      }
      
      label {
          display: block;
          margin-bottom: 8px;
          font-weight: bold;
      }
      
      input,
      textarea,
      button {
          width: 100%;
          padding: 10px;
          margin-bottom: 15px;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
          font-size: 16px;
      }
      
      input::placeholder,
      textarea::placeholder {
          color: #999;
      }
      
      button {
          background-color: #4c9daf;
          color: #fff;
          cursor: pointer;
          transition: background-color 0.3s ease;
      }
      
      button:hover {
          background-color: #1bd5ff;
      }
      
      a {
          text-decoration: none;
          color: #333;
          transition: color 0.3s ease;
      }
      
      a:hover {
          color: #4c9daf;
      }
      
      hr {
          margin-top: 20px;
          margin-bottom: 20px;
          border: 0;
          border-top: 1px solid #ddd;
      }
      
      
      
              .error-message {
                  font-size: 14px;
                  margin-top: 5px;
                  color: red;
              }
      
              .success-message {
                  font-size: 14px;
                  margin-top: 5px;
                  color: green;
              }
          </style>
                <?php
                if (isset($_POST['idcomment'])) {
                    $comment = $commentC->showcomment($_POST['idcomment']);
                    if ($comment) { // Check if $comment is not null
                ?>
                    <form class="form-container" action="" method="POST">
    <input type="hidden" name="idcomment" value="<?php echo $comment->getidcomment(); ?>">
    <input type="hidden" name="idarticle" value="<?php echo $comment->getidarticle(); ?>">
    <div class="form-container">
    <div class="row mb-3">
    <h5 class="mb-0">Modifiez commentaire </h5>
        <label class="col-sm-2 col-form-label" for="contenucomment">Comment:</label>
        <div class="col-sm-10">
            
            <input class="form-control" id="basic-default-author" name="datepublicomment" value="<?php echo $comment->getdatepublicomment(); ?>" />
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="datepublicomment">Date de Publication:</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="basic-default-name" name="contenucomment" value="<?php echo $comment->getcontenucomment(); ?>" readonly />
        </div>
    </div>
    <div class="row justify-content-end">
        
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" name="update_commentaire">Update</button>
        </div>
        <div class="col-sm-2">
            <a href="displayArticles.php" class="btn btn-primary">Cancel</a>
        </div>
    </div>
                    </div>
</form>
<?php
        if (isset($_POST['idcomment']) && isset($_POST['update_commentaire'])) {
            // This block will only execute if the form is submitted
            $idcomment = isset($_POST['idcomment']) ? $_POST['idcomment'] : '';
            $contenucomment = isset($_POST['contenucomment']) ? $_POST['contenucomment'] : '';
            $datepublicomment = isset($_POST['datepublicomment']) ? $_POST['datepublicomment'] : '';
            $idarticle = isset($_POST['idarticle']) ? $_POST['idarticle'] : '';
        
            $updatedcomment = new comment($idcomment, $contenucomment, $datepublicomment, $idarticle);
        
            $commentC->updatecomment($updatedcomment, $idcomment);
            header('Location: displayArticles.php');
        }
        
?>
<?php
    } else {
        echo "<p>Post not found</p>";
    }
}
?>
            
  

            </body>
            </html>
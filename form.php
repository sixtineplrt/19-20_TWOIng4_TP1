<?php
  $nom  = isset($_POST["Nom"]) ? $_POST["Nom"] : "";
  $email = isset($_POST["MDP"]) ? $_POST[""] : "";

  //connexion à la base de données
  //identifier votre BDD
  $database  = "AMAZON";

  //connectez-vous dans votre BDD
  $db_handle = mysqli_connect('localhost', 'root', 'root');
  $db_found  = mysqli_select_db($db_handle, $database);

  if(isset($_POST["Login"])){
    
    if($db_found){

      $sql = "SELECT * FROM Vendeur";
      
      if ($identifiant != "") {
        //on cherche le livre avec les paramètres titre et auteur
        $sql .= " WHERE Pseudo LIKE '%$identifiant%'";
      }
      if ($mdp != "") {
        $sql .= " AND MDP LIKE '%$mdp%'";
      }
    
      $result = mysqli_query($db_handle, $sql);

      //regarder s'il y a de résultat
      if (mysqli_num_rows($result) == 0) {
        //le livre est déjà dans la BDD
                ?>
                <style type="text/css">
                    h2{
                        text-align: center;
                        color: grey;
                        margin-top: 100px;
                        background: #C8D8EA;
                        font-size: 30px;
                    }
                    body{
                        background: #C8D8EA;
                        font-family: Arial, Helvetica, sans-serif;
                    }
                    a{
                        text-decoration: none;
                        text-align: center;
                        border: solid 1px black;
                        border-radius: 5px;
                        padding: 10px;
                        cursor: pointer;
                        background-color: grey;
                        margin-left: 30px;
                    }
                    div{
                        width: 100%;
                        margin-left: 43%;
                    }
                </style>
                <h2>Vous n'avez pas encore de compte chez nous.. <br> Inscrivez-vous dès maintenant !</h2>
                <div><a href="mainPage.html">Retour</a></div>
                
                <?php    
      }
      
      else {
        while ($data = mysqli_fetch_assoc($result)) {
          $sql ="UPDATE Vendeur SET Connecte='oui' WHERE Pseudo='$identifiant'";
          $result = mysqli_query($db_handle, $sql);
          header('Location: connectPage.php');
        }
      }
    }
    else {
      echo "Not found!";
    }
  }
?>
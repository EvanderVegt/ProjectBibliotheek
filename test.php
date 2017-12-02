<?php include 'General.php';
    $myDate = date("d-m-Y H:i:s");
    $conn = connectionDB();
?>

<html>
    <head>
        <header>Bewerken</header>
            <link rel = "stylesheet" type = "text/css" href="bibliotheek.css">
                <script src="javascript.js" type="text/javascript"></script>
                    <meta charset="UTF-8">
                        <title>Toevoegen</title>
                            <nav>
                                <div class="topnav" id="myTopnav">
                                    <a href="index.php" class="active">Home</a>
                                    <a href="toevoegen.php"> Toevoegen </a>
                                    <a href="bibliotheek.php"> Bibliotheek </a>
                                    <a href="#notities">Notities </a>
                                </div>
                            </nav>
                                    <style>
                                        #layout{
                                            width:100%;
                                            height:200px;
                                        }
                                        #linker{
                                            width:50%;
                                        }
                                        #rechter{

                                        }
                                    </style>
    </head>
    <body>
        <table id="layout" border="1">
            
            
            <tr><td id="linker">
<?PHP
                    
                        if (isset($_POST['delete']) && isset($_POST['Titel'])) {
        $titel = get_post($conn, 'Titel');
        print_r($titel);
        $query = "DELETE FROM `evdv_boek` WHERE Titel='$titel'";
        $result = $conn->query($query);
        //print_r($titel);
        if (!$result)
            echo "DELETE failed: $query<br>" .
            $conn->error . "<br><br>";
    }

    if (isset($_POST['Titel']) &&
            isset($_POST['Auteur']) &&
            isset($_POST['Isbn']) &&
            isset($_POST['Uitgever']) &&
            isset($_POST['Categorie']) &&
            isset($_POST['Ranking'])) {
        $titel = get_post($conn, 'Titel');
        $auteur = get_post($conn, 'Auteur');
        $isbn = get_post($conn, 'Isbn');
        $uitgever = get_post($conn, 'Uitgever');
        $categorie = get_post($conn, 'Categorie');
        $ranking = get_post($conn, 'Ranking');
        $query = "INSERT INTO `evdv_boek`"
                . "(`Invoerdatum`, `Titel`, `Auteur`, `Isbn`, `Uitgever`, `Categorie`, `Ranking`)"
                . " VALUES ('" . $myDate . "','" . $titel . "','" . $auteur . "','"
                . $isbn . "','" . $uitgever . "','" . $categorie . "','" . $ranking . "')";
        $result = $conn->query($query);



        if (!$result)
            echo "INSERT failed: $query<br>" .
            $conn->error . "<br><br>";
    }

    echo <<<_END
  <form action="toevoegen.php" method="post"><pre>

       Titel <input type="text" name="Titel" required>
      Auteur <input type="text" name="Auteur" required>
         ISBN<input type="text" name="Isbn" required>
     Uitgever<input type="text" name="Uitgever" required>
    Categorie<input type="text" name="Categorie" required>
      Ranking<input type="text" name="Ranking" required>
           <input class="button" type="submit" value="Voeg boek toe">
  </pre></form>
_END;

                    
                    

                    
                    
                    
?>  
                </td><td id="rechter">
                    
<?PHP
    $query = "SELECT * FROM `evdv_boek`";
    $result = $conn->query($query);
    if (!$result)
        die("Database access failed: " . $conn->error);

    $rows = $result->num_rows;

    for ($j = 0; $j < $rows; ++$j) {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_NUM);

        echo <<<_END
  <pre>
    Boek_id $row[0]
Invoerdatum $row[1]
      Titel $row[2]
     Auteur $row[3]
       Isbn $row[4]
   Uitgever $row[5]
  Categorie $row[6]
    Ranking $row[7]
  </pre>
_END;
    ?>
    
    
      <div id="verwijderBoek">
 <?PHP
  echo createTagSelect($conn, "Titel");
  print_r($row);
  echo '<form name="eriksselectboek" action="toevoegen.php" method="post">';
  echo '<input type="hidden" name="delete" value="yes">';
  echo "<input type='hidden' name='Titel' value='" . $row['2'] ."'>"; 
  echo '<input class="button" type="submit" value="Verwijder boek"></form>';
     ?>   
     </div>
 <?php
 
   }
                    
                    

                
                
?>              
                </td></tr>

        </table>
<?PHP
            $result->close();
    $conn->close();

    function get_post($conn, $var) {
        return $conn->real_escape_string($_POST[$var]);
    }
?>
    

        
        
    </body>
</html>

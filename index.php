<?php include 'General.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Bibliotheek info</title>
                    <link rel = "stylesheet" type = "text/css" href="bibliotheek.css">
                    <script src="javascript.js" type="text/javascript"></script>
                        <nav>
                            <header>Bibliotheek info Pagina</header>
                                <div class="topnav" id="myTopnav">
                                    <a href="index.php" class="active">Home</a>
                                    <a href="toevoegen.php"> Toevoegen </a>
                                    <a href="bibliotheek.php"> Bibliotheek </a>
                                    <a href="notities.PHP">Notities </a>
                                </div>
                        </nav>
    </head>
<body text="white">

    <?php
    
        $conn = connectionDB();

//-----Notities toevoegen-------------------------------------------------------

        if (isset($_POST['Notitie'])) {
            $notities = get_post($conn, 'Notitie');
            $boek_id = get_post($conn, 'boek');
            $query = "INSERT INTO `evdv_notitie`" . "(`Notitie_id`, `Notitie`, `Boek_id`)"
                . " VALUES (NULL,'" . $notities . "', '" . $boek_id . "')";
            
                echo $query;
                
                    $result = $conn->query($query);

        if (!$result)
            echo "INSERT failed: $query<br>" .
            $conn->error . "<br><br>";
         }
    ?>
    
        <div id="input notitie">
            
    <?php
        
//-----Notities (Titel selecteren-Text invoeren en verzenden--------------------
//-----MySql invoerveld "Titel" instellen op VARCHAR 45-------------------------

            echo "<form id=\"invoerText\" action=\"index.php\" method=\"post\"><pre>";
            echo '                                                   '
            . '                                              Kies de titel van een boek  ';
            echo createTagSelect($conn, "Titel");
            echo '<br>                                                               '
            . '                         voer een bladzijde nr. en notitie in '
            . '<textarea type="text" name="Notitie" cols="50" rows="3" style="width:'
                    . ' 320px; height: 50px;" required>Bladzijde : '
                    . '                                Notitie   :</textarea>   ';
            echo '<br>                                                                                '
            . '                                                                           '
                    . '    <input class="button" type="submit" value="Verzenden">';
            echo '</pre></form>';
    ?>
        </div>
    
    <?php
    
             $sql = "SELECT * FROM `evdv_boek` ORDER BY `Invoerdatum` DESC LIMIT 1";
             $result = $conn->query($sql);
    ?>
    
        <div id="laatst">
            
    <?php
    
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<br> Op " . $row["Invoerdatum"] . "<br> is als laatst een boek (" . $row['Titel'] . ") " .
                        "<br> van de schrijver " . $row["Auteur"] . " aan de bibliotheek toegevoegd.<br>";
            }
                } else {
                    echo "0 results";
                        }
                        
    ?>
            
        </div>
    
    <?php
    
                 $sql = "SELECT * FROM evdv_boek INNER JOIN evdv_notitie ON evdv_boek.Boek_id = evdv_notitie.Boek_id ORDER BY `Notitie_id` DESC LIMIT 1";
             $result = $conn->query($sql);
    ?>
    
        <div id="laatst">
            
    <?php
    
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<br>Het laatst toegevoegde notitie in de Bibliotheek is:<br> " . $row['Notitie'] . " " .
                        "<br>behorende bij het boek " . $row["Titel"] . ".<br>";
            }
                } else {
                    echo "0 results";
                        }
                        
    ?>
            
        </div>
    <?php
    
            $result->close();
            $conn->close();

            function get_post($conn, $var) {
            return $conn->real_escape_string($_POST[$var]);
            }
    ?>

</body>
</html>

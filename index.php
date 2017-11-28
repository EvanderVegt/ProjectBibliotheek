<?php include 'General.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bibliotheek info</title>
        <link rel = "stylesheet" type = "text/css" href="bibliotheek.css">


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
            
    
 
    $conn = connectionDB();    // Call for a PHP function // We can not find it on this page SO it must be on the shared page generalfunctions.php








 
    
    
    
    //-----Notities verwijderen-------------------------------------------------
//    
//    if (isset($_POST['delete']) && isset($_POST['Boek_id'])) {
//        $notitie_id = get_post($conn, 'Boek_id');
//        $query = "DELETE FROM `notitie` WHERE `notitie`.`Notitie_id`='$notitie_id'";
//        $result = $conn->query($query);
//        if (!$result)
//            echo "DELETE failed: $query<br>" .
//            $conn->error . "<br><br>";
//    }
    //-----Notities toevoegen---------------------------------------------------
    
    if (isset($_POST['Notitie'])) {
        $notities = get_post($conn, 'Notitie');
        $boek_id = get_post($conn, 'boek');
        $query = "INSERT INTO `notitie`" . "(`Notitie_id`, `Notitie`, `Boek_id`)" . " VALUES (NULL,'" . $notities . "', '" . $boek_id . "')";
        echo $query;
        $result = $conn->query($query);

        if (!$result)
            echo "INSERT failed: $query<br>" .
            $conn->error . "<br><br>";
    }
    ?>
<div id="input notitie">
    <?php
    //-----Notities (Titel selecteren-Text invoeren en verzenden----------------
    //-----MySql invoerveld "Titel" instellen op VARCHAR 45---------------------
    echo "<form id=\"invoerText\" action=\"index.php\" method=\"post\"><pre>";
    echo '                                                   '
    . '                                              Kies de titel van een boek  ';
    echo createTagSelect($conn, "Titel"); // THE FUNCTION is being Echoed VERY important because the string is in the function returned NOT echoed // 
    echo '<br>                                                                                        voer een bladzijde nr. en notitie in '
    . '<textarea type="text" name="Notitie" cols="50" rows="3" style="width: 320px; height: 50px;" required>Bladzijde :                                 Notitie   :</textarea>   ';
    echo '<br>                                                                                                                                                               <input type="submit" value="Verzenden">';
    echo '</pre></form>'; 
 ?>
</div>
<?php
$sql = "SELECT * FROM `boek` ORDER BY `Invoerdatum` DESC LIMIT 1";

$result = $conn->query($sql);
?>
    <div id="laatst">
        <?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> Op ". $row["Invoerdatum"]. " is als laatst een boek (". $row['Titel'].") " .
                "<br> van de schrijfer ". $row["Auteur"]. " aan de bibliotheek toegevoegd.<br>";
    }
} else {
    echo "0 results";
}
?>
    </div>
    <?php
//    
//        $query = "SELECT * FROM `boek`";
//    $result = $conn->query($query);
//    if (!$result)
//        die("Database access failed: " . $conn->error);
//
//    $rows = $result->num_rows;
//
//    for ($j = 0; $j < $rows; ++$j) {
//        $result->data_seek($j);
//        $row = $result->fetch_array(MYSQLI_NUM);
//
//        echo <<<_END
//  <pre>
//           Boek_id $row[0]
//       Invoerdatum $row[1]
//             Titel $row[2]
//            Auteur $row[3]
//              Isbn $row[4]
//          Uitgever $row[5]
//         Categorie $row[6]
//           Ranking $row[7]
//  </pre>
//
//_END;
//    }

    $result->close();
    $conn->close();

    function get_post($conn, $var) {
        return $conn->real_escape_string($_POST[$var]);
    }
    ?>

</body>
</html>

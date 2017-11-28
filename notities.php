<?php include 'General.php';
?>

<html>
   <head>
        <header>Notities</header>
            <link rel = "stylesheet" type = "text/css" href="bibliotheek.css">
                <meta charset="UTF-8">
                    <title>Notities</title>
                        <nav>
                            <div class="topnav" id="myTopnav">
                                <a href="index.php" class="active">Home</a>
                                <a href="toevoegen.php"> Toevoegen </a>
                                <a href="bibliotheek.php"> Bibliotheek </a>
                                <a href="notities.php">Notities </a>
                            </div>
                        </nav>
    </head>
<body>
    <?php
    $conn = connectionDB();
      if ($conn->connect_error) die($conn->connect_error);

 //------Haalt de data van de Titel uit tafel boek------------------------------

    $query2 = "SELECT * FROM `boek`";
    $result2 = $conn->query($query2);
    if (!$result2)
        die("Database access failed: " . $conn->error);

    $rows2 = $result2->num_rows;

    for ($h = 0; $h < $rows2; ++$h) {
        $result2->data_seek($h);
        $row2 = $result2->fetch_array(MYSQLI_NUM);

 //------Haalt de data van Notitie uit tafel notitie----------------------------   

        $query = "SELECT * FROM `notitie`";
        $result = $conn->query($query);
        if (!$result)
            die("Database access failed: " . $conn->error);

        $rows = $result->num_rows;

        for ($j = 0; $j < $rows; ++$j) {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_NUM);
            ?>
                <div id="notities" class="center">
                    
            <?php
            
                echo "Titel     : " . $row2[2];
                echo "Notitie_id: " . $row[0];
                echo "Notitie   : " . $row[1];
            ?>

                    <form action="notities.php" method="post">
                        <input type="hidden" name="delete" value="yes">
                        <input type="hidden" name="Notitie_id" value="$row[0]">
                        <input class="button" type="submit" value="Notitie verwijden">
                    </form>
            <?php
                 }
            }
  

              $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
            ?>
                </div>
</body>   
</html>


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
      
        if (isset($_POST['delete']) && isset($_POST['Notitie_id'])) {
        $notitie_id = get_post($conn, 'Notitie_id');
        print_r($notitie_id);
        $query = "DELETE notitie FROM boek INNER JOIN notitie ON boek.Boek_id"
                . " = notitie.Boek_id WHERE notitie.Notitie_id='$notitie_id'";

        $result = $conn->query($query);
        if (!$result)
            echo "DELETE failed: $query<br>" .
            $conn->error . "<br><br>";
        }

                 

 //------Haalt de data van Notitie uit tafel notitie----------------------------   

        $query = "SELECT * FROM boek INNER JOIN notitie ON boek.Boek_id = notitie.Boek_id";
        $result = $conn->query($query);
        if (!$result)
            die("Database access failed: " . $conn->error);

        $rows = $result->num_rows;
                
        for ($j = 0; $j < $rows; ++$j) {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_NUM);

        echo <<<_END
  <pre><div id="notities" class="center">

     Titel :$row[2]
Notitie_id :$row[8]
 $row[9]

  </pre>
  <form action="notities.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="Notitie_id" value='"$row[8]"'>
  <input class="button" type="submit" value="Verwijderen"></form></div>

_END;
    }

    $result->close();
    $conn->close();

    function get_post($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
    }
    ?>
    

</body>
</html>


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

    //------Haalt de data van de Titel uit tafel boek------------------------------

    $query = "SELECT * FROM `boek`";
    $result = $conn->query($query);
    if (!$result)
        die("Database access failed: " . $conn->error);

    $rows = $result->num_rows;

    for ($h = 0; $h < $rows; ++$h) {
        $result->data_seek($h);
        $row = $result->fetch_array(MYSQLI_NUM);

        //------Haalt de data van Notitie uit tafel notitie----------------------------   

        $query = "SELECT * FROM `notitie`";
        $result = $conn->query($query);
        if (!$result)
            die("Database access failed: " . $conn->error);

        $rows = $result->num_rows;

        for ($j = 0; $j < $rows; ++$j) {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_NUM);
            echo <<<_END
<pre>
    Titel     : $row[2]    
    Notitie_id: $row[0]
    Notitie   : $row[1]


</pre>
    <form action="index.php" method="post">
    <input type="hidden" name="delete" value="yes">
    <input type="hidden" name="Boek_id" value="$row[0]">
    <input type="submit" value="DELETE RECORD"></form>
_END;
        }
    }
    ?>
</body>   
</html>


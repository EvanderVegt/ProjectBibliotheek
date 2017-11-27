<?php include 'General.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bibliotheek info</title>
        <link rel = "stylesheet" type = "text/css" href="bibliotheek.css">
        <script>
            function letsgo() {
                var te = document.getElementById("eriksselect").value;
                alert(te);

            }
        </script>

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

<body>

    <?php
    $conn = connectionDB();    // Call for a PHP function // We can not find it on this page SO it must be on the shared page generalfunctions.php
 
    if (isset($_POST['delete']) && isset($_POST['Boek_id'])) {
        $notitie_id = get_post($conn, 'Boek_id');
        $query = "DELETE FROM `notitie` WHERE `notitie`.`Notitie_id`='$notitie_id'";
        $result = $conn->query($query);
        if (!$result)
            echo "DELETE failed: $query<br>" .
            $conn->error . "<br><br>";
    }

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


        echo "<form action=\"index.php\" method=\"post\"><pre>";
        echo createTagSelect($conn, "Titel"); // THE FUNCTION is being Echoed VERY important because the string is in the function returned NOT echoed // 


  
         echo '<textarea  type="text" name="Notitie" cols="50" rows="3" style="width: 300px; height: 50px;" required></textarea><br><br>';
         echo '<input type="submit" value="Verzenden">';
         echo '</pre></form>';
    




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
    Notitie_id: $row[0]
    Notitie   : $row[1]

</pre>
    <form action="index.php" method="post">
    <input type="hidden" name="delete" value="yes">
    <input type="hidden" name="Boek_id" value="$row[0]">
    <input type="submit" value="DELETE RECORD"></form>
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

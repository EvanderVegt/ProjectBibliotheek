<?php

function connectionDB() {

    $hostname = 'localhost';
    $databasenaam = 'projectbibliotheek';
    $username = 'root';
    $password = '';

    $conn = new mysqli($hostname, $username, $password, $databasenaam);
    return $conn;
}

function createtable($conn) {


    $sql = "SELECT evdv_boek.Boek_id, evdv_boek.Invoerdatum, evdv_boek.Titel, evdv_boek.Auteur,
        evdv_boek.Isbn, evdv_boek.Uitgever, evdv_boek.Categorie, evdv_boek.Ranking, evdv_notitie.Notitie
FROM evdv_boek
LEFT JOIN evdv_notitie ON evdv_boek.Boek_id = evdv_notitie.boek_id;";
    $result = $conn->query($sql);
    echo "<table id=customers>";
    $TR = "<tr>";
    for ($x = 0; $x < 1; $x++) {
        echo"<th>";
        echo"Boeknr.";
        echo"</th>";
        echo"<th>";
        echo"Invoerdatum";
        echo"</th>";
        echo"<th>";
        echo"Titel";
        echo"</th>";
        echo"<th>";
        echo"Auteur";
        echo"</th>";
        echo"<th>";
        echo"ISBN";
        echo"</th>";
        echo"<th>";
        echo"Uitgever";
        echo"</th>";
        echo"<th>";
        echo"Categorie";
        echo"</th>";
        echo"<th>";
        echo"Ranking";
        echo"</th>";
        echo"<th>";
        echo"Notitie";
        echo"</th>";
    }
    for ($x = 0; $x < $result->num_rows; $x++) {
        $row = $result->fetch_assoc();
        echo "<tr>";
        echo "<td>";
        echo $row['Boek_id'];
        echo "</td>";
        echo "<td>";
        echo $row['Invoerdatum'];
        echo "</td>";
        echo "<td>";
        echo $row['Titel'];
        echo "</td>";
        echo "<td>";
        echo $row['Auteur'];
        echo "</td>";
        echo "<td>";
        echo $row['Isbn'];
        echo "</td>";
        echo "<td>";
        echo $row['Uitgever'];
        echo "</td>";
        echo "<td>";
        echo $row['Categorie'];
        echo "</td>";
        echo "<td>";
        echo $row['Ranking'];
        echo "</td>";
        echo "<td>";
        echo $row['Notitie'];
        echo "</td>";
        echo "</tr>";
    }
    echo"</tr>";
    echo "<table id=customers>";
    return$TR;
}

function createTagSelect($conn) {
    $sql = "SELECT * FROM `evdv_boek`;";

    $erinResultSet = $conn->query($sql);

    $eruit = "<select id=eriksselectboek onchange=letsgaan() name=boek >";
    for ($x = 0; $x < $erinResultSet->num_rows; $x++) {
        $row = $erinResultSet->fetch_assoc();
        $eruit .= "<option value=" . $row['Boek_id'] . ">";
        $eruit .= $row['Titel'];
        $eruit .= "</option>";
    }
    $eruit .= "</select>";
    return $eruit;
}

function get_post($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
}
?> 

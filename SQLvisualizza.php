<?php

function SQLvisualizza() {
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:copertine.sqlite3');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Select all data from memory db messages table 
        $result = $file_db->query('SELECT * FROM copertine ORDER BY id DESC LIMIT 10');

        foreach ($result as $row) {
            echo "<tr><th scope='row'>" . $row['id'] . "</th>\n";
            switch ($row['tipologia'])
            {
                case 0:
                   echo "<td>" . "Senza alette" . "</td>\n"; 
                    break;
                case 1:
                   echo "<td>" . "Con alette" . "</td>\n"; 
                    break; 
            }
            echo "<td>" . $row['larghezza'] . "</td>\n";
            echo "<td>" . $row['altezza'] . "</td>\n";
            echo "<td>" . $row['dorso'] . "</td>\n";
            echo "<td>" . $row['abbondanza'] . "</td>\n";
            echo "<td>" . $row['taglio'] . "</td>\n";
            echo "<td>" . $row['aletta'] . "</td></tr>\n";
        }
        
        // Close file db connection
        $file_db = null;
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}
?>

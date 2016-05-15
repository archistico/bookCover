<?php

function SQLconta() {
    try {
        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:copertine.sqlite3');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Conta il numero di copertine create
        $resultset = $file_db->query("SELECT COUNT(*) FROM copertine");
        echo $resultset->fetchColumn();

        // Close file db connection
        $file_db = null;
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}

?>

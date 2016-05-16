<?php

function SQLaggiungi($tip, $lar, $alt, $dor, $abb, $tag, $mar, $ale, $isb) {
    try {

        // Create (connect to) SQLite database in file
        $file_db = new PDO('sqlite:copertine.sqlite3');
        // Set errormode to exceptions
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create table messages
        $file_db->exec("CREATE TABLE IF NOT EXISTS copertine (
                    id INTEGER PRIMARY KEY,
                    tipologia INTEGER,
                    larghezza INTEGER, 
                    altezza INTEGER, 
                    dorso INTEGER, 
                    abbondanza INTEGER, 
                    taglio INTEGER, 
                    margine INTEGER,
                    aletta INTEGER,
                    isbn INTEGER)");

        // Array with some test data to insert to database             
        $copertina = array(
            array('tipologia' => $tip,
                'larghezza' => $lar,
                'altezza' => $alt,
                'dorso' => $dor,
                'abbondanza' => $abb,
                'taglio' => $tag,
                'margine' => $mar,
                'aletta' => $ale,
                'isbn' => $isb
            )
        );

        /**************************************
         * Play with databases and tables     *
         **************************************/

        // Prepare INSERT statement to SQLite3 file db
        $insert = "INSERT INTO copertine (tipologia, larghezza, altezza, dorso, abbondanza, taglio, margine, aletta, isbn) 
                VALUES (:tipologia, :larghezza, :altezza, :dorso, :abbondanza, :taglio, :margine, :aletta, :isbn)";
        $stmt = $file_db->prepare($insert);

        // Bind parameters to statement variables
        $stmt->bindParam(':tipologia', $tipologia);
        $stmt->bindParam(':larghezza', $larghezza);
        $stmt->bindParam(':altezza', $altezza);
        $stmt->bindParam(':dorso', $dorso);
        $stmt->bindParam(':abbondanza', $abbondanza);
        $stmt->bindParam(':taglio', $taglio);
        $stmt->bindParam(':margine', $margine);
        $stmt->bindParam(':aletta', $aletta);
        $stmt->bindParam(':isbn', $isbn);

        // Loop thru all messages and execute prepared insert statement
        foreach ($copertina as $c) {
            // Set values to bound variables
            $tipologia = $c['tipologia'];
            $larghezza = $c['larghezza'];
            $altezza = $c['altezza'];
            $dorso = $c['dorso'];
            $abbondanza = $c['abbondanza'];
            $taglio = $c['taglio'];
            $margine = $c['margine'];
            $aletta = $c['aletta'];
            $isbn = $c['isbn'];
            
            // Execute statement
            $stmt->execute();
        }

        // Close file db connection
        $file_db = null;
    } catch (PDOException $e) {
        // Print PDOException message
        echo $e->getMessage();
    }
}
?>
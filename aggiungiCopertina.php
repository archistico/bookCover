<?php
 
  // Set default timezone
  date_default_timezone_set('UTC');
 
  try {
    /**************************************
    * Create databases and                *
    * open connections                    *
    **************************************/
 
    // Create (connect to) SQLite database in file
    $file_db = new PDO('sqlite:copertine.sqlite3');
    // Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION);
 
    /**************************************
    * Create tables                       *
    **************************************/
 
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
                    aletta INTEGER)");
 
    /**************************************
    * Set initial data                    *
    **************************************/
 
    // Array with some test data to insert to database             
    $copertina = array(
                  array('tipologia' => 1,
                        'larghezza' => 150,
                        'altezza' => 210,
                        'dorso' => 10,
                        'abbondanza' => 5,
                        'taglio' => 3,
                        'margine' => 10,
                        'aletta' => 70
                      )
                );
 
    /**************************************
    * Play with databases and tables      *
    **************************************/
 
    // Prepare INSERT statement to SQLite3 file db
    $insert = "INSERT INTO copertine (tipologia, larghezza, altezza, dorso, abbondanza, taglio, margine, aletta) 
                VALUES (:tipologia, :larghezza, :altezza, :dorso, :abbondanza, :taglio, :margine, :aletta)";
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
      
      // Execute statement
      $stmt->execute();
    }
 
    // Select all data from memory db messages table 
    $result = $file_db->query('SELECT * FROM copertine');
 
    foreach($result as $row) {
      echo "Id: " . $row['id'] . "\n" . "</br>";
      echo "Tipologia: " . $row['tipologia'] . "\n" . "</br>";
      echo "Larghezza: " . $row['larghezza'] . "\n" . "</br>";
      echo "Altezza: " . $row['altezza'] . "\n" . "</br>";
      echo "\n" . "</br>" . "</br>";
    }

    /**************************************
    * Close db connections                *
    **************************************/
 
    // Close file db connection
    $file_db = null;
  }
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
?>

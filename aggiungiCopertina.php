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
                    larghezza INTEGER, 
                    altezza INTEGER, 
                    dorso INTEGER, 
                    abbondanza INTEGER, 
                    taglio INTEGER, 
                    margineInterno INTEGER)");
 
    /**************************************
    * Set initial data                    *
    **************************************/
 
    // Array with some test data to insert to database             
    $messages = array(
                  array('title' => 'Hello!',
                        'message' => 'Just testing...',
                        'time' => 1327301464),
                  array('title' => 'Hello again!',
                        'message' => 'More testing...',
                        'time' => 1339428612),
                  array('title' => 'Hi!',
                        'message' => 'SQLite3 is cool...',
                        'time' => 1327214268)
                );
 
 
    /**************************************
    * Play with databases and tables      *
    **************************************/
 
    // Prepare INSERT statement to SQLite3 file db
    $insert = "INSERT INTO messages (title, message, time) 
                VALUES (:title, :message, :time)";
    $stmt = $file_db->prepare($insert);
 
    // Bind parameters to statement variables
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':time', $time);
 
    // Loop thru all messages and execute prepared insert statement
    foreach ($messages as $m) {
      // Set values to bound variables
      $title = $m['title'];
      $message = $m['message'];
      $time = $m['time'];
 
      // Execute statement
      $stmt->execute();
    }
 
    // Select all data from memory db messages table 
    $result = $memory_db->query('SELECT * FROM messages');
 
    foreach($result as $row) {
      echo "Id: " . $row['id'] . "\n" . "</br>";
      echo "Title: " . $row['title'] . "\n" . "</br>";
      echo "Message: " . $row['message'] . "\n" . "</br>";
      echo "Time: " . $row['time'] . "\n" . "</br>";
      echo "\n" . "</br>" . "</br>";
    }
  
    /**************************************
    * Drop tables                         *
    **************************************/
 
    // Drop table messages from file db
    // $file_db->exec("DROP TABLE messages");
 
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

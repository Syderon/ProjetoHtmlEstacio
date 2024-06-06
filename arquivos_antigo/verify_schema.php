<?php
try {
    $dbPath = realpath('banco_anime.db');
    if ($dbPath === false) {
        throw new Exception('Database file not found.');
    }

    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verify the table schema
    $query = "PRAGMA table_info(anime)";
    $result = $db->query($query);
    $columns = $result->fetchAll(PDO::FETCH_ASSOC);

    echo "Current Schema of 'anime' table:<br>";
    foreach ($columns as $column) {
        echo $column['name'] . " (" . $column['type'] . ")<br>";
    }
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "General Error: " . $e->getMessage();
}
?>
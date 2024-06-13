<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $dbPath = realpath('banco_anime.db');
        if ($dbPath === false) {
            throw new Exception('Database file not found.');
        }

        $db = new PDO('sqlite:' . $dbPath);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $anime_id = $_POST['anime_id'];

        $stmt = $db->prepare("DELETE FROM anime WHERE id = ?");
        $stmt->execute([$anime_id]);

        echo "Anime deleted successfully. <a href='index.html'>Go back to the list</a>";
    } catch (PDOException $e) {
        echo "PDO Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "General Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>

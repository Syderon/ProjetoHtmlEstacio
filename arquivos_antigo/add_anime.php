<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $episodes = $_POST['episodes'];
    $rating = $_POST['rating'];
    $video_link = $_POST['video_link'];
//teste
    try {
        $dbPath = realpath('banco_anime.db');
        if ($dbPath === false) {
            throw new Exception('Database file not found.');
        }
        $db = new PDO('sqlite:' . $dbPath);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("INSERT INTO anime (title, genre, episodes, rating, video_link) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $genre, $episodes, $rating, $video_link]);

        echo "Anime added successfully. <a href='index.php'>Go back to the list</a>";
    } catch (PDOException $e) {
        echo "PDO Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "General Error: " . $e->getMessage();
    }
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Anime</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add New Anime</h1>
    <form action="add_anime.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required><br>

        <label for="episodes">Episodes:</label>
        <input type="number" id="episodes" name="episodes" required><br>

        <label for="rating">Rating:</label>
        <input type="number" step="0.1" id="rating" name="rating" required><br>

        <label for="video_link">Video Link:</label>
        <input type="url" id="video_link" name="video_link" required><br>

        <input type="submit" value="Add Anime">
    </form>
</body>
</html>
<?php
}
?>

<?php
try {
    $dbPath = realpath('banco_anime.db');
    if ($dbPath === false) {
        throw new Exception('Database file not found.');
    }

    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM anime";
    $result = $db->query($query);

    $anime_list = [];
    foreach ($result as $row) {
        $anime_list[] = $row;
    }
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
    die();
} catch (Exception $e) {
    echo "General Error: " . $e->getMessage();
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Site</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Anime List</h1>
    <div id = "centered">
    <a id="button-container" href="add_anime.php">Add New Anime</a>
</div>
    <ul id="anime-list">
      <div class ="scrollable">
        <?php foreach ($anime_list as $anime): ?>
            <li>
                <strong><?php echo htmlspecialchars($anime['title']); ?></strong><br>
                Genre: <?php echo htmlspecialchars($anime['genre']); ?><br>
                Episodes: <?php echo htmlspecialchars($anime['episodes']); ?><br>
                Rating: <?php echo htmlspecialchars($anime['rating']); ?><br>
                <img src=<?php echo htmlspecialchars($anime['image_url']); ?> />
                <?php if (!empty($anime['video_link'])): ?>
                    <a href="<?php echo htmlspecialchars($anime['video_link']); ?>" target="_blank">Watch Video</a>
                <?php endif; ?>
                <form action="delete_anime.php" method="post" onsubmit="return confirm('Are you sure you want to delete this anime?');" style="display: inline;">
                    <input type="hidden" name="anime_id" value="<?php echo $anime['id']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </li>
            <?php endforeach; ?>
          </div>
    </ul>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>

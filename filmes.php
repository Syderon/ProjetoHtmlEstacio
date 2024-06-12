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
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">

  <title>ANIMEX</title>

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top" id="teste">
    <div class="container">
      <a class="navbar-brand" href="#">ANIMEX</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              Animes
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="animesnovos.html">Animes Novos</a>
              <a class="dropdown-item" href="epsodiosnovos.html">Epsódios Novos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="filmes.php">Animes DB</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 ml-auto btn-sm">
          <input class="form-control mr-sm-2 btn-sm bg-transparent" type="search" placeholder="Search"
            aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" id="btn-search" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container sec-anime">
    <section class="anime" id="anime">
      <h1 class="heading" style="margin-top: 50px;"></h1>
      <ul class="anime-list">
        <?php foreach ($anime_list as $anime): ?>
          <li class="anime-item">
            <strong><?php echo htmlspecialchars($anime['title']); ?></strong><br>
            Genre: <?php echo htmlspecialchars($anime['genre']); ?><br>
            Episodes: <?php echo htmlspecialchars($anime['episodes']); ?><br>
            Rating: <?php echo htmlspecialchars($anime['rating']); ?><br>
            <img src="<?php echo htmlspecialchars($anime['image_url']); ?>" /><br>
            <?php if (!empty($anime['video_link'])): ?>
              <a href="<?php echo htmlspecialchars($anime['video_link']); ?>" target="_blank">Watch Video</a>
            <?php endif; ?>
            <form action="delete_anime.php" method="post" onsubmit="return confirm('Are you sure you want to delete this anime?');" style="display: inline;">
              <input type="hidden" name="anime_id" value="<?php echo $anime['id']; ?>">
              <input type="submit" value="Delete">
            </form>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
  </div>

  <div class="container">
    <a href="add_anime.php" class="btn btn-primary">Add New Anime</a>
  </div>

  <div class="copyright container">
    <a href="#" class="logo"><i class="fas fa-infinity"></i>ANIMEX</a>
    <p>&#169; All rights reserved.</p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="js/main.js"></script>

</body>

</html>

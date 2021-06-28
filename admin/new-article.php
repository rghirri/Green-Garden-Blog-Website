<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $currentPage = $_SERVER['REQUEST_URI'];
// $currentFile = $_SERVER['PHP_SELF'];

// var_dump($currentFile);

require '../includes/header.php';

Auth::requireLogin();

$article = new Article();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = require '../includes/db.php';

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    if ($article->create($conn)) {

      Url::redirect("/admin/article.php?id={$article->id}");

    }
}

?>

<!-- Hero Banner Start  -->
<div class="hero-banner container-fluid container-xl">
  <picture class="hero-banner__overlay">
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/Green-Garden-hero-banner-1295x264-min.png" alt="" />
  </picture>

  <div class="hero-banner__title">
    <h1>add article</h1>
  </div>
</div>


<!-- Hero Banner End  -->
<!-- Header End  -->
<section class="wrapper  wrapper--narrow">
  <!-- Check for validation errors -->

  <?php require 'includes/article-form.php'; ?>

</section>

<?php require '../includes/footer.php'; ?>
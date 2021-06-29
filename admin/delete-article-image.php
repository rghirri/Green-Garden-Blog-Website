<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 require '../includes/header.php';

Auth::requireLogin();


$conn = require '../includes/db.php';

if (isset($_GET['id'])) {

$article = Article::getByID($conn, $_GET['id']);

if ( ! $article) {
die("article not found");
}

} else {
die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

         $previous_image = $article->image_file;

          if ($article->setImageFile($conn, null)) {

              if ($previous_image) {
                  unlink("../uploads/$previous_image");
              }

              Url::redirect("/admin/edit-article-image.php?id={$article->id}");

          }

      } 
?>

<!-- Hero Banner Start  -->
<div class="hero-banner container-fluid container-xl">
  <?php if ($article->image_file): ?>
  <picture class="hero-banner__overlay__darker">
    <!-- Display image begin -->
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/<?= $article->image_file; ?>" alt="" />
    <!-- Display image end -->
  </picture>
  <?php else: ?>
  <picture class="hero-banner__overlay">
    <!-- Display image begin -->
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/Green-Garden-hero-banner-1295x264-min.png"
      height="264" alt="" />
    <!-- Display image end -->
  </picture>
  <?php endif; ?>

  <div class="hero-banner__title">
    <h1>Delete Article image</h1>
  </div>
</div>


<!-- Hero Banner End  -->
</header>
<!-- Header End  -->
<section class="wrapper  wrapper--narrow">

  <form method="post">

    <p>Are you sure?</p>

    <button>Delete</button>
    <a href="edit-article-image.php?id=<?= $article->id; ?>">Cancel</a>

  </form>
</section>

<?php require '../includes/footer.php'; ?>
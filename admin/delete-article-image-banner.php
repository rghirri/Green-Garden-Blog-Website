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

         $previous_image = $article->image_file_banner;

          if ($article->setImageFileBanner($conn, null)) {

              if ($previous_image) {
                  unlink("../uploads/$previous_image");
              }

              Url::redirect("/admin/edit-article-image-banner.php?id={$article->id}");

          }

      } 
?>

<!-- Hero Banner Start  -->
<section class="wrapper  wrapper--narrow">
  <div class="text-center">
    <h2>delete image banner</h2>
  </div>
</section>
<div class="hero-banner container-fluid container-xl mb-5">

  <?php if ($article->image_file_banner): ?>
  <!-- Display image begin -->
  <img class="hero-banner__overlay-image img-fluid" src="/uploads/<?= $article->image_file_banner; ?>" alt="" />
  <!-- Display image end -->
  <?php endif; ?>

</div>

<section class="wrapper  wrapper--narrow">

  <form method="post">

    <p>Are you sure?</p>

    <button>Delete</button>
    <a href="edit-article-image-banner.php?id=<?= $article->id; ?>">Cancel</a>

  </form>
</section>

<?php require '../includes/footer.php'; ?>
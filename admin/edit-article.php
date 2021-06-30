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

//  var_dump($article->getCategories($conn));

$category_ids = array_column($article->getCategories($conn), 'id');
$categories = Category::getAll($conn);

// var_dump($categories);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$article->title = $_POST['title'];
$article->content = $_POST['content'];
$article->published_at = $_POST['published_at'];

$category_ids = $_POST['category'] ?? [];

// var_dump($category_ids);
// exit;

if ($article->update($conn)) {

  $article->setCategories($conn, $category_ids);

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
    <h1>edit article</h1>
  </div>
</div>


<!-- Hero Banner End  -->
</header>
<!-- Header End  -->
<section class="wrapper  wrapper--narrow">
  <!-- Check for validation errors -->

  <?php require 'includes/article-form.php'; ?>

</section>

<?php require '../includes/footer.php'; ?>
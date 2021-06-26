<?php
require 'classes/Database.php';
require 'classes/Article.php';
require 'includes/url.php';

// session_start();

// if (! isLoggedIn()) {

//     die("unauthorised");

// }

$article = new Article();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $db = new Database();
    $conn = $db->getConn();

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    if ($article->create($conn)) {

        redirect("/article.php?id={$article->id}");

    }
}

?>

<?php require 'includes/header.php'; ?>

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
</header>
<!-- Header End  -->
<section class="wrapper  wrapper--narrow">
  <!-- Check for validation errors -->

  <?php require 'includes/article-form.php'; ?>

</section>

<?php require 'includes/footer.php'; ?>
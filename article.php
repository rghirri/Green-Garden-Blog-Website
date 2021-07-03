<?php 
//======================================================================
// This is the article page which will display a single article 
// of the article list which is displayed in the none admin index.php.
//======================================================================

//-----------------------------------------------------
// PHP debug code which I used to test page for errors
// This code must be remove when the site is ready for 
// live production.
//-----------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Include header as part of the code */
 require 'includes/header.php';

 /* Get connection to database to access data */
$conn = require 'includes/db.php';

/* Get the article record based on the ID along 
   with associated categories */
if (isset($_GET['id'])) {
  $article = Article::getWithCategories($conn, $_GET['id'], true);

}else{
  $article = null;
}
?>

<!-- PHP and HTML code -->
<!-- Get data from the database and display -->

<!-- Check if there are any articles in the database -->
<?php if ($article) : ?>
<!-- Hero Banner Start  -->
<div class="hero-banner container-fluid container-xl">
  <?php if ($article[0]['image_file_banner']) : ?>
  <picture class="hero-banner__overlay__darker">
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/<?= $article[0]['image_file_banner']; ?>" alt="" />
  </picture>
  <?php else: ?>
  <picture class="hero-banner__overlay">
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/Green-Garden-hero-banner-1295x264-min.png" alt="" />
  </picture>
  <?php endif; ?>
  <div class="hero-banner__title">
    <h1><?= htmlspecialchars($article[0]['title']); ?></h1>
  </div>
</div>
<!-- Hero Banner End  -->

<!-- Single post begins -->
<section class="wrapper  wrapper--medium">
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="single-post">
        <p id="meta-data">
          <!-- pubish time and date -->
          <time datetime="<?= $article[0]['published_at'] ?>"><?php
                        $datetime = new DateTime($article[0]['published_at']);
                        echo $datetime->format("j F, Y");
                    ?></time>
          <!-- categories -->
          <?php if ($article[0]['category_name']) : ?>
          <span> | Categories:
            <?php foreach ($article as $a) : ?>
            <?= htmlspecialchars($a['category_name']); echo ' '; ?>
            <?php endforeach; ?>
          </span>
          <?php endif; ?>
        </p>
        <!-- Content excerpt -->
        <p><?= htmlspecialchars($article[0]['content']); ?></p>
        <a href="/"><button class="btn">Back to Previous</button></a>
      </div>
    </div>
  </div>
</section>
<!-- Single post Ends -->
<?php else : ?>
<!-- If there are no articles in the database -->
<p>Article not found.</p>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>
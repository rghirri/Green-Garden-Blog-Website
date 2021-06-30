<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 require '../includes/header.php';

 Auth::requireLogin();

$conn = require '../includes/db.php';


if (isset($_GET['id'])) {
  $article = Article::getWithCategories($conn, $_GET['id']);

}else{
  $article = null;
}

?>


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
</header>
<!-- Header End  -->

<!-- Single post begins -->


<section class="wrapper  wrapper--medium">
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="single-post">
        <p id="meta-data"><time datetime="<?= $article[0]['published_at'] ?>"><?php
                        $datetime = new DateTime($article[0]['published_at']);
                        echo $datetime->format("j F, Y");
                    ?></time> |
          <!-- categories -->
          <?php if ($article[0]['category_name']) : ?>
          <span>Categories:
            <?php foreach ($article as $a) : ?>
            <?= htmlspecialchars($a['category_name']); ?>
            <?php echo ',' ?>
            <?php endforeach; ?>
          </span>
          <?php endif; ?>
        </p>
        <p><?= htmlspecialchars($article[0]['content']); ?></p>
        <button class="btn"><a href="/admin/">Back to Previous</a></button>
        <button class="btn"><a href="/admin/edit-article.php?id=<?= $article[0]['id']; ?>">Edit article</a></button>
        <button class="btn"><a href="/admin/edit-article-image.php?id=<?= $article[0]['id']; ?>">Edit article
            image blog</a></button>
        <button class="btn"><a href="/admin/edit-article-image-banner.php?id=<?= $article[0]['id']; ?>">Edit article
            image banner</a></button>
        <button class="btn"><a class="delete" href="/admin/delete-article.php?id=<?= $article[0]['id']; ?>">Delete
            article</a></button>
      </div>
    </div>
  </div>
</section>


<!-- Single post Ends -->
<?php else : ?>
<p>Article not found.</p>
<?php endif; ?>

<?php require '../includes/footer.php'; ?>
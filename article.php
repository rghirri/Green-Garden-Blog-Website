<?php 
require 'includes/init.php';

$conn = require 'includes/db.php';


if (isset($_GET['id'])) {
  $article = Article::getByID($conn, $_GET['id']);

}else{
  $article = null;
}

?>

<?php require 'includes/header.php'; ?>
<?php if ($article) : ?>
<!-- Hero Banner Start  -->
<div class="hero-banner container-fluid container-xl">
  <picture class="hero-banner__overlay">
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/herbs-banner-1295x264-min.png" alt="" />
  </picture>

  <div class="hero-banner__title">
    <h1><?= htmlspecialchars($article->title); ?></h1>
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
        <p id="meta-data"><time datetime="<?= $article->published_at ?>"><?php
                        $datetime = new DateTime($article->published_at);
                        echo $datetime->format("j F, Y");
                    ?></time> | Tools</p>
        <p><?= htmlspecialchars($article->content); ?></p>
        <button class="btn"><a href="/">Back to Previous</a></button>
        <button class="btn"><a href="edit-article.php?id=<?= $article->id; ?>">Edit article</a></button>
        <button class="btn"><a href="delete-article.php?id=<?= $article->id; ?>">Delete</a></button>
      </div>
    </div>
  </div>
</section>


<!-- Single post Ends -->
<?php else : ?>
<p>Article not found.</p>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>
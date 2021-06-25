<?php require 'includes/database.php'; 


$conn = getDB();


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
$sql = "SELECT *
        FROM article
        WHERE id = " . $_GET['id'];

$results = mysqli_query($conn, $sql);

if ($results === false) {

    echo mysqli_error($conn);

} else {

    $article = mysqli_fetch_assoc($results);

}

}else{
  $article = null;
}

?>

<?php require 'includes/header.php'; ?>
<?php if ($article === null) : ?>
<p>Article not found.</p>
<?php else : ?>
<!-- Hero Banner Start  -->
<div class="hero-banner container-fluid container-xl">
  <picture class="hero-banner__overlay">
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/herbs-banner-1295x264-min.png" alt="" />
  </picture>

  <div class="hero-banner__title">
    <h1><?= htmlspecialchars($article['title']); ?></h1>
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
        <p id="meta-data"><time datetime="<?= $article['published_at'] ?>"><?php
                        $datetime = new DateTime($article['published_at']);
                        echo $datetime->format("j F, Y");
                    ?></time> | Tools</p>
        <p><?= htmlspecialchars($article["content"]); ?></p>
        <button class="btn"><a href="/">Back to Previous</a></button>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Single post Ends -->

<?php require 'includes/footer.php'; ?>
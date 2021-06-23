<?php 
$db_host = "localhost";
$db_name = "green_garden_blog_db";
$db_user ="ggb_cms";
$db_pass ="rjQ2BtgiCz246XDe";

$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$sql = "select *
        FROM article
        ORDER BY published_at;";
$result = mysqli_query($conn,$sql);   

if ($result === false){
  echo mysqli_error($conn);
}else{
  $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);

}

?>

<?php require 'includes/header.php'; ?>

<!-- Post list begins -->

<?php if (empty($articles)) : ?>
<p>No articles found.</p>
<?php else : ?>

<section class="wrapper  wrapper--medium">
  <?php foreach ($articles as $article) : ?>
  <?php if(!($article['id'] % 2 == 0 )) : ?>
  <div class="row pt-5">
    <div class="col-md-6">
      <div class="row justify-content-center">
        <div class="col-10 col-lg-9">
          <div class="post-list d-flex flex-column">
            <h2 class="post-list__title"><?= $article['title'] ?></h2>
            <p id="meta-data">22 feb 2021 | cooking</p>
            <p class=""><?= $article["content"] ?></p>
          </div>
          <button class="btn">Read More</button>
        </div>
      </div>

    </div>
    <div class="col-md-6 ">
      <img class="post-list__image img-fluid" src="/uploads/herbs-min.png" alt="" class="img-fluid" />
    </div>
  </div>
  <?php else : ?>
  <div class="row pt-5">
    <div class="col-md-6 order-2 order-md-1">
      <img class="post-list__image img-fluid" src="/uploads/garden-tools-min.png" alt="" class="img-fluid" />
    </div>
    <div class="col-md-6 order-1 order-md-2">
      <div class="row justify-content-center">
        <div class="col-10 col-lg-9">
          <div class="post-list d-flex flex-column">
            <h2 class="post-list__title"><?= $article['title'] ?></h2>
            <p id="meta-data">30 jun 2021 | Tools</p>
            <p class=""><?= $article['content'] ?></p>
          </div>
          <button class="btn">Read More</button>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php endif; ?>
  <!-- Post list Pagination  -->
  <nav aria-label="Page">
    <ul class="pagination pt-5">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</section>

<!-- Post list Ends -->

<?php require 'includes/footer.php'; ?>
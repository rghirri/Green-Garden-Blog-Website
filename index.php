<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'includes/header.php';

$conn = require 'includes/db.php';

$pageNumber = $_GET['page'];

$paginator = new Paginator($pageNumber ?? 1, 3);

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

?>


<!-- Hero Banner Start  -->
<div class="hero-banner container-fluid container-xl">
  <picture class="hero-banner__overlay">
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/Green-Garden-hero-banner-1295x264-min.png" alt="" />
  </picture>

  <div class="hero-banner__title">
    <h1>The Green Garden Blog</h1>
  </div>
</div>

<!-- Hero Banner End  -->
</header>
<!-- Header End  -->

<!-- Post list begins -->

<?php if (empty($articles)) : ?>
<p>No articles found.</p>
<?php else : ?>

<section class="wrapper  wrapper--medium">

  <?php 
  $i=0;
  foreach ($articles as $article) : 
  $i++;
  if(!($i % 2 == 0 )) : 
  
  ?>


  <div class="row pt-5">
    <div class="col-md-6">
      <div class="row justify-content-center">
        <div class="col-10 col-lg-9">
          <div class="post-list d-flex flex-column">
            <h2 class="post-list__title"><?= $article['title'] ?></h2>
            <p id="meta-data"><time datetime="<?= $article['published_at'] ?>"><?php
                        $datetime = new DateTime($article['published_at']);
                        echo $datetime->format("j F, Y");
                    ?></time> | cooking</p>
            <p> <?php
                      $string = $article["content"];
                      $max = 150; // or 200, or whatever
                      if(strlen($string) > $max) {
                        // find the last space < $max:
                        $shorter = substr($string, 0, $max+1);
                        $string = substr($string, 0, strrpos($shorter, ' ')).'...';
                      }
                      echo $string; ?>

            </p>
          </div>
          <button class="btn"><a href="/article.php?id=<?= $article['id']; ?>">Read More</a></button>
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
            <p id="meta-data"><time datetime="<?= $article['published_at'] ?>"><?php
                        $datetime = new DateTime($article['published_at']);
                        echo $datetime->format("j F, Y");
                    ?></time> | Tools</p>
            <p> <?php
                      $string = $article["content"];
                      $max = 150; // or 200, or whatever
                      if(strlen($string) > $max) {
                        // find the last space < $max:
                        $shorter = substr($string, 0, $max+1);
                        $string = substr($string, 0, strrpos($shorter, ' ')).'...';
                      }
                      echo $string; ?>

            </p>
          </div>
          <button class="btn"><a href="/article.php?id=<?= $article['id']; ?>">Read More</a></button>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php endif; ?>

  <!-- Post list Pagination begin -->
  <nav aria-label="Page">
    <ul class="pagination pt-5">
      <?php if ($paginator->previous): ?>
      <li class="page-item">
        <a class="page-link" href="?page=<?= $paginator->previous; ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php else: ?>
      <li class="page-item">
        <p class="page-link">
          <span aria-hidden="true">&laquo;</span>
        </p>
      </li>
      <?php endif; ?>

      <li class="page-item"><a class="page-link" href="?page=<?= $pageNumber ?>">1</a></li>
      <li class="page-item"><a class="page-link" href="?page=<?= $pageNumber ?>">2</a></li>
      <li class="page-item"><a class="page-link" href="?page=<?= $pageNumber ?>">3</a></li>
      <li class="page-item">
        <a class="page-link" href="?page=<?= $paginator->next; ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</section>
<!-- Post list Pagination end -->
<!-- Post list Ends -->

<?php require 'includes/footer.php'; ?>
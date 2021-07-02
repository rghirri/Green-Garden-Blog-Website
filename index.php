<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'includes/header.php';

$conn = require 'includes/db.php';


$paginator = new Paginator($_GET['page'] ?? 1, 3, Article::getTotal($conn,true));


$articles = Article::getPage($conn, $paginator->limit, $paginator->offset, true);



?>
<div id="#content">
  <!-- Hero Banner Start  -->
  <div class="hero-banner container-fluid container-xl">
    <picture class="hero-banner__overlay">
      <img class="hero-banner__overlay-image img-fluid" src="/uploads/Green-Garden-hero-banner-1295x264-min.png"
        alt="" />
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
                    ?></time>
                <!-- categories -->
                <?php if ($article['category_names']) : ?>
                <span> | Categories:
                  <?php foreach ($article['category_names'] as $name) : ?>
                  <?= htmlspecialchars($name); ?>
                  <?php endforeach; ?>
                </span>
                <?php endif; ?>
              </p>
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
            <a href="/article.php?id=<?= $article['id']; ?>"><button class="btn">Read More</button></a>
          </div>
        </div>

      </div>
      <div class="col-md-6 ">
        <img class="post-list__image img-fluid" src="/uploads/<?= $article['image_file'];?>" alt="" class="img-fluid" />
      </div>
    </div>
    <?php else : ?>
    <div class="row pt-5">
      <div class="col-md-6 order-2 order-md-1">
        <img class="post-list__image img-fluid" src="/uploads/<?= $article['image_file'];?>" alt="" class="img-fluid" />
      </div>
      <div class="col-md-6 order-1 order-md-2">
        <div class="row justify-content-center">
          <div class="col-10 col-lg-9">
            <div class="post-list d-flex flex-column">
              <h2 class="post-list__title"><?= $article['title'] ?></h2>
              <p id="meta-data"><time datetime="<?= $article['published_at'] ?>"><?php
                        $datetime = new DateTime($article['published_at']);
                        echo $datetime->format("j F, Y");
                    ?></time> |
                <!-- categories -->
                <?php if ($article['category_names']) : ?>
                <span>Categories:
                  <?php foreach ($article['category_names'] as $name) : ?>
                  <?= htmlspecialchars($name); ?>
                  <?php endforeach; ?>
                </span>
                <?php endif; ?>
              </p>
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
            <a href="/article.php?id=<?= $article['id']; ?>"><button class="btn">Read More</button></a>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php require 'includes/pagination.php'; ?>
  </section>
  <!-- Post list Pagination end -->
  <!-- Post list Ends -->
</div>



<?php require 'includes/footer.php'; ?>
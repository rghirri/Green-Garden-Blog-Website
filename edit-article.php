<?php
require 'includes/database.php';
require 'includes/single-article.php';
require 'includes/url.php';

$conn = dataBase_connect();

if (isset($_GET['id'])) {

    $article = singleArticle($conn, $_GET['id']);


    if ($article){
      $id            =  $article['id'];
      $title         =  $article['title'];
      $content       =  $article['content'];
      $published_at  =  $article['published_at'];
      
    }else{
      
      die("article not found");
    }
    
} else {
  
    die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $title         = $_POST['title'];
  $content       = $_POST['content'];
  $published_at  = $_POST['published_at'];
  
  $errors = validateArticle($title, $content, $published_at);
   
   
   if (empty($errors)){

      $sql = "UPDATE article
              SET title = ?,
                  content = ?,
                  published_at = ?
              WHERE id = ?";

      $stmt = mysqli_prepare($conn, $sql);

      if ($stmt === false) {

          echo mysqli_error($conn);

      } else {

          if ($published_at == ''){
              $published_at = null;
          }

          mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);

          if (mysqli_stmt_execute($stmt)) {

            redirect("/article.php?id=$id");  

          } else {

              echo mysqli_stmt_error($stmt);

          }
      }
    
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

<?php require 'includes/footer.php'; ?>
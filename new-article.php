<?php
require 'includes/database.php';
require 'includes/single-article.php';
require 'includes/url.php';


$title          = '';
$content        = '';
$published_at   = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title         = $_POST['title'];
    $content       = $_POST['content'];
    $published_at  = $_POST['published_at'];
    
    $errors = validateArticle($title, $content, $published_at);
     
     
     if (empty($errors)){

    $conn = dataBase_connect();

    $sql = "INSERT INTO article (title, content, published_at) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {

        echo mysqli_error($conn);

    } else {

        if ($published_at == ''){
            $published_at = null;
         }

        mysqli_stmt_bind_param($stmt, "sss", $title  , $content, $published_at);

        if (mysqli_stmt_execute($stmt)) {

            $id = mysqli_insert_id($conn);

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
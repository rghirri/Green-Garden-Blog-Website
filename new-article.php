<?php

require 'includes/database.php';


$errors         = [];
$title          = '';
$content        = '';
$published_at   = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title         = $_POST['title'];
    $content       = $_POST['content'];
    $published_at  = $_POST['published_at'];
    
     if ($title == ''){
        $errors[] = 'Please Enter Title';
     }
     if ($content == ''){
        $errors[] = 'Please Enter Content';
     }

     if ($published_at != ''){
        $date_time = date_create_from_format('Y/m/d H:i', $published_at);
        
        if ($date_time === false){
            $errors[] = 'Invalid date and time';
        }else{
            $date_errors = date_get_last_errors();
            if($date_errors['warning_count']>0){
                $errors[] = 'Invalid date and time';
            }
        }
     }
     
     
     if (empty($errors)){

    $conn = getDB();

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

            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
                $protocol = 'https';
            }else{
                $protocol = 'http';
            }

            header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/article.php?id=$id" );
            exit;

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

  <?php if (! empty($errors)): ?>
  <ul>
    <?php foreach ($errors as $error): ?>
    <li><?= $error ?></li>
    <?php endforeach ?>
  </ul>
  <?php endif;  ?>

  <div class="row">
    <div class="col-md-10 offset-md-1">
      <form method="post">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="Article title" autocomplete="off"
            value=<?= htmlspecialchars($title) ?>>
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" name="content" rows="4" cols="40" id="content" placeholder="Article content"
            rows="3"><?= htmlspecialchars($content) ?></textarea>
        </div>

        <div class="mb-3">
          <label for="published_at" class="form-label">Published Date</label>
          <input class="form-control" name="published_at" id="published_at" placeholder="Published Date"
            autocomplete="off" value=<?= htmlspecialchars($published_at) ?>>
        </div>

        <button class="btn mt-3 add_article_btn">add article</button>

      </form>
    </div>
  </div>
</section>

<?php require 'includes/footer.php'; ?>
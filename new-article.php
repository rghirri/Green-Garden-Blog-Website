<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'includes/database.php';

    $sql = "INSERT INTO  article (title, content, published_at)
            VALUES (?, ?, ? )"; 

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {

        echo mysqli_error($conn);

    } else {
        mysqli_stmt_bind_param($stmt, "sss", $_POST['title'], $_POST['content'], $_POST['published_at']);

        if (mysqli_stmt_execute($stmt)){
            $id = mysqli_insert_id($conn);
            echo "Inserted record with ID: $id";
        }else{
            echo mysqli_stmt_error($stmt);
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
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <form method="post">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="Article title">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" name="content" rows="4" cols="40" id="content" placeholder="Article content"
            rows="3"></textarea>
        </div>

        <div>
          <label for="published_at">Publication date and time</label>
          <input name="published_at" id="published_at">
        </div>

        <button class="btn">add article</button>

      </form>
    </div>
  </div>
</section>

<?php require 'includes/footer.php'; ?>
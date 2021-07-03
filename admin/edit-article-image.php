<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 require '../includes/header.php';

Auth::requireLogin();



$conn = require '../includes/db.php';

if (isset($_GET['id'])) {

$article = Article::getByID($conn, $_GET['id']);

if ( ! $article) {
die("article not found");
}

} else {
die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  try {

      if (empty($_FILES)) {
          throw new Exception('Invalid upload');
      }

      switch ($_FILES['file']['error']) {
          case UPLOAD_ERR_OK:
              break;

          case UPLOAD_ERR_NO_FILE:
              throw new Exception('No file uploaded');
              break;

          case UPLOAD_ERR_INI_SIZE:
              throw new Exception('File is too large (from the server settings)');
              break;

          default:
              throw new Exception('An error occurred');
      }

      // Restrict the file size
      if ($_FILES['file']['size'] > 1000000) {

          throw new Exception('File is too large');

      }

      // Restrict the file type
      $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

      if ( ! in_array($mime_type, $mime_types)) {

          throw new Exception('Invalid file type');

      }

      // Move the uploaded file
      $pathinfo = pathinfo($_FILES["file"]["name"]);

      $base = $pathinfo['filename'];

      // Replace any characters that aren't letters, numbers, underscores or hyphens with an underscore
      $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

      // Restrict the filename to 200 characters
      $base = mb_substr($base, 0, 200);

      $filename = $base . "." . $pathinfo['extension'];

      $destination = "../uploads/$filename";

      // Add a numeric suffix to the filename to avoid overwriting existing files
      $i = 1;

      while (file_exists($destination)) {

          $filename = $base . "-$i." . $pathinfo['extension'];
          $destination = "../uploads/$filename";

          $i++;
      }

      if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

          $previous_image = $article->image_file;

          if ($article->setImageFile($conn, $filename)) {

              if ($previous_image) {
                  unlink("../uploads/$previous_image");
              }

              Url::redirect("/admin/edit-article-image.php?id={$article->id}");

          }

      } else {

          throw new Exception('Unable to move uploaded file');

      }

  } catch (Exception $e) {
    $error = $e->getMessage();
  }

}

?>

<!-- Hero Banner Start  -->
<section class="wrapper  wrapper--narrow">
  <div class="text-center">
    <h2>Edit blog list image</h2>
  </div>
</section>
<div class="hero-banner container-fluid container-xl mb-5">
  <div class="text-center">
    <h2><?php echo $article->title; ?></h2>
  </div>
  <?php if ($article->image_file): ?>
  <!-- Display image begin -->
  <img class="hero-banner__overlay-image img-fluid" src="/uploads/<?= $article->image_file; ?>" alt="" />
  <!-- Display image end -->
  <?php endif; ?>

</div>


<!-- Hero Banner End  -->

<!-- Header End  -->




<section class="wrapper  wrapper--narrow">
  <?php if (isset($error)) : ?>
  <p class="text-danger"><?= $error ?></p>
  <?php endif; ?>
  <form method="post" enctype="multipart/form-data">

    <div>
      <h2>Please follow the following instructions for blog image:</h2>
      <ul>
        <li>The image dimensions need to be 466 x 327 px</li>
        <li>The image file will need to be compressed using https://imagecompressor.com/</li>
        <li>The image file name needs to be unique and relevent to article</li>
      </ul>

    </div>
    <label for="file">Image file</label>
    <input type="file" name="file" id="file">
    <button class="btn">Upload</button>
    <a class="delete" href="/admin/delete-article-image.php?id=<?= $article->id; ?>"><button class="btn">Delete article
        blog image</button></a>


  </form>

  <a href="/admin/article.php?id=<?= $article->id; ?>"><button class="btn mt-5">Back to Previous</button></a>

</section>

<?php require '../includes/footer.php'; ?>
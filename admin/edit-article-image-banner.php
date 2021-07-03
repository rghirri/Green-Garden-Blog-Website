<?php
//======================================================================
// This is the edit article page image (banner) which will edit the image 
// banner displayed on the article page.
//======================================================================

//-----------------------------------------------------
// PHP debug code which I used to test page for errors
// This code must be remove when the site is ready for 
// live production.
//-----------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Include header as part of the code */
 require '../includes/header.php';

/* This page can be only access by admin user. 
   This code is used to check if admin user is 
   logged in or not  */
Auth::requireLogin();

/* Get connection to database to access data */
$conn = require '../includes/db.php';

/* This code checks for the requested article's id to edit it's banner image. */
if (isset($_GET['id'])) {
$article = Article::getByID($conn, $_GET['id']);

if ( ! $article) {
die("article not found");
}

} else {
die("id not supplied, article not found");
}

/* This code checks for POST requests */
/* It also checks whether the file uploaded is valid
   and that there aren't any errors then redirects to 
   /admin/edit-article-image-banner.php */
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

      $filenameBanner = $base . "." . $pathinfo['extension'];

      $destination = "../uploads/$filenameBanner";

      // Add a numeric suffix to the filename to avoid overwriting existing files
      $i = 1;

      while (file_exists($destination)) {

          $filenameBanner = $base . "-$i." . $pathinfo['extension'];
          $destination = "../uploads/$filenameBanner";

          $i++;
      }

      if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

          $previous_image = $article->image_file_banner;

          if ($article->setImageFileBanner($conn, $filenameBanner)) {

              if ($previous_image) {
                  unlink("../uploads/$previous_image");
              }

              Url::redirect("/admin/edit-article-image-banner.php?id={$article->id}");

          }

      } else {

          throw new Exception('Unable to move uploaded file');

      }

  } catch (Exception $e) {
    $error = $e->getMessage();
  }

}

?>

<!-- PHP and HTML code -->
<!-- Get request to update banner image -->

<!-- Hero Banner Start  -->
<section class="wrapper  wrapper--narrow">
  <div class="text-center">
    <h2>edit blog page image</h2>
  </div>
</section>
<div class="hero-banner container-fluid container-xl mb-5">
  <div class="text-center">
    <h2><?php echo $article->title; ?></h2>
  </div>
  <?php if ($article->image_file_banner) : ?>
  <picture class="hero-banner__overlay__darker">
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/<?= $article->image_file_banner; ?>" alt="" />
  </picture>
  <?php endif; ?>
</div>
<!-- Hero Banner End  -->

<!-- PHP and HTML code to instruct admin user to image requirements  -->
<section class="wrapper  wrapper--narrow">
  <?php if (isset($error)) : ?>
  <p class="text-danger"><?= $error ?></p>
  <?php endif; ?>
  <form method="post" enctype="multipart/form-data">

    <div>
      <h2>Please follow the following instruction for banner image:</h2>
      <ul>
        <li>The image dimensions need to be 1295 x 264 px</li>
        <li>The image file will need to be compressed using https://imagecompressor.com/</li>
        <li>The image file name needs to be unique and relevent to article</li>
      </ul>

    </div>
    <label for="file">Image file</label>
    <input type="file" name="file" id="file">
    <button class="btn">Upload</button>
    <a class="delete" href="/admin/delete-article-image-banner.php?id=<?= $article->id; ?>"><button class="btn">Delete
        article
        banner image</button></a>

  </form>
  <a href="/admin/article.php?id=<?= $article->id; ?>"><button class="btn mt-5">Back to Previous</button></a>
</section>

<?php /* Include footer as part of the code */ ?>
<?php require '../includes/footer.php'; ?>
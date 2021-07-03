<?php
//======================================================================
// This is the delete article page image (banner) which will delete the image 
// banner displayed on the article page.
// This page uses javascript and PHP to confirm delete request
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

/* This code checks for the requested article's id to delete it's banner image. */
if (isset($_GET['id'])) {
$article = Article::getByID($conn, $_GET['id']);
  if ( ! $article) {
    die("article not found");
  }
  } else {
    die("id not supplied, article not found");
  }

/* This code checks for POST requests and deletes the banner image file */
/* It then redirects to edit-article-image-banner.php */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

         $previous_image = $article->image_file_banner;

          if ($article->setImageFileBanner($conn, null)) {

              if ($previous_image) {
                  unlink("../uploads/$previous_image");
              }

              Url::redirect("/admin/edit-article-image-banner.php?id={$article->id}");

          }

      } 
?>

<!-- PHP and HTML code -->
<!-- Get request to delete banner image -->

<!-- Hero Banner Start  -->
<section class="wrapper  wrapper--narrow">
  <div class="text-center">
    <h2>delete image banner</h2>
  </div>
</section>
<div class="hero-banner container-fluid container-xl mb-5">

  <?php if ($article->image_file_banner): ?>
  <!-- Display image begin -->
  <img class="hero-banner__overlay-image img-fluid" src="/uploads/<?= $article->image_file_banner; ?>" alt="" />
  <!-- Display image end -->
  <?php endif; ?>

</div>

<section class="wrapper  wrapper--narrow">
  <!-- Confirm request to delete banner image -->
  <form method="post">

    <p>Are you sure?</p>

    <button>Delete</button>
    <a href="edit-article-image-banner.php?id=<?= $article->id; ?>">Cancel</a>

  </form>
</section>
<?php /* Include footer as part of the code */ ?>
<?php require '../includes/footer.php'; ?>
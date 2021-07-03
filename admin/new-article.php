<?php
//======================================================================
// This is the edit article page which will edit the the text  displayed 
// on the article page.
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
   logged in or not . This is done by calling 
    the requireLogin() method in Auth class */
Auth::requireLogin();

/* This code creates a new article object of the Article class */
$article = new Article();

/* This code declares an array */
$category_ids = [];

/* Get connection to database to access data */
$conn = require '../includes/db.php';

/* Gets categories that are needed to be selected
   the method getAll($conn) is called from 
   Category class */
$categories = Category::getAll($conn);


/* This code checks for POST requests, creates 
   article and redirects to new
   /admin/article.php */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];
    $category_ids = $_POST['category'] ?? [];

    if ($article->create($conn)) {

      $article->setCategories($conn, $category_ids);

      Url::redirect("/admin/article.php?id={$article->id}");

    }
}

?>

<!-- PHP and HTML code -->
<!-- Get request to update article -->

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

<section class="wrapper  wrapper--narrow">
  <!-- Form to add new article -->
  <?php require 'includes/article-form.php'; ?>

</section>

<?php /* Include footer as part of the code */ ?>
<?php require '../includes/footer.php'; ?>
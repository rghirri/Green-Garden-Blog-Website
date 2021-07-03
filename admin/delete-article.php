<?php
//======================================================================
// This is the delete article page which will delete the  
// article and then redirect to /admin/index.php
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

/* This code checks for the requested article's id to delete it. */
if (isset($_GET['id'])) {

    $article = Article::getByID($conn, $_GET['id']);

    if ( ! $article) {
        die("article not found");
    }

} else {
    die("id not supplied, article not found");
}

/* This code checks for POST requests and deletes the article */
/* It then redirects to /admin/index.php */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
         if ($article->delete($conn)){   
            Url::redirect("/admin/index.php");  
          } 
    }
?>


<h2>Delete article</h2>

<form method="post">
  <p>Are you sure?</p>
  <button>Delete</button>
  <a href="/admin/article.php?id=<?= $article->id; ?>">Cancel</a>
</form>

<?php /* Include footer as part of the code */ ?>
<?php require '../includes/footer.php'; ?>
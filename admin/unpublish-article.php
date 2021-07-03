<?php
//======================================================================
// This code is called when a request to unpublish an article is made
//======================================================================

/* This code includes init.php file 
   which has the class autoloader*/
require '../includes/init.php';

/* This page can be only access by admin user. 
   This code is used to check if admin user is 
   logged in or not . This is done by calling 
    the requireLogin() method in Auth class */
Auth::requireLogin();

/* Get connection to database to access data */
$conn = require '../includes/db.php';

/* This code gets the article using article id  */
$article = Article::getByID($conn, $_POST['id']);

/* This code adds NULL to $published_at 
   using  unpublish($conn) */
$published_at = $article->unpublish($conn);
?>

<!-- Returned unpublished date as NULL -->
<time><?= $published_at ?></time>
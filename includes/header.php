<?php 
/* This code includes init.php file 
   which has the class autoloader*/
require dirname(__DIR__) . '/includes/init.php';

/* This code used to determine which links can be displayed 
  depending on whether admin user is logged in
  or not. Also, for adding active classe to current */
$currentPage = $_SERVER['REQUEST_URI'];
$currentFile = $_SERVER['PHP_SELF'];
    if ($currentPage == "/admin/" || $currentPage == "/admin/article.php" ){
      Auth::requireLogin();
      } 

      if (isset($_GET['id'])) {
        $pageId =  $_GET['id'];
      
      }else{
        $pageId = null;
      }

      if (isset($_GET['page'])) {
        $pageNum =  $_GET['page'];
      
      }else{
        $pageNum = 1;
      }
  
  ?>

<!DOCTYPE html>
<html lang="en">
<!-- css, styling and favicon files -->

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/vendor/bootstrap-5.0.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/vendor/css/normalize.css" />
  <link rel="stylesheet" href="/vendor/css/jquery.datetimepicker.min.css">
  <link rel="stylesheet" href="/css/styles.css" />
  <title>Green Garden Blog</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/uploads/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/uploads/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/uploads/favicons/favicon-16x16.png">
  <link rel="manifest" href="/uploads/favicons/site.webmanifest">
  <link rel="mask-icon" href="/uploads/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="/uploads/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-config" content="/uploads/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
</head>

<body>

  <!-- Navbar Links Start  -->
  <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <div class="container-fluid">
      <a class="navbar-brand" href="/"><img id="nav-logo" src="../uploads/Green-Garden-Logo-130x130.png"
          alt="Green Garden Blog Logo" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav text-uppercase">
          <!--    This part of the navbar can be only access by admin user. 
              This code is used to check if admin user is 
              logged in or not. This is done by calling 
              the requireLogin() method in Auth class -->
          <?php if (Auth::isLoggedIn()):?>
          <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == "/" || $currentPage == "/?page=".$pageNum || $currentPage == "/article.php?id=".$pageId): echo "active"; else: ""; endif; ?>"
              aria-current="page" href="/">home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == "/admin/new-article.php"): echo "active"; else: ""; endif; ?>"
              href="/admin/new-article.php">add article</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == "/admin/" || $currentPage == "/admin/?page=".$pageNum || $currentPage == $currentFile."?id=".$pageId): echo "active"; else: ""; endif; ?>"
              href="/admin">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout.php"><button class="btn text-uppercase">log out</button></a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == "/" || $currentPage == "/?page=".$pageNum || $currentPage == "/article.php?id=".$pageId): echo "active"; else: ""; endif; ?>"
              aria-current="page" href="/">home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == "/contact.php"): echo "active"; else: ""; endif; ?>"
              href="/contact.php">contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/login.php"><button class="btn text-uppercase">log in</button></a>
          </li>
          <?php endif; ?>
          <!-- login end -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar Links End  -->
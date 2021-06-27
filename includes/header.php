<?php require 'classes/Auth.php';?>
<?php session_start();?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/vendor/bootstrap-5.0.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/vendor/normalize.css" />
  <link rel="stylesheet" href="/vendor/jquery.datetimepicker.min.css">
  <link rel="stylesheet" href="/css/styles.css" />
  <title>Green Garden Blog Home</title>
</head>

<body>
  <!-- Header Start  -->

  <!-- Navbar Links Start  -->
  <nav class="navbar navbar-expand-md navbar-light bg-transparent">
    <div class="container-fluid">
      <a class="navbar-brand" href="/"><img id="nav-logo" src="uploads/Green-Garden-Logo-130x130.png"
          alt="Green Garden Blog Logo" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav text-uppercase">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/">home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">contact</a>
          </li>
          <!-- login begin -->
          <?php if (Auth::isLoggedIn()):?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              log out
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/new-article.php">add article</a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">
              log in
            </a>
          </li>
          <?php endif; ?>
          <!-- login end -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar Links End  -->
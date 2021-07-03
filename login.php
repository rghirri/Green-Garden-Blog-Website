<?php
//======================================================================
// This is the login page where admin user can login
//======================================================================

/* This code includes init.php file 
   which has the class autoloader*/
require 'includes/init.php';

/* This code checks for POST requests, and
   check whether username and password 
    is correct */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $conn = require 'includes/db.php';

    if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {

        session_regenerate_id(true);

        $_SESSION['is_logged_in'] = true;

        Url::redirect('/');

    } else {

        $error = "Login Incorrect";
    }
}

?>

<section class="wrapper  wrapper--narrow wrapper--narrow__height">
  <div class="container">
    <div class="row text-center">
      <a class="" href="/"><img id="" src="../uploads/Green-Garden-Logo-130x130.png" alt="Green Garden Blog Logo" /></a>
    </div>
  </div>
  <div class="container">
    <h2 class="text-center mt-5 fs-6 text-uppercase">Login form</h2>
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <!-- validate form begin -->
            <?php if (! empty($error)) : ?>
            <p class="text-danger"><?= $error ?></p>
            <?php endif; ?>
            <!-- validate form end -->
            <form method="post" id=loginForm>

              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                  autocomplete="off">
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                  autocomplete="off">
              </div>

              <button class="btn mt-3 mx-2 add_article_btn">login</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
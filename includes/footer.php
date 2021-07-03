<!-- This code is included in the files to add footer -->

<!-- Footer Start -->
<footer class="container-fluid">
  <!-- footer nav-links begin -->
  <div class="footer-nav container pt-5 d-flex flex-column">
    <a href="/"><img class="footer-nav__logo" src="../uploads/Green-Garden-logo-100x100.png"
        alt="Green Garden Blog Logo" /></a>
    <ul class="footer-nav__lists m-auto">
      <li class=" footer-nav__list">
        <a class="footer-nav__link" aria-current="page" href="/">home</a>
      </li>
      <li class="footer-nav__list">
        <a class="footer-nav__link" href="#">contact</a>
      </li>
      <!--    This part of the navbar can be only access by admin user. 
              This code is used to check if admin user is 
              logged in or not. This is done by calling 
              the requireLogin() method in Auth class -->
      <?php if (Auth::isLoggedIn()):?>
      <li class="footer-nav__list">
        <a class="footer-nav__link" href="/logout.php">login out</a>
      </li>
      <?php else: ?>
      <li class="footer-nav__list">
        <a class="footer-nav__link" href="/login.php">login</a>
      </li>
      <?php endif; ?>
      <!-- ------------------------------ -->
    </ul>
    <p class="footer-nav__copy mt-5">Copyright &copy; <?php echo date("Y");?> Green Garden Blog. All rights reserved</p>
  </div>
</footer>
<!-- Footer End -->
</body>
<!-- javascript files -->
<script src="/vendor/js/jquery-3.6.0.min.js"></script>
<script src="/vendor/js/jquery.datetimepicker.full.min.js"></script>
<script src="/vendor/js/jquery-validation-1.19.3/dist/jquery.validate.min.js"></script>
<script src="/vendor/bootstrap-5.0.1/js/bootstrap.min.js"></script>
<script src="/js/script.js"></script>

</html>
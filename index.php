<?php require 'includes/header.php'; ?>

<!-- Post list begins -->

<section class="wrapper  wrapper--medium">
  <div class="row pt-5">
    <div class="col-md-6">
      <div class="row justify-content-center">
        <div class="col-10 col-lg-9">
          <div class="post-list d-flex flex-column">
            <h2 class="post-list__title">How to grow herbs at home</h2>
            <p id="meta-data">22 feb 2021 | cooking</p>
            <p class="">Lorem ipsum dolor sit amet ac finibus gravida rutrum maximus eu est tellus sem fames sagittis
              nulla
              morbi leo lacinia ornare sociosqu vulputate vel donec eu facilisis ut tortor nec</p>
          </div>
          <button class="btn">Grow herbs</button>
        </div>
      </div>

    </div>
    <div class="col-md-6 ">
      <img class="post-list__image img-fluid" src="/uploads/herbs-min.png" alt="" class="img-fluid" />
    </div>
  </div>

  <div class="row pt-5">
    <div class="col-md-6 order-2 order-md-1">
      <img class="post-list__image img-fluid" src="/uploads/garden-tools-min.png" alt="" class="img-fluid" />
    </div>
    <div class="col-md-6 order-1 order-md-2">
      <div class="row justify-content-center">
        <div class="col-10 col-lg-9">
          <div class="post-list d-flex flex-column">
            <h2 class="post-list__title">Which garden tool to use</h2>
            <p id="meta-data">30 jun 2021 | Tools</p>
            <p class="">Lorem ipsum dolor sit amet ac finibus gravida rutrum maximus eu est tellus sem fames sagittis
              nulla
              morbi leo lacinia ornare sociosqu vulputate vel donec eu facilisis ut tortor nec</p>
          </div>
          <button class="btn">Garden tools</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Post list Pagination  -->
  <nav aria-label="Page">
    <ul class="pagination pt-5">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</section>

<!-- Post list Ends -->

<?php require 'includes/footer.php'; ?>
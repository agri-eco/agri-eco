<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid px-4 px-lg-5 ">
    <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <a class="navbar-brand" href="<?php echo site_url . ''; ?>">
      <img src="<?php echo site_url . 'home.png' ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url . ''  ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="./?page=packages">View Package</a></li>
        <!-- <li class="nav-item"><a class="nav-link" href="./?page=about">About</a></li> -->
        <!--<li class="nav-item"><a class="nav-link" href="./?page=contact">Contact Us</a></li>-->
      </ul>
      <div class="d-flex align-items-center">
        <?php if (!isset($_SESSION['userdata']['id'])) : ?>
          <button class="btn btn-outline-dark ml-2" id="login-btn" type="button">Login</button>
        <?php else : ?>

          <a href="./?page=my_account" class="text-dark  nav-link"><b> Hi, <?php echo $_settings->userdata('firstname') ?>!</b></a>
          <a href="logout.php" class="text-dark  nav-link"><i class="fa fa-sign-out-alt"></i></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<script>
  $(function() {
    $('#login-btn').click(function() {
      uni_modal("", "login.php")
    })
    $('#navbarResponsive').on('show.bs.collapse', function() {
      $('#mainNav').addClass('navbar-shrink')
    })
    $('#navbarResponsive').on('hidden.bs.collapse', function() {
      if ($('body').offset.top == 0)
        $('#mainNav').removeClass('navbar-shrink')
    })
  })
</script>
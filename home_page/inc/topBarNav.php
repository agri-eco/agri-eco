<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid px-4 px-lg-5 ">
    <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <a class="navbar-brand" href="<?php echo base_url . ''; ?>">
      <img src="<?php echo base_url . ($_settings->info('logo')) ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      <?php echo $_settings->info('short_name') ?>
    </a>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
        <li class="nav-item"><a class="nav-link" aria-current="page" href="./">Home</a></li>
        <li class="nav-item"><a class="nav-link" aria-current="page" href="./?p=tour1">Map</a></li>
        <li class="nav-item"><a class="nav-link" aria-current="page" href="<?php echo base_url . '../cvsu_retail'; ?>">Retail Market</a></li>
        <li class="nav-item"><a class="nav-link" aria-current="page" href="<?php echo base_url . '../reservation'; ?>">Reservation</a></li>
        <li class="nav-item"><a class="nav-link" href="./?p=contact1">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link" href="./?p=about">About</a></li>
      </ul>
      <div class="d-flex align-items-center">
        <?php if (!isset($_SESSION['userdata']['id'])) : ?>
          <button class="btn btn-outline-dark ml-2" id="login-btn" type="button">Login</button>
        <?php else : ?>

          <a href="./?p=my_account" class="text-dark  nav-link"><b> Hi, <?php echo $_settings->userdata('firstname') ?>! </b></a>
          <a href="logout.php" class="text-dark  nav-link ml-3"><i class="fa fa-sign-out-alt"> </i></a>
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

  $('#search-form').submit(function(e) {
    e.preventDefault()
    var sTxt = $('[name="search"]').val()
    if (sTxt != '')
      location.href = './?p=products&search=' + sTxt;
  })
</script>
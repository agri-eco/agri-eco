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
        <li class="nav-item"><a class="nav-link" aria-current="page" href="./?p=tour">Map</a></li>
        <li class="nav-item"><a class="nav-link" aria-current="page" href="./?p=portal">Retail Market</a></li>
        <!-- <li class="nav-item"><a class="nav-link" aria-current="page" href="<?php echo base_url . '../cvsu_retail'; ?>">Retail Market</a></li> -->
        <li class="nav-item"><a class="nav-link" aria-current="page" href="./?p=packages">Reservation</a></li>
        <li class="nav-item"><a class="nav-link" href="./?p=contact1">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link" href="./?p=about">About</a></li>
      </ul>
      <div class="d-flex align-items-center ">
        <?php if (!isset($_SESSION['userdata']['id'])) : ?>
          <button class="btn btn-outline-dark ml-2" id="login-btn" type="button">Login</button>
        <?php else : ?>
          <a class="text-dark mr-2 nav-link" href="./?p=cart">
            <i class="bi-cart-fill me-1 fas fa-cart-arrow-down">Cart</i>
            <span class="badge bg-dark text-white ms-1 rounded-pill" id="cart-count">
              <?php
              if (isset($_SESSION['userdata']['id'])) :
                $count = $conn->query("SELECT SUM(quantity) as items from `cart` where client_id =" . $_settings->userdata('id'))->fetch_assoc()['items'];
                echo ($count > 0 ? $count : 0);
              else :
                echo "0";
              endif;
              ?>
            </span>
          </a>
          <ul class="navbar-nav">
            <li class="dropdown dropdown-hover">
              <button id="dropdownSubMenu1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"><b> Hi, <?php echo $_settings->userdata('firstname') ?>!</b></button>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li>
                  <a tabindex="-1" href="./?p=edit_account" class="dropdown-item"><i class="fa fa-user"></i>Manage Account</a>
                </li>
                <li><a href="./?p=purchase" class="dropdown-item"><i class="fas fa-search-dollar"></i>My Purchase</a></li>
                <li><a href="./?p=bookings" class="dropdown-item"><i class="fas fa-search-location"></i>My Bookings</a></li>
                <li><a href="javascript:void(0)" class="dropdown-item logout  "><i class="fa fa-sign-out-alt"></i>Logout</a></li>
              </ul>
            </li>
            <!-- End Level two -->
          </ul>


          </ul>
          <!-- <a href="./?p=my_account" class="text-dark  nav-link"><b> Hi, <?php echo $_settings->userdata('firstname') ?>!</b></a> -->
          <!-- <a href="javascript:void(0)" class="text-dark logout nav-link ml-3"><i class="fa fa-sign-out-alt"> </i></a> -->

          <!-- <a href="logout.php" class="text-dark  nav-link"><i class="fa fa-sign-out-alt"></i></a> -->
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<script>
  $(document).ready(function() {
    $('.logout').click(function() {
      _conf("Are you sure to Log out of session?", "delete_user")
    })
    $('.table').dataTable();
  })

  function delete_user() {
    $.ajax({
      url: _base_url_ + "logout.php",
      success: function() {
        alert_toast("Logout Successful", 'success');
        setTimeout(() => {
          location.replace('./')
        }, 1000);
      }
    })
  }
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
    $('#search-form').submit(function(e) {
      e.preventDefault()
      var sTxt = $('[name="search"]').val()
      if (sTxt != '')
        location.href = './?p=products&search=' + sTxt;
    })
  })
</script>
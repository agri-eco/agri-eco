<div class="text-center">
  <hr>
  <div class="row">
    <div class="col-12 col-sm-12  col-md-12">
      <div class="info-box">
        <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-plus-square"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Items</span>
          <span class="info-box-number">
            <?php
            $inv = $conn->query("SELECT sum(quantity) as total FROM inventory ")->fetch_assoc()['total'];
            $sales = $conn->query("SELECT sum(quantity) as total FROM order_list where order_id in (SELECT order_id FROM sales) ")->fetch_assoc()['total'];
            echo number_format($inv - $sales);
            ?>
            <?php ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-12  col-md-12">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-info elevation-1"><a class="fas fa-th-list" href="<?php echo base_url ?>admin/?page=orders"></a></span>

        <div class="info-box-content">
          <span class="info-box-text">Pending Orders</span>
          <span class="info-box-number">
            <?php
            $pending = $conn->query("SELECT count(id) as total FROM `orders` where status = '0' ")->fetch_assoc()['total'];
            echo number_format($pending);
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->



  </div>

  <div class="row">
    <div class="col-12 col-sm-12  col-md-12">
      <div class="info-box">
        <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-plus-square"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Active Packages</span>
          <span class="info-box-number">
            <?php
            $inv = $conn->query("SELECT sum(status) as total FROM packages ")->fetch_assoc()['total'];

            echo number_format($inv);
            ?>
            <?php ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-12  col-md-12">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-info elevation-1"><a class="fas fa-th-list" href="<?php echo base_url ?>admin/?page=books"></a></span>

        <div class="info-box-content">
          <span class="info-box-text">Pending Booking</span>
          <span class="info-box-number">
            <?php
            $pending = $conn->query("SELECT count(id) as total FROM `book_list` where status = '0' ")->fetch_assoc()['total'];
            echo number_format($pending);
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

  </div>

  <div class="row">
    <div class="col-12 col-sm-12 col-md-12">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Sales</span>
          <span class="info-box-number">
            <?php
            $sales = $conn->query("SELECT sum(amount) as total FROM `orders` where paid = '1'  ")->fetch_assoc()['total'];
            echo number_format($sales);
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div>
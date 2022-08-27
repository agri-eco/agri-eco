<html>

<body>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Apriori Algorithm</h3>
        </div>
        <div class="container-fluid">
            <div class="card-body">

                <?php

                $con = mysqli_connect("localhost", "root", "", "agri_eco_db");
                ?>

                <?php

                if ($result = $con->query("select product_name from products where status='1'", MYSQLI_USE_RESULT)) {


                    while ($i = $result->fetch_row()) {
                        $item[] = $i[0];
                    }
                    if (empty($item)) {
                        die;
                    }
                    $result->close();
                }


                ?>

            </div>
        </div>
        <div class="container-fluid">
            <div class="card-body">


                <?php
                echo "<pre><br><h2>Transaction</h2>";
                echo "<table class=table border=\2\>";
                echo " <tr><td>Item Set</td></tr>";
                if ($result = $con->query("select group_concat(products.product_name separator ',')
    from order_list left join products 
	 on (products.id = order_list.product_id) 
	 group by order_list.order_id ", MYSQLI_USE_RESULT)) {

                    $z = 0;
                    while ($b = $result->fetch_row()) {
                        $purchase[] = $b[0];

                        echo " <tr><td> " . $b[0] . "</td></tr>";
                        $z++;
                    }

                    if (empty($purchase)) {
                        die;
                    }
                    $result->close();
                }

                echo "</table>";
                echo "</pre>";

                ?>


            </div>
        </div>
        <div class="container-fluid">
            <div class="card-body">


                <?php
                $con->close();

                $item1 = count($item) - 1;
                $item2 = count($item);
                $item3 = count($item);

                ?>

            </div>
        </div>
        <div class="container-fluid">
            <div class="card-body">
                <?php

                echo "<pre>";
                echo "\r\n<h3>Step 2: Combine 2 Item</h3>\r\n";
                echo "<table class=table border=\2\>";
                echo "<tr> <td>Item Set</td><td> Support Count</td><td>Support</td></tr>";

                for ($i = 0; $i < $item1; $i++) {
                    for ($j = $i + 1; $j < $item2; $j++) {
                        $item_pair = $item[$i] . '|' . $item[$j];
                        $item_array[$item_pair] = 0;
                        $sprt[$item_pair] = 0;
                        foreach ($purchase as $item_purchase) {
                            if ((strpos($item_purchase, $item[$i]) !== false) && (strpos($item_purchase, $item[$j]) !== false)) {
                                $item_array[$item_pair]++;
                                $sprt[$item_pair]++;
                            }
                            $spr[$item_pair] = round($sprt[$item_pair] / $z * 100, 2);
                        }
                        if ($item_array[$item_pair] > 0) {
                            echo " <tr> <td>$item_pair </td><td> " . $item_array[$item_pair] . "</td><td> " . $spr[$item_pair] . "%</td></tr>";
                        }
                    }
                }
                echo "</table>";
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-md-3 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            // $products = $conn->query("SELECT p.*,i.quantity FROM products p inner join inventory i on p.id = i.id where p.status = 1 and p.category_id = '{$category_id}' and p.id !='{$id}' and i.quantity > 0 order by rand() limit 4 ");
            $products = $conn->query("SELECT p.*,i.quantity FROM products p inner join inventory i on p.id = i.id where p.status = 1 and p.category_id = '{$category_id}' and p.id !='{$id}' and i.quantity > 0 order by rand() limit 4 ");

            while ($row = $products->fetch_assoc()) :
                $upload_path = base_app . '/uploads/product_' . $row['id'];
                $img = "";
                if (is_dir($upload_path)) {
                    $fileO = scandir($upload_path);
                    if (isset($fileO[2]))
                        $img = "uploads/product_" . $row['id'] . "/" . $fileO[2];
                    // var_dump($fileO);
                }
                $inventory = $conn->query("SELECT * FROM inventory where product_id = " . $row['id']);
                $_inv = array();
                foreach ($row as $k => $v) {
                    $row[$k] = trim(stripslashes($v));
                }
                while ($ir = $inventory->fetch_assoc()) {
                    $_inv[] = number_format($ir['price']);
                }
            ?>
                <div class="col mb-5">
                    <div class="card h-100 product-item">
                        <!-- Product image-->
                        <img class="card-img-top w-100" src="<?php echo validate_image($img) ?>" height="200rem" style="object-fit:cover" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $row['product_name'] ?></h5>
                                <!-- Product price-->
                                <?php foreach ($_inv as $k => $v) : ?>
                                    <span><b>Price: </b><?php echo $v ?></span>
                                <?php endforeach; ?>
                                <p class="m-0"><small>By: <?php echo $row['department'] ?></small></p>
                                <br>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-flat btn-primary " href=".?p=view_product&id=<?php echo md5($row['id']) ?>">View</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
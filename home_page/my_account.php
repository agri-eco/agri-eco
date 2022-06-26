    <section class="py-2">
        <div class="container">
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="w-100 justify-content-between d-flex">
                        <h4><b>Orders</b></h4>
                        <a href="./?p=edit_account" class="btn btn btn-dark btn-flat">
                            <div class="fa fa-user-cog"></div> Manage Account
                        </a>
                    </div>
                    <hr class="border-warning">
                    <table class="table table-stripped text-dark">
                        <colgroup>
                            <col width="5%">
                            <col width="15%">
                            <col width="25%">
                            <col width="5%">
                            <col width="20%">
                            <col width="10%">

                        </colgroup>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DateTime</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Delivery Address</th>
                                <th>Order Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $conn->query("SELECT o.*,concat(c.firstname,' ',c.lastname) as client from `orders` o inner join clients c on c.id = o.client_id where o.client_id = '" . $_settings->userdata('id') . "' order by unix_timestamp(o.date_created) desc ");
                            while ($row = $qry->fetch_assoc()) :
                                $row['delivery_address'] = strip_tags(stripslashes(html_entity_decode($row['delivery_address'])));

                            ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                    <td><?php echo md5($row['id']); ?></td>
                                    <td><?php echo number_format($row['amount']) ?> </td>
                                    <td>
                                        <?php if ($row['order_type'] == 2) {
                                            echo "Cavite State University Main Campus - Bancod I, Indang, Cavite";
                                        } else {
                                            echo $row['delivery_address'];
                                            // echo stripslashes(html_entity_decode($row['delivery_address']));
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($row['status'] == 0) : ?>
                                            <span class="badge badge-light text-dark">Pending</span>
                                        <?php elseif ($row['status'] == 1) : ?>
                                            <span class="badge badge-primary">Packed</span>
                                        <?php elseif ($row['status'] == 2) : ?>
                                            <span class="badge badge-warning">Out for Delivery</span>
                                        <?php elseif ($row['status'] == 3) : ?>
                                            <span class="badge badge-success">Delivered</span>
                                        <?php elseif ($row['status'] == 5) : ?>
                                            <span class="badge badge-success">Picked up</span>
                                        <?php elseif ($row['status'] == 6) : ?>
                                            <span class="badge badge-danger">Cancelled</span>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="py-2">
        <div class="container">
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="w-100 justify-content-between d-flex">
                        <h4><b>Booked Packages</b></h4>

                    </div>
                    <hr class="border-warning">
                    <table class="table table-stripped text-dark">
                        <colgroup>
                            <col width="5%">
                            <col width="10">
                            <col width="25">
                            <col width="25">
                            <col width="15">

                        </colgroup>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DateTime</th>
                                <th>Package</th>
                                <th>Schedule</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $conn->query("SELECT b.*,p.title FROM book_list b inner join `packages` p on p.id = b.package_id where b.user_id ='" . $_settings->userdata('id') . "' order by date(b.date_created) desc ");
                            while ($row = $qry->fetch_assoc()) :
                                $review = $conn->query("SELECT * FROM `rate_review` where package_id='{$row['id']}' and user_id = " . $_settings->userdata('id'))->num_rows;
                            ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                    <td><?php echo $row['title'] ?></td>
                                    <td>
                                        Check in: <?php echo date("Y-m-d", strtotime($row['date_start'])) ?><br>
                                        Check out: <?php echo date("Y-m-d", strtotime($row['date_end'])) ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($row['status'] == 0) : ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php elseif ($row['status'] == 1) : ?>
                                            <span class="badge badge-primary">Confirmed</span>
                                        <?php elseif ($row['status'] == 2) : ?>
                                            <span class="badge badge-danger">Cancelled</span>
                                        <?php elseif ($row['status'] == 3) : ?>
                                            <span class="badge badge-success">Done</span>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
    </section>
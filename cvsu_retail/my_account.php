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
                                <th>Action</th>
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
                                    <td><a href="javascript:void(0)" class="view_order" data-id="<?php echo $row['id'] ?>"><?php echo md5($row['id']); ?></a></td>
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
                                    <td align="center">
                                        <?php if ($row['status'] == 0) : ?>

                                            <button type="button" class="btn btn-flat btn-default btn-secondary  btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                Action
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a href="javascript:void(0)" class="dropdown-item view_order" data-id="<?php echo $row['id'] ?>">View</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel</a>
                                            </div>

                                            <!-- <button type="button" class="btn btn-flat btn-default btn-sm">
                                                <a class="btn btn-flat btn-default btn-secondary btn-sm cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel</a>
                                            </button> -->
                                        <?php else : ?>
                                            <button type="button" class="btn btn-flat btn-default btn-sm">
                                                <a href="javascript:void(0)" class="btn btn-flat btn-default btn-secondary btn-sm view_order" data-id="<?php echo $row['id'] ?>">View</a>
                                            </button>
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
    <script>
        function cancel_book($id) {
            start_loader()
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=update_order_status",
                method: "POST",
                data: {
                    id: $id,
                    status: 6
                },
                dataType: "json",
                error: err => {
                    console.log(err)
                    alert_toast("an error occured", 'error')
                    end_loader()
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        alert_toast("Order cancelled", 'success')
                        setTimeout(function() {
                            location.reload()
                        }, 2000)
                    } else {
                        console.log(resp)
                        alert_toast("an error occured", 'error')
                    }
                    end_loader()
                }
            })
        }
        $(function() {
            $('.view_order').click(function() {
                uni_modal("Order Details", "./admin/orders/view_order.php?view=user&id=" + $(this).attr('data-id'), 'large')
            })
            $('.cancel_data').click(function() {
                _conf("Are you sure to cancel this order?", "cancel_book", [$(this).data('id')])
            })
            $('table').dataTable();

        })
    </script>
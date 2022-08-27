<?php
$brands = isset($_GET['b']) ? json_decode(urldecode($_GET['b'])) : array();
?>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-end mb-2">
                <button class="btn btn-outline-dark btn-flat btn-sm" type="button" id="empty_cart">Empty Cart</button>
            </div>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <h3><b>Cart List</b></h3>
                <hr class="border-dark">

                <div class="icheck-primary d-inline" style=" transform: scale(2); margin: 20px;">
                    <input type="checkbox" id="brandAll">
                    <label for="brandAll">
                        All
                    </label>
                </div>

                <?php
                $qry = $conn->query("SELECT c.*,p.product_name,i.price,p.id as pid from `cart` c inner join `inventory` i on i.id=c.inventory_id inner join products p on p.id = i.product_id where c.client_id = " . $_settings->userdata('id'));
                while ($row = $qry->fetch_assoc()) :
                    $upload_path = base_app . '/uploads/product_' . $row['pid'];
                    $img = "";
                    foreach ($row as $k => $v) {
                        $row[$k] = trim(stripslashes($v));
                    }
                    if (is_dir($upload_path)) {
                        $fileO = scandir($upload_path);
                        if (isset($fileO[2]))
                            $img = "uploads/product_" . $row['pid'] . "/" . $fileO[2];
                        // var_dump($fileO);
                    }
                    $inventory = $conn->query("SELECT * FROM inventory where product_id = " . $row['pid']);
                    $inv = array();
                    while ($ir = $inventory->fetch_assoc()) {
                        $inv[] = $ir;
                        $sold = $conn->query("SELECT o.status,sum(ol.quantity) as total FROM order_list ol inner join orders o on o.id = ol.order_id where ol.product_id='{$ir['id']}' and o.status != 4  ")->fetch_assoc()['total'];
                        $avail =  $inv[0]['quantity'] - $sold;
                    }
                ?>
                    <div class="d-flex w-100 justify-content-between  mb-2 py-2 border-bottom cart-item">
                        <div class="d-flex align-items-center col-8">
                            <?php
                            if ($avail < $row['quantity'] && $avail != 0) {
                            ?>
                                <div class="input-group-append">
                                    <input type="checkbox" name="brand" id="<?php echo $row['id'] ?>" <?php echo in_array($row['id'], $brands) ? "checked" : "" ?> class="brand-item" value="<?php echo isset($row['price']) * isset($avail) ? number_format($row['price'] * $avail, 2) : 0.00  ?>" style=" transform: scale(2); margin: 20px;">
                                    <!-- <label for="<?php echo $row['id'] ?>"> -->
                                    </label>
                                </div>
                            <?php
                            } else if ($avail == 0) {
                            ?>
                                <div class="input-group-append">
                                    <input disabled type="checkbox" style=" transform: scale(2); margin: 20px;">
                                    <!-- <label for="<?php echo $row['id'] ?>"> -->
                                    </label>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="input-group-append">
                                    <input type="checkbox" name="brand" id="<?php echo $row['id'] ?>" <?php echo in_array($row['id'], $brands) ? "checked" : "" ?> class="brand-item" value="<?php echo isset($row['price']) * isset($row['quantity']) ? number_format($row['price'] * $row['quantity'], 2) : 0.00  ?>" style=" transform: scale(2); margin: 20px;">
                                    <!-- <label for="<?php echo $row['id'] ?>"> -->

                                    <!-- </label> -->
                                </div>
                            <?php
                            }
                            ?>

                            <span class="mr-2"> <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger rem_item" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></a></span>
                            <img src="<?php echo validate_image($img) ?>" loading="lazy" class="cart-prod-img mr-2 mr-sm-2" alt="" style="height: 15vh; width: 15vw; object-fit: contain;">
                            <div>

                                <p class=" mb-1 mb-sm-1"><?php echo $row['product_name'] ?></p>

                                <p class="mb-1 mb-sm-1"><small><b>Price: </b>₱ <span class="price"><?php echo isset($row['price']) ? number_format($row['price'], 2) : 0.00 ?></span></small></p>
                                <div>
                                    <div class="input-group" style="width:130px !important">
                                        <?php
                                        if ($row['quantity'] > 1) {
                                        ?>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-outline-secondary min-qty" type="button" id="button-addon1-<?php echo $row['id'] ?>"><i class="fa fa-minus"></i></button>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="input-group-prepend">
                                                <button disabled class="btn btn-sm btn-outline-secondary min-qty" type="button" id="button-addon1-<?php echo $row['id'] ?>"><i class="fa fa-minus"></i></button>
                                            </div>
                                        <?php
                                        }
                                        if ($avail < $row['quantity']) {
                                        ?>
                                            <input type="number" class="form-control form-control-sm qty text-center cart-qty" placeholder="" aria-label="Example text with button addon" value="<?php echo $avail ?>" aria-describedby="button-addon1" data-id="<?php echo $row['id'] ?>" readonly>

                                        <?php
                                        } else {
                                        ?>
                                            <input type="number" class="form-control form-control-sm qty text-center cart-qty" placeholder="" aria-label="Example text with button addon" value="<?php echo $row['quantity'] ?>" aria-describedby="button-addon1" data-id="<?php echo $row['id'] ?>" readonly>
                                            <input type="hidden" class="form-control form-control-sm qty text-center avail" placeholder="" style="max-width: 3rem; height: 3rem;" aria-label="Example text with button addon" value="<?php echo $avail ?>" aria-describedby="button-addon1" readonly>

                                        <?php
                                        }
                                        if ($avail <= $row['quantity']) {
                                        ?>
                                            <div class="input-group-append">
                                                <button disabled class="btn btn-sm btn-outline-secondary plus-qty" type="button" id="button-addon1-<?php echo $row['id'] ?>"><i class="fa fa-plus"></i></button>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-outline-secondary plus-qty" type="button" id="button-addon1-<?php echo $row['id'] ?>"><i class="fa fa-plus"></i></button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($row['quantity'] > $avail) {
                        ?>
                            <div class="col text-right align-items-center d-flex justify-content-end">
                                <h4>₱<b class="total-amount"><?php echo isset($row['price']) * isset($avail) ? number_format($row['price'] * $avail, 2) : 0.00  ?></b></h4>
                            </div>
                        <?php } else { ?>
                            <div class="col text-right align-items-center d-flex justify-content-end">
                                <h4>₱<b class="total-amount"><?php echo isset($row['price']) * isset($row['quantity']) ? number_format($row['price'] * $row['quantity'], 2) : 0.00  ?></b></h4>
                            </div>
                        <?php } ?>
                    </div>
                <?php endwhile; ?>
                <div class="d-flex w-100 justify-content-between mb-2 py-2 border-bottom">
                    <div class="col-8 d-flex justify-content-end">
                        <h4>Grand Total:</h4>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <h4>₱ </h4>
                        <h4 id="grand-total">-</h4>
                    </div>
                </div>
            </div>
        </div>
        <?php

        if (!empty($img)) : ?>
            <div class="d-flex w-100 justify-content-end">
                <!-- <a href="./?p=checkout" class="btn btn-lg btn-flat btn-primary"><i class="bi-cart-fill me-1 fas fa-cart-arrow-down">Checkout</i></a> -->
                <!-- <a href="./?p=checkout" class="btn btn-lg btn-flat btn-primary"><i class="bi-cart-fill me-1 fas fa-cart-arrow-down">Checkout</i></a> -->
                <!-- <a class="btn btn-lg btn-flat btn-primary" href="./?p=checkout&b=['<?php $brands ?>']"><i class="bi-cart-fill me-1 fas fa-cart-arrow-down">Checkout1</i></a> -->
                <button type="button" class="btn btn-lg btn-flat btn-primary btn_checkout"><i class="bi-cart-fill me-1 fas fa-cart-arrow-down">Checkout</i>
                </button>
            </div>

        <?php endif; ?>
    </div>
</section>

<script>
    $('.btn_checkout').attr('disabled', true)

    function _filter() {
        var brands = []
        var total = 0.00
        $('.brand-item:checked').each(function() {
            brands.push(this.id);

            // $('.brand-item:checked').each(function() {
            amount = $(this).val()
            amount = amount.replace(/\,/g, '')
            amount = parseFloat(amount)
            total += amount
            // })

        });
        $('#grand-total').text(parseFloat(total).toLocaleString('en-US'))

        if (brands <= 0) {
            $('.btn_checkout').attr('disabled', true)
        } else {
            $('.btn_checkout').removeAttr('disabled')
        }

        $(document).on("click", 'button.btn_checkout', function() {
            window.location.href = "./?p=checkout&b=[" + brands + "]";
        });
        // $('.brand-item:checked').each(function() {
        //     // brands.push(parseInt($(this).val()));
        //     brands.push($(this).val())
        //     // brands.join(",")
        // })
        // var arr = [brands.join(",")];
        // var cnt = 0;
        // var things = arr;
        // for (var i = 0; i < brands.length; i++) {
        //     // var arr = [brands.join(",")];
        //     alert_toast("Selected values: " + brands);
        //     if (brands.length == i)
        //         $("a[href='./?p=checkout'").attr('href', "./?p=checkout&b=[" + brands + "]")

        // alert_toast("Selected values: " + brands);
        // $("a[href='./?p=checkout'").attr('href', "./?p=checkout&b=[" + brands + "]")
        // }
        // var cnt = brands.length;
        // if (brands.length == cnt)
        // $.each(brands, function(index, value) {
        //     // Get value in alert  
        //     // alert_toast("./?p=checkout&b=[" + arr + "]");
        //     // $("a[href='./?p=checkout']").attr('href', "./?p=checkout&b=[" + brands.join(",") + "]")
        //     // alert_toast("Selected values: " + brands.length);
        //     // $("a[href='./?p=checkout'").attr('href', "./?p=checkout&b=[" + brands + "]")
        // });

        _b = JSON.stringify(brands)
        var checked = $('.brand-item:checked').length
        var total = $('.brand-item').length
        if (checked == total) {
            $('#brandAll').prop('checked', true)
        } else {
            $('#brandAll').prop('checked', false)
        }
        // $('#brandAll').change(function() {
        //     if ($(this).is(':checked') == true) {
        //         $('.brand-item').prop('checked', true)
        //     } else {
        //         $('.brand-item').prop('checked', false)
        //     }
        // })
    }
    // $("a[href='./?p=checkout'").attr('href', "./?p=checkout&b=" + _b)

    // if (checked == brands.length) {
    //     alert_toast("Selected values: " + _b);
    //     $("a[href='./?p=checkout'").attr('href', "./?p=checkout&b=" + _b)
    // }

    // $("a[href='./?p=checkout'").attr('href', "./?p=checkout&b=" + _b)
    // else
    // location.href = "./?p=cart&b=[" + brands.join(",") + "]";
    // $("a[href='./?p=checkout'").attr('href', "./?p=checkout&b=[" + arr + "]")
    // $("a[href='#'").attr('href', "./?p=checkout&b=[" + brands.join(",") + "]")


    // function _filter() {
    //     var brands = []
    //     $('.brand-item:checked').each(function() {
    //         brands.push($(this).val())
    //     })
    //     var arr = [brands.join(",")];
    //     // $.each(arr, function(index, value) {
    //     //     // Get value in alert  
    //     //     alert_toast(value);

    //     //     // alert_toast("Selected values: " + brands.join(","));

    //     // });
    //     // $("a[href='./?p=checkout']").attr('href', "./?p=checkout&b=[" + value + "]")
    //     // this.href = this.href.replace(/^http:\/\/beta\.localhost\.com/, "./?p=checkout&b=[" + brands.join(", ") + "]");
    //     bb = JSON.stringify(brands)
    //     var checked = $('.brand-item:checked').length
    //     var total = $('.brand-item').length
    //     if (checked == total)
    //         location.href = "./?p=brands&id=" + (_b);
    //     else
    //         location.href = "./?p=brands&id=" + (_b);
    // }

    // function check_filter() {
    //     var checked = $('.brand-item:checked').length
    //     var total = $('.brand-item').length
    //     if (checked == total) {
    //         $('#brandAll').attr('checked', true)
    //     } else {
    //         $('#brandAll').attr('checked', false)
    //     }
    //     // if ('<?php echo isset($_GET['b']) ?>' == '')
    //     //     $('#brandAll,.brand-item').attr('checked', false)
    // }
    $(function() {
        // check_filter()
        $('#brandAll').change(function() {
            if ($(this).is(':checked') == true) {
                $('.brand-item').prop('checked', true)
            } else {
                $('.brand-item').prop('checked', false)
            }
            _filter()
        })
        $('.brand-item').change(function() {
            _filter()

        })
    })



    // function _filter() {
    //     var total = 0.00
    //     // $("input:checkbox[name=brand]:checked").each(function() {
    //     // })
    //     $('.total-amount').each(function() {
    //         amount = $(this).text()
    //         amount = amount.replace(/\,/g, '')
    //         amount = parseFloat(amount)
    //         total += amount
    //     })
    //     $('#grand-total').text(parseFloat(total).toLocaleString('en-US'))
    // }


    function qty_change($type, _this) {
        var qty = _this.closest('.cart-item').find('.cart-qty').val()
        var price = _this.closest('.cart-item').find('.price').text()
        var avail = _this.closest('.cart-item').find('.avail').val()
        price = price.replace(/,/g, '')
        console.log(price)
        var cart_id = _this.closest('.cart-item').find('.cart-qty').attr('data-id')
        var new_total = 0
        start_loader();

        if ($type == 'minus') {
            qty = parseInt(qty) - 1
            $('.plus-qty').prop('disabled', false);
            if (qty < 2) {
                // qty = parseInt(qty) + 1
                $('.min-qty').prop('disabled', true);
            }

        } else if ($type == 'plus') {
            qty = parseInt(qty) + 1
            $('.min-qty').prop('disabled', false);
            if (qty == avail) {
                // qty = parseInt(qty) - 1
                $('.plus-qty').prop('disabled', true);
            }

        }

        price = parseFloat(price)
        // console.log(qty,price)

        new_total = parseFloat(qty * price).toLocaleString('en-US')
        _this.closest('.cart-item').find('.cart-qty').val(qty)
        _this.closest('.cart-item').find('.total-amount').text(new_total)
        _this.closest('.cart-item').find('.avail').val(avail)
        _filter()


        $.ajax({
            url: 'classes/Master.php?f=update_cart_qty',
            method: 'POST',
            data: {
                id: cart_id,
                quantity: qty
            },
            dataType: 'json',
            error: err => {
                console.log(err)
                alert_toast("an error occured", 'error');
                end_loader()
            },
            success: function(resp) {
                if (!!resp.status && resp.status == 'success') {
                    location.reload()
                    end_loader()
                } else {
                    alert_toast("an error occured", 'error');
                    end_loader()
                }
            }

        })
    }

    function rem_item(id) {
        $('.modal').modal('hide')
        var _this = $('.rem_item[data-id="' + id + '"]')
        var id = _this.attr('data-id')
        var item = _this.closest('.cart-item')
        start_loader();
        $.ajax({
            url: 'classes/Master.php?f=delete_cart',
            method: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            error: err => {
                console.log(err)
                alert_toast("an error occured", 'error');
                end_loader()
            },
            success: function(resp) {
                if (!!resp.status && resp.status == 'success') {
                    item.hide('slow', function() {
                        location.reload()
                        item.remove()

                    })
                    _filter()
                    end_loader()
                } else {
                    alert_toast("an error occured", 'error');
                    end_loader()
                }
            }

        })
    }

    function empty_cart() {
        start_loader();
        $.ajax({
            url: 'classes/Master.php?f=empty_cart',
            method: 'POST',
            data: {},
            dataType: 'json',
            error: err => {
                console.log(err)
                alert_toast("an error occured", 'error');
                end_loader()
            },
            success: function(resp) {
                if (!!resp.status && resp.status == 'success') {
                    location.reload()
                } else {
                    alert_toast("an error occured", 'error');
                    end_loader()
                }
            }

        })
    }
    $(function() {
        _filter()
        $('.min-qty').click(function() {
            qty_change('minus', $(this))
        })
        $('.plus-qty').click(function() {
            qty_change('plus', $(this))
        })
        $('#empty_cart').click(function() {
            // empty_cart()
            _conf("Are you sure to empty your cart list?", 'empty_cart', [])
        })
        $('.rem_item').click(function() {
            _conf("Are you sure to remove the item in cart list?", 'rem_item', [$(this).attr('data-id')])
        })
    })
</script>
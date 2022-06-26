<?php
$total = 0;
$qry = $conn->query("SELECT c.*,p.product_name,i.price,p.id as pid from `cart` c inner join `inventory` i on i.id=c.inventory_id inner join products p on p.id = i.product_id where c.client_id = " . $_settings->userdata('id'));
while ($row = $qry->fetch_assoc()) :
    $total += $row['price'] * $row['quantity'];
endwhile;
?>
<section class="py-5">
    <div class="container">
        <div class="card rounded-0">
            <div class="card-body"></div>
            <h3 class="text-center"><b>Checkout</b></h3>
            <hr class="border-dark">
            <form action="" id="place_order">
                <input type="hidden" name="amount" value="<?php echo $total ?>">
                <input type="hidden" id="payment_method" name="payment_method" value="Cash on Delivery">
                <input type="hidden" name="paid" value="0">
                <div class="row row-col-1 justify-content-center">
                    <div class="col-6">
                        <div class="form-group col mb-0">
                            <label for="" class="control-label">Order Type</label>
                        </div>
                        <div class="form-group d-flex pr-2">
                            <div class="custom-control custom-radio mr-3">
                                <input class="custom-control-input custom-control-input-primary custom-control-input-outline" type="radio" id="customRadio5" name="order_type" value="1" checked="">
                                <label for="customRadio5" class="custom-control-label">For Delivery</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio4" name="order_type" value="2">
                                <label for="customRadio4" class="custom-control-label">Pick up in store</label>
                            </div>
                        </div>
                        <div class="form-group col address-holder">
                            <label for="" class="control-label">Delivery Address</label>
                            <textarea id="" cols="30" rows="3" name="delivery_address" class="form-control" style="resize:none"><?php echo $_settings->userdata('default_delivery_address') ?></textarea>
                        </div>
                        <div class="pick-up">
                            <input class="form-control" type="" value="Cavite State University Main Campus - Bancod I, Indang, Cavite" aria-label="Disabled input example" disabled readonly>
                        </div>
                        <div class="col">
                            <span>
                                <h4><b>Total:</b> <?php echo number_format($total) ?></h4>
                            </span>
                        </div>
                        <hr>

                        <h4 class="text-muted">Payment Method</h4>
                        <div class="d-flex w-100 justify-content-between ">
                            <button class="btn btn-flat btn-dark method-holder1">Cash on Delivery</button>
                        </div>
                        <div class="d-flex w-100 justify-content-between ">
                            <button class="btn btn-flat btn-dark method-holder">Cash on Pick-up</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    $('.pick-up').hide()
    $('.method-holder').hide()
    $(function() {
        $('[name="order_type"]').change(function() {
            if ($(this).val() == 2) {
                $('.address-holder').hide('slow')
                $('.method-holder1').hide('slow')
                $('.method-holder').show('slow')
                $('.pick-up').show('slow')
                $('#payment_method').val('Cash on pick-up')
            } else {
                $('.address-holder').show('slow')
                $('.method-holder').hide('slow')
                $('.method-holder1').show('slow')
                $('.pick-up').hide('slow')
            }
        })
        $('#place_order').submit(function(e) {
            e.preventDefault()
            start_loader();
            $.ajax({
                url: 'classes/Master.php?f=place_order',
                method: 'POST',
                data: $(this).serialize(),
                dataType: "json",
                error: err => {
                    console.log(err)
                    alert_toast("an error occured", "error")
                    end_loader();
                },
                success: function(resp) {
                    if (!!resp.status && resp.status == 'success') {
                        alert_toast("Order Successfully placed.", "success")
                        setTimeout(function() {
                            location.replace('./')
                        }, 2000)
                    } else {
                        console.log(resp)
                        alert_toast("an error occured", "error")
                        end_loader();
                    }
                }
            })
        })
    })
</script>
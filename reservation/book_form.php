<?php
require_once('config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `packages` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = stripslashes($v);
        }
    }
}
date_default_timezone_set('Asia/Manila');
?>
<style>
    #uni_modal .modal-content>.modal-footer {
        display: none;
    }

    .marquee {
        animation: animate 5s linear infinite;
        display: inline-block;
        padding-left: 100%;
    }

    @keyframes animate {
        100% {
            transform: translate(-100%, 0);
        }
    }
</style>
<div class="container-fluid">
    <form action="" id="book-form">
        <input type="hidden" name="package_id" value="<?php echo $_GET['id'] ?>">
        <div class="form-group">
            <label for="date_start" class="control-label">Check in:</label>
            <input type="date" name="date_start" id="date_start" class="form-control form-conrtrol-sm rounded-0" min="<?php echo date("Y-m-d") ?>" value="<?php echo date("Y-m-d") ?>" required>
        </div>
        <div class="form-group">
            <label for="date_end" class="control-label">Check out:</label>
            <input type="date" name="date_end" id="date_end" class="form-control form-conrtrol-sm rounded-0" min="<?php echo date("Y-m-d") ?>" value="<?php echo date("Y-m-d") ?>" required>
        </div>
        <div id="msg" class="text-danger"></div>
        <div id="check-availability-loader" class="d-none">
            <center>
                <div class="d-flex align-items-center col-md-6">
                    <strong>Checking Availability...</strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
            </center>
        </div>
        <div class="form-group">
            <label for="rent_days" class="control-label">Days to Rent</label>
            <input type="number" name="rent_days" id="rent_days" class="form-control form-conrtrol-sm rounded-0 text-right" value="1" required readonly>
        </div>
        <div class="form-group">
            <label for="cost" class="control-label">Daily Rate</label>
            <input type="text" name="cost" id="cost" class="form-control form-conrtrol-sm rounded-0 text-right" value="<?php echo isset($cost) ? number_format($cost, 2) : 0.00 ?>" required readonly>
        </div>
        <div class="form-group">
            <label for="amount" class="control-label">Tour payment</label>
            <input type="number" name="cost" id="amount" class="form-control form-conrtrol-sm rounded-0 text-right" value="<?php echo isset($cost) ? number_format($cost, 2) : 0.00 ?>" required readonly>
        </div>
        <div class="form-group">
            <label for="unli" class="control-label">Add ons (Optional)
                <fieldset>
                    <input type="radio" class="control-label" name="enabler" value="Enable" checked>Enable
                    <input type="radio" class="control-label" name="enabler" value="Disable">Disable
                </fieldset>
            </label><br>
            <fieldset>

                <div>
                    <input type="checkbox" id="unli" name="unli" value="Unli Samgyupsal">
                    <label for="unli"> Unlimited samgyupsal &amp; Al fresco dining experience</label><br>
                </div>
                <div class="form-group d-flex pr-2">
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio5" name="inclusion" value="Half Day Photoshoot">
                        <label for="customRadio5" class="custom-control-label">Half Day Photoshoot - Maximum of 10 guests, 8am-1pm or 1pm-6pm, use of villa</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio4" name="inclusion" value="Whole Day Photoshoot">
                        <label for="customRadio4" class="custom-control-label">Whole Day Photoshoot - Maximum of 10 guests, 8am-6pm, use of villa</label>
                    </div>
                </div>
            </fieldset>

            <input type="button" class="btn btn-primary" value="Reset" id="btnReset">

            <!-- <div class="custom-control custom-radio mr-3">
                          <input class="custom-control-input custom-control-input-primary custom-control-input-outline" type="radio" id="customRadio5" name="unli" value=""checked="">
                          <label for="customRadio5" class="custom-control-label">None</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio4" name="unli" value="Unlimited samgyupsal" >
                          <label for="customRadio4" class="custom-control-label">Unlimited samgyupsal &amp; Al fresco dining  experience</label>
                        </div> -->

            <!-- <div class="form-group d-flex pr-2"> -->
            <!-- <div class="custom-control custom-radio mr-3">
                          <input class="custom-control-input custom-control-input-primary custom-control-input-outline" type="radio" id="customRadio6" name="unli" value="1"checked="">
                          <label for="customRadio6" class="custom-control-label">None</label>
                        </div> -->

            <!-- </div> -->
            <!-- <select type="number" name="inclusion" id="item" class="custom-select select2" required>
                <option value="">None</option>
                <?php
                $qry = $conn->query("SELECT * FROM `package_inclusion` where status='1' order by id asc");
                while ($row = $qry->fetch_assoc()) :
                    // $a = $row['inclusion_cost'];    
                    // $int_value = intval($a);
                ?>
                <option value="<?php echo $row['item'] ?>"  <?php echo isset($inclusion) && $inclusion == $row['id'] ? 'selected' : '' ?>><?php echo $row['item']; ?> | <?php echo $row['item_details']; ?></option>
                <?php endwhile; ?>
                </select> -->
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary" name="save" id='submit' onclick="$('#uni_modal form').submit()">Book now</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
</div>
<script>
    // Enable checkbox
    $("input[value='Enable']").change(function() {
        $("input[name='unli']").prop('disabled', false);
        $("input[name='inclusion']").prop('disabled', false);
    });
    // Disable checkbox
    $("input[value='Disable']").change(function() {
        $("input[name='unli']").prop('disabled', true);
        $("input[name='inclusion']").prop('disabled', true);
    });

    // Trigger reset button click
    $("#btnReset").on("click", function() {
        $("input[value='Enable']").prop('checked', true);
        $("input[name='unli']").prop('checked', false);
        $("input[name='unli']").prop('disabled', false);
        $("input[name='inclusion']").prop('checked', false);
        $("input[name='inclusion']").prop('disabled', false);
    });

    function calc_rent_days() {
        var ds = new Date($('#date_start').val())
        var de = new Date($('#date_end').val())
        var diff = de - ds;
        var days = (Math.floor((diff) / (1000 * 60 * 60 * 24))) + 1
        $('#rent_days').val(days)
        if (days > 0) {
            calc_amount()
        }
    }

    function calc_amount() {
        var dr = "<?php echo isset($cost) ? $cost : '' ?>";
        // var dr = $('#cost').val()
        var dt = $('#item').val()
        var days = $('#rent_days').val()
        var amount = dr * days;
        var amount1 = (dt - 1);
        var amount2 = (amount1 + amount) + 1;
        console.log(amount)
        $('#amount').val(amount)
    }
    $(function() {
        $('#date_start, #date_end,#item').change(function() {
            $('#msg').text('')
            $('#date_start, #date_end').removeClass('border-success border-danger')
            var ds = $('#date_start').val()
            var de = $('#date_end').val()
            var package_id = "<?php echo isset($id) ? $id : '' ?>";
            var max_unit = "<?php echo isset($quantity) ? $quantity : '' ?>";
            if (ds == '' || de == '' || package_id == '' || max_unit == '')
                return false;
            if (de < ds) {
                $('#date_start, #date_end').addClass('border-danger')
                $('#msg').text("Invalid Selected Dates")
                return false;
            }
            $('#check-availability-loader').removeClass('d-none')
            $('#uni_modal button').attr('disabled', true)
            $.ajax({
                url: 'classes/Master.php?f=rent_avail',
                method: "POST",
                data: {
                    ds: ds,
                    de: de,
                    package_id: package_id,
                    max_unit: max_unit
                },
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast('An error occured while checking availability', 'error')
                    $('#check-availability-loader').addClass('d-none')
                    $('#uni_modal button').attr('disabled', false)
                },
                success: function(resp) {
                    if (resp.status == 'success') {
                        $('#date_start, #date_end').addClass('border-success')
                    } else if (resp.status == 'not_available') {
                        $('#date_start, #date_end').addClass('border-danger')
                        $('#msg').text(resp.msg)
                    } else {
                        alert_toast('An error occured while checking availability', 'error')
                    }
                    $('#check-availability-loader').addClass('d-none')
                    $('#uni_modal button').attr('disabled', false)
                    calc_rent_days()
                }
            })

        })
        $('#book-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            if (_this.find('.border-danger').length > 0) {
                alert_toast('Can\'t proceed submission due to invalid inputs in some fields.', 'warning')
                return false;
            }
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=book_tour",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        alert_toast("Book Request Successfully sent.")
                        $('.modal').modal('hide')
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({
                            scrollTop: _this.closest('.card').offset().top
                        }, "fast");
                        end_loader()
                    } else {
                        alert_toast("An error occured", 'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        })
    })
</script>
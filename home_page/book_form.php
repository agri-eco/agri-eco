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

    .toggleSwitch span span {
        display: none;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 45px;
        height: 17px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 13px;
        width: 13px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 17px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .slidecontainer {
        width: 100%;
    }

    .slider1 {
        -webkit-appearance: none;
        width: 100%;
        height: 15px;
        border-radius: 5px;
        background: #d3d3d3;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .slider1:hover {
        opacity: 1;
    }

    .slider1::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: black;
        cursor: pointer;
    }

    .slider1::-moz-range-thumb {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: #04AA6D;
        cursor: pointer;
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
            <label for="pax" class="control-label">Number of Pax</label>
            <input type="range" name="pax" for="pax" min="<?php echo $min ?>" max="<?php echo $max ?>" value="<?php echo $min ?>" class="slider1 form-control form-conrtrol-sm rounded-0 text-right" id="pax">
            <p>Pax: <span id="demo"></span></p>
        </div>
        <div class="form-group">
            <label for="rent_days" class="control-label">Days to Rent</label>
            <input type="number" name="rent_days" id="rent_days" class="form-control form-conrtrol-sm rounded-0 text-right" value="1" required readonly>
        </div>
        <div class="form-group">
            <label for="amount2" class="control-label">Daily Rate</label>
            <input type="text" id="amount2" class="form-control form-conrtrol-sm rounded-0 text-right" value="<?php echo '₱';
                                                                                                                echo $cost;
                                                                                                                echo '/pax'; ?>" required readonly>

        </div>
        <div class="form-group">
            <label for="amount" class="control-label">Tour payment</label>
            <input type="text" id="amount" class="form-control form-conrtrol-sm rounded-0 text-right" value="<?php echo '₱';
                                                                                                                echo $cost * $min;
                                                                                                                echo '.00'; ?>" required readonly>
        </div>
        <b>Add ons (Optional)</b>
        <div class="form-group">
            <label class="switch">
                <input class="toggle" id="enabler" name="enabler" type="checkbox" />
                <span class="slider round"></span>
            </label>
            <fieldset>
                <div class="custom-control address-holder">
                    <input class="unli custom-control-input custom-control-input-primary" type="checkbox" id="unli" name="unli" value="Unli Samgyupsal">
                    <label for="unli" class="custom-control-label">Unli-samgyupsal & Al fresco dining experience - ₱550/Pax </label><br>
                </div>
                <div class="form-group d-flex pr-2">
                    <div class="custom-control custom-radio address-holder">
                        <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio5" name="inclusion" value="Half Day Photoshoot">
                        <label for="customRadio5" class="custom-control-label">Half Day Photoshoot - Maximum of 10 guests, 8am-1pm or 1pm-6pm, use of villa - ₱5000</label>
                    </div>
                    <div class="custom-control custom-radio address-holder">
                        <input class="custom-control-input custom-control-input-primary" type="radio" id="customRadio4" name="inclusion" value="Whole Day Photoshoot">
                        <label for="customRadio4" class="custom-control-label">Whole Day Photoshoot - Maximum of 10 guests, 8am-6pm, use of villa - ₱7000</label>
                    </div>
                </div>
                <div class="form-group address-holder">
                    <label for="amount1" class="control-label">Add on payment</label>
                    <input type="text" id="amount1" class="form-control form-conrtrol-sm rounded-0 text-right" value="0" required readonly>
                </div>
            </fieldset>
        </div>
        <div class="modal-footer">
            <label for="cost" class="control-label">Total Payment</label>
            <input type="text" id="cost" class="form-control form-conrtrol-sm rounded-0 text-right" value="<?php echo '₱';
                                                                                                            echo $cost * $min;
                                                                                                            echo '.00'; ?>" required readonly>
            <input type="hidden" name="cost" id="cost1" class="form-control form-conrtrol-sm rounded-0 text-right" value="<?php echo $cost * $min; ?>" required readonly>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" name="save" id='submit' onclick="$('#uni_modal form').submit()">Book now</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<script>
    (function() {
        $(document).ready(function() {
            $('.toggle').on('change', function() {
                var isChecked = $(this).is(':checked');
                var selectedData;
                var $switchLabel = $('.toggle');
                console.log('isChecked: ' + isChecked);

                if (isChecked) {
                    selectedData = $switchLabel.attr('data-on');
                    $("input[name='unli']").prop('disabled', false);
                    $("input[name='inclusion']").prop('disabled', false);
                    $('.address-holder').show('slow')
                } else {
                    selectedData = $switchLabel.attr('data-off');
                    $("input[name='unli']").prop('disabled', true);
                    $("input[name='inclusion']").prop('disabled', true);
                    $("input[name='unli']").prop('checked', false);
                    $("input[name='inclusion']").prop('checked', false);
                    calc_amount()
                    $('.address-holder').hide('slow')
                }
                console.log('Selected data: ' + selectedData);

            });
        });

    })();
    var slider = document.getElementById("pax");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function() {
        var x = this.value;
        $('#pax').val(x)
        output.innerHTML = x;
        calc_amount()
    }
    $('.address-holder').hide()

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
        if ($("input[name='unli']").is(':checked')) {
            var un = 550;
        } else {
            var un = 0;
        }
        if ($("input[value='Whole Day Photoshoot']").is(':checked')) {
            var rb = 7000;
        } else if ($("input[value='Half Day Photoshoot']").is(':checked')) {
            var rb = 5000;
        } else {
            var rb = 0;
        }
        var dr = "<?php echo isset($cost) ? $cost : '' ?>";
        var days = $('#rent_days').val()
        var px = $('#pax').val()
        var amount = dr * days;
        var amount4 = '₱' + amount * px + '.00';
        var amount1 = '₱' + ((un * px) + rb) + '.00';
        var amount6 = (((un * px) + rb) + (amount * px));
        var amount5 = '₱' + (((un * px) + rb) + (amount * px)) + '.00';
        // var amount2 = (amount4 + amount1) + 1;
        console.log(amount4)
        $('#amount').val(amount4)
        $('#amount1').val(amount1)
        $('#cost').val(amount5)
        $('#cost1').val(amount6)
    }
    $(function() {
        $('#date_start,#date_end,#unli,#customRadio5,#customRadio4,#pax').change(function() {
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
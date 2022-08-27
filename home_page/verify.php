<?php
include('config.php');
$act = $conn->query("SELECT * FROM clients where id = " . $_settings->userdata('id'));

while ($ive = $act->fetch_assoc()) :
    $lol = $ive['active'];

?>
    <style>
        #uni_modal .modal-content>.modal-footer,
        #uni_modal .modal-content>.modal-header {
            display: none;
        }
    </style>

    <div class="container-fluid">

        <div class="row">
            <h3 class="float-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h3>
            <div class="col-lg-12">
                <h3 class="text-center">Verify Email</h3>
                <hr>
                <form action="" id="verification">
                    <h5 class="text-center">Verify Your email to proceed in transaction.</h5>
                    <div class="row  align-items-center h-100">

                        <div class="col-lg-12">
                            <div class="form-group" style="display: flex;">
                                <input style=" flex: 1;" type="text" name="email" class="form-control  form" value="<?php echo $_settings->userdata('email') ?>" required readonly>
                                <?php

                                if ($ive['active'] == 0) {
                                ?>
                                    <!-- <a href="./?p=edit_account" class="btn btn btn-primary btn-flat">
                                        <div class="fa fa-user-cog"></div> Verify Email
                                    </a> -->
                                    <button class=" btn btn-primary btn-flat btn-default veri">Verify Email</button>
                                <?php
                                } else if ($ive['active'] == 1) {
                                ?>
                                    <button disabled type="button" class=" btn-primary">Email Already Verified</button>

                            <?php
                                }
                            endwhile;
                            ?>
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-end">

                        </div>
                    </div>
                </form>
                <!-- <form action="" id="verification">

                <div class="form-group">
                    <label for="email" class="control-label">Please enter your email.</label>
                    <input type="email" name="email" class="form-control form" value="" placeholder="(Enter your email)" required>
                </div>

                <div class="form-group d-flex justify-content-between">
                    <a href="javascript:void()" id="login-show">Already have an Account</a>
                    <button class="btn btn-primary btn-flat">Send code</button>
                </div>
            </form> -->
            </div>
        </div>
        <!--</div>-->
    </div>

    <script>
        $(function() {
            $(".veri").click(function() {
                $(this).html('Resend Verification');
            });
            $('#verification').submit(function(e) {
                e.preventDefault();

                start_loader()
                if ($('.err-msg').length > 0)
                    $('.err-msg').remove();
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=verify",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    error: err => {
                        console.log(err)
                        alert_toast("an error occured", 'error')
                        end_loader()
                    },
                    success: function(resp) {
                        if (typeof resp == 'object' && resp.status == 'success') {
                            alert_toast("Email Verification sent", 'success');
                            setTimeout(function() {
                                end_loader()
                            }, 2000)
                        } else if (resp.status == 'failed' && !!resp.msg) {
                            var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                            $('#verification').prepend(_err_el)
                            end_loader()

                        } else {
                            console.log(resp)
                            alert_toast("Email Not Found.", 'error')
                        }

                    }
                })
            })
        })
    </script>
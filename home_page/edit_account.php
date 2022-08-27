<?php

$act = $conn->query("SELECT * FROM clients where id = " . $_settings->userdata('id'));

while ($ive = $act->fetch_assoc()) :
    $lol = $ive['active'];

?>


    <div class="container">
        <!--<div class="card rounded-0">-->
        <div class="card-body">
            <div class=" justify-content-between d-flex">
                <h4><b>Update Account Details</b></h4>
                <!-- <a href="./?p=my_account" class="btn btn btn-primary btn-flat">
                    <div class="fa fa-angle-left"></div> Back to Transactions
                </a> -->
            </div>
        </div>
        <!--</div>-->
    </div>
    <div class="container-fluid">
        <!--<div class="card rounded-0">-->
        <div class="card-body">
            <hr class="border-warning">
            <div>

                <form action="" id="update_account">
                    <input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
                    <div class="row  align-items-center">
                        <div class="col-lg-6 border-right">
                            <div class="form-group">
                                <label for="firstname" class="control-label" required>Firstname</label>
                                <input type="text" name="firstname" class="form-control  form" value="<?php echo $_settings->userdata('firstname') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="control-label" required>Lastname</label>
                                <input type="text" name="lastname" class="form-control  form" value="<?php echo $_settings->userdata('lastname') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label" required>Contact</label>
                                <input type="tel" pattern="^\d{11}$" class="form-control  form" placeholder='09xxxxxxxxx' name="contact" value="<?php echo $_settings->userdata('contact') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Gender</label>
                                <select name="gender" id="" class="custom-select select" required>
                                    <option <?php echo $_settings->userdata('gender') == "Male" ? "selected" : '' ?>>Male</option>
                                    <option <?php echo $_settings->userdata('gender') == "Female" ? "selected" : '' ?>>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <form action="" id="verify">
                                <label for="email" class="control-label">Email</label>
                                <div class="form-group" style="display: flex;">
                                    <input style=" flex: 1;" type="text" name="email" class="form-control form" value="<?php echo $_settings->userdata('email') ?>" required readonly>
                                    <?php

                                    if ($ive['active'] == 0) {
                                    ?>
                                        <!-- <a href="./?p=edit_account" class="btn btn btn-primary btn-flat">
                                        <div class="fa fa-user-cog"></div> Verify Email
                                    </a> --> <a href="javascript:void()" id="verify" class="btn btn-primary btn-flat">
                                            <div class=" fa fa-user-cog">
                                            </div> Verify Email
                                        </a>
                                        <!-- <button class="btn btn-primary btn-primary verify" id='submit'>Verify Email</button> -->
                                    <?php
                                    } else if ($ive['active'] == 1) {
                                    ?>
                                        <button disabled type="button" class="fa fa-check btn-primary">Email Verified</button>

                                <?php
                                    }
                                endwhile;
                                ?>
                                </div>
                            </form>
                            <!-- <div class="form-group col-lg-6">
                                <label for="email" class="control-label">Email</label>
                                <input type="text" name="email" class="form-control  form" value="<?php echo $_settings->userdata('email') ?>" required readonly>
                            </div> -->
                            <div class="form-group">
                                <label for="cpassword" class="control-label">Current Password</label>
                                <input type="password" name="cpassword" class="form-control  form" value="" placeholder="(Leave blank if you dont want to change password)">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">New Password</label>
                                <input type="password" name="password" class="form-control  form" value="" placeholder="(Enter value to change password)">
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button class="btn btn-primary btn-flat btn-default" id="submit">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!--</div>-->
    </div>

    <script>
        $(function() {
            $('#verify').click(function() {
                uni_modal("", "verify.php")

            })


            $('#update_account [name="password"],#update_account [name="cpassword"]').on('input', function() {
                if ($('#update_account [name="password"]').val() != '' || $('#update_account [name="cpassword"]').val() != '')
                    $('#update_account [name="password"],#update_account [name="cpassword"]').attr('required', true);
                else
                    $('#update_account [name="password"],#update_account [name="cpassword"]').attr('required', false);
            })
            $('#update_account').submit(function(e) {
                e.preventDefault();
                start_loader()
                if ($('.err-msg').length > 0)
                    $('.err-msg').remove();
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=update_account",
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
                            alert_toast("Account succesfully updated", 'success');
                            $('#update_account [name="password"],#update_account [name="cpassword"]').attr('required', false);
                            $('#update_account [name="password"],#update_account [name="cpassword"]').val('');
                        } else if (resp.status == 'failed' && !!resp.msg) {
                            var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                            $('#update_account').prepend(_err_el)
                            $('body, html').animate({
                                scrollTop: 0
                            }, 'fast')
                            end_loader()

                        } else {
                            console.log(resp)
                            alert_toast("an error occured", 'error')
                        }
                        end_loader()
                    }
                })
            })
        })
    </script>
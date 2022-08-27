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
            <h3 class="text-center">Enter Email</h3>
            <hr>
            <form action="" id="update_account">

                <div class="form-group">
                    <label for="email" class="control-label">Please enter your email.</label>
                    <input type="email" name="email" class="form-control form" value="" placeholder="(Enter your email)" required>
                </div>

                <div class="form-group d-flex justify-content-between">
                    <a href="javascript:void()" id="login-show">Already have an Account</a>
                    <button class="btn btn-primary btn-flat">Send code</button>
                </div>
            </form>
        </div>
    </div>
    <!--</div>-->
</div>

<script>
    $(function() {
        $('#login-show').click(function() {
            uni_modal("", "login.php")
        })
        $('#update_account').submit(function(e) {
            e.preventDefault();
            start_loader()
            if ($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=sendotp",
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
                        alert("Email succesfully sent", 'success');
                        setTimeout(function() {
                            location.reload()
                        }, 2000)
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var _err_el = $('<div>')
                        _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                        $('#update_account').prepend(_err_el)
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
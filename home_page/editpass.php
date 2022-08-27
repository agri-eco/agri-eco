<?php
require_once('config.php');
if (isset($_GET['code'])) {
    $code = $_GET['code'];
}

?>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width,initial-scale=1'>
    <meta name='x-apple-disable-message-reformatting'>
    <title></title>
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body style='margin:0;padding:0;'>
    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
        <tr>
            <td align='center' style='padding:0;'>
                <table role='presentation' style='width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;'>
                    <tr>
                        <div class="container">
                            <!--<div class="card rounded-0">-->
                            <div class="card-body">
                                <div class=" justify-content-between d-flex">
                                    <h4><b>Forgot Password</b></h4>

                                </div>
                            </div>
                            <!--</div>-->
                        </div>
                        <div class="container w-50">
                            <!--<div class="card rounded-0">-->
                            <div class="card-body">
                                <hr class="border-warning">
                                <div>
                                    <form action="" id="update_account">
                                        <input type="hidden" name="code" class="form-control form" value="<?php echo $code ?>">

                                        <div class="form-group">
                                            <label for="cpassword" class="control-label">New Password</label>
                                            <input type="password" name="cpassword" class="form-control form" value="" placeholder="(Enter New password)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="control-label">Retype New Password</label>
                                            <input type="password" name="password" class="form-control form" value="" placeholder="(Retype new password)" required>
                                        </div>

                                        <div class="form-group d-flex justify-content-end">
                                            <button class="btn btn-primary btn-flat">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--</div>-->
                        </div>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
<script>
    $(function() {
        $('#update_account').submit(function(e) {
            e.preventDefault()
            start_loader();
            $.ajax({
                url: 'classes/Master.php?f=passforgot',
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
                        alert_toast("Password Successfully change.", "success")
                        setTimeout(function() {
                            location.replace('./')
                        }, 2000)
                    } else {
                        console.log(resp)
                        alert_toast("Password do not match", "error")
                        end_loader();
                    }
                }
            })
        })

    })
</script>
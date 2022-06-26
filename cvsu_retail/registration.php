<style>
    #uni_modal .modal-content>.modal-footer,#uni_modal .modal-content>.modal-header{
        display:none;
    }
</style>
<div class="container-fluid">
    <form action="" id="registration">
        <div class="row">
        
        <h3 class="text-center">Create New Account
            <span class="float-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </span>
        </h3>
            <hr>
        </div>
        <div class="row  align-items-center h-100">
            
            <div class="col-lg-6 border-right">
                
            <div class="form-group">
                    <label for="firstname" class="control-label">Firstname</label>
                    <input type="text" class="form-control form-control form" id="firstname" name="firstname"  required>
                </div>
                <div class="form-group">
                    <label for="lastname" class="control-label">Lastname</label>
                    <input type="text" class="form-control form-control form" id="lastname"name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="contact"  class="control-label">Contact</label>
                    <input type="tel" pattern="^\d{11}$" class="form-control form-control form" placeholder="09xxxxxxxxx" minlength='11' id="contact"name="contact" required>
                </div>
                <div class="form-group">
                    <label for="gender" class="control-label">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
				</div>
				<div class="col-lg-6">
                <div class="form-group">
                    <label for="default_delivery_address" class="control-label">Default Delivery Address</label>
                    <textarea class="form-control form" id="default_delivery_address"rows='3' name="default_delivery_address" required></textarea>
                </div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" class="form-control" id="email" name="email" required>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password"  minlength="7" name="password" required>
				</div>
                    <a href="javascript:void()" id="login-show">Already have an Account</a>
                    <button class="btn btn-primary btn-flat">Register</button>
                </div>
            </div>
        </div>
    </form>

</div>
<script>
    $(function(){
        $('#login-show').click(function(){
            uni_modal("","login.php")
        })
        $('#registration').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=register",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert("Email Verification sent. Please check your email",'success')
                        setTimeout(function(){
                            location.reload()
                        },1000)
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                        $('[name="password"]').after(_err_el)
                        end_loader()
                        
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                        end_loader()
                    }
                }
            })
        })
       
    })
</script>
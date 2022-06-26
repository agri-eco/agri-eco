// System Info
$('#system-frm').submit(function(e){
    e.preventDefault()
    start_loader()
    if($('.err_msg').length > 0)
        $('.err_msg').remove()
    $.ajax({
        url:_base_url_+'classes/SystemSettings.php?f=update_settings',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success:function(resp){
            if(resp == 1){
                // alert_toast("Data successfully saved",'success')
                    location.reload()
            }else{
                $('#msg').html('<div class="alert alert-danger err_msg">An Error occured</div>')
                end_load()
            }
        }
    })
})
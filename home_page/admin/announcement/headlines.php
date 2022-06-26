
 <div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form action="" id="headlines">
                <div>
                    <h3>Announcement</h3>
                    <div class="form-group">
                        <label for="title" class="control-label">Annoucnement Headline</label>
                        <input type="text" class="form-control form-control-sm" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="announcements" class="control-label">Content</label>
                        <textarea name="announcements" cols="30" rows="2" class="form-control summernote"><?php echo isset($announcements) ? $announcements : ''; ?></textarea>
                    </div>
                </div> 
                 <!-- <div>
                    <h3>Events</h3>
                    <div class="form-group">
                        <label for="name" class="control-label">Event Headline</label>
                        <input type="text" class="form-control form-control-sm" name="event_title">
                    </div>
                    <div class="form-group">
                    <label for="" class="control-label">Event Content</label>
                    <textarea name="events" cols="30" rows="2" class="form-control summernote"></textarea>
                </div>
                </div>
                <div>
                    <h3>News</h3>
                    <div class="form-group">
                        <label for="name" class="control-label">News Headline</label>
                        <input type="text" class="form-control form-control-sm" name="news_title"  >
                    </div>
                    <div class="form-group">
                    <label for="" class="control-label">News Content</label>
                    <textarea name="news" cols="30" rows="2" class="form-control summernote"></textarea>
                </div>
                </div> 

                  <div class="form-group">
                    <label for="" class="control-label">Carousel Images</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="carousel" onchange="displayImg(this,$(this))">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img src="<?php  ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                </div>  -->

            </form>
        </div>
        <div class="card-footer">
            <div class="col-md-12">
                <div class="row">
                    <button class="btn btn-sm btn-primary" form="headlines">POST</button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

    $(function(){
        $('#headlines').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=home",
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
                        alert_toast("Announcement successfully posted",'success')
                        setTimeout(function(){
                            location.replace('../admin/?page=announcement')
                        },2000)
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                        $('#headlines').prepend(_err_el)
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
	$(document).ready(function(){
		 $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
	})
</script>
<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `headlines` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id) ? "Update ": "Create New Announcement " ?></h3>
	</div>
	<div class="card-body">
		<form action="" id="package-form">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
			<div class="form-group">
                        <label for="title" class="control-label">Annoucnement Headline</label>
                        <input type="text" class="form-control form-control-sm" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="announcements" class="control-label">Content</label>
                        <textarea name="announcements" cols="30" rows="2" class="form-control summernote"><?php echo isset($announcements) ? $announcements : ''; ?></textarea>
                    </div>
            <!-- <div class="form-group">
				<label for="" class="control-label">Images</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img[]" multiple accept="image/*" onchange="displayImg(this,$(this))">
	              <label class="custom-file-label" for="customFile">Choose file</label>
	            </div>
			</div>
            <?php if(isset($upload_path) && is_dir(base_app.$upload_path)): ?>
            <?php 
            
                $file= scandir(base_app.$upload_path);
                foreach($file as $img):
                    if(in_array($img,array('.','..')))
                        continue;
                    
                
            ?>
                <div class="d-flex w-100 align-items-center img-item">
                    <span><img src="<?php echo base_url.$upload_path.'/'.$img ?>" width="150px" height="100px" style="object-fit:cover;" class="img-thumbnail" alt=""></span>
                    <span class="ml-4"><button class="btn btn-sm btn-default text-danger rem_img" type="button" data-path="<?php echo base_app.$upload_path.'/'.$img ?>"><i class="fa fa-trash"></i></button></span>
                </div>
            <?php endforeach; ?>
            <?php endif; ?> -->
			
		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="package-form">Save</button>
		<a class="btn btn-flat btn-default" href="?page=announcement">Cancel</a>
	</div>
</div>
<script>
    function displayImg(input,_this) {
        console.log(input.files)
        var fnames = []
        Object.keys(input.files).map(k=>{
            fnames.push(input.files[k].name)
        })
        _this.siblings('.custom-file-label').html(JSON.stringify(fnames))
	    
	}
    function delete_img($path){
        start_loader()
        
        $.ajax({
            url: _base_url_+'classes/Master.php?f=delete_p_img',
            data:{path:$path},
            method:'POST',
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured while deleting an Image","error");
                end_loader()
            },
            success:function(resp){
                $('.modal').modal('hide')
                if(typeof resp =='object' && resp.status == 'success'){
                    $('[data-path="'+$path+'"]').closest('.img-item').hide('slow',function(){
                        $('[data-path="'+$path+'"]').closest('.img-item').remove()
                    })
                    alert_toast("Image Successfully Deleted","success");
                }else{
                    console.log(resp)
                    alert_toast("An error occured while deleting an Image","error");
                }
                end_loader()
            }
        })
    }
	$(document).ready(function(){
		$('.rem_img').click(function(){
            _conf("Are sure to delete this image permanently?",'delete_img',["'"+$(this).attr('data-path')+"'"])
        })
		$('#package-form').submit(function(e){
			e.preventDefault();
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_announcement",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./?page=announcement";
					}else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

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
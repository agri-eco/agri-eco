<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Announcements</h3>
		<div class="card-tools">
			<a href="?page=announcement/headlines" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		
        <div class="container-fluid">
			<table class="table table-stripped text-dark">
            <colgroup>
                <col width="10%">
                <col width="30%">
                <col width="40%">
                <col width="20%">
            </colgroup>
                <thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Announcements</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `headlines` ");
						while($row = $qry->fetch_assoc()):
                            $row['announcements'] = strip_tags(stripslashes(html_entity_decode($row['announcements'])));
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo $row['title'] ?></td>
                        <td><p class="truncate-1 m-0"><?php echo $row['announcements'] ?></p></td>
							<td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
								<a class="dropdown-item" href="?page=announcement/manage&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                <div class="dropdown-divider"></div>
                                <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-file text-primary"></span> View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
                        </td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this announcement permanently?","delete_package",[$(this).attr('data-id')])
		})
        $('.view_data').click(function(){
            uni_modal("Announcement Details","announcement/view.php?id="+$(this).attr('data-id'))
            $(this).closest('tr').find('.status').html('<span class="badge badge-success">Read</span>')
        })
		$('.table').dataTable();
	})
	function delete_package($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_announcement",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
                    alert_toast("Announcement successfully Deleted",'success')
                        setTimeout(function(){
                            location.reload()
                        },2000)
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
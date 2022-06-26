<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>

<div class="card card-outline card-primary">

	<div class="card-header">
		<div class="card-tools">
			<!-- <a href="?page=users/manage" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> New User</a> -->
		</div>
		<h3 class="text-center">Client Account</h3>

	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="container-fluid">
				<table class="table table-bordered table-stripped">
					<colgroup>
						<col width="5%">
						<col width="15%">
						<col width="20%">
						<col width="35%">
						<col width="10%">

					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Action</th>


						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$qry = $conn->query("SELECT * from `clients` order by 'firstname' desc ");
						while ($row = $qry->fetch_assoc()) :
							$row['id'] = strip_tags(stripslashes(html_entity_decode($row['id'])));
						?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td><?php echo $row['firstname'] ?></td>
								<td><?php echo $row['lastname'] ?></td>
								<td><?php echo $row['email'] ?></td>



								<td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm">
										<a class="delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
									</button>



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
	$(document).ready(function() {
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this Client?", "delete_user", [$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})

	function delete_user($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_user1",
			method: "POST",
			data: {
				id: $id
			},
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload();
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}
</script>
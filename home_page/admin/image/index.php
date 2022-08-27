<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Image</h3>
		<?php
		$count = $conn->query("SELECT count(id) as total from `image` order by date(date_created) desc ")->fetch_assoc()['total'];
		if ($count < 5) {
		?>
			<div class="card-tools">
				<a href="?page=image/manage" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create New</a>
			</div>
		<?php
		} else {
		?>
			<div class="card-tools">
				<a class="btn btn-flat btn-primary many_data" href="javascript:void(0)"><span class="fa fa-plus text-danger"></span> Create New</a>
			</div>
		<?php
		}
		?>

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
						<col width="15%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Date Created</th>
							<th>Image</th>
							<th>Description</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$qry = $conn->query("SELECT * from `image` order by date(date_created) desc ");
						while ($row = $qry->fetch_assoc()) :
							$row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));
							$upload_path = base_app . '/uploads1/package_' . $row['id'];
							$img = "";
							foreach ($row as $k => $v) {
								$row[$k] = trim(stripslashes($v));
							}
							if (is_dir($upload_path)) {
								$fileO = scandir($upload_path);
								if (isset($fileO[2]))
									$img = "uploads1/package_" . $row['id'] . "/" . $fileO[2];
								// var_dump($fileO);
							}
						?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
								<td><img src="<?php echo validate_image($img) ?>" loading="lazy" style="max-width: 80%; max-height: 80%;" class="text-center" alt=""></td>
								<td>
									<p class="truncate-1 m-0"><?php echo $row['description'] ?></p>
								</td>
								<td class="text-center">
									<?php if ($row['status'] == 1) : ?>
										<span class="badge badge-success">Show</span>
									<?php else : ?>
										<span class="badge badge-danger">Hide</span>
									<?php endif; ?>
								</td>
								<td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
										Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item" href="?page=image/manage&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
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
	$(document).ready(function() {
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this image permanently?", "delete_package", [$(this).attr('data-id')])
		})
		$('.many_data').click(function() {
			alert_toast("Too many promoted images. Delete some.", 'error');
		})
		$('.table').dataTable();
	})

	function delete_package($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_package1",
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
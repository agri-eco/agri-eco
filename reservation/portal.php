<style>
	header.masthead {
		/* background-image: url('<?php echo validate_image($_settings->info('cover')) ?>') !important; */
		background-image: url(<?php echo site_url . $_settings->info('cover') ?>);
	}

	header.masthead .container {
		background: #0000006b;
	}
</style>
<!-- Masthead-->
<header class="masthead">
	<div class="container">
		<div class="masthead-subheading">Welcome To CvSU Tour Reservation System</div>
		<div class="masthead-heading text-uppercase">Explore our Tour Packages</div>
		<a class="btn btn-primary btn-xl text-uppercase" href="./?page=packages">View Tours</a>
	</div>
</header>
<?php
require_once('../config.php');
if (!empty($_GET['code']) && isset($_GET['code'])) {
	$code = $_GET['code'];
	$sql = $conn->query("SELECT * FROM clients where code='$code'");
	// $sql=mysqli_query("SELECT * FROM clients WHERE code='$code'");
	$num = mysqli_fetch_array($sql);
	if ($num > 0) {
		$st = 0;

		$result = $conn->query("SELECT id FROM clients where code='$code'and active='$st'");
		// $result =mysqli_query("SELECT id FROM clients WHERE code='$code' and active='$st'");
		$result4 = mysqli_fetch_array($result);

		if ($result4 > 0) {
			$st = 1;
			$result1 = $conn->query("UPDATE clients SET active='$st' where code='$code'");
			// $result1=mysqli_query("UPDATE clients SET active='$st' WHERE code='$code'");
			$msg = "Your account is activated";
		} else {
			$msg = "Your account is already active, no need to activate again";
		}
	} else {
		$msg = "Wrong activation code.";
	}
}

?>
<!DOCTYPE html>
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
	<table role='presentation' style='margin-top:15vh; width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
		<tr>
			<td align='center' style='padding:0;'>
				<table role='presentation' style='width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;'>
					<tr>
						<td style='padding:36px 30px 42px 30px;'>
							<table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
								<tr>
									<td style='padding:0 0 36px 0;color:#153643;'>
										<h1 style='font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;'><?php echo htmlentities($msg); ?></h1>
										<p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'></p>
										<p style='background-color: #0b0c0b; border: none; color: white; padding: 6px 21px; text-align: center; text-decoration: none;display: inline-block; font-size: 16px;'><a href='http://localhost/agri_eco/reservation/' style='color:#ffffff;text-decoration:underline;'>Log in</a></p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style='padding:30px;background:#ee4c50;'>
							<table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;'>
								<tr>
									<td style='padding:0;width:50%;' align='left'>
										<p style='margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;'>
											&reg; CvSU, Agri-Eco<br /><a href='http://localhost/agri_eco/cvsu_retail/' style='color:#ffffff;text-decoration:underline;'>Visit Us</a>
										</p>
									</td>
									<td style='padding:0;width:50%;' align='right'>
										<table role='presentation' style='border-collapse:collapse;border:0;border-spacing:0;'>
											<tr>
												<td style='padding:0 0 0 10px;width:38px;'>
													<a href='https://www.facebook.com/cvsuagriecopark' style='color:#ffffff;'><img src='https://assets.codepen.io/210284/fb_1.png' alt='Facebook' width='38' style='height:auto;display:block;border:0;' /></a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>
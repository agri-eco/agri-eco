<?php
require_once('../config.php');

use PHPMailer\PHPMailer\PHPMailer;

class Master extends DBConnection
{
	private $settings;
	function __construct1()
	{
		parent::__construct1();
		$this->load->model('users_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	function capture_err()
	{
		if (!$this->conn->error)
			return false;
		else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_category()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'description'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (isset($_POST['description'])) {
			if (!empty($data)) $data .= ",";
			$data .= " `description`='" . addslashes(htmlentities($description)) . "' ";
		}
		$check = $this->conn->query("SELECT * FROM `categories` where `category` = '{$category}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Category already exist.";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$sql = "INSERT INTO `categories` set {$data} ";
			$save = $this->conn->query($sql);
		} else {
			$sql = "UPDATE `categories` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "New Category successfully saved.");
			else
				$this->settings->set_flashdata('success', "Category successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_category()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `categories` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Category successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function delete_sub_category()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `sub_categories` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Sub Category successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_sub_category()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'description'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (isset($_POST['description'])) {
			if (!empty($data)) $data .= ",";
			$data .= " `description`='" . addslashes(htmlentities($description)) . "' ";
		}
		$check = $this->conn->query("SELECT * FROM `sub_categories` where `sub_category` = '{$sub_category}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Sub Category already exist.";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$sql = "INSERT INTO `sub_categories` set {$data} ";
			$save = $this->conn->query($sql);
		} else {
			$sql = "UPDATE `sub_categories` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "New Sub Category successfully saved.");
			else
				$this->settings->set_flashdata('success', "Sub Category successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function save_product()
	{
		extract($_POST);
		foreach ($_POST as $k => $v) {
			$_POST[$k] = addslashes($v);
		}
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'description'))) {
				if (!empty($data)) $data .= ",";
				$v = addslashes($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (isset($_POST['description'])) {
			if (!empty($data)) $data .= ",";
			$data .= " `description`='" . addslashes(htmlentities($description)) . "' ";
		}
		$check = $this->conn->query("SELECT * FROM `products` where `product_name` = '{$product_name}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Item already exist.";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$sql = "INSERT INTO `products` set {$data} ";
			$save = $this->conn->query($sql);
			$id = $this->conn->insert_id;
		} else {
			$sql = "UPDATE `products` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			if (isset($_FILES['img']) && count($_FILES['img']['tmp_name']) > 0) {
				if (!is_dir(base_app . 'uploads/product_' . $id)) {
					mkdir(base_app . 'uploads/product_' . $id);
					$data = " `upload_path`= 'uploads/product_{$id}' ";
				} else {
					$data = " `upload_path`= 'uploads/product_{$id}' ";
				}
				$this->conn->query("UPDATE `products` set {$data} where id = '{$id}' ");
				foreach ($_FILES['img']['tmp_name'] as $k => $v) {
					move_uploaded_file($_FILES['img']['tmp_name'][$k], base_app . 'uploads/product_' . $id . '/' . $_FILES['img']['name'][$k]);
				}
			}
			// $upload_path = "uploads/product_".$id;
			// if(!is_dir(base_app.$upload_path))
			// 	mkdir(base_app.$upload_path);
			// if(isset($_FILES['img']) && count($_FILES['img']['tmp_name']) > 0){
			// 	foreach($_FILES['img']['tmp_name'] as $k => $v){
			// 		if(!empty($_FILES['img']['tmp_name'][$k])){
			// 			move_uploaded_file($_FILES['img']['tmp_name'][$k],base_app.$upload_path.'/'.$_FILES['img']['name'][$k]);
			// 		}
			// 	}
			// }
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "New Item successfully saved.");
			else
				$this->settings->set_flashdata('success', "Item successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_product()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `products` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			if (is_dir(base_app . 'uploads/product_' . $id)) {
				$file = scandir(base_app . 'uploads/product_' . $id);
				foreach ($file as $img) {
					if (in_array($img, array('..', '.')))
						continue;
					unlink(base_app . 'uploads/product_' . $id . '/' . $img);
				}
				rmdir(base_app . 'uploads/product_' . $id);
			}
			$this->settings->set_flashdata('success', "Product successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_img()
	{
		extract($_POST);
		if (is_file($path)) {
			if (unlink($path)) {
				$resp['status'] = 'success';
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete ' . $path;
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown ' . $path . ' path';
		}
		return json_encode($resp);
	}
	function save_inventory()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'description'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `inventory` where `product_id` = '{$product_id}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Inventory already exist.";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$data = " id = '{$product_id}' ";
			$data .= " ,product_id = '{$product_id}' ";
			$data .= " ,quantity = '{$quantity}' ";
			$data .= " ,price = '{$price}' ";
			// $data .= " ,date_created = '{$date_created}' ";
			$sql = "INSERT INTO `inventory` set {$data} ";
			$save = $this->conn->query($sql);
		} else {
			$sql = "UPDATE `inventory` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id))
				$this->settings->set_flashdata('success', "New Inventory successfully saved.");
			else
				$this->settings->set_flashdata('success', "Inventory successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_inventory()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `inventory` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Invenory successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function register()
	{

		extract($_POST);
		$data = '';
		$_POST['password'] = md5($_POST['password']);
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `clients` where `email` = '{$email}' " . (!empty($id) ? " and id != {$id} " : "") . " ")->num_rows;

		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Email already taken.";
			return json_encode($resp);
			exit;
		}
		if (empty($id)) {
			$data = " firstname = '{$firstname}' ";
			$data .= " ,lastname = '{$lastname}' ";
			$data .= " ,contact = '{$contact}' ";
			$data .= " ,gender = '{$gender}' ";
			$data .= " ,email = '{$email}' ";
			$notmdpass = $password;
			$password = md5($password);
			$data .= " ,password = '{$password}' ";
			$data .= " ,default_delivery_address = '{$default_delivery_address}' ";
			$set = '1234567890';
			$code = substr(str_shuffle($set), 0, 5);
			$data .= " ,code = '{$code}' ";
			$active = false;
			$data .= " ,active = '{$active}' ";
			$sql = "INSERT INTO `clients` set {$data} ";
			$save = $this->conn->query($sql);
			$id = $this->conn->insert_id;
			if ($save) {

				require_once "PHPMailer/PHPMailer.php";
				require_once "PHPMailer/SMTP.php";
				require_once "PHPMailer/Exception.php";

				$mail = new PHPMailer();
				$subject = "Email verification";
				$message = 	"
		<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>
		<head>
		  <meta charset='UTF-8'>
		  <meta name='viewport' content='width=device-width,initial-scale=1'>
		  <meta name='x-apple-disable-message-reformatting'>
		  <title></title>
		  <style>
			table, td, div, h1, p {font-family: Arial, sans-serif;}
		  </style>
		</head>
		<body style='margin:0;padding:0;'>
		  <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
			<tr>
			  <td align='center' style='padding:0;'>
				<table role='presentation' style='width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;'>
				  <tr>
					<td style='padding:36px 30px 42px 30px;'>
					  <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
						<tr>
						  <td style='padding:0 0 36px 0;color:#153643;'>
							<h1 style='font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;'>Hello, " . $firstname . "</h1>
							<p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>Please click the button below to verify your email address.</p>
							<p style='background-color: #0b0c0b; border: none; color: white; padding: 6px 21px; text-align: center; text-decoration: none;display: inline-block; font-size: 16px;'><a href='" . base_url . "emailverify/email_verification.php?code=$code' style='color:#ffffff;text-decoration:underline;'>Click Here</a></p>
						  </td>
						</tr>
						<tr>
						  <td style='padding:0;'>
							<table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
							  <tr>
								<td style='width:260px;padding:0;vertical-align:top;color:#153643;'>
								  <p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>Email: " . $email . "</p>
								</td>
								<td style='width:20px;padding:0;font-size:0;line-height:0;'>&nbsp;</td>
								<td style='width:260px;padding:0;vertical-align:top;color:#153643;'>
								  <p style='margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;'>Password: " . $notmdpass . "</p>
								</td>
							  </tr>
							</table>
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
							  &reg; CvSU, Agri-Eco<br/><a href='" . base_url . "' style='color:#ffffff;text-decoration:underline;'>Visit Us</a>
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
						";
				//SMTP Settings
				$mail->isSMTP();
				$mail->Host = "smtp.gmail.com";
				$mail->SMTPAuth = true;
				$mail->Username = "try.acc1two3@gmail.com";
				$mail->Password = 'uvjwbxfcwvpuxjjn';
				$mail->Port = 465; //587
				$mail->SMTPSecure = "ssl"; //tls



				//Email Settings
				$mail->isHTML(true);
				$mail->setFrom($email, 'noreply');
				$mail->addAddress($email);
				$mail->Subject = $subject;
				$mail->Body = $message;
				if ($mail->send()) {
					$status = "success";
					$response = "Email is sent!";
				} else {
					$status = "failed";
					$response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
				}
			}
		} else {
			$sql = "UPDATE `clients` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if ($save) {
			$resp['status'] = 'success';
			// if(empty($id))
			// 	$this->settings->set_flashdata('success',"Account successfully created.");
			// else
			// 	$this->settings->set_flashdata('success',"Account successfully updated.");
			// foreach($_POST as $k =>$v){
			// 		$this->settings->set_userdata($k,$v);
			// }
			// $this->settings->set_userdata('id',$id);

		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function add_to_cart()
	{
		extract($_POST);
		$data = " client_id = '" . $this->settings->userdata('id') . "' ";
		$_POST['price'] = str_replace(",", "", $_POST['price']);
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `cart` where `inventory_id` = '{$inventory_id}' and client_id = " . $this->settings->userdata('id'))->num_rows;
		if ($this->capture_err())
			return $this->capture_err();
		if ($check > 0) {
			$sql = "UPDATE `cart` set quantity = quantity + {$quantity} where `inventory_id` = '{$inventory_id}' and client_id = " . $this->settings->userdata('id');
		} else {
			$sql = "INSERT INTO `cart` set {$data} ";
		}

		$save = $this->conn->query($sql);
		if ($this->capture_err())
			return $this->capture_err();
		if ($save) {
			$resp['status'] = 'success';
			$resp['cart_count'] = $this->conn->query("SELECT SUM(quantity) as items from `cart` where client_id =" . $this->settings->userdata('id'))->fetch_assoc()['items'];
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function update_cart_qty()
	{
		extract($_POST);

		$save = $this->conn->query("UPDATE `cart` set quantity = '{$quantity}' where id = '{$id}'");
		if ($this->capture_err())
			return $this->capture_err();
		if ($save) {
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function empty_cart()
	{
		$delete = $this->conn->query("DELETE FROM `cart` where client_id = " . $this->settings->userdata('id'));
		if ($this->capture_err())
			return $this->capture_err();
		if ($delete) {
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_cart()
	{
		extract($_POST);
		$delete = $this->conn->query("DELETE FROM `cart` where id = '{$id}'");
		if ($this->capture_err())
			return $this->capture_err();
		if ($delete) {
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_order()
	{
		extract($_POST);
		$delete = $this->conn->query("DELETE FROM `orders` where id = '{$id}'");
		$delete2 = $this->conn->query("DELETE FROM `order_list` where order_id = '{$id}'");
		$delete3 = $this->conn->query("DELETE FROM `sales` where order_id = '{$id}'");
		if ($this->capture_err())
			return $this->capture_err();
		if ($delete) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Order successfully deleted");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		return json_encode($resp);
	}
	function place_order()
	{
		// extract($_POST);
		// $data = "";
		// $client_id = $this->settings->userdata('id');
		// $_POST['client_id'] = $client_id;
		// foreach($_POST as $k =>$v){
		// 		if(!empty($data)) $data .=",";
		// 			$data .= " `{$k}`='{$v}' ";
		// }
		// // $data = " client_id = '{$client_id}' ";
		// // $data .= " ,amount = '{$amount}' ";
		// // $data .= " ,payment_method = '{$payment_method}' ";
		// // $data .= " ,paid = '{$paid}' ";
		// // $data .= " ,order_type = '{$order_type}' ";
		// // $data .= " ,delivery_address = '{$delivery_address}' ";
		// $order_sql = "INSERT INTO `orders` set {$data}";
		// $save_order = $this->conn->query($order_sql);
		extract($_POST);
		$client_id = $this->settings->userdata('id');
		$data = " client_id = '{$client_id}' ";
		$data .= " ,amount = '{$amount}' ";
		$data .= " ,payment_method = '{$payment_method}' ";
		$data .= " ,paid = '{$paid}' ";
		$data .= " ,order_type = '{$order_type}' ";
		$data .= " ,delivery_address = '{$delivery_address}' ";
		// 		$order_sql = "INSERT INTO `orders` set {$data}";
		// 		$save_order = $this->conn->query($order_sql);
		$order_sql = "INSERT INTO `orders` set {$data} ";
		$save_order = $this->conn->query($order_sql);
		$id = $this->conn->insert_id;
		if ($this->capture_err())
			return $this->capture_err();
		if ($save_order) {
			$order_id = $this->conn->insert_id;
			$data = '';
			$cart = $this->conn->query("SELECT c.*,p.product_name,i.price,p.id as pid from `cart` c inner join `inventory` i on i.id=c.inventory_id inner join products p on p.id = i.product_id where c.client_id ='{$client_id}' ");
			while ($row = $cart->fetch_assoc()) :
				if (!empty($data)) $data .= ", ";
				$total = $row['price'] * $row['quantity'];
				$data .= "('{$order_id}','{$row['pid']}','{$row['quantity']}','{$row['price']}', $total)";
			endwhile;
			$list_sql = "INSERT INTO `order_list` (order_id,product_id,quantity,price,total) VALUES {$data} ";
			$save_olist = $this->conn->query($list_sql);
			if ($this->capture_err())
				return $this->capture_err();
			// if($save_olist){
			// 	$slct=$this->conn->query("SELECT c.*,count(c.id) as cid, i.quantity as q from inventory i inner join cart c on i.id=c.inventory_id inner join products p on p.id = i.product_id where i.product_id = i.id  ");
			// 	while($row= $slct->fetch_assoc()):
			// 		$lol=$row['cid'];

			// 	// for($i=0; $i<$lol;$i++) {	
			// 	$qnty = $row['q'] - $row['quantity'];

			// 	// }
			// 	endwhile;
			// 	// $add = array($lol);
			// 	// count($add);
			// 	// for($i=0; $i<$add;$i++) {
			// 	// 	$sql = $this->conn->query("UPDATE inventory i inner join cart c set i.quantity = {$add[0]}  ");	
			// 	// }
			// 	// $add1 = array($qnty);

			// 	// $count=sizeof();

			// 		// for($i=0; $i<$client_id; $i++) {
			// 			// }


			// 	// $update = $this->conn->query("UPDATE `inventory` set quantity = '{$qnty}' where id = '{$product_id}'");
			// 	// $update = "UPDATE `inventory` set 'quantity' = {$qnty} ";
			// 	// $save = $this->conn->query($update);

			// }
			if ($save_olist) {
				$empty_cart = $this->conn->query("DELETE FROM `cart` where client_id = '{$client_id}'");
				$data = " order_id = '{$order_id}'";
				$data .= " ,total_amount = '{$amount}'";
				$save_sales = $this->conn->query("INSERT INTO `sales` set $data");
				if ($this->capture_err())
					return $this->capture_err();
				$resp['status'] = 'success';
			} else {
				$resp['status'] = 'failed';
				$resp['err_sql'] = $save_olist;
			}
		} else {
			$resp['status'] = 'failed';
			$resp['err_sql'] = $save_order;
		}
		return json_encode($resp);
	}
	function update_order_status()
	{
		extract($_POST);
		$update = $this->conn->query("UPDATE `orders` set `status` = '$status' where id = '{$id}' ");
		if ($update) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success", " Order status successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function pay_order()
	{
		extract($_POST);
		$update = $this->conn->query("UPDATE `orders` set `paid` = '1' where id = '{$id}' ");
		if ($update) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success", " Order payment status successfully updated.");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_account()
	{
		extract($_POST);
		$data = "";
		if (!empty($password)) {
			$_POST['password'] = md5($password);
			if (md5($cpassword) != $this->settings->userdata('password')) {
				$resp['status'] = 'failed';
				$resp['msg'] = "Current Password is Incorrect";
				return json_encode($resp);
				exit;
			}
		}
		$check = $this->conn->query("SELECT * FROM `clients`  where `email`='{$email}' and `id` != $id ")->num_rows;
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "Email already taken.";
			return json_encode($resp);
			exit;
		}
		foreach ($_POST as $k => $v) {
			if ($k == 'cpassword' || ($k == 'password' && empty($v)))
				continue;
			if (!empty($data)) $data .= ",";
			$data .= " `{$k}`='{$v}' ";
		}
		$save = $this->conn->query("UPDATE `clients` set $data where id = $id ");
		if ($save) {
			foreach ($_POST as $k => $v) {
				if ($k != 'cpassword')
					$this->settings->set_userdata($k, $v);
			}

			$this->settings->set_userdata('id', $this->conn->insert_id);
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_category':
		echo $Master->save_category();
		break;
	case 'delete_category':
		echo $Master->delete_category();
		break;
	case 'save_sub_category':
		echo $Master->save_sub_category();
		break;
	case 'delete_sub_category':
		echo $Master->delete_sub_category();
		break;
	case 'save_product':
		echo $Master->save_product();
		break;
	case 'delete_product':
		echo $Master->delete_product();
		break;

	case 'save_inventory':
		echo $Master->save_inventory();
		break;
	case 'delete_inventory':
		echo $Master->delete_inventory();
		break;
	case 'register':
		echo $Master->register();
		break;
	case 'add_to_cart':
		echo $Master->add_to_cart();
		break;
	case 'update_cart_qty':
		echo $Master->update_cart_qty();
		break;
	case 'delete_cart':
		echo $Master->delete_cart();
		break;
	case 'empty_cart':
		echo $Master->empty_cart();
		break;
	case 'delete_img':
		echo $Master->delete_img();
		break;
	case 'place_order':
		echo $Master->place_order();
		break;
	case 'update_order_status':
		echo $Master->update_order_status();
		break;
	case 'pay_order':
		echo $Master->pay_order();
		break;
	case 'update_account':
		echo $Master->update_account();
		break;
	case 'delete_order':
		echo $Master->delete_order();
		break;
	default:
		// echo $sysset->index();
		break;
}

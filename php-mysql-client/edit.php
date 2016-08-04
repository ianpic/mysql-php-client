<?php 

session_start();
if( !$_SESSION['loggedInUser']) {
	header('Location: index.php');
}

$clientID = $_GET['id'];

include('includes/connect.php');
include('includes/function.php');

$query = "SELECT * FROM clients WHERE id='$clientID'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
	while ( $row = mysqli_fetch_assoc($result) ) {
		$name 		=	$row['name'];
		$email 		=	$row['email'];
		$phone 		=	$row['phone'];
		$address 	=	$row['address'];
		$company 	=	$row['company'];
		$notes 		=	$row['notes'];
	}
} 
else {
	echo "Error: ".$query.'<br>'. mysqli_error($conn);
}


if( isset($_POST['edit_save'] ) ) {

	$clientName 	= validateFormData( $_POST['client_name']);
	$clientEmail 	= validateFormData( $_POST['client_email']);
	$clientPhone	= validateFormData( $_POST['client_phone']);
	$clientAddress 	= validateFormData( $_POST['client_address']);
	$clientCompany	= validateFormData( $_POST['client_company']);
	$clientNote 	= validateFormData( $_POST['client_note']);

	$query = "UPDATE clients SET
				name='$clientName',
				email='$clientEmail',
				phone='$clientPhone',
				address='$clientAddress',
				company='$clientCompany',
				notes='$clientNote' 
				WHERE 
				id='$clientID'";
	$result = mysqli_query($conn, $query);

	if ($result) {
		
		header('Location: clients.php?alert=editsuccess');
	}
	else {
		echo "Error updating record: ". mysqli_error($conn);
	}

}

if ( isset( $_POST['delete_user'])) {
	$alertMessage ='<div class="alert alert-danger">
					<p>Are Fucking Sure About this? </p>

					<form action="'.htmlspecialchars( $_SERVER["PHP_SELF"])	.'?id='.$clientID.'" method="post">
					<input type="submit" value="Sure!" name="confirm-delete" class="btn btn-danger">
					<a href="" class="btn btn-default" name="close" data-dismiss="alert">Cancel</a>

					</form>
	</div>';
}
if (isset($_POST['confirm-delete'])) {
	

	$query = "DELETE FROM clients WHERE id='$clientID'";
	$result = mysqli_query($conn, $query);

	if ($result) {

		header('Location: clients.php?alert=deleted');
	}
	else {
		echo "Error to delete record: ". mysqli_error($conn);
	}

}

include('includes/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Login | MYSQL AND</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body class="container">
<h1>Add Client Address Book</h1>	
	<?php echo $alertMessage ?>
	<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']);?>?id=<?php echo $clientID; ?>" method="post" class="row">
		<div class="col-sm-6">
			<input type="text" name="client_name" placeholder="Fullname" class="form-control" value="<?php echo $name; ?>"><br>
		</div>
		<div class="col-sm-6">	
			<input type="email" name="client_email" placeholder="Email" class="form-control"  value="<?php echo $email; ?>"><br>
		</div>
		<div class="col-sm-6">	
			<input type="text" name="client_phone" placeholder="Phone Number" class="form-control"  value="<?php echo $phone; ?>"><br>
		</div>
		<div class="col-sm-6">	
			<input type="text" name="client_address" placeholder="Address" class="form-control"  value="<?php echo $address; ?>"><br>
		</div>
		<div class="col-sm-6">	
			<input type="text" name="client_company" placeholder="company" class="form-control"  value="<?php echo $company; ?>"><br>
		</div>
		<div class="col-sm-6">	
			<textarea col="30" row="10" name="client_note" placeholder="Note..." class="form-control"><?php echo $notes; ?></textarea><br>
		</div>
		<div class="col-sm-6 ">	
			<input type="submit" value="Delete" class="btn btn-danger" name="delete_user"><br>
		</div>
		<div class="col-sm-6 ">	
			<a href="clients.php" class="btn btn-default">Cancel</a>
			<input type="submit" value="Update" class="btn btn-success" name="edit_save"><br>
		</div>
		
	</form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
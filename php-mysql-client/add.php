<?php 

session_start();

if( !$_SESSION['loggedInUser']) {
	header('Location: index.php');
}
include('includes/connect.php');

include('includes/function.php');


if ( isset( $_POST['add'])) {
	

	$clientName = $clientEmail = $clientPhone = $clientAddress = $clientCompany = $clientNote = "";

	if( !$_POST['name']) {
		$nameError = "Please enter a name";
	}
	else {
		$clientName = validateFormData( $_POST['name']);
	}

	if( !$_POST['email']) {
		$nameError = "Please enter a email";
	}
	else {
		$clientEmail = validateFormData( $_POST['email']);
	}

	$clientPhone 	= validateFormData( $_POST['phone']);
	$clientAddress 	= validateFormData( $_POST['address']);
	$clientCompany 	= validateFormData( $_POST['company']);
	$clientNote 	= validateFormData( $_POST['note']);


	if ($clientName && $clientEmail) {
		$query = "INSERT INTO clients(name,email,phone,address,company,notes) VALUES ('$clientName', '$clientEmail','$clientPhone','$clientAddress','$clientCompany','$clientNote')";

		$result = mysqli_query($conn, $query);

		if($result) {
			header('Location: clients.php?alert=success');
		}
		else {
			echo 'Error: '.$query.'<br>'. mysqli_error($conn);
		}
	}

}
mysqli_close($conn);

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

	<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>" method="post" class="row">
		<div class="col-sm-6">
			<input type="text" name="name" placeholder="Fullname" class="form-control"><br>
		</div>
		<div class="col-sm-6">	
			<input type="email" name="email" placeholder="Email" class="form-control"><br>
		</div>
		<div class="col-sm-6">	
			<input type="text" name="phone" placeholder="Phone Number" class="form-control"><br>
		</div>
		<div class="col-sm-6">	
			<input type="text" name="address" placeholder="Address" class="form-control"><br>
		</div>
		<div class="col-sm-6">	
			<input type="text" name="company" placeholder="company" class="form-control"><br>
		</div>
		<div class="col-sm-6">	
			<textarea col="30" row="10" name="note" placeholder="Note..." class="form-control"></textarea><br>
		</div>
		<div class="col-sm-6">	
			<a href="clients.php" class="btn btn-default">Cancel</a>
		</div>
		<div class="col-sm-6">	
			<input type="submit" value="Save Client" class="btn btn-success" name="add"><br>
		</div>
		
	</form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
<?php 
session_start();
include('includes/function.php');

// echo $password = password_hash('123123', PASSWORD_DEFAULT);

if(isset( $_POST['login'])) {

	$formEmail = validateFormData( $_POST['email']);
	$formPass = validateFormData($_POST['password']);


	include('includes/connect.php');

	//create query
	$query = "SELECT name, password FROM users WHERE email='$formEmail'";

	$result = mysqli_query($conn, $query);

	//verify if result is returned
	if(mysqli_num_rows($result) > 0) {

		//store basic user data in variable; note: it will pass as array
		while($row = mysqli_fetch_assoc($result)) {
			$name			= $row['name'];
			$hashPass		= $row['password'];
		}

		//verify hashed password with submitted password
		if(password_verify($formPass, $hashPass)) {

				$_SESSION['loggedInUser'] = $name;


				header('Location: clients.php');
		}
		else {
			$loginError = "<div class='alert alert-danger'>Wrong username / password.</div>";
		}

	}
	else {
		$loginError = '<div class="alert alert-danger">No username found! <a class="close " data-dismiss="alert">&times;</a></div>';

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | MYSQL AND</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body class="container">
    <h1><a href="index.php" style="text-decoration:none;">Login</a></h1>
	<?php echo $loginError; ?>
    <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>" method="post">
    	<input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $formEmail; ?>">
    	<input type="password" name="password" placeholder="password" class="form-control">
    	<input type="submit" value="Login!" name="login" class="btn btn-default">
    </form>
	

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
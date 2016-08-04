<?php 

session_start();

if( !$_SESSION['loggedInUser']) {

	header('Location: index.php');
}
//connect to the database
include('includes/connect.php');


$query = "SELECT * FROM clients";
$result = mysqli_query($conn, $query);

if( isset($_GET['alert'])) {

	if ($_GET['alert'] == "success") {
		
		$alertMessage = "<div class='alert alert-success'>New client added! </div>";
	}
	elseif ($_GET['alert'] == "editsuccess") {
		$alertMessage = "<div class='alert alert-success'>Client Updated! </div>";
	}
	elseif( $_GET['alert'] == "deleted") {
		$alertMessage = "<div class='alert alert-success'>Client Deleted! </div>";
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
	<h1>Client Address Book</h1>	
	<?php echo $alertMessage ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Address</th>
			<th>Company</th>
			<th>Notes</th>
			<th>Edit</th>			
		</tr>
	<?php 
		if(mysqli_num_rows($result) > 0 ) {
			while($row = mysqli_fetch_assoc( $result) ) {
				$name 		=	$row['name'];
				$email 		=	$row['email'];
				$phone 		=	$row['phone'];
				$address 	=	$row['address'];
				$company 	=	$row['company'];
				$notes 		=	$row['notes'];

			$table = '<tr>';
			$table .= '<td>'.$name.'</td>';
			$table .= '<td>'.$email.'</td>';
			$table .= '<td>'.$phone.'</td>';
			$table .= '<td>'.$address.'</td>';
			$table .= '<td>'.$company.'</td>';
			$table .= '<td>'.$notes.'</td>';
			$table .= '<td><a href="edit.php?id='.$row['id'].'" title="" class="btn btn-primary">Edit</a> </td>';
			$table .= '</tr>';

			echo $table;
			} 
		}
		else {
			echo "<div class='alert alert-warning'>No Clients Yet! </div>'"; 
		}
	 ?>

	<tr>
		<td colspan="7"><div class="text-center"><a href="add.php" class="btn btn-success">Add New</a></div></td>
	</tr>
	</table>
 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
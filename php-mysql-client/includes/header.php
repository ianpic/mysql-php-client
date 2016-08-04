<?php 

if($_SESSION['loggedInUser']) { ?>



 <ul>
 	<li><a href="clients.php">My Clients</a></li>
 	<li><a href="add.php">Add Client</a></li>
 </ul>
  <ul>
 	<p>Hello, <?php echo $_SESSION['loggedInUser'] ?></p>
 	<li><a href="logout.php">Logout</a></li>
 </ul>
 <?php } else { ?>

 <ul>
 	
 	<li><a href="index.php">Login</a></li>
 </ul>

<?php } ?>

<?php 
session_start();
$db = mysqli_connect('localhost', 'SrBarbosa', 'Wy$rUH1r#', 'calificador_registration');
if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ./index.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: ./index.php");
}
$user = $_SESSION['username'];
$query = "SELECT * FROM `users` WHERE id != '' AND username = '$user'";
$results = mysqli_query($db, $query);
if(mysqli_num_rows($results) != 1){
	$_SESSION['msg'] = "Unauthorized access. You've been reported to the great admin. ";
	header("location: ./index.php");	
}
?>
<!DOCTYPE html>

<html>
		<head>
	        <title>Edit Assigment</title><meta charset="UTF-8" />
	        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<link rel="stylesheet" href="css/bootstrap.min.css" />
			<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
	        <link rel="stylesheet" href="css/matrix-login.css" />
	        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
			<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
	   </head>
	    <body>
	        <div id="loginbox">
	            <form id="loginform" class="form-vertical" action="index.html">
					 <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
	            </form>
	        </div>
	    </body>
	<body>
		<div class="container-fluid">
		<h1>Activate Assignments</h1>
		<br><br>

		<form action="./fileuploads/reactivateUp.php" method="post" enctype="multipart/form-data">
			
                 
        <h4>Select the assigment you wish to Activate</h4>
            
            <?php 
			require './fileuploads/Database.php';
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM `Assigments` WHERE id_group = ?";
			$result = $pdo->prepare($sql);
			$result->execute(array($_SESSION['group']));

			?>

            <select name="task">
			<?php while ($row = $result->fetch(PDO::FETCH_NUM)) { if(file_exists('./fileuploads/deactivated/'.$row[2])){?>
				<option value="<?php echo $row[2] ?>"><?php echo $row[2]; ?>  </option>
				<?php } ?>
			<?php } ?>
		</select>

			<br><br>
	 		<input type="submit" value="Confirm" name="submit" class="btn btn-primary">

		</form>

		<form action="./indexAdmin.php" method="post" enctype="multipart/form-data">
			<div class="form-group col-md-6">
				<h4>Return to home page:</h4>
				<input type="submit" value="Home" name="submit" class="btn btn-primary">
			</div>
		</form>

	</body>
</html>

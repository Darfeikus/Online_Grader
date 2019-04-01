<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ./index.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ./index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <title>Sumbission</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <?php  if (isset($_SESSION['username'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <p> <a href="/index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
    <body>
        <div id="loginbox">
            <?php 
                if (isset($_POST['group'])){
                    $_SESSION['group'] = $_POST['group'];
                    if (file_exists('./fileuploads/Classes/'.$_POST['group'])) 
                        header('Location: activateAssigments.php');
                    else
                        echo "It seems you can't go there :p";
                }
            ?>
            <form method="post" class="form-vertical" action="">
				 <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
                <h4>Select the group you whish to check:</h4>
                    
                    <?php 
                        require './fileuploads/Database.php';
                        $pdo = Database::connect();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT * FROM `Groups` WHERE matricula = ?";
                        $result = $pdo->prepare($sql);
                        $result->execute(array($_SESSION['username']));

                    ?>

                    <select name="group">
                        <?php while ($row = $result->fetch(PDO::FETCH_NUM)) { ?>
                          <option value="<?php echo $row[0] ?>"><?php echo $row[1]; ?>  </option>
                        <?php } ?>
                    </select>

                <br><br>
                <input type="submit" value="Go" name="submit" class="btn btn-primary"/>
            </form>
        </div>
    </body>
    
    <form action="./indexAdmin.php" method="post" enctype="multipart/form-data">
            <div class="form-group col-md-6">
                <h4>Return to home page:</h4>
                <input type="submit" value="Home" name="submit" class="btn btn-primary">
            </div>
        </form>
</html>

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
    $_SESSION['msg'] = "Unauthorized access. Esta entrada fue reportada. ";
    header("location: ./index.php"); 
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Home Page</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Home Page</a></h1>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_ly"> <a href="fileuploads/groupIndex.php"> <i class="icon-list"></i> <span class="label label-important"></span> Submit Code </a> </li>
      </ul>
    </div>
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="fileuploads/createNewAssignement.php"> <i class="icon-pencil"></i> <span class="label label-important"></span> Create New Assignement </a> </li>
      </ul>
      <ul class="quick-actions">
        <li class="bg_lg"> <a href="editIndex.php"> <i class="icon-book"></i> <span class="label label-important"></span> Edit Assigment </a> </li>
      </ul>
      <ul class="quick-actions">
        <li class="bg_lr"> <a href="deleteIndex.php"> <i class="icon-book"></i> <span class="label label-important"></span> Delete Assigment </a> </li>
      </ul>
      <ul class="quick-actions">
        <li class="bg_ly"> <a href="reactivateIndex.php"> <i class="icon-book"></i> <span class="label label-important"></span> Reactivate </a> </li>
      </ul>
    </div>
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="fileuploads/createGroup.php"> <i class="icon-dashboard"></i> <span class="label label-important"></span> Create a Group </a> </li>
      </ul>
      <ul class="quick-actions">
        <li class="bg_lr"> <a href="deleteGroup.php"> <i class="icon-dashboard"></i> <span class="label label-important"></span> Delete a Group </a> </li>
      </ul>
      <ul class="quick-actions">
        <li class="bg_lg"> <a href="fileuploads/groupIndexTable.php"> <i class="icon-dashboard"></i> <span class="label label-important"></span> Check Assigment Results </a> </li>
      </ul>
    </div>
  </div>
  <?php  if ($_SESSION['id'] == '2') : ?>
    <div class="container-fluid">
      <div class="quick-actions_homepage">
        <ul class="quick-actions">
          <li class="bg_ly"> <a href="permissions.php"> <i class="icon-user"></i> <span class="label label-important"></span> Give Permissions to users </a> </li>
        </ul>
      </div>
    </div>
  <?php endif ?>


<script src="js/excanvas.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.flot.min.js"></script>
<script src="js/jquery.flot.resize.min.js"></script>
<script src="js/jquery.peity.min.js"></script>
<script src="js/fullcalendar.min.js"></script>
<script src="js/matrix.js"></script>
<script src="js/matrix.dashboard.js"></script>
<script src="js/jquery.gritter.min.js"></script>
<script src="js/matrix.interface.js"></script>
<script src="js/matrix.chat.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/matrix.form_validation.js"></script>
<script src="js/jquery.wizard.js"></script>
<script src="js/jquery.uniform.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/matrix.popover.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/matrix.tables.js"></script>

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();
          }
          // else, send page to designated URL
          else {
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
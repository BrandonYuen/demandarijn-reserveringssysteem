<?php
	require_once "includes/settings.php";
	require_once "includes/classes/Databases/Database.php";
	require_once "includes/classes/Reserveringen/Reservering.php";


    //New DB connection
    $db = new \Reserveringen\Databases\Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection = $db->getConnection();

	if ( (isset($_GET['id'])) && (isset($_GET['page'])) ){
		$id = $_GET['id'];
		$page = $_GET['page'];
	}else{
		echo "ERROR: No ID or PAGE in url. <br><br>";
		echo "<a href=\"admin.php\">Back to admin panel</a>";
		die;
	}

	//Check if given ID exists in Database
	$query = "SELECT count(*) from reserveringen WHERE id=$id";
    $result = $connection->query($query)->fetchColumn();

	if ($result > 0){
		//Delete
		$db->deleteById($id);
	}
	header("location: admin.php?page=$page");
	die;

 ?>

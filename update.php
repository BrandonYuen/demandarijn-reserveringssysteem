<?php
	require_once "includes/settings.php";
	require_once "includes/classes/Databases/Database.php";
	require_once "includes/classes/Reserveringen/Reservering.php";


    //New DB connection
    $db = new \Reserveringen\Databases\Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection = $db->getConnection();

	if ((isset($_POST['id'])) &&
		(isset($_POST['page'])) &&
		(isset($_POST['datum'])) &&
		(isset($_POST['tijd'])) &&
		(isset($_POST['aantal_personen'])) &&
		(isset($_POST['tafelnummer'])) &&
		(isset($_POST['name'])) &&
		(isset($_POST['email'])) &&
		(isset($_POST['telefoonnummer'])) &&
		(isset($_POST['toevoegingen']))
	){
		$id = $_POST['id'];
		$page = $_POST['page'];
		$datum = $_POST['datum'];
		$tijd = $_POST['tijd'];
		$aantal_personen = $_POST['aantal_personen'];
		$tafelnummer = $_POST['tafelnummer'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$telefoonnummer = $_POST['telefoonnummer'];
		$toevoegingen = $_POST['toevoegingen'];
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
		$db->updateById($id, $datum, $tijd, $aantal_personen, $tafelnummer, $name, $email, $telefoonnummer, $toevoegingen);
	}
	//echo "Successfully updated reservering by id: $id";
	header("location: admin.php?page=$page");
	die;

 ?>

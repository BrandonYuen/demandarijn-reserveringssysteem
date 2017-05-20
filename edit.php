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

	//Get reservering data
    $query = "SELECT * FROM reserveringen WHERE id = $id";
    $reserveringen = $connection->query($query)->fetchAll(PDO::FETCH_CLASS, "Reserveringen\\Reservering");

 ?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>De Mandarijn - Reserveren</title>

	<!--Libraries-->
	<script src="libraries/jquery/jquery-3.1.1.min.js"></script>
	<script src="libraries/jquery/jquery-ui.js"></script>
	<script src="libraries/bootstrap/js/bootstrap.js" rel="stylesheet"></script>
	<link href="libraries/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="libraries/jquery/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script src="libraries/timepicker/jquery.timepicker.js" rel="stylesheet"></script>
	<link href="libraries/timepicker/jquery.timepicker.css" rel="stylesheet" type="text/css" />

	<!--Javascript-->
	<script src="js/datetime.js"></script>

	<!--CSS-->
	<link href="css/index.css" rel="stylesheet" type="text/css" />
	<link href="css/form.css" rel="stylesheet" type="text/css" />
	<link href="css/shadows.css" rel="stylesheet" type="text/css" />
	<link href="css/mobile.css" rel="stylesheet" type="text/css" />
	<link rel="icon" href="images/favicon.ico" />
</head>

 	<div class="form-reserveren">
 	<?php foreach ($reserveringen as $reservering): ?>
		<form method="post" action="update.php">
			<fieldset>
				<label for="name">Naam*</label>
				<input type="text" name="name" value="<?= htmlentities($reservering->name); ?>">
				<label for="email">Email Adres*</label>
				<input type="email" name="email" value="<?= htmlentities($reservering->email); ?>">
				<label for="postcode">Telefoonnummer*</label>
				<input type="text" name="telefoonnummer" value="<?= htmlentities($reservering->telefoonnummer); ?>">
				<label for="postcode">Toevoegingen</label>
				<textarea name="toevoegingen"> <?= htmlentities($reservering->toevoegingen); ?> </textarea>
				<label for="postcode">Datum</label>
				<input type="text" name="datum" value="<?= htmlentities($reservering->datum); ?>">
				<label for="postcode">Tijd</label>
				<input type="text" name="tijd" value="<?= htmlentities($reservering->tijd); ?>">
				<label for="postcode">Aantal personen</label>
				<input type="text" name="aantal_personen" value="<?= htmlentities($reservering->aantal_personen); ?>">
				<label for="postcode">Tafelnummer</label>
				<input type="text" name="tafelnummer" value="<?= htmlentities($reservering->tafelnummer); ?>">
			</fieldset>
			<input type="hidden" name="id" value="<?= $id ?>">
			<input type="hidden" name="page" value="<?= $page ?>">
			<input type="submit" value="Update" />
	</form>
	</div>
	<?php endforeach; ?>
</html>

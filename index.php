<?php require_once "includes/initialize.php"; ?>
<!doctype html>
<html lang="en">

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

<body>
	<?php if (isset($error)): ?>
	    <span class="error"><?= $error; ?></span>
	<?php endif; ?>

	<!--Main container-->
	<div id="main" class="effect7">

	    <div id="header" class="header">
			<div>
				<h1>De Mandarijn</h1>
				<h3>Online Reserveren</h3>
			</div>
	    </div>

	    <!-- Steps title / header -->
	    <div id="formTitle" class="text-center">
	        <?php if ($showPage == "step1"): ?>
	            <div class="numberCircle">1</div> &nbsp;<h3>Kies een datum en tijd.</h3>
	        <?php elseif ($showPage == "step2"): ?>
	            <div class="numberCircle">2</div> &nbsp;<h3>Kies een tafel.</h3>
	        <?php elseif ($showPage == "step3"): ?>
	            <div class="numberCircle">3</div> &nbsp;<h3>Vul uw gegevens in.</h3>
	        <?php elseif ($showPage == "step4"): ?>
	            <div class="numberCircle">4</div> &nbsp;<h3>Bevestig uw reservering.</h3>
	        <?php elseif ($showPage == "success"): ?>
	            Bedankt voor het reserveren!
	        <?php endif; ?>
	    </div>

	    <div id="formContainer">
	    <!-- Content van de stap / container -->
	        <?php if ($showPage == "step1"): ?>
	            <div class="form-reserveren">
	                <form method="post">
	                    <fieldset>
	                        <label for="datum">Kies een datum</label>
	                        <input name="datum" type="text" id="datepicker" placeholder="Klik hier om een datum te kiezen" value=<?php echo"'$datum'"?>><br>
	                        <label for="tijd">Kies een tijd</label>
	                        <input name="tijd" type="text" id="timepicker" placeholder="Klik hier om een tijd te kiezen" value=<?php echo"'$tijd'"?>>
	                        <label for="aantal_personen">Aantal Personen*</label>
	                        <select id="aantal_personen" name="aantal_personen" value=<?php echo"$aantal_personen"?>>
	                            <option value="1">1</option>
	                            <option value="2">2</option>
	                            <option value="3">3</option>
	                            <option value="4">4</option>
	                            <option value="5">5</option>
	                            <option value="6">6</option>
	                            <option value="7">7</option>
	                            <option value="8">8</option>
	                        </select>
	                        Maandag t/m Vrijdag (Dinsdag gesloten)<br>
	                        16:00 uur tot 21:30 uur<br>
	                        <br>
	                        Zaterdag, Zondag en alle feestdagen<br>
	                        12:00 uur tot 21:30 uur<br>
	                        <br>
	                        De gehele zomer gewoon geopend!<br><br>
	                    </fieldset>
	                    <input type="hidden" name="action" value="validateStep1">
	                    <input type="submit" value="Volgende" />
	                </form>
	            </div>

	        <?php elseif ($showPage == "step2"): ?>
	            <div class="form-reserveren">
	                <form method="post">
	                    <fieldset>
	                        <label for="tafel">Kies een tafel</label>
	                        <img src="images/demandarijn_plattegrond.png" width="100%"><br><br>
	                        <select id="tafelnummer" name="tafelnummer">
	                            <option value="1">Tafel 1</option>
	                            <option value="2">Tafel 2</option>
	                            <option value="3">Tafel 3</option>
	                            <option value="4">Tafel 4</option>
	                            <option value="5">Tafel 5</option>
	                            <option value="6">Tafel 6</option>
	                            <option value="7">Tafel 7</option>
	                            <option value="8">Tafel 8</option>
	                            <option value="9">Tafel 9</option>
	                            <option value="10">Tafel 10</option>
	                            <option value="11">Tafel 11</option>
	                            <option value="12">Tafel 12</option>
	                            <option value="13">Tafel 13</option>
	                            <option value="14">Tafel 14</option>
	                            <option value="15">Tafel 15</option>
	                        </select>
	                    </fieldset>
	                    <input type="hidden" name="action" value="validateStep2">
	                    <input type="submit" value="Volgende" />
	                </form>
	            </div>

	        <?php elseif ($showPage == "step3"): ?>
	            <div class="form-reserveren">
	                <form method="post">
	                    <fieldset>
	                        <label for="name">Naam*</label>
	                        <input type="text" name="name" placeholder="Henk van der Steen" value=<?php echo"'$name'"?>>
	                        <label for="email">Email Adres*</label>
	                        <input type="email" name="email" placeholder="voorbeeld@gmail.com" value=<?php echo"'$email'"?>>
	                        <label for="postcode">Telefoonnummer*</label>
	                        <input type="text" name="telefoonnummer" placeholder="1234 AB" value=<?php echo"'$telefoonnummer'"?>>
	                        <label for="postcode">Toevoegingen</label>
	                        <textarea name="toevoegingen" placeholder="Optionele toevoeging (bijv. Ik ben allergisch voor pinda's)"><?php echo"$toevoegingen"?></textarea>
	                    </fieldset>
	                    <input type="hidden" name="action" value="validateStep3">
	                    <input type="submit" value="Volgende" />
	                </form>
	            </div>

	        <?php elseif ($showPage == "step4"): ?>
	            <div class="form-reserveren">
	                <form method="post">
	                    <fieldset>
	                        <label for="name">Kloppen de onderstaade gegevens?</label>
	                        Datum: <input readonly name="datum" type="text" value=<?php echo"'$datum'"?>>
	                        Tijd: <input readonly name="tijd" type="text" value=<?php echo"'$tijd'"?>>
	                        Aantal personen: <input readonly name="aantal_personen" type="text" value=<?php echo"'$aantal_personen'"?>>
	                        Tafelnummer: <input readonly name="tafelnummer" type="text" value=<?php echo"'$tafelnummer'"?>>
	                        Gegevens: <input readonly name="name" type="text" value=<?php echo"'$name'"?>>
	                        <input readonly name="email" type="text" value=<?php echo"'$email'"?>>
	                        <input readonly name="telefoonnummer" type="text" value=<?php echo"'$telefoonnummer'"?>>
	                        <input readonly name="toevoegingen" placeholder="Geen toevoegingen" type="text" value=<?php echo"'$toevoegingen'"?>>
	                    </fieldset>
	                    <input type="hidden" name="action" value="validateStep4">
	                    <input type="submit" value="Reservering Bevestigen" />
	                </form>
	            </div>
	        <?php endif; ?>
	    </div>
	</div>
</body>
</html>

<script src="libraries/datetimepicker/jquery.datetimepicker.full.js"></script>

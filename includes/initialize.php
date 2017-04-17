<?php
    require_once "settings.php";
    require_once "classes/Databases/Database.php";

    ini_set('display_errors', -1);
    session_start();

    //Default Page
    $showPage = "none";

    //Define action
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
    }else{$action = "none";}

    //Do stuff based on the specified action
    switch ($action) {

        //None means there is no post data
        case "none":
            //Prepare new form data
            $datum = "";
            $tijd = "";
            $aantal_personen = "";
            if (isset($_SESSION["datum"])) {
                $datum = $_SESSION["datum"];
                $tijd = $_SESSION["tijd"];
                $aantal_personen = $_SESSION["aantal_personen"];
            }

            $showPage = "step1";
            break;

        case "validateStep1":
            //Process post data
            $datum = ($_POST["datum"]);
            $tijd = ($_POST["tijd"]);
            $aantal_personen = ($_POST["aantal_personen"]);
            $_SESSION["datum"] = $datum;
            $_SESSION["tijd"] = $tijd;
            $_SESSION["aantal_personen"] = $aantal_personen;

            //Prepare new form data
            $tafelnummer = "";
            if (isset($_SESSION["tafelnummer"])) {
                $tafelnummer = $_SESSION["tafelnummer"];
            }

            $showPage = "step2";
            break;

        case "validateStep2":
            //Process post data
            $tafelnummer = ($_POST["tafelnummer"]);
            $_SESSION["tafelnummer"] = $tafelnummer;

            $name = isset($_SESSION["name"]) ? $_SESSION["name"] : "";
            $email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
            $telefoonnummer = isset($_SESSION["telefoonnummer"]) ? $_SESSION["telefoonnummer"] : "";
            $toevoegingen = isset($_SESSION["toevoegingen"]) ? $_SESSION["toevoegingen"] : "";

            $showPage = "step3";

            break;

        case "validateStep3":
            //Set variables to data from POST
            $name = ($_POST["name"]);
            $email = ($_POST["email"]);
            $telefoonnummer = ($_POST["telefoonnummer"]);
            $toevoegingen = ($_POST["toevoegingen"]);

            //TODO: Check if form data is valid input

            //set session data to variables from post
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            $_SESSION["telefoonnummer"] = $telefoonnummer;
            $_SESSION["toevoegingen"] = $toevoegingen;

            //Prepare new form data
            $datum = isset($_SESSION["datum"]) ? $_SESSION["datum"] : 'Error: Click op "Opnieuw"';
            $tijd = isset($_SESSION["tijd"]) ? $_SESSION["tijd"] : 'Error: Click op "Opnieuw"';
            $aantal_personen = isset($_SESSION["aantal_personen"]) ? $_SESSION["aantal_personen"] : 'Error: Click op "Opnieuw"';
            $tafelnummer = isset($_SESSION["tafelnummer"]) ? $_SESSION["tafelnummer"] : 'Error: Click op "Opnieuw"';
            $name = isset($_SESSION["name"]) ? $_SESSION["name"] : 'Error: Click op "Opnieuw"';
            $email = isset($_SESSION["email"]) ? $_SESSION["email"] : 'Error: Click op "Opnieuw"';
            $telefoonnummer = isset($_SESSION["telefoonnummer"]) ? $_SESSION["telefoonnummer"] : 'Error: Click op "Opnieuw"';
            $toevoegingen = isset($_SESSION["toevoegingen"]) ? $_SESSION["toevoegingen"] : 'Error: Click op "Opnieuw"';

            //Show next page
            $showPage = "step4";
            break;

        case "validateStep4":
            //Set variables to data from POST
            $datum = ($_POST["datum"]);
            $tijd = ($_POST["tijd"]);
            $aantal_personen = ($_POST["aantal_personen"]);
            $tafelnummer = ($_POST["tafelnummer"]);
            $name = ($_POST["name"]);
            $email = ($_POST["email"]);
            $telefoonnummer = ($_POST["telefoonnummer"]);
            $toevoegingen = ($_POST["toevoegingen"]);


            try {
                //New DB connection
                $db = new \Reserveringen\Databases\Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $connection = $db->getConnection();

                //Insert new reservering into database
                $db->insert($datum,$tijd,$aantal_personen,$tafelnummer,$name,$email,$telefoonnummer,$toevoegingen);

            } catch (Exception $e) {
                //Set error variable for template
                $error = "Oops, try to fix your error please: " . $e->getMessage() . " on line " . $e->getLine() . " of " . $e->getFile();
            }


            //Show next page
            $showPage = "success";
            break;

    }

	//Javascript Injection Protection
	if (isset($datum)){
		$datum = htmlentities($datum);
	}
	if (isset($tijd)){
		$tijd = htmlentities($tijd);
	}
	if (isset($aantal_personen)){
		$aantal_personen = htmlentities($aantal_personen);
	}
	if (isset($tafelnummer)){
		$tafelnummer = htmlentities($tafelnummer);
	}
	if (isset($name)){
		$name = htmlentities($name);
	}
	if (isset($email)){
		$email = htmlentities($email);
	}
	if (isset($telefoonnummer)){
		$telefoonnummer = htmlentities($telefoonnummer);
	}
	if (isset($toevoegingen)){
		$toevoegingen = htmlentities($toevoegingen);
	}

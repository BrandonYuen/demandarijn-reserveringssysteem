<?php require_once "includes/initialize_admin.php";
require_once 'libraries/carbon/carbon.php';

use Carbon\Carbon; ?> <!--//Initialise admin core code-->
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>De Mandarijn - Reserveren</title>

    <!--Libraries-->
    <script src="libraries/jquery/jquery-3.1.1.min.js"></script>
    <script src="libraries/jquery/jquery-ui.js"></script>
    <script src="libraries/bootstrap/js/bootstrap.js" rel="stylesheet"></script>
    <link href="libraries/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="libraries/jquery/jquery-ui.css" rel="stylesheet" type="text/css" />

    <!--Javascript-->
    <script src="js/reserveringen.js"></script>

    <!--CSS-->
    <link href="css/admin.css" rel="stylesheet" type="text/css" />

    <nav class="navbar navbar-default" style="margin-bottom: 0px;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">De Mandarijn</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li <?php if (isset($_GET['page']))
                    {
                        if (!($_GET['page'] == "today")) {
                            ?>class="active"<?php
                        }
                    }
                    else{
                        ?>class="active"<?php
                    }?>><a href="admin.php"><b>Complete Lijst</b> <span class="sr-only">(current)</span></a></li>

                    <li <?php if (isset($_GET['page']))
                        {
                        if ($_GET['page'] == "today") {
                        ?>class="active"<?php
                        }
                    }?>><a href="?page=today"><b>Vandaag</b> </a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</head>

<body>
<?php if (isset($reserveringen)):?>
    <div id="pagination" class="text-center"><?php echo $pagination; ?></div>

    <table width="100%">
        <thead>
        <tr>
            <th width="8%">Datum</th>
            <th width="5%">Tijd</th>
            <th width="2%">Personen</th>
            <th width="2%">Tafelnummer</th>
            <th width="10%">Naam</th>
            <th width="10%">Email</th>
            <th width="10%">Telefoonnummer</th>
            <th width="30%">Toevoegingen</th>
            <th width="10%">Geplaatst</th>
            <th width="15%">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($reserveringen as $reservering): ?>
            <tr>
                <td><?= htmlentities($reservering->datum); ?></td>
                <td><?= htmlentities($reservering->tijd); ?></td>
                <td><?= htmlentities($reservering->aantal_personen); ?></td>
                <td><?= htmlentities($reservering->tafelnummer); ?></td>
                <td><?= htmlentities($reservering->name); ?></td>
                <td><?= htmlentities($reservering->email); ?></td>
                <td><?= htmlentities($reservering->telefoonnummer); ?></td>
                <td><?= htmlentities($reservering->toevoegingen); ?></td>
                <td><?php
					//If creation date exists
					if ($reservering->creationdatetime != NULL){
						$daysAgo = Carbon::parse($reservering->creationdatetime)->diffInDays(Carbon::now());
						if ($daysAgo > 0){
							echo $daysAgo. " dagen geleden";
						}
						else{
							$hoursAgo = Carbon::parse($reservering->creationdatetime)->diffInHours(Carbon::now());
							if ($hoursAgo > 0){
								echo $hoursAgo. " uren geleden";
							}
							else{
								$minutesAgo = Carbon::parse($reservering->creationdatetime)->diffInMinutes(Carbon::now());
								if ($minutesAgo > 0){
									echo $minutesAgo. " minuten geleden";
								}
								else{
									$secondsAgo = Carbon::parse($reservering->creationdatetime)->diffInSeconds(Carbon::now());
									echo $secondsAgo. " seconden geleden";
								}
							}
						}
					}
				?></td>
                <td>  <a href="delete.php?page=<?=$page?>&id=<?= htmlentities($reservering->id)?>">DELETE <span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="edit.php?page=<?=$page?>&id=<?= htmlentities($reservering->id)?>">EDIT <span class="glyphicon glyphicon-pencil"></span></a> </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>

</html>

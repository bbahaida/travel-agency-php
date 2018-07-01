<?php

session_start();
require_once("inc/connection.php");
if(empty($_SESSION['agence'])){

    if(empty($_GET['ag']))
    {
        header("Location: ../index.php");
    }
    else{
        $req = $bdd->query("select * from agence where ville = '".$_GET['ag']."'");
        $ses = $req->fetch();
        $_SESSION['agence'] = $ses['ville'];
        $_SESSION['id'] = $ses['id_agence'];
        $_SESSION['tel'] = $ses['tel'];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="graph/charts/assets/css/xcharts.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <?php include("inc/link.php");?>
        <title>Transport | Home</title>
    </head>
    <body>
        <?php include_once("inc/header.php");?>

        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="h3 text-center">Voyages entrant vers <?php echo $_SESSION['agence'];?></h3><br/>
                            <div id="input"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="h3 text-center">Voyages sortant de <?php echo $_SESSION['agence'];?></h3><br/>
                            <div id="output"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="h3 text-center">Trasfert <?php echo $_SESSION['agence'];?></h3><br/>
                                <div id="trans"></div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                            <div class="col-sm-12">
                                <h3 class="h3 text-center">Courrier <?php echo $_SESSION['agence'];?></h3><br/>
                                <div id="courrier"></div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="h3 text-center">Trasfert vers <?php echo $_SESSION['agence'];?></h3><br/>
                                <div id="trans_in"></div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                            <div class="col-sm-12">
                                <h3 class="h3 text-center">Courrier vers <?php echo $_SESSION['agence'];?></h3><br/>
                                <div id="courrier_in"></div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <?php include_once("inc/footer.php");?>
        <script src="graph/js/jquery-2.1.4.min.js"></script>
        <script src="graph/js/fusioncharts.js"></script>
        <script src="graph/js/fusioncharts.charts.js"></script>
        <script src="graph/js/themes/fusioncharts.theme.zune.js"></script>
        <script src="graph/js/themes/fusioncharts.theme.ocean.js"></script>
        <script src="graph/js/themes/fusioncharts.theme.carbon.js"></script>
        <script src="graph/js/themes/fusioncharts.theme.fint.js"></script>
        <script src="js/voyage.js"></script>
        <script src="graph/js/trans.js"></script>
        <script src="graph/js/courrier.js"></script>
        <script src="graph/js/trans_in.js"></script>
        <script src="graph/js/courrier_in.js"></script>
    </body>
</html>
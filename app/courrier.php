<?php
require_once("inc/connection.php");

session_start();
$req = $bdd->query("SELECT * FROM agence where ville != '".$_SESSION['agence']."'");


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include("inc/link.php");?>
<title>Transport | Courrier</title>
</head>

<body>
<?php include("inc/header.php");?>
<div class="container">
        <div class="row">
            <div class="jumbotron col-sm-pull-1 col-sm-push-1 col-sm-10">
                	<div class="row">
                    <div class="col-sm-12">
                	<form role="form" action="" method="post" id="trans" name="trans">
                        <div class="row in">
                            <div class="form-group">
                            	<label class="col-sm-2 control-label" for="Nom">Nom:</label>
                                <div class="col-sm-4">
									<input type="text" class="form-control" placeholder="Ex: Mohamed ould Ahmed" name="nomc" id="nomc" />
                                </div>
                            	<label class="col-sm-2 control-label" for="tel">Tel:</label>
                                <div class="col-sm-4">
									<input type="tel" class="form-control" placeholder="Ex: 36200304" name="telc" id="telc" />
                                </div>
                            </div>
                        </div>
                        <div class="row in">
                            <div class="form-group">
                            	<label class="col-sm-2 control-label">Destination:</label>
                                <div class="col-sm-4">
									<input type="text" class="form-control" placeholder="Ex: Mohamed ould Ahmed" name="nomd" id="nomd" />
                                </div>
                            	<label class="col-sm-2 control-label" for="tel">Tel:</label>
                                <div class="col-sm-4">
									<input type="tel" class="form-control" placeholder="Ex: 36200304" name="teld" id="teld" />
                                </div>
                            </div>
                        </div>
                        <div class="row in">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="Nom">Vers:</label>
                                <div class="col-sm-4">
									<select class="form-control" id="ville" name="ville">
                                    	<?php
                                        while($d = $req->fetch()){
										?>
                                        <option value="<?php echo $d['ville'];?>"><?php echo $d['ville'];?></option>
                                        <?php
										}
										?>
                                    </select>
                                </div>
                                <label class="col-sm-2 control-label" for="Nom">Voyage:</label>
                                <div class="col-sm-4">
									<select class="form-control" id="voyage" name="voyage">
                                    	<option value="7:00:00">7:00</option>
                                        <option value="8:00:00">8:00</option>
                                        <option value="15:00:00">15:00</option>
                                    </select>
                                </div>
                            </div>
                           </div>
                        </form>
                        <div class="row in">
                         <div class="form-group">
                            	<div class="col-sm-offset-8 col-sm-4">
						<button class="form-control btn btn-info log_btn" name="btn" onClick="control()" >Valider</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </div>
        <div class="container-fluid">
        	<div class="row">
            	<div class="col-xs-push-2 col-xs-8 col-xs-pull-2">
                	<div class="table-responsive">
                    	<h4 align="center" class="danger"><span class="glyphicon glyphicon-log-in"></span> Courrier vers <?php echo $_SESSION['agence'];?></h4>
                        <div id="input"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-push-2 col-xs-8 col-xs-pull-2">
                	<div class="table-responsive">
                    	<h4 align="center"><span class="glyphicon glyphicon-log-out"></span> Courrier de <?php echo $_SESSION['agence'];?></h4>
                        <div id="output"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once("inc/footer.php");?>
    <script type="text/javascript" src="js/courrier.js"></script>
</body>
</html>
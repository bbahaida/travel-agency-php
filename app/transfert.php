<?php
require_once("inc/connection.php");

session_start();
$done = false;
if(!empty($_POST['telc'])){

	$nomc = $_POST['nomc'];
	$telc = (int)$_POST['telc'];
	$nomd = $_POST['nomd'];
	$teld = (int)$_POST['teld'];
	$montant = doubleval($_POST['montant']);
	$ville = (int)$_POST['ville'];
	$r = $bdd->prepare("select * from clients where tel = ?");
	$r->execute(array($telc));
	$d = $r->fetch();
	if(!empty($d)){
		$id = $d['id_client'];
	}
	else {
		$query = $bdd->prepare("insert into clients(nom,tel) values(:nomc,:telc) ");
		$query->execute(array(
			'nomc' => $nomc,
			'telc' => $telc
		));
		$r = $bdd->prepare("select * from clients where tel = ?");
		$r->execute(array($telc));
		$d = $r->fetch();
		$id = $d['id_client'];
	}
	$query2 = $bdd->prepare("insert into transferts(montant,tel,nom_recepteur,date_transfert,id_client,id_agence,agence) values(:montant,:tel,:nom_recepteur,now(),:id_client,:id_agence,:agence)");
	$query2->execute(array(
		'montant' => $montant,
		'tel' => $teld,
		'nom_recepteur' => $nomd,
		'id_client' => $id,
		'id_agence' => $ville,
		'agence' => $_SESSION['agence']
	));
	
	$done = true;
}

$req = $bdd->query("SELECT * FROM agence where ville != '".$_SESSION['agence']."'");


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include("inc/link.php");?>
<title>Transport | Transfert</title>
</head>

<body>
<?php include("inc/header.php");?>
<div class="container">
        <div class="row">
            <div class="jumbotron col-lg-pull-2 col-lg-push-2 col-lg-8">
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
                            	<label class="col-sm-2 control-label">Montant:</label>
                                <div class="col-sm-4">
									<input type="text" class="form-control" onBlur="prix()" placeholder="Ex: 10000" name="montant" id="montant"/>
                                </div>
                                <label class="col-sm-2 control-label" for="Nom">Vers:</label>
                                <div class="col-sm-4">
									<select class="form-control" name="ville" id="ville">
                                    	<?php
                                        while($d = $req->fetch()){
										?>
                                        <option value="<?php echo $d['id_agence'];?>"><?php echo $d['ville'];?></option>
                                        <?php
										}
										?>
                                    </select>
                                </div>
                            	
                            </div>
                        </div>
                        </form>
                        <div class="row in">
                            <div class="form-group">
                            	<div class="col-sm-offset-2 col-sm-4">
						<button class="form-control btn btn-info log_btn" name="btn" onClick="control()" ><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Transfert</button>

                                </div>
                                <label class="col-sm-2 control-label" for="Nom">Cout:</label>
                                <div class=" col-sm-4">
                               		<input type="text" class="form-control" disabled id="cout" value="0.00 MRO" />
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
                    	<h4 align="center" class="danger"><span class="glyphicon glyphicon-log-in"></span> Transfert vers <?php echo $_SESSION['agence'];?></h4>
                        <div id="input"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-push-2 col-xs-8 col-xs-pull-2">
                	<div class="table-responsive">
                    	<h4 align="center"><span class="glyphicon glyphicon-log-out"></span> Transfert de <?php echo $_SESSION['agence'];?></h4>
                        <div id="output"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once("inc/footer.php");?>
    <script type="text/javascript" src="js/trans.js"></script>
</body>
</html>
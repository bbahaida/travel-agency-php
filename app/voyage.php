<?php
require_once("inc/connection.php");
session_start();
$req = $bdd->query("SELECT * FROM agence where ville = '".$_SESSION['agence']."'");
$d = $req->fetch();
$req->closeCursor();
if(!empty($_POST['btn'])){
	$depart = $_POST['depart'];
	$dest = $_POST['dest'];
	$date = $_POST['date'];
	$heure = '';
	switch($_POST['heure']){
		case '1' : $heure = "7:00:00";break;
		case '2' : $heure = "8:00:00";break;
		case '3' : $heure = "15:00:00";break;
		}
	$bus = $_POST['bus'];
	$t = $bdd->query("select * from voyages where (destination = '".$dest."' and cast(date_depart as date) = '".$date."' and heure_depart = '".$heure."' and id_agence = ".$depart.")");
	$c = $t->rowCount();
	$t->closeCursor();
	if($c > 0){
		$traite = true;
	}
	else {
		$t = $bdd->query("select * from voyages where (cast(date_depart as date) = '".$date."' and bus = '".$bus."')");
		$c = $t->rowCount();
		$t->closeCursor();
		if($c > 0){
			$traite = true;
		}
		else {
		$t = $bdd->prepare("insert into voyages(destination,date_depart,heure_depart,id_agence,bus) values(:dest,:date,:heure,:depart,:bus)");
		$t->execute(array(
			'dest' => $dest,
			'date' => $date,
			'heure' => $heure,
			'depart' => $depart,
			'bus' => $bus
			));
		$traite = false;
	}
}
	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include("inc/link.php");?>
<title>Transport | Voyage</title>
</head>

<body>
<?php include_once("inc/header.php");?>
<div class="container">
        <div class="row">
            <div class="jumbotron col-xs-pull-1 col-xs-push-1 col-xs-10">
            		<?php
                    if(isset($traite)){
						if($traite){
						?>
                        <div class="row">
                            <div class="col-xs-12">
                               <p class="text-danger text-center">Voyage deja exister !!</p> 
                            </div>
                        </div>
                        <?php
						unset($traite);
						}
						else{
						?>
                        <div class="row">
                            <div class="col-xs-12">
                               <p class="text-success text-center">Voyage enregistrer avec succee</p> 
                            </div>
                        </div>
                        <?php
						}
						unset($traite);
					}
					?>
                	<div class="row">
                    <div class="col-xs-12">
                	<form role="form" action="" method="post" id="trans" name="trans">
                        <div class="row in">
                            <div class="form-group">
                            	<label class="col-xs-2 control-label" for="Nom">Depart:</label>
                                <div class="col-xs-4">
									<select name="depart" class="form-control">
										<option value="<?php echo $d['id_agence'];?>"><?php echo $d['ville'];?></option>
                                    </select>
                                </div>
                            	<label class="col-xs-2 control-label" for="Nom">Destination:</label>
                                <div class="col-xs-4">
									<select name="dest" class="form-control">
                                    	<?php
										$req = $bdd->query("SELECT * FROM agence where id_agence != ".$d['id_agence']);
                                        while($d = $req->fetch()){
										?>
										<option value="<?php echo $d['ville'];?>"><?php echo $d['ville'];?></option>
										<?php
										}
										$req->closeCursor();
										?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row in">
                            <div class="form-group">
                            	<label class="col-xs-2 control-label">Date Depart:</label>
                                <div class="col-xs-4">
									<select name="date" class="form-control">
                                    	<option value="<?php
											if((int)date("H") < 15) echo date("Y-m-d");
											else echo date("Y-m-d",time()+(9*3600));?>">
											<?php
											if((int)date("H") < 15) echo date("Y-m-d");
											else echo date("Y-m-d",time()+(9*3600));?>
                                            </option>
                                    </select>
                                </div>
                            	<label class="col-xs-2 control-label">Heure:</label>
                                <div class="col-xs-4">
									<select name="heure" class="form-control">
                                    	<?php
                                        if((int) date("H") < 7 || (int) date("H") > 15){
												?>
                                        <option value="1">7:00</option>
                                        <option value="2">8:00</option>
                                        <option value="3">15:30</option>
                                                <?php
										}
										else if((int) date("H") < 8){
												?>
                                        <option value="2">8:00</option>
                                        <option value="3">15:30</option>
                                                <?php
										}
										else {
												?>
                                        <option value="3">15:30</option>
                                                <?php
											}
											
										?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row in">
                           <div class="form-group">
                            	<label class="col-xs-2 control-label">Bus:</label>
                           <div class="col-xs-4">
								<select name="bus" class="form-control">
                                    <?php
									$req = $bdd->query("SELECT * FROM bus");
									
                                    while($d = $req->fetch()){
									
									?>
									<option value="<?php echo $d['matricule'];?>"><?php echo $d['matricule'];?></option>
									<?php
									}
									
									?>
                               </select>
                            </div>
                        
                        </form>
                        <div class="col-xs-offset-2 col-xs-4">
							<input type="submit" class="form-control btn btn-info log_btn" name="btn" value="Enregistrer" />
                        </div>
                        </div>
                	</div>
            	</div>
        	</div>
        </div>
<?php include_once("inc/footer.php");?>
</body>
</html>
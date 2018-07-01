<?php
require_once("../inc/connection.php");
session_start();
if(!empty($_POST['ville'])){
	$nomc = $_POST['nomc'];
	$telc = (int)$_POST['telc'];
	$nomd = $_POST['nomd'];
	$teld = (int)$_POST['teld'];
	$ville = $_POST['ville'];
	$voyage = $_POST['voyage'];
	$ag = $_SESSION['id'];
	$vo = $bdd->query("select * from voyages where cast(date_depart as date) = cast(now() as date) and heure_depart = '".$voyage."' and destination = '".$ville."'");
	if($vo->rowCount() > 0){
	$dvo = $vo->fetch();
	$id_voyage = $dvo['id_voyage'];
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
	$query2 = $bdd->prepare("insert into courrier(destination,nom_recepteur,tel,date_courrier,id_voyage,id_client,id_agence) values(:destination,:nom_recepteur,:tel,now(),:id_voyage,:id_client,:id_agence)");
	$query2->execute(array(
		'destination' => $ville,
		'nom_recepteur' => $nomd,
		'tel' => $teld,
		'id_voyage' => $id_voyage,
		'id_client' => $id,
		'id_agence' => $ag
		));
		die("Done");
	}
	else die("Pas de voyage");
}
?>
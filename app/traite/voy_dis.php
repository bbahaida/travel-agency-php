<?php
	session_start();
	$out = '<option value="0">Voyages</option>';
	if((int)date("H") < 17) $date = date("Y-m-d");
	else $date =  date("Y-m-d",time()+(9*3600));
	require_once("../inc/connection.php");
	$sql = "select id_voyage as id , heure_depart as h from voyages where destination = '".$_POST['v']."' and date_depart = '".$date."' and id_agence = '".$_SESSION['id']."'";
	$req = $bdd->query($sql);
	if($req->rowCount() > 0){
		while($d = $req->fetch()){
			$out .= '<option value="'.$d['id'].'">'.$d['h'].'</option>';
		}
		die($out);
	}
	echo $out;
?>
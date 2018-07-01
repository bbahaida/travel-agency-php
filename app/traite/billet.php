<?php
require_once("../inc/connection.php");
session_start();

if(!empty($_SESSION['id'])){
	if(!empty($_POST['num'])){
		
		// recuperation variable
		
		$nomc = $_POST['nomc'];
		$telc = $_POST['telc'];
		$dest = $_POST['dest'];
		$src = $_SESSION['agence'];
		$id_vo = $_POST['id_vo'];
		$num = $_POST['num'];
		
		//end recuperation variable
		
		//calcul montant
		
		$mnt = 0;
		if(strtolower($src) == 'nktt'){
			if(strtolower($dest) == 'ndb') $mnt = 6000;
			else if(strtolower($dest) == 'alag') $mnt = 4000;
			else $mnt = 3000;
		}
		else if(strtolower($src) == 'ndb'){
			if(strtolower($dest) == 'nktt') $mnt = 6000;
			else if(strtolower($dest) == 'alag') $mnt = 10000;
			else $mnt = 9000;
		}
		else if(strtolower($src) == 'alag'){
			if(strtolower($dest) == 'nktt') $mnt = 4000;
			else if(strtolower($dest) == 'ndb') $mnt = 10000;
			else $mnt = 7000;
		}
		else{
			if(strtolower($dest) == 'ndb') $mnt = 9000;
			else if(strtolower($dest) == 'alag') $mnt = 7000;
			else $mnt = 3000;
		}
		
		// end calcul montant
		
		// veriication client
		
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
		
		// end vrification client
		
		$query2 = $bdd->prepare("insert into billets(montant,numero,id_voyage,id_client,date_billet) values(:mnt,:num,:id_vo,:id_client,now())");
		$query2->execute(array(
			'mnt' => $mnt,
			'num' => $num,
			'id_vo' => $id_vo,
			'id_client' => $id
		));
		
		echo 'Done'; 
	}
}

?>
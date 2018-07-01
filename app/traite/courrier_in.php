<?php
session_start();
require_once("../inc/connection.php");
$sql = "select * from courrier where destination = '".$_SESSION['agence']."' order by code desc limit 0,10";

$req = $bdd->query($sql);

$output = '
<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<tr class="danger">
					<th width="10%">Code</th>
					<th width="30%">Nom</th>
					<th width="30%">Numero</th>
					<th width="30%">Agence</th>
				</tr>
			
';
if(!empty($req)){
	while($r = $req->fetch()){
		$q = "select * from agence where id_agence = ".$r['id_agence'];
		$e = $bdd->query($q);
		$v = $e->fetch();
		$e->closeCursor();
			$output.='
				<tr class="info">
					<td>'.$r['code'].'</td>
					<td class="nom" >'.$r['nom_recepteur'].'</td>
					<td class="tel" >'.$r['tel'].'</td>
					<td class="ville" >'.$v['ville'].'</td>
				</tr>
			';
	}
}
else{
	
		$output.='
			<tr>
				<td colspan="4">Pas de transfert</td>
			</tr>
		';
	}
	$output.='
			</table>
		</div>';
	echo $output;
?>
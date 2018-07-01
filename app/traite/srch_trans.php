<?php
session_start();
require_once("../inc/connection.php");
$sql = "select * from transferts where tel = ".$_POST['tel'];
$output = '
<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<tr class="danger">
					<th width="20%">Code</th>
					<th width="20%">Nom</th>
					<th width="20%">Tel</th>
					<th width="20%">Montant</th>
					<th width="20%">Date</th>
				</tr>
';
$req = $bdd->query($sql);


if(!empty($req)){
	while($r = $req->fetch()){
			$output.='
				<tr class="info">
					<td>'.$r['code'].'</td>
					<td>'.$r['nom_recepteur'].'</td>
					<td>'.$r['tel'].'</td>
					<td>'.$r['montant'].'</td>
					<td>'.$r['date_transfert'].'</td>
				</tr>
			';
		}
}
else{
	
		$output.='
			<tr>
				<td colspan="5">Pas de transfert</td>
			</tr>
		';
	}
	$output.='
			</table>
		</div>';
	echo $output;
?>
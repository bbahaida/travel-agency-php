<?php
session_start();
require_once("../inc/connection.php");
$sql = "select * from transferts where id_agence = ".$_SESSION['id']." order by code desc limit 0,10";

$req = $bdd->query($sql);

$output = '
<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<tr class="danger">
					<th width="15%">Code</th>
					<th width="25%">Nom</th>
					<th width="25%">Numero</th>
					<th width="20%">Montant</th>
					<th width="15%">Agence</th>
					
				</tr>
			
';
if(!empty($req)){
	while($r = $req->fetch()){
			$output.='
				<tr class="info">
					<td>'.$r['code'].'</td>
					<td class="nom" >'.$r['nom_recepteur'].'</td>
					<td class="tel" >'.$r['tel'].'</td>
					<td class="montant" >'.$r['montant'].'</td>
					<td class="ville" >'.$r['agence'].'</td>
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
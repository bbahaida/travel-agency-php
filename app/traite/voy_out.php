<?php
session_start();
require_once("../inc/connection.php");
$sql = "select * from voyages where id_agence = ".$_SESSION['id']." and date_depart >= cast(now() as date) order by heure_depart desc limit 0,10";

$output = '
<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<tr class="danger">
					<th width="30%">Destination</th>
					<th width="20%">Heure</th>
					<th width="20%">Bus</th>
					<th width="30%">Date</th>
				</tr>
';
$req = $bdd->query($sql);


if(!empty($req)){
	while($r = $req->fetch()){
			$output.='
				<tr class="info">
					<td>'.$r['destination'].'</td>
					<td>'.$r['heure_depart'].'</td>
					<td>'.$r['bus'].'</td>
					<td>'.$r['date_depart'].'</td>
				</tr>
			';
		}
}
else{
	
		$output.='
			<tr>
				<td colspan="3">Pas de transfert</td>
			</tr>
		';
	}
	$output.='
			</table>
		</div>';
	echo $output;
?>
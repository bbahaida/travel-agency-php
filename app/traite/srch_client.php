<?php
session_start();
require_once("../inc/connection.php");

$sql = "select * from clients where tel = ".$_POST['tel'];
$output = '
<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<tr class="danger">
					<th width="50%">Nom</th>
					<th width="50%">Tel</th>
				</tr>
';
$req = $bdd->query($sql);


if(!empty($req)){
	while($r = $req->fetch()){
			$output.='
				<tr class="info">
					<td>'.$r['Nom'].'</td>
					<td>'.$r['tel'].'</td>
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
<?php
session_start();
require_once("../inc/connection.php");
if(!empty($_SESSION['id'])){
	if(!empty($_POST['v'])){
		$s = "select c.nom as n, b.numero as num, v.destination as dest, v.date_depart as date from clients as c , billets as b , voyages as v where b.id_voyage = ".$_POST['v']." and c.id_client = b.id_client and v.id_voyage = b.id_voyage order by b.numero";
		$output = '
		<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<tr class="danger">
							<th width="30%">Nom</th>
							<th width="20%">Billets</th>
							<th width="20%">Destination</th>
							<th width="30%">Date</th>
						</tr>
		';
		$req = $bdd->query($s);
		
		
		if(!empty($req)){
			while($r = $req->fetch()){
					$output.='
						<tr class="info">
							<td>'.$r['n'].'</td>
							<td>'.$r['num'].'</td>
							<td>'.$r['dest'].'</td>
							<td>'.$r['date'].'</td>
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
	}
	
}
?>
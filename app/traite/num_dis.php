<?php
	session_start();
	$out = '<option value="0">Numero</option>';
	require_once("../inc/connection.php");
	$sql = "select * from billets where id_voyage = ".$_POST['id']." order by numero";
	$req = $bdd->query($sql);
	if($req->rowCount() > 0){
		$i = 1;
		while($d = $req->fetch()){
			while($i<16){
				if($i == $d['numero']){
					break;
				}
				$out .= '<option value="'.$i.'">'.$i.'</option>';
				$i++;
			}
			$i++;
		}
		if($i<16){
			while($i<16){
				$out .= '<option value="'.$i.'">'.$i.'</option>';
				$i++;
			}
		}
	}
	else{
		for($i = 1 ; $i < 16; $i++) $out .= '<option value="'.$i.'">'.$i.'</option>';
	}
	echo $out;
?>
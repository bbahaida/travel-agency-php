<?php
require_once("inc/connection.php");
session_start();

$ville = $bdd->query("select * from agence where id_agence != ".$_SESSION['id']);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include("inc/link.php");?>
<title>Transport | Billet</title>
</head>

<body>
<?php include_once("inc/header.php");?>
<div class="container">
        <div class="row">
            <div class="jumbotron col-xs-pull-1 col-xs-push-1 col-xs-10">
                <form action="" method="post" name="billet">
                	<div class="row in">
                            <div class="form-group">
                            	<label class="col-sm-1 control-label" for="nomc">Nom:</label>
                                <div class="col-sm-5">
									<input type="text" class="form-control" placeholder="Ex: Brahim Baheida" name="nomc" id="nomc" />
                                </div>
                            	<label class="col-sm-1 control-label" for="telc">Tel:</label>
                                <div class="col-sm-5">
									<input type="tel" class="form-control" placeholder="Ex: 36200304" name="telc" id="telc" />
                                </div>
                            </div>
                        </div>
                        <div class="row in">
                            <div class="form-group">
                                <div class=" col-xs-offset-1 col-sm-5">
									<select name="ville" class="form-control" id="ville">
                                    	<?php
                                        while($v = $ville->fetch()){
										?>
                                        <option value="<?php echo strtolower($v['ville']);?>"><?php echo $v['ville'];?></option>
                                        <?php
										}
										?>
                                    </select>
                                </div>
                            	
                                <div class="col-xs-offset-1 col-sm-3">
									<select class="form-control"  name="voyage" style="display:none" id="voyage" >
                                    
                                    </select>
                                </div>
                                <div class="col-sm-2">
									<select class="form-control" style="display:none"  name="num" id="num" >
                                    
                                    </select>
                                </div>
                            </div>
                        </div>
                </form>
                		<div class="row in">
                            <div class="form-group">
               					 <div class="col-xs-offset-1 col-sm-2">
                                 	<button class="btn log_btn" id="btn"><a>Valider</a></button>
                                </div>
                                <div class=" col-xs-offset-4 col-sm-5" id="list">
                                 	<button class="btn log_btn" id="btn_list"><a>List Voyageurs</a></button>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
     </div>
        <div class="container">
        	<div class="row">
            	<div class="col-xs-push-2 col-xs-8 col-xs-pull-2">
                	<div class="table-responsive">
                        <div id="input"></div>
                    </div>
                </div>
            </div>
        </div>
        
<?php include_once("inc/footer.php");?>

<script type="text/javascript">
	$(document).ready(function(){
        voy();
		num();
    });
	$("#btn_list").click(function(){
		var v = $("#voyage").val();
		fetsh_input();
	});
	function voy(){
		var ville = $("#ville").val();
		
		$.ajax({
			url: "traite/voy_dis.php",
			data: {v:ville},
			dataType:"text",
			method: "POST",
			success: function(data){
				//eModal.alert(data);
				$("#voyage").html(data).show("slow","swing");
			}
		});
	}
	function num(){
		var id = $("#voyage").val();
		if(id > 0){
			$.ajax({
				url: "traite/num_dis.php",
				data: {id:id},
				dataType:"text",
				method: "POST",
				success: function(data){
					//eModal.alert(data);
					$("#num").html(data).show("slow");
					$("#btn_list").show("slow");
				}
			});
		}
		else 
		{
			$("#num").hide("slow");
			$("#btn_list").hide("slow");
		}
		
	}
	function fetsh_input(){
		
		$("#input").html('<img src="img/load1.gif" class="col-xs-offset-6"/>');
		var v = $("#voyage").val();
		$.ajax({
			url: "traite/billet_list.php",
			method: "POST",
			data: {v:v},
			dataType:"text",
			success: function(data){
				//eModal.alert(data);
				$("#input").html(data);
			}
		});
	}
	$("#ville").change(function(){
		$("#num").hide("slow");
		
		voy();
	});
	$("#ville").focusin(function(){
		$("#num").hide("slow");
		voy();
	});
	$("#ville").focusout(function(){
		$("#num").hide("slow");
		voy();
	});
	$("#voyage").change(function(){
		num();
	});
	$("#voyage").focusin(function(){
		num();
	});
	$("#voyage").focusout(function(){
		num();
	});
	function isNull(val){
		if(val == ''){
			return true;
		}
		return false;
	}
	
	function control(){
		var nom = $("#nomc");
		var tel = $("#telc");
		var ville = $("#ville");
		var voyage = $("#voyage");
		var num = $("#num");
		var champ = [nom,tel,ville,voyage,num];
		for(var i = 0 ; i < champ.length ; i++){
			if(isNull(champ[i].val())){
				champ[i].parent().addClass("has-error");
				return false;
			}
			else{
				champ[i].parent().removeClass("has-error");
			}
		}
		var reg = /[0-9]{8}/;
		if(!(tel.val().match(reg))){
			tel.parent().addClass("has-error");
			return false;
		}
		else{
			tel.parent().removeClass("has-error");
		}
		if(isNaN(voyage.val()) || voyage.val() <= 0){
			voyage.parent().addClass("has-error");
			return false;
		}
		else{
			voyage.parent().removeClass("has-error");
		}
		if(isNaN(num.val()) || num.val() <= 0){
			num.parent().addClass("has-error");
			return false;
		}
		else{
			num.parent().removeClass("has-error");
		}
		return true;
	}
	$("#btn").click(function(){
		if(!control()) return false;
		var nom = $("#nomc").val();
		var tel = $("#telc").val();
		var ville = $("#ville").val();
		var voyage = $("#voyage").val();
		var num = $("#num").val();
		$.ajax({
			url: "traite/billet.php",
			method: "POST",
			data: {nomc:nom,telc:tel,dest:ville,id_vo:voyage,num:num},
			dataType:"text",
			success: function(data){
				eModal.alert(data);
			}
		});
		fetsh_input();
	});
</script>

</body>
</html>
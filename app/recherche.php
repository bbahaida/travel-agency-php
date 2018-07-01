<?php
session_start();
require_once("inc/connection.php");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include("inc/link.php");?>
<style>
</style>
<title>Transport | Recherche</title>
</head>

<body>
<?php include_once("inc/header.php");?>
        <div class="container">
            <div class="row">
                <div class="search">
                    <div class="col-sm-8">
                       <div class="input-group">
                         <input class="form-control" placeholder="Search" name="srch" id="srch"/>
                            <div class="input-group-btn">
                              <button class="btn btn-primary" id="btn_srch"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                       </div>
                       <form role="form" id="form">
                           <div class="col-sm-1">
                                Transfert: <input type="radio" class="form-control radio" name="rad" value="1"/>
                           </div>
                           <div class="col-sm-1">
                                Courrier: <input type="radio" class="form-control radio" name="rad" value="2"/>
                           </div>
                           <div class="col-sm-1">
                                Billet: <input type="radio" class="form-control radio" name="rad" value="3"/>
                           </div>
                           <div class="col-sm-1">
                                Client: <input type="radio" class="form-control radio" name="rad" value="4"/>
                           </div>
                       </form>
                    </div>
                </div>
            </div>
            <div class="row"></div>
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
$("#btn_srch").click(function(){
	var v = $('input[name=rad]:checked',"#form").val();
  	var tel = $("#srch").val();
	switch(v){
		case '1' : trans(tel); break;
		case '2' : courrier(tel); break; //33728751
		case '3' : billet(tel); break;
		case '4' : client(tel); break;
	}
});
function trans(tel){
	$("#input").html('<img src="img/load1.gif" class="col-xs-offset-6"/>');
	$.ajax({
		url:"traite/srch_trans.php",
		method: "POST",
		data: {tel:tel},
		dataType:"text",
		success: function(data){
			$("#input").html(data);
		}
	});
}
function courrier(tel){
	$("#input").html('<img src="img/load1.gif" class="col-xs-offset-6"/>');
	$.ajax({
		url:"traite/srch_courrier.php",
		method: "POST",
		data: {tel:tel},
		dataType:"text",
		success: function(data){
			$("#input").html(data);
		}
	});
}
function billet(tel){
	$("#input").html('<img src="img/load1.gif" class="col-xs-offset-6"/>');
	$.ajax({
		url:"traite/srch_billet.php",
		method: "POST",
		data: {tel:tel},
		dataType:"text",
		success: function(data){
			$("#input").html(data);
		}
	});
}
function client(tel){
	$("#input").html('<img src="img/load1.gif" class="col-xs-offset-6"/>');
	$.ajax({
		url:"traite/srch_client.php",
		method: "POST",
		data: {tel:tel},
		dataType:"text",
		success: function(data){
			$("#input").html(data);
		}
	});
}
</script>
</body>
</html>
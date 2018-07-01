
	$(document).ready(function(){
		fetsh_input();
		fetsh_output();
	});
	function fetsh_input(){
		$("#input").html('<img src="img/load1.gif" class="col-xs-offset-5"/>');
		$.ajax({
			url: "traite/voy_in.php",
			method: "POST",
			success: function(data){
				$("#input").html(data);
			}
		});
	}
	function fetsh_output(){
		$("#output").html('<img src="img/load1.gif" class="col-xs-offset-5"/>');
		$.ajax({
			url: "traite/voy_out.php",
			method: "POST",
			success: function(data){
				$("#output").html(data);
			}
		});
	}
	/*Copyright Brahim Baheida & Mouin Sidatt*/
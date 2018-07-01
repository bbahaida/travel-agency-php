
	$(document).ready(function(){
		fetsh_input();
		fetsh_output();
	});
	function fetsh_input(){
		$("#input").html('<img src="img/load1.gif" class="col-xs-offset-6"/>');
		$.ajax({
			url: "traite/courrier_in.php",
			method: "POST",
			success: function(data){
				$("#input").html(data);
			}
		});
	}
	function fetsh_output(){
		$("#output").html('<img src="img/load1.gif" class="col-xs-offset-6"/>');
		$.ajax({
			url: "traite/courrier_out.php",
			method: "POST",
			success: function(data){
				$("#output").html(data);
			}
		});
	}
   
			function isNull(val){
				if(val.value == ''){
					val.parentNode.className = "col-xs-4 has-error";
					val.focus();
					return true;
				}
				return false;
			}
			function isNumber(val){
				var rex = /[0-9]{8}/;
				var value = val.value;
				if(!value.match(rex)){
					val.parentNode.className = "col-sm-4 has-error";
					val.focus();
					return false;
					}
				else return true;
			}

			function control(){
				var nomc = document.getElementById('nomc');
				var nomd = document.getElementById('nomd');
				var telc = document.getElementById('telc');
				var teld = document.getElementById('teld');
				var ville = document.getElementById("ville").value;
				var voyage = document.getElementById("voyage").value;
				var champ = new Array(nomc,nomd,telc,teld);
				for(var i = 0; i < champ.length; i++){
					if(isNull(champ[i])){
						return ;
					}
					else {
						champ[i].parentNode.className = "col-sm-4";
					}
				}
				if(!isNumber(telc)) return;
				else if(!isNumber(teld)) return;
				$.ajax({
					url: "traite/courrier_traite.php",
					method: "POST",
					data: {nomc:nomc.value,nomd:nomd.value,telc:telc.value,teld:teld.value,ville:ville,voyage:voyage},
					dataType:"text",
					success: function(data){
						eModal.alert(data);
						fetsh_input();
						fetsh_output();
					}
				});
			}
	/*Copyright Brahim Baheida & Mouin Sidatt*/

	$(document).ready(function(){
		fetsh_input();
		fetsh_output();
	});
	function fetsh_input(){
		$("#input").html('<img src="img/load1.gif" class="col-xs-offset-6"/>');
		$.ajax({
			url: "traite/trans_in.php",
			method: "POST",
			success: function(data){
				$("#input").html(data);
			}
		});
	}
	function fetsh_output(){
		$("#output").html('<img src="img/load1.gif" class="col-xs-offset-6"/>');
		$.ajax({
			url: "traite/trans_out.php",
			method: "POST",
			success: function(data){
				$("#output").html(data);
			}
		});
	}
    function prix(){
		var montant = document.getElementById('montant');
		var montval = parseFloat(montant.value);
		var cout = document.getElementById('cout');
		if(isNaN(montval)){
			cout.value = '0.00 MRO';
			val.parentNode.className = "col-xs-4 has-error";
				val.focus();
				return ;
		}
		if(montval <= 0) cout.value = '0.00 MRO';
		else if(montval <= 50000) cout.value = '500.00 MRO';
		else if(montval <= 100000) cout.value = '1000.00 MRO';
		else if(montval > 100000) cout.value = '2000.00 MRO';
		else cout.value = '0.00 MRO';
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
			val.parentNode.className = "col-xs-4 has-error";
			val.focus();
			return false;
		}
		else return true;
	}
	function setNull(val){
		val.value = '';
	}
	function control(){
		var nomc = document.getElementById('nomc');
		var nomd = document.getElementById('nomd');
		var telc = document.getElementById('telc');
		var teld = document.getElementById('teld');
		var montant = document.getElementById('montant');
		var ville = document.getElementById("ville").value;
		var champ = new Array(nomc,nomd,telc,teld,montant);
		for(var i = 0; i < champ.length; i++){
			if(isNull(champ[i])){
				return ;
			}
			else {
				champ[i].parentNode.className = "col-xs-4";
			}
		}
		if(!isNumber(telc)) return ;
		else if(!isNumber(teld)) return ;
		$.ajax({
			url : "transfert.php",
			type: "POST",
			data : {nomc:nomc.value,nomd:nomd.value,telc:telc.value,teld:teld.value,montant:montant.value,ville:ville},
			dataType:"text",
			success: function(){
				eModal.alert("Done");
				fetsh_input();
				fetsh_output();
				for(var i = 0; i < champ.length; i++) setNull(champ[i]);
			}
		});
	}
	/*Copyright Brahim Baheida & Mouin Sidatt*/
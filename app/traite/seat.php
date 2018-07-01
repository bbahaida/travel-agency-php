<?php
if(true){
	$bd = new PDO("mysql:host=localhost;dbname=trans_proj","root","");
	$req = $bd->query("select numero as num from billets where id_voyage = ".$_POST['id']."");
	$t = false;
	if($req->rowCount() > 0){
		$t = true;
	}
}
if(!empty($_POST['num'])){
	$r = $bd->prepare("insert into billets(montant,numero,mat) values(:num)");
	$r->execute(array(
	'num' => $_POST['num']
	));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Demo Seat Reservation with jQuery</title>

    <script src="jquery-2.1.4.min.js" type="text/javascript"></script>
    <style type="text/css">
	#holder{	
	 height:120px;	 
	 width:300px;
	 border:1px solid #A4A4A4;
	 margin-left:10px;
	}
	 #place {
	 position:relative;
	 margin:7px;
	 }
     #place a{
	 font-size:0.6em;
	 }
     #place li
     {
         list-style: none outside none;
         position: absolute;   
     }    
     #place li:hover
     {
        background-color:yellow;      
     } 
	 #place .seat{
	 background:url("images/available_seat_img.gif") no-repeat scroll 0 0 transparent;
	 height:40px;
	 width:33px;
	 margin-left: 20px;
	 display:block;	 
	 }
      #place .selectedSeat
      { 
		background-image:url("images/booked_seat_img.gif");      	 
      }
	   #place .selectingSeat
      { 
		background-image:url("images/selected_seat_img.gif");      	 
      }
	  #place .row-3, #place .row-4{
		margin-top:10px;
	  }
	 #seatDescription{
	 padding:0px;
	 }
	  #seatDescription li{
	  verticle-align:middle;	  
	  list-style: none outside none;
	   padding-left:35px;
	  height:35px;
	  float:left;
	  }
    </style>
	</head>
<body>
        <div id="holder"> 
            <ul  id="place">
            </ul>    
        </div>
		<div style="width:580px;text-align:left;margin:5px">	
			<input type="button" id="btnShowNew" value="Show Selected Seats" />
        </div>
    <script type="text/javascript">
	$("#btn").click(function(){
		$("form1").hide("slow");
	});
        $(function () {
            var settings = {
                rows: 3,
                cols: 5,
                rowCssPrefix: 'row-',
                colCssPrefix: 'col-',
                seatWidth: 50,
                seatHeight: 35,
                seatCss: 'seat',
                selectedSeatCss: 'selectedSeat',
				selectingSeatCss: 'selectingSeat'
            };

            var init = function (reservedSeat) {
                var str = [], seatNo, className;
                for (i = 0; i < settings.rows; i++) {
                    for (j = 0; j < settings.cols; j++) {
                        seatNo = (i + j * settings.rows + 1);
                        className = settings.seatCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
                        if ($.isArray(reservedSeat) && $.inArray(seatNo, reservedSeat) != -1) {
                            className += ' ' + settings.selectedSeatCss;
                        }
                        str.push('<li class="' + className + '"' +
                                  'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px"  value="'+seatNo+'">' +
                                  '<a title="' + seatNo + '">' + seatNo + '</a>' +
                                  '</li>');
                    }
                }
                $('#place').html(str.join(''));
            };

            //case I: Show from starting
            //init();

            //Case II: If already booked
            var bookedSeats = [0 <?php while($d=$req->fetch()) echo ','.$d['num'];?>];
            init(bookedSeats);


            $('.' + settings.seatCss).click(function () {
			if ($(this).hasClass(settings.selectedSeatCss)){
				alert('This seat is already reserved');
			}
			else{
                if(confirm("Voulez vouz choisir ?")){
					$.ajax({
						url: "seat.php",
						method: "POST",
						data:{num:$(this).val()},
						dataType:"text",
						success: function(data){
							alert("done");
						}
					})
					$(this).toggleClass(settings.selectedSeatCss);
				}
			}
            });

            $('#btnShowNew').click(function () {
                var str = [], item;
                $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
                    item = $(this).attr('title');                   
                    str.push(item);                   
                });
                alert(str.join(','));
            })
        });
    
    </script>
</body>
</html>

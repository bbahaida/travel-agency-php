$(function(){
	$("#trans").html('<img src="img/load1.gif" class="col-xs-offset-5"/>');
	$.ajax({
		url: 'graph/trans_charts.php',
		type: 'GET',
		success : function(data) {
		chartData = data;
		var chartProperties = {
        "caption": "transfert graphe",
        "xAxisName": "date",
        "yAxisName": "montant",
        "rotatevalues": "1",
        "theme": "ocean"
      };
	  var w ='';
	  var h ='';
	  	if($("body").width() < 550){
			w = '300';
			h = '200';
		}
		else{
			w = '550';
			h = '350';
		}
      apiChart = new FusionCharts({
        type: 'column2d',
        renderAt: 'trans',
        width: w,
        height: h,
        dataFormat: 'json',
        dataSource: {
          "chart": chartProperties,
          "data": chartData
        }
      });
      apiChart.render();
    }
  });
});
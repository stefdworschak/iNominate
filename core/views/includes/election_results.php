<?php
  $election_id = !isset($_GET['election_id']) ? 0 : $_GET['election_id'];
  if($election_id == 0){
    header('Location:index.php');
  } else {
    $json_content='';
    $json_content2='';
    $json_content3='';

    $rows=$c->displayResults($election_id);

    for($i=0; $i<sizeof($rows);$i++){
      $row=$rows[$i];
      $color = $row->getWin() == 1 ? ', color: "#04bf67"' : '';
      $color2 = $row->getWin() == 1 ? ', color: "#80d69a"' : '';
      $color3 = $row->getWin() == 1 ? ', color: "#c6eccf"' : '';
      $json_content .= '{
          y: ' . $row->getRank1() . ' , label: "' . $row->getName() .'"'. $color .'
      }';
      $json_content2 .= '{
          y: ' . $row->getRank2() . ' , label: "' . $row->getName() .'"'. $color2 .'
      }';
      $json_content3 .= '{
          y: ' . $row->getRank3() . ' , label: "' . $row->getName() .'"'. $color3 .'
      }';
      $json_content .= $i<sizeof($rows)-1 ? ',' : '';
      $json_content2 .= $i<sizeof($rows)-1 ? ',' : '';
      $json_content3 .= $i<sizeof($rows)-1 ? ',' : '';
    }
    //echo $json_content;
  }


 ?>
 <script>
 window.onload = function () {

 var chart = new CanvasJS.Chart("chartContainer", {
 	animationEnabled: true,
 	title:{
 		text: "",
 		fontFamily: "arial black",
 		fontColor: "#000"
 	},
 	axisX: {
 		interval: 1,
 		intervalType: "Candidate"
 	},
 	axisY:{
 		valueFormatString:"#",
 		gridColor: "#B6B1A8",
 		tickColor: "#B6B1A8"
 	},
 	toolTip: {
 		shared: true,
 		content: toolTipContent
 	},
 	data: [{
 		type: "stackedColumn",
 		showInLegend: true,
 		color: "#f88379",
 		name: "Rank 1 Votes",
 		dataPoints: [<?php echo $json_content; ?>]
 		},
 		{
 			type: "stackedColumn",
 			showInLegend: true,
 			name: "Rank 2 Votes",
 			color: "#feada3",
 			dataPoints: [<?php echo $json_content2; ?>]
 		},
 		{
 			type: "stackedColumn",
 			showInLegend: true,
 			name: "Rank 3 Votes",
 			color: "#ffd6d0",
 			dataPoints: [<?php echo $json_content3; ?>]
 		}]
 });
 chart.render();

 function toolTipContent(e) {
 	var str = "";
 	var total = 0;
 	var str2, str3;
 	for (var i = 0; i < e.entries.length; i++){
 		var  str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\"> "+e.entries[i].dataSeries.name+"</span>: <strong>"+e.entries[i].dataPoint.y+"</strong><br/>";
    if(i == 1) {
      total += e.entries[i].dataPoint.y * 0.3;
    } else if(i == 2) {
      total += e.entries[i].dataPoint.y * 0.15;
    } else {
      total += e.entries[i].dataPoint.y
    }
 		str = str.concat(str1);
 	}
 	str2 = "<span style = \"color:DodgerBlue;\"><strong>"+(e.entries[0].dataPoint.label)+"</strong></span><br/>";
 	total = Math.round(total * 100) / 100;
 	str3 = "<span style = \"color:Tomato\"> Total Score:</span><strong>"+total+"</strong><br/>";
 	return (str2.concat(str)).concat(str3);
 }

 }
 </script>

 <div class="row">
   <div class="card profile_card">
     <h4 class="card-header">Election Results<span style="float:right;"><a href="index.php?view=elections" class="btn btn-primary">Back</a></span></h4>
     <div class="card-body">

       <div id="chartContainer" style="height: 300px; width: 100%;"></div>

    </div>
  </div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

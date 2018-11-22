<?php

  $c = new DBClass;
  $all=$c->getCandidates();
  $html = "";
  $html .= '<div class="row">';
  for($i=0; $i < sizeof($all);$i++){

    //New Line of

    if($i % 4 == 0) {
      //$html .= "<div class='row'>";
    }

    $img = $all[$i]['img_link'] == '' ? 'core/img/portrait.png' : $all[$i]['img_link'];

    $html .= "
    <div class='col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 single-row'>
      <div class='card' style='width:100%;'>
      <img class='card-img-top' src='" . $img ."' alt='Profile Photo'>
      <div class='card-body'>
        <h5 class='card-title'><span class='candidate_name'>" . $all[$i]['candidate_name'] ."</span></h5>
        <p><strong>Running For:</strong> <span class='election_title'>" . $all[$i]['election_title'] .  "</span><br />
        <strong>Department:</strong> <span class='election_department'>" . $all[$i]['election_department'] .  "</span><br />
        <strong>Open Until:</strong> <span class='election_end'>" . substr($all[$i]['election_end'],0,10) .  "</span>
        </p>
        <a href='index.php?view=profile&id=" . $all[$i]['profile_id'] ."' class='btn btn-primary'>See Profile</a>
        &nbsp;<a href='#' class='btn btn-danger'>Vote!</a>
      </div>
      </div>
    </div>
    ";
    //print_r($all[$i]['candidate_name'] . '<br>');
    //if($i % 3 == 0 && $i != 0) {$html .= "</div>";}

  }
  if(sizeof($all) % 4 != 0){
    $append = (sizeof($all) % 4) * 3;
    //$html .= "<div class='col-md-" . $append ."'>&nbsp;</div></div>";
  }
  $html .= '</div>';
//echo $html;
 ?>

 <div class="row">
   <div class="card profile_card">
     <h4 class="card-header">All Candidates <span id="search_div"><input type="text" id="search"><i class="fas fa-search"></i></span></h4>
     <div class="card-body">

        <?php
            echo $html;
        ?>
      </div>
    </div>
  </div>

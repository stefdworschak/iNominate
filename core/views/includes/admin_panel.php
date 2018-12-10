<?php
  if(!isset($_SESSION)) {
    header('Location:../../../index.php');
  }
?>

<div class="container">
    <div class="row">
      <div class="card profile_card">
        <h4 class="card-header">Admin Panel</h4>
        <div class="card-body">
          <a href="index.php?view=create_election" class="btn btn-primary btn-md">Create New Election</a>
          <br /><br />

          <?php
            $mode = isset($_GET['admin_mode']) ? $_GET['admin_mode'] : 'results';
            if($mode == 'results') {
                echo "<h5 class='card-title profile_subtitle'>Elections Results | <a href='index.php?view=admin_panel&admin_mode=ongoing'>Ongoing Elections</a> | <a href='index.php?view=admin_panel&admin_mode=past'>Past Elections</a></h5>";
            } else if($mode == 'ongoing') {
                echo "<h5 class='card-title profile_subtitle'><a href='index.php?view=admin_panel&admin_mode=results'>Election Results</a> | Ongoing Elections | <a href='index.php?view=admin_panel&admin_mode=past'>Past Elections</a></h5>";
            } else {
                echo "<h5 class='card-title profile_subtitle'><a href='index.php?view=admin_panel&admin_mode=results'>Election Results</a> | <a href='index.php?view=admin_panel&admin_mode=ongoing'>Ongoing Elections</a> | Past Elections</h5>";
            }



            $c = new DBClass;
            $all=$c->getElections($_SESSION['org']);
            $html='';
            for($i=0;$i < sizeof($all); $i++){
              if(strtotime($all[$i]['expiry_date']) <= time() && $all[$i]['closed'] == 0 && $mode == 'results'){
                  $html .= "
                  <div class='card main_card'>
                    <h5 class='card-header'>" . $all[$i]['title'] ."</h5>
                    <div class='card-body'>
                      <!--<h5 class='card-title'></h5>-->
                      <p class='card-text'>
                        <strong>Number of Votes:</strong> " . $all[$i]['num_votes'] ." <br>
                        <strong>Number of Candidates:</strong> ". $all[$i]['reg_candidates'] ."/" . $all[$i]['num_candidates'] ." <br>
                        <strong>Election expiry date:</strong> " . $all[$i]['expiry_date'] ." <br>
                      </p>
                      <form method='POST' action='core/functions/close_election.php' enctype='multipart/form-data' style='display:inline'>
                      <input type='hidden' value='".$all[$i]['id']."' name='election_id' />
                      <input type='submit'  class='btn btn-success btn-sm' value='Confirm Results' />
                      </form>
                    </div>
                  </div>

                  ";
              } else if(strtotime($all[$i]['expiry_date']) > time() && $mode == 'ongoing'){
                $html .= "
                <div class='card main_card'>
                  <h5 class='card-header'>" . $all[$i]['title'] ."</h5>
                  <div class='card-body'>
                    <!--<h5 class='card-title'></h5>-->
                    <p class='card-text'>
                      <strong>Number of Votes:</strong> " . $all[$i]['num_votes'] ." <br>
                      <strong>Number of Candidates:</strong> ". $all[$i]['reg_candidates'] ."/" . $all[$i]['num_candidates'] ." <br>
                      <strong>Election expiry date:</strong> " . $all[$i]['expiry_date'] ." <br>
                    </p>
                    <a href='#' class='btn btn-warning btn-sm'>Edit</a>
                  </div>
                </div>
                ";
              } else if(strtotime($all[$i]['expiry_date']) <= time() && $all[$i]['closed'] == 1 && $mode == 'past') {
                $html .= "
                <div class='card main_card'>
                  <h5 class='card-header'>" . $all[$i]['title'] ."</h5>
                  <div class='card-body'>
                    <!--<h5 class='card-title'></h5>-->
                    <p class='card-text'>
                      <strong>Number of Votes:</strong> " . $all[$i]['num_votes'] ." <br>
                      <strong>Number of Candidates:</strong> ". $all[$i]['reg_candidates'] ."/" . $all[$i]['num_candidates'] ." <br>
                      <strong>Election expiry date:</strong> " . $all[$i]['expiry_date'] ." <br>
                    </p>
                    <a href='index.php?view=election_results&election_id=" . $all[$i]['id'] . "' class='btn btn-primary btn-sm'>View Results</a>
                  </div>
                </div>
                ";
              }
            }
            echo $html;
           ?>
          <!--<p class="card-text profile_text">With supporting text below as a natural lead-in to additional content.</p>-->

      </div>
    </div>
</div>

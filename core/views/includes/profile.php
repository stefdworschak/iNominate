<?php
  ob_start();
  $id = isset($_GET['id']) == '' || !isset($_GET['id']) ? -1 : $_GET['id'];

  if($id == -1){
    header('Location:index.php?view=candidates');
  } else if(is_numeric($id)){
    $pro=$c->getCandidateProfile($id);
    if(sizeof($pro) == 0) {
        header('Location:index.php?view=candidates');
    }
  } else {
    header('Location:index.php?view=candidates');
  }
  $img=$pro['img_link'] == '' ? 'core/img/portrait.png' : $pro['img_link'];
?>

<div class="container">
    <div class="row">
      <div class="card profile_card">
        <h4 class="card-header"><?php echo $pro['candidate_name']; ?></h4>
        <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                  <img src="<?php echo $img; ?>" width="150px" height="150px" style="border-radius:150px;" alt="profile photo" />
                  <br /><br />
              </div>
              <div class="col-md-6">
                      <table width="100%" border="1" class="table table-bordered">
                      <tr>
                        <th scope="col" style="width:120px;">Running For</td>
                        <td><?php echo $pro['election_title']; ?></td>
                      </tr>
                      <tr>
                        <th scope="col" style="width:120px;">Details</td>
                        <td><?php echo $pro['election_description']; ?></td>
                      </tr>
                      <tr>
                        <th scope="col" style="width:120px;">Department</td>
                        <td><?php echo $pro['election_department']; ?></td>
                      </tr>
                      <tr>
                        <th scope="col" style="width:120px;">Election End</td>
                        <td><?php echo $pro['election_end']; ?></td>
                      </tr>
                    </table>
              </div>
            </div>
          <div class="col-md-12">
          <a href="#" class="btn btn-primary btn-sm" id="contact_btn">Contact</a> <a href="#" class="btn btn-warning btn-sm">Add Favourite</a>  <a href="#" class="btn btn-danger btn-sm">Vote!</a>
          <br /><br />
          <div class="form-group profile_text" id="contact_div">
              <form method="POST" action="core/functions/send_message.php" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $_SESSION['xssid']; ?>" name="xssid" />
                <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" name="from_id" />
                <input type="hidden" value="<?php echo $pro['user_id']; ?>" name="to_id" />
                <input type="hidden" value="<?php echo $id; ?>" name="profile_id" />
                <input type="hidden" value=0 name="thread_id" />
                <input class="form-control" type="text" placeholder="Subject" name="subject" style="width:60%; margin-bottom:10px;" />
                <textarea class="form-control" id="contact" style="width:60%;height:100px;" name="message" placeholder="Messge"></textarea>
                <input type="submit" value="Send" class="btn btn-success" />
              </form>
          </div>
          <h5 class="card-title profile_subtitle">Mission Statement</h5>
          <p class="card-text profile_text"><?php echo $pro['mission_statement']; ?></p>
          <h5 class="card-title profile_subtitle">Policies</h5>
          <p class="card-text profile_text"><?php echo $pro['policies']; ?></p>
          <h5 class="card-title profile_subtitle">Areas of Interest</h5>
          <p class="card-text profile_text"><?php echo $pro['areas_of_interest']; ?></p>
        </div>
        </div>
      </div>
    </div>
</div>

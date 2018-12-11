<div class="row">
  <div class="card profile_card">
    <h4 class="card-header">Create A Poll</h4>
    <div class="card-body">

    <form method="POST" action="core/functions/add_poll.php" enctype="multipart/form-data" id="createPollFrm">
      <div class="form-group">
        <label for="poll_question">Poll Question<span class="err_output" id="q_err"><span></label>
        <textarea class="form-control" id="poll_question" name="poll_question" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="opt1">Option 1<span class="err_output" id="opt1_err"><span></label>
        <input type="text" class="form-control" id="opt1" name="opt1" placeholder="First Option">
      </div>

      <div class="form-group">
        <label for="opt2">Option 2<span class="err_output" id="opt2_err"><span></label>
        <input type="text" class="form-control" id="opt2" name="opt2" placeholder="Second Option">
      </div>

      <div class="form-group">
        <label for="opt3">Option 3<span class="err_output" id="opt3_err"><span></label>
        <input type="text" class="form-control" id="opt3" name="opt3" placeholder="Third Option">
      </div>

      <div class="form-group">
        <label for="opt4">Option 4<span class="err_output" id="opt4_err"><span></label>
        <input type="text" class="form-control" id="opt4" name="opt4" placeholder="Fourth Option">
      </div>

      <div class="form-group">
        <label for="opt5">Option 5<span class="err_output" id="opt5_err"><span></label>
        <input type="text" class="form-control" id="opt5" name="opt5" placeholder="Fifth Option">
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="poll_expirydate">Expiry Date<span class="err_output" id="expDate_err"><span></label>
            <input type="date" class="form-control" id="poll_expirydate" name="poll_expirydate">
        </div>
        <div class="col-md-6 mb-3">
            <label for="poll_expirytime">Time<span class="err_output" id="expTime_err"><span></label>
            <input type="time" class="form-control" id="poll_expirytime" name="poll_expirytime">
        </div>
      </div>
      <div class="form-group">
        <label for="poll_range">Audience<span class="err_output" id="range_err"><span></label>
        <select class="form-control"  id="poll_range" name="poll_range">
          <option>All</option>
          <option>My Department Only</option>
        </select>
      </div>

      <button class="btn btn-primary">Create Poll</button>
    </form>
    </div>
  </div>
</div>

<div class="row">
  <div class="card profile_card">
    <h4 class="card-header">Create A Poll</h4>
    <div class="card-body">

    <form method="POST" action="core/functions/add_poll.php" enctype="multipart/form-data">
      <div class="form-group">
        <label for="poll_question">Poll Question</label>
        <textarea class="form-control" id="poll_question" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label for="opt1">Option 1</label>
        <input type="text" class="form-control" id="opt1" placeholder="First Option">
      </div>

      <div class="form-group">
        <label for="opt2">Option 2</label>
        <input type="text" class="form-control" id="opt2" placeholder="Second Option">
      </div>

      <div class="form-group">
        <label for="opt3">Option 3</label>
        <input type="text" class="form-control" id="opt3" placeholder="Third Option">
      </div>

      <div class="form-group">
        <label for="opt4">Option 4</label>
        <input type="text" class="form-control" id="opt4" placeholder="Fourth Option">
      </div>

      <div class="form-group">
        <label for="opt5">Option 5</label>
        <input type="text" class="form-control" id="opt5" placeholder="Fifth Option">
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="election_expirydate">Expiry Date<span class="err_output" id="expDate_err"><span></label>
            <input type="date" class="form-control" id="election_expirydate" name="election_expirydate">
        </div>
        <div class="col-md-6 mb-3">
            <label for="election_expirytime">Time<span class="err_output" id="expTime_err"><span></label>
            <input type="time" class="form-control" id="election_expirytime" name="election_expirytime">
        </div>
      </div>

      <button class="btn btn-primary">Create Poll</button>
    </form>
    </div>
  </div>
</div>

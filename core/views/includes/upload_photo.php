<!-- https://getbootstrap.com/docs/4.1/components/input-group/#custom-file-input -->

<h5>Upload a Profile Photo</h5>
<form method="POST" action="core/functions/upload_photo.php" enctype="multipart/form-data">
<div class="input-group mb-3" style="width:50%;">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputfileAddon01">Upload</span>
  </div>
  <div class="custom-file">
      <input type="file" name="upload_photo" accept="image/*" class="custom-file-input" id="upload_photo" aria-describedby="inputGroupFileAddon01">
      <label class="custom-file-label" for="inputfile">Choose file</label>
    </div>
  </div>

  <div id="display_photo">

  </div>
  <br />
  <button type="submit" class="btn btn-primary" id="submit_photo" style="display:none;">Upload Photo</button>
</form>

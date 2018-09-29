<h2>Hello, <?php echo $_SESSION['first_name']; ?>, you are logged in</h2>
<br /><br />
<form method="POST" action="core/functions/logout_script.php" enctype="multipart/form-data">
  <input type="submit" value="Logout" />
</form>

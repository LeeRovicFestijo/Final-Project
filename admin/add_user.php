<div class="row-fluid">
  <!-- block -->
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left">Add User</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form method="post">
          <div class="control-group">
            <div class="controls">
              <input class="input focused" name="firstname" id="focusedInput" type="text" placeholder="Firstname"
                required>
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <input class="input focused" name="lastname" id="focusedInput" type="text" placeholder="Lastname"
                required>
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <input class="input focused" name="username" id="focusedInput" type="text" placeholder="Username"
                required>
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <input class="input focused" name="password" id="focusedInput" type="text" placeholder="Password"
                required>
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <button name="save" class="btn btn-info"><i class="icon-plus-sign icon-large"></i></button>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /block -->
</div>

<?php
if (isset($_POST['save'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $password = $_POST['password'];


  $query = mysqli_query($conn, "select * from users where username = '$username' and password = '$password' and firstname = '$firstname' and password = '$password' ") or die(mysqli_error($conn));
  $count = mysqli_num_rows($query);

  if ($count > 0) { ?>
    <script>
      alert('Data Already Exists');
    </script>
    <?php
  } else {
    mysqli_query($conn, "insert into users (username,password,firstname,lastname) values('$username','$password','$firstname','$lastname')") or die(mysqli_error($conn));

    mysqli_query($conn, "insert into activity_log (date,username,action) values(NOW(),'$user_username','Add User $username')") or die(mysqli_error($conn));
    ?>
    <script>
      window.location = "admin_user.php";
    </script>
    <?php
  }
}
?>
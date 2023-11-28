<div class="row-fluid">
  <!-- block -->
  <div class="block">
    <div class="navbar navbar-inner block-header">
      <div class="muted pull-left">Add Teacher</div>
    </div>
    <div class="block-content collapse in">
      <div class="span12">
        <form method="post">
          <!--
                    <label>Photo:</label>
                    <div class="control-group">
                                          <div class="controls">
                                               <input class="input-file uniform_on" id="fileInput" type="file" required>
                                          </div>
                                        </div>
                  -->

          <div class="control-group">
            <label>Barangay:</label>
            <div class="controls">
              <select name="barangay" class="" required>
                <option></option>
                <?php
                $query = mysqli_query($conn, "select * from barangay order by barangay_name");
                while ($row = mysqli_fetch_array($query)) {

                  ?>
                  <option value="<?php echo $row['barangay_id']; ?>">
                    <?php echo $row['barangay_name']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <input class="input focused" name="firstname" id="focusedInput" type="text" placeholder="Firstname">
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <input class="input focused" name="lastname" id="focusedInput" type="text" placeholder="Lastname">
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
  $barangay_id = $_POST['barangay'];


  $query = mysqli_query($conn, "select * from teacher where firstname = '$firstname' and lastname = '$lastname' ") or die(mysqli_error($conn));
  $count = mysqli_num_rows($query);

  if ($count > 0) { ?>
    <script>
      alert('Data Already Exists');
    </script>
    <?php
  } else {

    mysqli_query($conn, "insert into teacher (firstname,lastname,location,barangay_id)
								values ('$firstname','$lastname','uploads/NO-IMAGE-AVAILABLE.jpg','$barangay_id')         
								") or die(mysqli_error($conn)); ?>
    <script>
      window.location = "teachers.php";
    </script>
  <?php }
} ?>
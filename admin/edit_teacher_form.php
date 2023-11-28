   <div class="row-fluid">
       <a href="teachers.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Teacher</a>
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Edit Teacher</div>
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
									<?php
									$query = mysqli_query($conn,"select * from teacher where teacher_id = '$get_id' ")or die(mysqli_error($conn));
									$row = mysqli_fetch_array($query);
									?>
										
										  <div class="control-group">
											<label>Barangay:</label>
                                          <div class="controls">
                                            <select name="barangay"  class="chzn-select"required>
											<?php
											$query_teacher = mysqli_query($conn,"select * from teacher join  barangay")or die(mysqli_error($conn));
											$row_teacher = mysqli_fetch_array($query_teacher);
											
											?>
											
                                             	<option value="<?php echo $row_teacher['barangay_id']; ?>">
												<?php echo $row_teacher['barangay_name']; ?>
												</option>
											<?php
											$barangay = mysqli_query($conn,"select * from barangay order by barangay_name");
											while($barangay_row = mysqli_fetch_array($barangay)){
											
											?>
											<option value="<?php echo $barangay_row['barangay_id']; ?>"><?php echo $barangay_row['barangay_name']; ?></option>
											<?php } ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" value="<?php echo $row['firstname']; ?>" name="firstname" id="focusedInput" type="text" placeholder = "Firstname">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" value="<?php echo $row['lastname']; ?>"  name="lastname" id="focusedInput" type="text" placeholder = "Lastname">
                                          </div>
                                        </div>
										
										
									
											<div class="control-group">
                                          <div class="controls">
												<button name="update" class="btn btn-success"><i class="icon-save icon-large"></i></button>

                                          </div>
                                        </div>
                                </form>
								</div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
					
					
				   <?php
                            if (isset($_POST['update'])) {
                       
                                $firstname = $_POST['firstname'];
                                $lastname = $_POST['lastname'];
                                $barangay_id = $_POST['barangay'];
								
								
								$query = mysqli_query($conn,"select * from teacher where firstname = '$firstname' and lastname = '$lastname' ")or die(mysqli_error($conn));
								$count = mysqli_num_rows($query);
								
								if ($count > 1){ ?>
								<script>
								alert('Data Already Exist');
								</script>
								<?php
								}else{
								
								mysqli_query($conn,"update teacher set firstname = '$firstname' , lastname = '$lastname' , barangay_id = '$barangay_id' where teacher_id = '$get_id' ")or die(mysqli_error($conn));	
								
								?>
								<script>
							 	window.location = "teachers.php"; 
								</script>
								<?php   }} ?>
						 
						 
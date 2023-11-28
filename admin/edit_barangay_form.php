   <div class="row-fluid">
    <a href="barangay.php" class="btn btn-info"><i class="icon-plus-sign icon-large"></i> Add Barangay</a>
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Edit Barangay</div>
                            </div>
							<?php 
							$query = mysqli_query($conn,"select * from barangay where barangay_id = '$get_id'")or die(mysqli_error($conn));
							$row = mysqli_fetch_array($query);
							?>
                            <div class="block-content collapse in">
                                <div class="span12">
								<form method="post">
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" value="<?php echo $row['barangay_name']; ?>" id="focusedInput" name="d" type="text" placeholder = "Deparment">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" value="<?php echo $row['oic']; ?>" id="focusedInput" name="dn" type="text" placeholder = "Person Incharge">
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
 if (isset($_POST['update'])){
 

 $dn = $_POST['dn'];
 $d = $_POST['d'];
 
 mysqli_query($conn,"update barangay set barangay_name = '$dn' , oic  = '$d' where barangay_id = '$get_id' ")or die(mysqli_error($conn));
 ?>
 <script>
 window.location='barangay.php'; 
 </script>
 <?php 
 }
 ?>
 
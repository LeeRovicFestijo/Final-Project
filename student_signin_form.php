<link href="admin/assets/form-style.css" rel="stylesheet" media="screen"/>

			<form id="signin_student" class="form-signin" method="post">
			<h3 class="form-signin-heading"><i class="icon-lock"></i> Sign up as Student</h3>
			<input type="text" class="input-block-level" id="username" name="username" placeholder="ID Number" required>
			<input type="text" class="input-block-level" id="firstname" name="firstname" placeholder="Firstname" required>
			<input type="text" class="input-block-level" id="lastname" name="lastname" placeholder="Lastname" required>
			<label>Class</label>
			<select name="class_id" class="input-block-level span5">
				<option></option>
				<?php
				$query = mysqli_query($conn,"select * from class order by class_name ")or die(mysqli_error($conn));
				while($row = mysqli_fetch_array($query)){
				?>
				<option value="<?php  echo $row['class_id']; ?>"><?php echo $row['class_name']; ?></option>
				<?php
				}
				?>
			</select>
			<div class="passwordContainer">
				<input type="password" class="input-block-level" id="password" name="password" placeholder="Password" required>
				<img src="admin/images/eye-close.png" alt="eyeclose" id="eyeclose1" class="eyeicon1">
				<input type="password" class="input-block-level" id="cpassword" name="cpassword" placeholder="Re-type Password" required>
				<img src="admin/images/eye-close.png" alt="eyeclose" id="eyeclose2" class="eyeicon2">
			</div>
			<button id="signin-student" name="login" class="btn btn-info" type="submit"><i class="icon-check icon-large"></i> Sign in</button>
			</form>
			
			<script>
				const eyeicon1 = document.querySelector(".eyeicon1")
				const eyeicon2 = document.querySelector(".eyeicon2")
				const password = document.getElementById("password")
				const cpassword = document.getElementById("cpassword")
				
				eyeicon1.addEventListener("click", () =>  {

					if (password.type === "password") {
						password.type = "text";
						eyeicon1.src="admin/images/eye-open.png"
					} else {
						password.type = "password";
						eyeicon1.src="admin/images/eye-close.png"
					}

				})

				eyeicon2.addEventListener("click", () =>  {

					if (cpassword.type === "password") {
						cpassword.type = "text";
						eyeicon2.src="admin/images/eye-open.png";
					} else {
						cpassword.type = "password";
						eyeicon2.src="admin/images/eye-close.png";
					}
				})

				jQuery(document).ready(function(){
				jQuery("#signin_student").submit(function(e){
						e.preventDefault();
							
							var password = jQuery('#password').val();
							var cpassword = jQuery('#cpassword').val();
						
						if(password.match(/[a-z]/g) && password.match(/[A-Z]/g) && password.match(/[0-9]/g) && password.match(/[!@#$%^&*]/g) && password.length >= 8) {
							var formData = jQuery(this).serialize();
							$.ajax({
								type: "POST",
								url: "student_signup.php",
								data: formData,
								success: function(html){
									if(html=='true')
										{
											if(password == cpassword){
												$.jGrowl("Welcome to ALS Learning Management System", { header: 'Sign-up Successful' });
												var delay = 1000;
												setTimeout(function(){ window.location = 'dashboard_student.php' }, delay);  
											}else{
												$.jGrowl("Passwords do not match", { header: 'Sign-up Failed' });
											}
										}else{
											$.jGrowl("Student is not found in the database. Please check Your ID Number, Firstname, Lastname and the Section. ", { header: 'Sign-Up Failed' });
										}
								}
								
								
							});

						} else {
							$.jGrowl("Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.", { header: 'Sign-up Failed' })
						}
					});
				});
			</script>

			
		
			<a onclick="window.location='index.php'" id="btn_login" name="login" class="btn" type="submit"><i class="icon-signin icon-large"></i> Click here to Login</a>
			
			
			
				
		
					

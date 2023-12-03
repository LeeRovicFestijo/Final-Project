<link href="admin/assets/form-style.css" rel="stylesheet" media="screen"/>

			<form id="signin_teacher" class="form-signin" method="post">
					<h3 class="form-signin-heading"><i class="icon-lock"></i> Sign up as Teacher</h3>
					<input type="text" class="input-block-level"  name="firstname" placeholder="Firstname" required>
					<input type="text" class="input-block-level"  name="lastname" placeholder="Lastname" required>
					<label>Barangay</label>
					<select name="barangay_id" class="input-block-level span12">
						<option></option>
						<?php
						$query = mysqli_query($conn,"select * from barangay order by barangay_name ")or die(mysqli_error($conn));
						while($row = mysqli_fetch_array($query)){
						?>
						<option value="<?php echo $row['barangay_id'] ?>"><?php echo $row['barangay_name']; ?></option>
						<?php
						}
						?>
					</select>
					<div class="passwordContainer">
						<input type="password" class="input-block-level" id="password" name="password" placeholder="Password" required>
						<img src="admin/images/eye-close.png" alt="eyeclose" id="eyeclose3" class="eyeicon1">
						<input type="password" class="input-block-level" id="cpassword" name="cpassword" placeholder="Re-type Password" required>
						<img src="admin/images/eye-close.png" alt="eyeclose" id="eyeclose4" class="eyeicon2">
					</div>
					<button id="signin-teacher" name="login" class="btn btn-info" type="submit"><i class="icon-check icon-large"></i> Sign in</button>
			</form>
			<script>

				const eyeicon1 = document.querySelector(".eyeicon1")
				const eyeicon2 = document.querySelector(".eyeicon2")
				const password = document.getElementById("password")
				const cpassword = document.getElementById("cpassword")
				
				eyeicon1.addEventListener("click", () =>  {
					console.log("hello")
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
						eyeicon2.src="admin/images/eye-open.png"
					} else {
						cpassword.type = "password";
						eyeicon2.src="admin/images/eye-close.png"
					}
				})

			jQuery(document).ready(function(){
			jQuery("#signin_teacher").submit(function(e){
					e.preventDefault();
						var password = jQuery('#password').val();
						var cpassword = jQuery('#cpassword').val();
					
						if(password.match(/[a-z]/g) && password.match(/[A-Z]/g) && password.match(/[0-9]/g) && password.match(/[!@#$%^&*]/g) && password.length >= 8) {
							var formData = jQuery(this).serialize();
							$.ajax({
								type: "POST",
								url: "teacher_signup.php",
								data: formData,
								success: function(html){
									if(html=='true')
									{
										if(password == cpassword){
											$.jGrowl("Welcome to ALS Learning Management System", { header: 'Sign-up Successful' });
											var delay = 1000;
											setTimeout(function(){ window.location = 'dasboard_teacher.php' }, delay);  
										}else{
											$.jGrowl("Passwords do not match", { header: 'Sign-up Failed' });
										}
									}else{
										$.jGrowl("Your data is not found in the database", { header: 'Sign-up Failed' });
									}
								}
								
								
							});
					} else {
						$.jGrowl("Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.", { header: 'Sign-up Failed' })
					}
				});
			});
			</script>
			<a onclick="window.location='index.php'" id="btn_login" name="login" class="btn" type="submit"><i class="icon-signin icon-large"></i> Click here to Log In</a>
			
			
			
				
		
					
		

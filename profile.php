<?php

//profile.php

include('master/Examination.php');

$exam = new Examination;

$exam->user_session_private();

include('header.php');

$exam->query = "
	SELECT * FROM user_table 
	WHERE user_id = '".$_SESSION['user_id']."'
";

$result = $exam->query_result();

?>

	<div class="containter">
		<div class="d-flex justify-content-center">
			<br /><br />
			<span id="message"></span>
			<div class="card" style="margin-top:50px;margin-bottom: 100px;">
        		<div class="card-header"><h4>Change Profile</h4></div>
        		<div class="card-body">
        			<form method="post" id="profile_form">
        				<?php
        				foreach($result as $row)
        				{
        				?>
        				<script>
        				$(document).ready(function(){
        					$('#user_gender').val("<?php echo $row["user_gender"]; ?>");
							$('#user_class').val("<?php echo $row["user_class"]; ?>");
        				});
        				</script>
					    <div class="form-group">
					        <label>Enter Name</label>
					        <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $row["user_name"]; ?>" />
					    </div>
					    <div class="form-group">
					        <label>Select Gender</label>
					        <select name="user_gender" id="user_gender" class="form-control">
					          	<option value="Male">Male</option>
					          	<option value="Female">Female</option>
					        </select>
					    </div>
						<div class="form-group">
					        <label>Select Class</label>
					        <select name="user_class" id="user_class" class="form-control">
					          	<option value="class one">class one</option>
					          	<option value="class two">class two</option>
								<option value="class three">class three</option>
								<option value="class four">class four</option>
								<option value="class five">class five</option>
								<option value="class six">class six</option>
								<option value="JHS one">JHS one</option>
								<option value="JHS two">JHS two</option>
								<option value="JHS three">JHS three</option>
					        </select>
					    </div>
					    <div class="form-group">
					        <label>Enter Mobile Number</label>
					        <input type="text" name="user_mobile_no" id="user_mobile_no" class="form-control" value="<?php echo $row["user_mobile_no"]; ?>" />
					    </div>
					    <div class="form-group">
					        <label>Select Profile Image - </label>
					        <input type="file" name="user_image" id="user_image" accept="image/*" /><br />
					        <img src="upload/<?php echo $row["user_image"]; ?>" class="img-thumbnail" width="250"  />
					        <input type="hidden" name="hidden_user_image" value="<?php echo $row["user_image"]; ?>" />
					    </div>
					    <br />
					    <div class="form-group" align="center">
					        <input type="hidden" name="page" value="profile" />
					        <input type="hidden" name="action" value="profile" />
					        <input type="submit" name="user_profile" id="user_profile" class="btn btn-info" style="color:#ffffff;border: none;background-image: linear-gradient(90deg, #009ACD, #00BFFF);" value="Save" />
					    </div>
					    <?php
						}
					    ?>
          			</form>
        		</div>
      		</div>
      		<br /><br />
      		<br /><br />
		</div>
	</div>

</body>

</html>

<script>

$(document).ready(function(){

	$('#profile_form').parsley();
	
	$('#profile_form').on('submit', function(event){

		event.preventDefault();

		$('#user_name').attr('required', 'required');

		$('#user_name').attr('data-parsley-pattern', '^[a-zA-Z ]+$');

		$('#user_class').attr('required', 'required');

		$('#user_mobile_no').attr('required', 'required');

		$('#user_mobile_no').attr('data-parsley-pattern', '^[0-9]+$');

		//$('#user_image').attr('required', 'required');

		$('#user_image').attr('accept', 'image/*');

		if($('#profile_form').parsley().validate())
		{
			$.ajax({
				url:"user_ajax_action.php",
				method:"POST",
				data: new FormData(this),
				dataType:"json",
				contentType: false,
				cache: false,
				processData:false,				
				beforeSend:function()
				{
					$('#user_profile').attr('disabled', 'disabled');
					$('#user_profile').val('please wait...');
				},
				success:function(data)
				{
					if(data.success)
					{
						location.reload(true);
					}
					else
					{
						$('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
					}
					$('#user_profile').attr('disabled', false);
					$('#user_profile').val('Save');
				}
			});
		}
	});
});

</script>
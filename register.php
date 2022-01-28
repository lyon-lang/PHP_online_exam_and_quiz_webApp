<?php

//register.php

include('master/Examination.php');

$exam = new Examination;

$exam->user_session_public();

include('header.php');

?>

<div class="containter">
<h1 style="color: #00BFFF;">Joggo</h1>
		<div class="d-flex justify-content-center">
			<br />
      <form method="post" id="user_register_form"  class="indexform" style="padding:20px;background-color:#ffffff;box-shadow:0px 2px 4px 0 rgba(0,0,0,0.4);">
              <div class="form-group">
                <h2>Register</h2>
              </div>
        		
        			   <span id="message"></span>
                <form method="post" id="user_register_form">
                  <div class="form-group">
                    <label>Enter Email Address</label>
                    <input type="text" name="user_email_address" id="user_email_address" class="form-control" data-parsley-checkemail data-parsley-checkemail-message='Email Address already Exists' />
                  </div>
                  <div class="form-group">
                    <label>Enter Password</label>
                    <input type="password" name="user_password" id="user_password" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Enter Confirm Password</label>
                    <input type="password" name="confirm_user_password" id="confirm_user_password" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Enter Name</label>
                    <input type="text" name="user_name" id="user_name" class="form-control" /> 
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
                    <input type="text" name="user_mobile_no" id="user_mobile_no" class="form-control" /> 
                  </div>
                  <div class="form-group">
                    <label>Select Profile Image</label>
                    <input type="file" name="user_image" id="user_image" />
                  </div>
                  <br />
                  <div class="form-group" align="center">
                    <input type="hidden" name='page' value='register' />
                    <input type="hidden" name="action" value="register" />
                    <input type="submit" name="user_register" id="user_register" class="btn btn-info" style="color:#ffffff;border: none;background-image: linear-gradient(90deg, #009ACD, #00BFFF);" value="Register" />
                  </div>
                  <p>Already have an account?</p>
                  <div class="form-group">
                  <a href="login" style="text-decoration:none;color:#00BFFF;">Login</a>
                  </div>
        </form>
          			
        	
      		
      		
		</div>
	</div>
          <br /><br />
      		<br /><br />
</body>

</html>

<script>

$(document).ready(function(){

  window.ParsleyValidator.addValidator('checkemail', {
    validateString: function(value){
      return $.ajax({
        url:'user_ajax_action.php',
        method:'post',
        data:{page:'register', action:'check_email', email:value},
        dataType:"json",
        async: false,
        success:function(data)
        {
          return true;
        }
      });
    }
  });

  $('#user_register_form').parsley();

  $('#user_register_form').on('submit', function(event){
    event.preventDefault();

    $('#user_email_address').attr('required', 'required');

    $('#user_email_address').attr('data-parsley-type', 'email');

    $('#user_password').attr('required', 'required');

    $('#confirm_user_password').attr('required', 'required');

    $('#confirm_user_password').attr('data-parsley-equalto', '#user_password');

    $('#user_name').attr('required', 'required');

    $('#user_name').attr('data-parsley-pattern', '^[a-zA-Z ]+$');

    $('#user_address').attr('required', 'required');

    $('#user_mobile_no').attr('required', 'required');

    $('#user_mobile_no').attr('data-parsley-pattern', '^[0-9]+$');

    $('#user_image').attr('required', 'required');

    $('#user_image').attr('accept', 'image/*');

    if($('#user_register_form').parsley().validate())
    {
      $.ajax({
        url:'user_ajax_action.php',
        method:"POST",
        data:new FormData(this),
        dataType:"json",
        contentType:false,
        cache:false,
        processData:false,
        beforeSend:function()
        {
          $('#user_register').attr('disabled', 'disabled');
          $('#user_register').val('please wait...');
        },
        success:function(data)
        {
          if(data.success)
          {
            $('#message').html('<div class="alert alert-success">Please check your email</div>');
            $('#user_register_form')[0].reset();
            $('#user_register_form').parsley().reset();
          }

          $('#user_register').attr('disabled', false);

          $('#user_register').val('Register');
        }
      })
    }

  });
	
});

</script>
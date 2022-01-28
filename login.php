<?php

//login.php

include('master/Examination.php');

$exam = new Examination;

$exam->user_session_public();

include('header.php');

?>
  <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h1 style="color: #00BFFF;">Joggo</h1>
        </div>
        <div class="col-md-6" style="margin-top:100px;">
          

            <span id="message">
            <?php
            if(isset($_GET['verified']))
            {
              echo '
              <div class="alert alert-success">
                Your email has been verified, now you can login
              </div>
              ';
            }
            ?>   
            </span>
           
              <form method="post" id="user_login_form"  class="indexform" style="padding:20px;background-color:#ffffff;box-shadow:0px 2px 4px 0 rgba(0,0,0,0.4);">
              <div class="form-group">
                <h2>Login</h2>
              </div>
                  <div class="form-group">
                      <input type="text" name="user_email_address" id="user_email_address" placeholder="Enter Email Address" class="form-control" />
                    </div>
                  <div class="form-group">
                    <input type="password" name="user_password" placeholder="Enter Password" id="user_password" class="form-control" />
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="login" />
                    <input type="submit" name="user_login" id="user_login" class="btn btn-info" style="color:#ffffff;border: none;background-image: linear-gradient(90deg, #009ACD, #00BFFF);" value="Login" />
                  </div>
                  <p>Don't have an account?</p>
                  <div class="form-group">
                  <a href="register" style="text-decoration:none;color:#00BFFF;">Register</a>
                </div>
              </form>
                
            
        </div>
        <div class="col-md-3">

        </div>
      </div>
  </div>

</body>
</html>

<script>

$(document).ready(function(){

  $('#user_login_form').parsley();

  $('#user_login_form').on('submit', function(event){
    event.preventDefault();

    $('#user_email_address').attr('required', 'required');

    $('#user_email_address').attr('data-parsley-type', 'email');

    $('#user_password').attr('required', 'required');

    if($('#user_login_form').parsley().validate())
    {
      $.ajax({
        url:"user_ajax_action.php",
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function()
        {
          $('#user_login').attr('disabled', 'disabled');
          $('#user_login').val('please wait...');
        },
        success:function(data)
        {
          if(data.success)
          {
            location.href='home';
          }
          else
          {
            $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
          }

          $('#user_login').attr('disabled', false);

          $('#user_login').val('Login');
        }
      })
    }

  });

});

</script>
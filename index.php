
<?php

//index.php

include('master/Examination.php');

$exam = new Examination;

include('header.php');

?>

	<div class="containter">
	<?php
	if(isset($_SESSION["user_id"]))
		{
			$exam->query = "
			SELECT * FROM user_table 
			WHERE user_id = '".$_SESSION['user_id']."'
			";

			$result = $exam->query_result();
			foreach($result as $row){
			echo '<span style="font-size:28px;">Hi , <img src="upload/'.$row['user_image'].'" class="rounded-circle" style="width:50px;height:50px;border: solid 2px;border-color: #009ACD;">  '.$row['user_name'].'</span>';
			echo '<br>';
			echo '<br>';
			echo'<span style="font-size:20px;">You are in '.$row['user_class'].', all Quizzes here are base on your class</span>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
			echo '<br>';
		}
		}
			?>
	
		<?php
		if(isset($_SESSION["user_id"]))
		{

		?>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<select name="exam_list" id="exam_list" class="form-control input-lg">
					<option value="">Select Quiz and Enroll</option>
					<?php
					
					$exam->user_session_private();
					$exam->query = "
						SELECT * FROM user_table 
						WHERE user_id = '".$_SESSION['user_id']."'
					";

					$result = $exam->query_result();
					foreach($result as $row){
						$userid = $row['user_id'];
					$exam->query = "
					SELECT user_table.user_id, user_table.user_class, online_exam_table.online_exam_id, online_exam_table.online_exam_title, online_exam_table.user_class, online_exam_table.online_exam_code FROM user_table, online_exam_table WHERE user_table.user_id = $userid AND user_table.user_class = online_exam_table.user_class ORDER BY online_exam_title ASC
					";
					$result = $exam->query_result();
					$output = '';
					foreach($result as $row)
					{	if($exam->If_user_already_enroll_exam($row["online_exam_id"], $_SESSION['user_id']))
						{}else{
						$output .= '<option value="'.$row["online_exam_id"].'">'.$row["online_exam_title"].'</option>';
					}
					}
						
						


		
					echo $output;
					#echo $exam->Fill_exam_list();
				}
					
					?>
				</select>
				<span id="exam_details" ></span>
				<br>
				<p class="text-center"><a href="enrolled" class="btn btn-primary btn-sm" style="text-justify:center;border: none;background-image: linear-gradient(90deg, #009ACD, #00BFFF);">View Enrolled Quiz</a> </p>
				<br />
				<p class="text-center">All Enrolled Quizzes can be viewed and soleved by pressing the View Enrolled Quiz button or Enrolled Quiz on the navigation bar</p>
				
			</div>
			<div class="col-md-3"></div>
		</div>
		<script>
		$(document).ready(function(){

			$('#exam_list').parsley();

			var exam_id = '';

			$('#exam_list').change(function(){

				$('#exam_list').attr('required', 'required');

				if($('#exam_list').parsley().validate())
				{
					exam_id = $('#exam_list').val();
					$.ajax({
						url:"user_ajax_action.php",
						method:"POST",
						data:{action:'fetch_exam', page:'index', exam_id:exam_id},
						success:function(data)
						{
							$('#exam_details').html(data);
						}
					});
				}
			});

			$(document).on('click', '#enroll_button', function(){
				exam_id = $('#enroll_button').data('exam_id');
				online_exam_code = $('#enroll_button').data('online_exam_code');
				$.ajax({
					url:"user_ajax_action.php",
					method:"POST",
					data:{action:'enroll_exam', page:'index', exam_id:exam_id, online_exam_code:online_exam_code},
					beforeSend:function()
					{
						$('#enroll_button').attr('disabled', 'disabled');
						$('#enroll_button').text('please wait');
					},
					success:function()
					{
						$('#enroll_button').attr('disabled', false);
						$('#enroll_button').removeClass('btn-warning');
						$('#enroll_button').addClass('btn-success');
						$('#enroll_button').text('Enroll success');
					}
				});
			});

		});
		</script>
		<?php
		}
		else
		{
		?>

		<div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
            <div class="container-fluid"><a class="navbar-brand" href="#" id="dojo">Joggo</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1"><span class="ml-auto navbar-text actions" id="sign"> <a href="login.php" class="login"><strong>Log In</strong></a><button class="btn btn-primary reg" type="button" id="reg"><a href="register.php" style="text-decoration:none;color:#ffffff;"><strong>Register</strong></a></button></span></div>
            </div>
        </nav>
		</div>
		<div class="container">
        <h1 class="text-center"><strong>Welcome to Joggo</strong></h1>
        <h3 class="text-center">Where students from class one to JHS three practice what they have learnt.</h3>
    </div>				<div class="caption v-middle text-center">
					<h1 class="cd-headline clip" style="font-size:24px;">
			            <span class="blc" style="font-size:24px;">Coronavirus Tips | </span>
			            <span class="cd-words-wrapper" style="font-size:24px;">
			              <b class="is-visible">Stay Home.</b>
			              <b>Avoid Social Gathering.</b>
			              <b>Wash Hands.</b>
                		  <b>Use Sanitizers.</b>
			            </span>
	          		</h1>
				</div>
    <div>
        <div class="container-fluid" id="nursery">
            <div class="row">
                <div class="col-md-12 col-lg-7">
                    <div class="forkids">
                        <h3 id="dfkinfo">Is your child in Nursery or KG?</h3>
                        <h3 id="dfkinfo">No need to log In&nbsp;</h3>
                    </div>
                </div>
                <div class="col">
                    <div class="pressbtn">
                        <h3 id="dfkinfo">Just press the button</h3><button class="btn btn-primary" type="button" id="kidsbtn"><strong>Press Here &gt;</strong></button></div>
                </div>
            </div>
        </div>
    </div>
    <h3 class="text-center">For class one to JHS three</h3>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-lg-3">
                    <div class="homeinfo">
                        <div class="logdet">
                            <h4 class="text-center infohome" id="h1info">The platform Ghanaian Parents are recommending for the kids.</h4>
                            <p>Don't have an account?</p><a href="register.php" class="btn btn-primary btn-block registerbtn" type="submit" id="registerbtn" style="border:none;"><strong>Register</strong></a>
                            <div class="form-group">
                                <p>Already have an account.</p>
                            </div>
                            <div class="form-group"><a href="login.php" class="btn btn-primary btn-block login" type="button"><strong>Log In</strong></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <h1 class="text-center">Coming Soon</h1>
        <div class="container-fluid dojjoskul" id="dojjoskul">
            <div class="row">
                <div class="col-md-12 col-lg-12 offset-lg-0">
                    <div></div>
                </div>
            </div>
            <div id="dojoskul">
                <h2 class="text-center">Joggo for schools&nbsp;</h2>
                <h4 class="text-center">where school can have their own portals and manage their students</h4>
            </div>
        </div>
    </div>
    <div class="footer-basic">
        <div></div>
        <div></div>
        <footer>
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Services</a></li>
                <li class="list-inline-item"><a href="#">About</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
            </ul>
            <p class="copyright">Joggo © 2020</p>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Animated-Type-Heading.js"></script>
		<?php
		}
		?>
		
	</div>
</div>
</body>

</html>
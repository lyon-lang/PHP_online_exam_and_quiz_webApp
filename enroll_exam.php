<?php

//enroll_exam.php

include('master/Examination.php');

$exam = new Examination;

$exam->user_session_private();

$exam->Change_exam_status($_SESSION['user_id']);

include('header.php');


?>
<div >
		<div id="user_details_area"></div>		
</div>

<div class="card">
	<div class="card-header">Quiz List</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover" id="exam_data_table">
				<thead>
					<tr>
						<th>Quiz Title</th>
						<th>Class</th>
						<th>Total </th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
</div>
</body>
</html>

<script>

$(document).ready(function(){
	//var exam_id = "";

	var dataTable = $('#exam_data_table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"user_ajax_action.php",
			type:"POST",
			data:{action:'fetch', page:'enroll_exam'}
		},
		"columnDefs":[
			{
				"targets":[4],
				"orderable":false,
			},
		],
	});

	function load_user_details()
	{
		$.ajax({
			url:"user_ajax_action.php",
			method:"POST",
			data:{page:'view_exam', action:'user_detail'},
			success:function(data)
			{
				$('#user_details_area').html(data);
			}
		})
	}

	load_user_details();

	$(document).on('click', '.restart', function(){
		
		var exam_id = $(this).data('exam_id');
		
		
		$.ajax({
			url:"user_ajax_action.php",
			method:"POST",
			data:{exam_id:exam_id, page:'view_exam', action:'restart'},
			success:function(data)
			{
			alert('Quiz has been Restarted');
			location.reload();	
			}
		})
	});

});

</script>
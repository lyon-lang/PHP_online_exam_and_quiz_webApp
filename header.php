<!DOCTYPE html>
<html lang="en">
<head>
  	<title>Joggo Online Quiz</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.1/dist/parsley.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  	<link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="style/TimeCircles.css" />
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Animated-Type-Heading.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <script src="style/TimeCircles.js"></script>
</head>
<body>
	

  <?php
  if(isset($_SESSION['user_id']))
  {
  ?>
  <nav class="navbar navbar-light navbar-expand-md">
    <a id="dojo" style="color:#00BFFF;" class="navbar-brand" href="home" ><strong>Joggo</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="enrolled">Enrolled Quiz</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="change_profile">Change Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="change_password">Change Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="logout">Logout</a>
        </li>    
      </ul>
    </div>  
  </nav>

  <div class="container-fluid">
  <?php
  }
  ?>
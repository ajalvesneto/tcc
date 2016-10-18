<?php
	require "framework/classes/class_config.php";
	require FWCLASSES."class_command.php";
	$command = new Command();

	if (!isset($_SESSION["id"])){
		$_SESSION["id"] = Usefuls::mt_aleatory_code();
	}

	if (isset($_POST["url"])){

		$url = str_replace("http://","",$_POST["url"]);
		$url = explode("/", $url);

		if (isset($_POST["databases"])){
			if ($_POST["databases"] == "0"){
				$database = "";
			}else{
				$database = $_POST["databases"];

			}
		}

		if (isset($_POST["tables"])){
			if ($_POST["tables"] == "0"){
				$table = "";
			}else{
				$table = $_POST["tables"];

			}
		}




		$resultInsert = $command->mt_insertComand($_POST["url"],$database,$table,$_SESSION["id"]);
		$_SESSION["url_sqlmap"] = $url[0];
		$_SESSION["url"] = $_POST["url"];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
  <title>TCC - Antônio Alves</title>
  <link rel='stylesheet' href='assets/css/bootstrap.min.css'>
  <link rel='stylesheet' href='assets/css/material.css'>
  <link rel='stylesheet' href='assets/css/style.css'>
  
  <script src='assets/js/jquery.js'></script>
  <script type="text/javascript">
  	jQuery(window).load(function () {
		jQuery.ajax({
	        url : "listDatabases.php",
	    	data: { url : "<?php echo $_SESSION['url_sqlmap']?>" },
	        dataType : "json",
	        success : function(data){
	        	var databases = "";
	        	for($i=0; $i < data.length; $i++){
	        		databases = databases + '<option name="'+data[$i]+'" selected="selected">'+data[$i]+'</option>';
	        	}
	        	if (databases == ""){
	        		databases = '<option name="0">No database(s) found</option>';	
	        	}
	        jQuery('#databases').html(databases);
	        }
    	});

    	jQuery.ajax({
	        url : "listTables.php",
	    	data: { url : "<?php echo $_SESSION['url_sqlmap']?>" },
	        dataType : "json",
	        success : function(data){
	        	var tables = "";
	        	for($i=0; $i < data.length; $i++){
	        		tables = tables + '<option name="'+data[$i]+'" selected="selected">'+data[$i]+'</option>';
	        	}
	        	if (tables == ""){
	        		tables = '<option name="0">No tables(s) found</option>';	
	        	}else{
					jQuery('#tables').html(tables);
					jQuery('#group_tables').css("display","block");
	        	}
	        
	        },
		  	error: function(){
		    	alert('error!');
		  	}
    	});
    });	
  </script>
  <script src='assets/js/app.js'></script>
  <script>
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });
  </script>
</head>
<body class="">
  <div class="piluku-preloader text-center">
  <div class="loader">Loading...</div>
</div>
<div class="wrapper ">
<div class="left-bar ">
	<div class="admin-logo">
		<div class="logo-holder pull-left">
			<img class="logo" src="assets/images/example.png" alt="logo">	
		</div>
		<!-- logo-holder -->			
		<a href="#" class="menu-bar  pull-right"><i class="ti-menu"></i></a>
	</div>
	<!-- admin-logo -->
	<ul class="list-unstyled menu-parent" id="mainMenu">
		<li>
			<a href="index.html" class="waves-effect waves-light">
				<i class="icon ti-home"></i>
				<span class="text ">Dashboard</span>
			</a>
		</li>
	</ul>
</div>
<!-- left-bar -->

<div class="content" id="content">
	
	<div class="overlay"></div>			
	
	<div class="top-bar">
	<nav class="navbar navbar-default top-bar">
		<div class="menu-bar-mobile" id="open-left"><i class="ti-menu"></i>
		</div>

		<form class="navbar-left" role="search">
			<div class="search">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav navbar-nav navbar-right top-elements">	
			<li class="piluku-dropdown dropdown">
				<!-- @todo Change design here, its bit of odd or not upto usable -->

				<a href="#" class="dropdown-toggle avatar_width" data-toggle="dropdown" role="button" aria-expanded="false"><span class="avatar-holder"><img src="assets/images/avatar.jpeg" alt=""></span><span class="avatar_info">Bootstrap</span><span class="drop-icon"><!-- <i class="ion ion-chevron-down"></i> --></span></a>
				<ul class="dropdown-menu dropdown-piluku-menu  animated fadeInUp wow avatar_drop neat_drop dropdown-right" data-wow-duration="1500ms" role="menu">
					<li>
						<a href="profile.html"> <i class="ion-android-settings"></i>Settings</a>
					</li>
					<li>
						<a href="mailbox.html"> <i class="ion-android-chat"></i>Messages</a>
					</li>
					<li>
						<a href="dropzone-file-upload.html"> <i class="ion-android-cloud-circle"></i>Upload</a>
					</li>
					<li>
						<a href="profile.html"> <i class="ion-android-create"></i>Edit profile</a>
					</li>
					<li>
						<a href="lock-screen.html" class="logout_button"><i class="ion-power"></i>Logout</a>
					</li>   
				</ul>
			</li>
		</ul>
	</nav>
</div>
<!-- /top-bar -->
	

	<!-- Page Header -->
	<div class="page_header">
		<div class="pull-left">
			<i class="icon ti-layout-grid2-thumb page_header_icon"></i>
			<span class="main-text">Form Elements</span>
			<p class="text">
				Piluku elements are designed in an awesome way which gives a unified and professional look to the forms. 
			</p>
		</div>
		<div class="right pull-right">
			<ul class="right_bar">
				<li class="list-unstyled"><i class="icon ion-checkmark text-primary"></i> &nbsp;Input Masks</li>
				<li class="list-unstyled"><i class="icon ion-checkmark text-primary"></i> &nbsp;Group selection</li>
				<li class="list-unstyled"><i class="icon ion-checkmark text-primary"></i> &nbsp;Various Switches</li>
				<li class="list-unstyled"><i class="icon ion-checkmark text-primary"></i> &nbsp;Pickers</li>
				<li class="list-unstyled"><i class="icon ion-checkmark text-primary"></i> &nbsp;and more...</li>
			</ul>
		</div>
	</div>
	<!-- /pageheader -->

	<!--main content-->
	<div class="main-content">
		<!--theme panel-->
		<div class="panel">
			<div class="panel-body">
				<!--form-heading-->
				<div class="form-heading">
					horizontal form
				</div>
				<?php
					if ($resultInsert == 0){
						echo 	'<div class="alert alert-danger">
									Ocorreu um erro. :(
								</div>';
					}else if ($resultInsert == 1){
						echo 	'<div class="alert alert-success">
									Comando Adicionado.
								</div>';
					}else{
						echo 	'<div class="alert alert-warning">
									Comando já adicionado, aguarde seu processamento.
								</div>';
					}
				?>
				<!--form-heading-->
				<form class="form" method="post" action="index.php">
					<!--Default Horizontal Form-->
					
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">URL:</label>							
							<input id="url" type="text" class="form-control" placeholder="http://seusite.com?parametro=xxx" name="url" value="<?php echo $_SESSION["url"]?>">
						</div>
					</div>	

					<div class="col-md-6">
						<div class="form-group" id="databases_groups">
								<label class="control-label">Databases:</label>
								<select name="databases" id="databases" class="name_search form-control">
								</select>
						</div>

						<div class="form-group">
							<button class="btn btn-primary">
							<i class="ion ion-search"></i>
							<span>Link Button</span>
							</button>
						</div>	
					</div>

					<div class="col-md-6">
						<div class="form-group" id="group_tables" style="display: none;">
								<label class="control-label">Tables:</label>
								<select name="tables" id="tables" class="name_search form-control">
								</select>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!--theme panel-->
	</div>
	<!--main content-->

</div>  

	<div class="side-bar right-bar ">
		
	</div>
	<!-- /Right-bar -->
</div>
<!-- wrapper -->

<script src='assets/js/jquery-ui-1.10.3.custom.min.js'></script>
<script src='assets/js/bootstrap.min.js'></script>
<script src='assets/js/jquery.nicescroll.min.js'></script>
<script src='assets/js/wow.min.js'></script>
<script src='assets/js/jquery.loadmask.min.js'></script>
<script src='assets/js/jquery.accordion.js'></script>
<script src='assets/js/materialize.js'></script>
<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/core.js'></script>
<script src='assets/js/select2.js'></script>
<script src='assets/js/jquery.multi-select.js'></script>
<script src='assets/js/bootstrap-filestyle.js'></script>
<script src='assets/js/bootstrap-datepicker.js'></script>
<script src='assets/js/bootstrap-colorpicker.js'></script>
<script src='assets/js/jquery.maskedinput.js'></script>
<script src='assets/js/form-elements.js'></script>

 
<script src="assets/js/jquery.countTo.js"></script>
</body>
</html>
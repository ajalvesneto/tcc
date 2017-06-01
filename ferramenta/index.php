<?php
	require "framework/classes/class_config.php";
	require FWCLASSES."class_request.php";
	$request = new Request();;

	if (!isset($_SESSION["id"])){
		$_SESSION["id"] = Usefuls::mt_aleatory_code();
	}

	if ((isset($_POST["url"])) && ($_POST["url"]) != "") {

		$url = str_replace("http://","",$_POST["url"]);
		$url = explode("/", $url);

		$resultInsert = $request->mt_insertRequest($_POST["url"],$_SESSION["id"]);

		$_SESSION["url_sqlmap"] = $url[0];
		$_SESSION["url"] = $_POST["url"];
	}else{
		$_SESSION["url_sqlmap"] = "";
		$_SESSION["url"] = "";
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'inc_head.php';?>
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
	
	<?php include 'inc_menu.php'; ?>
	
</div>
<!-- left-bar -->

<div class="content" id="content">
	
	<div class="overlay"></div>			
	
	<div class="top-bar">
	<nav class="navbar navbar-default top-bar">
		<div class="menu-bar-mobile" id="open-left"><i class="ti-menu"></i>
		</div>

	</nav>
</div>
<!-- /top-bar -->
	

	<!-- Page Header -->
	<div class="page_header">
		<div class="pull-left">
			<i class="icon ti-target page_header_icon"></i>
			<span class="main-text">Alvo dos Testes</span>
			<p class="text">
				Insira aqui a url que deseja verificar. 
			</p>
		</div>	
	</div>
	<!-- /pageheader -->

	<!--main content-->
	<div class="main-content">
		<!--theme panel-->
		<div class="panel">
			<div class="panel-body">
				<!--form-heading-->
				<?php
					if ($resultInsert == "0"){
						echo 	'<div class="alert alert-danger">
									Ocorreu um erro. :(
								</div>';
					}else if ($resultInsert == "1"){
						echo 	'<div class="alert alert-success">
									Comando Adicionado, aguarde o seu processamento.
								</div>';
					}else if ($resultInsert == "2") {
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
						<div class="form-group" id="group_databases" style="display:none;">
								<label class="control-label">Databases:</label>
								<select name="databases" id="databases" class="name_search form-control">
								</select>
						</div>

						<div class="form-group">
							<button class="btn btn-primary">
							<i class="fa fa-plus"></i>
							<span>Adicionar</span>
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
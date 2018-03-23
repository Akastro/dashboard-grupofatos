<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao/conexao.php");
	seguranca_adm();
?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Anselmo Lima - Grupo Fatos">
		<link rel="icon" href="imagens/favicon.png">

		<title>Administrativo - Fatos</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<link href="css/theme.css" rel="stylesheet">
		<script src="js/ie-emulation-modes-warning.js"></script>
		
		
		<!-- Carregar a API do google -->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

		<!-- Preparar a geracao do grafico -->
		<script type="text/javascript">
	
		  // Carregar a API de visualizacao e os pacotes necessarios.
		  google.charts.load('current', {'packages':['corechart']});
	
		  // Especificar um callback para ser executado quando a API for carregada.
		  google.charts.setOnLoadCallback(function(){
			var json_text = $.ajax({url: "departamento.php", dataType:"json", async: false}).responseText;
			var json = eval("(" + json_text + ")");
			
			var dados = new google.visualization.DataTable(json.dados);
	
			var chart = new google.visualization.PieChart(document.getElementById('area_grafico'));
			chart.draw(dados, json.config);
			
		  });
		  
		</script>


	</head>

	<body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
		    </button>
				<a class="navbar-brand" href="menu_adm.php">Dashboard</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="chartjs.html">HELP DESK</a></li>
					<li><a href="#about">SOLICITAÇÃO</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TAREFAS <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="chartjs.html">Help Desk</a></li>
							<li><a href="#">Projetos</a></li>
							<li><a href="#">Solictação</a></li>
						</ul>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
    </nav>
	
	<div id="area_grafico"></div>

	<div class="container theme-showcase" role="main">
		<div class="page-header">
			<h1>Usuários</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th>Inscrição</th>
							<th>Nome</th>
							<th>Situação</th>
							<th>Nivel de acesso</th>
							<th>Cadastrado</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Anselmo Lima</td>
							<td>Ativo</td>
							<td>Administrador</td>
							<td>20/02/2018 03:15:20</td>
							<td>
								<button type="button" class="btn btn-xs btn-primary">Visualizar</button>
								<button type="button" class="btn btn-xs btn-warning">Editar</button>
								<button type="button" class="btn btn-xs btn-danger">Apagar</button>
							</td>
						</tr>     

								<tr>
							<td>2</td>
							<td>Administrador</td>
							<td>Ativo</td>
							<td>Administrador</td>
							<td>20/02/2018 10:15:20</td>
							<td>
								<button type="button" class="btn btn-xs btn-primary">Visualizar</button>
								<button type="button" class="btn btn-xs btn-warning">Editar</button>
								<button type="button" class="btn btn-xs btn-danger">Apagar</button>
							</td>
						</tr>           
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	
</body>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/ajax.js"></script>
    <script src="js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>


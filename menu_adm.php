

<?php 
    include_once("conexao/conexao.php");
    $result_ticket= "SELECT avaliacao AS ESTRELAS, descricao AS SETOR, nome AS COLABORADOR , date_format(FROM_UNIXTIME(`dtabertura`),'%d/%m/%Y')AS DATA_INICIAL, date_format(FROM_UNIXTIME(`dtfechamento`),'%d/%m/%Y') AS DATA_FINAL FROM (( hd_ticket INNER JOIN hd_departamento ON hd_ticket.coddepartamento = hd_departamento.coddepartamento) 
    INNER JOIN usuario ON hd_ticket.codusuario = usuario.codusuario) 
    GROUP BY descricao ORDER BY SETOR";
    $resultado_tickets = mysqli_query($conn, $result_ticket);

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

	<title>Dashboard - Grupo Fatos</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
     <script type="text/javascript">
        // Carrega Charts e os pacotes corechart e barchart.
     google.charts.load('current', {'packages':['corechart']});
       // Especificar um callback para ser executado quando a API for carregada.
     google.charts.setOnLoadCallback(function(){
        var json_text = $.ajax({url: "departamento.php", dataType:"json", async: false}).responseText;
        var json = eval("(" + json_text + ")");

        var dados = new google.visualization.DataTable(json.dados);
         //Pizza
        var chart = new google.visualization.PieChart(document.getElementById('area_grafico'));
        chart.draw(dados, json.config);
         //Barra
         var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
         barchart.draw(dados, json.config);

     });

</script>

</head>

<!--inicio de body-->
<body>
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
			<a class="navbar-brand" href="#">Dashboard</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">USUÁRIO <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="administrativo.php">Listar Usuários</a></li>
						<li><a href="#">Nivel de Acesso</a></li>
						<li><a href="#">Status de Usuários</a></li>
						<div class="navbar-form navbar-right">					
				<a href="sair.php"><button type="submit" class="btn btn-success">Sair</button></a>
			</div>
					</ul>
				</li>
				<li><a href="chartjs.html">HELP DESK</a></li>
					<li><a href="#about">SOLICITAÇÃO</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TAREFAS <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="chartjs.html">Help Desk</a></li>
							<li><a href="#">Projetos</a></li>
							<li><a href="#">Solictação</a></li>
			</ul>

		</div><!--/.nav-collapse -->				
	</div>
</nav>
<!--fim da Fixed navbar-->

<!--formulario de perquisa-->
<form method="GET" action="departamento.php">
<h1>DASHBOARD DE AVALIACÃO:</h1>
<select id=$descricao>
            <option value="" >Selecione o Departamento</option>
            <option value="01_Financeiro">Financeiro</option> 
            <option value="03_Trabalhista">Trabalhista</option>
            <option value="05_Contabil">Contábil</option>
            <option value="09_TI">TI</option> 
            <option value="10_RH">RH</option>
            <option value="04_Fiscal">Fiscal</option>
            <option value="06_Legalização">Legalização</option> 
            <option value="08_Comercial">Comercial</option> 
            <option value="10_Consultoria">Consultoria</option>
            <option value="07_Controladoria">Controladoria</option>
            <option value="11_Qualidade">Qualidade</option>
            <option value="12_Jurídico">Jurídico</option>
            <option value="13_Diretoria">Diretoria</option>
            <option value="14_Gerência">Gerência</option>
            <option value="02_Motoboy">Motoboy</option>
            
            </select>
            
           <br></br>
            <label id="FROM_UNIXTIME(`dtabertura`)">Escolha a data Inicial: </label>
            <input type="date" id="date_format(FROM_UNIXTIME(`dtabertura`),'%d/%m/%Y')">
            <span class="validity"></span>

            <label id="FROM_UNIXTIME(`dtabertura`)">Escolha a data Final: </label>
            <input type="date" id="date_format(FROM_UNIXTIME(`dtabertura`),'%d/%m/%Y')">
            <span class="validity"></span>
            <br></br>
            <input type="button" class="btn btn-xs btn-primary btn-md" name="btnPesquisar" value="Pesquisar" onclick="getDados();"/>
            </form>

<!--fim do formulario de pesquisa-->

<!--Table and divs that hold the pie charts-->
<table class="columns">
      <tr>
      <h2>Resultados da pesquisa:</h2>
      <div id="Resultado"></div>
        <td><div id="area_grafico" style="border: 1px solid #ccc"></div></td>
       <!-- <td><div id="barchart_div" style="border: 1px solid #ccc"></div></td>-->
        </tr>
       </table>
 
<!--Tabela para lista-->
             
      </div>

      <!--fim de pesquisa-->

  


			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>Departamento</th>
								<th>Colaborador</th>
                                <th>Avaliação</th>
                                <th>Abertos em</th>
                                <th>Fechados em</th>
                                <th>Ação</th>
							</tr>
						</thead>
						<tbody>
            <hr/>
    <h2>Resultados da pesquisa:</h2>
    
      <hr>
              <?php 
               // Captura os dados da consulta e inseri na tabela HTML     
              while($hd_ticket = mysqli_fetch_assoc($resultado_tickets)){ 
			  ?>
                
				 <tr>
				  <td><?php echo $hd_ticket ['SETOR']; ?></td>
				  <td><?php echo $hd_ticket ['COLABORADOR']; ?></td>
                  <td><?php echo $hd_ticket ['ESTRELAS']; ?></td>
                  <td><?php echo $hd_ticket ['DATA_INICIAL']; ?></td>
                  <td><?php echo $hd_ticket ['DATA_FINAL']; ?></td>
				 <td><button type="button" class="btn btn-xs btn-primary">Visualizar</button>	</td>
								</tr>
							<?php } ?>
						</tbody>
					 </table>
				</div>
      </tr>
    </table>
  </div>
 </form>
</body>
 <!--fim da body-->


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
 </html>
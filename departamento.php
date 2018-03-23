<?php

// Estrutura basica do Grafico
$grafico = array(
    //Array dos dados do Banco 
    'dados' => array(                                       
        'cols' => array(
            array('type' => 'string', 'label' => 'avaliacao'),
            array('type' => 'string', 'label' => 'descricao'),
          
            
        ),  
        'rows' => array()
    ),
    // Configuração do Arquivo de tamanho e cores
    'config' => array(
        'title' => 'Quantidade de Avalicão por Setor', //define titulo
        'width' => 750, //define o tamanho
        'height'=> 400, //define altuara
        'colors'=> ['#008B00', '#1E90FF', '#FF8C00', '#CD0000', '#6495ED', '#8B8989'] //define cores
               )
);

// Consultar dados no BD
$pdo = new PDO('mysql:host=localhost;dbname=mysuite', 'root', '');
$sql = "SELECT 
CASE
WHEN avaliacao  = 5 THEN 'ÓTIMO'
WHEN avaliacao  = 4 THEN 'BOM'
WHEN avaliacao  = 3 THEN 'REGULAR'
WHEN avaliacao  = 2 THEN 'RUIM'
WHEN avaliacao  = 1 THEN 'PESSIMO'
ELSE 'SEM AVALIAÇÃO'
END AS AVALIACAO,
COUNT(*) AS ESTRELA,
descricao AS SETOR,
codticket as ticket,
nome AS COLABORADOR,
date_format(FROM_UNIXTIME(`dtabertura`),'%d/%m/%Y')AS DATA_INICIAL, date_format(FROM_UNIXTIME(`dtfechamento`),'%d/%m/%Y') AS DATA_FINAL
FROM (( hd_ticket INNER JOIN hd_departamento ON hd_ticket.coddepartamento = hd_departamento.coddepartamento) 
INNER JOIN usuario ON hd_ticket.codusuario = usuario.codusuario) 
GROUP BY `hd_ticket`.avaliacao DESC;
";



$stmt = $pdo->query($sql);
while ($obj = $stmt->fetchObject()) {
    $grafico['dados']['rows'][] = array('c' => array(
        array('v' => $obj->AVALIACAO),
        array('v' => (int)$obj->ESTRELA)
       
    ));
}


// Enviar dados na forma de JSON
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($grafico);
exit(0);

?>




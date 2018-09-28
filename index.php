<?php

require 'vendor/autoload.php';



function ExecuteMySQL($query)
{


	$servername = "sdi.iabas.org.br:3306";
	$username = "root";
	$password = "010572!dev";
	//$DB="portalinfo";
	$DB="indicadores";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$DB);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} ;

	$conn->set_charset("utf8");

	$result = $conn->query($query);

	if ($conn->error!='') {
	
		echo "Ocorrencia [ " . $conn->error."]<BR>" ;
	}

	//echo ("rodou".$result);
	return $result;
}

function rectoARRAY($rec)
{
	$array_=[];
	$count=0;
	while($row = $rec->fetch_assoc()) {
		$count++;
		$array_[$count] = $row;
	}

	return $array_;

}


function ServiceHandler() {


    $query="select  VARIAVEL_ID,VARIAVEL_NOME  from VARIAVEL order by VARIAVEL_ID ";
    $result=ExecuteMySQL($query);
    $recV=rectoARRAY($result);

    $j=json_encode(array_values($recV));

    $data = new stdClass();
    $data->Nome = "Michael";
    $data->CPF = "071.100.407-20";
        $data2 = new stdClass();
        $data2->Logradouro = "Rua Jornalista Luis Eduardo Lobo";
        $data2->Numero = "437";
        $data2->Complemento = "437";
    $data->Endereco = $data2;

    return $j;
   # return json_encode($data);
};


$app = new \Slim\App;

$app->get('/', 'ServiceHandler');
$app->post('/', 'ServiceHandler');

$app->run();

<?php

require 'vendor/autoload.php';

function ServiceHandler() {
    $data = new stdClass();
    $data->Nome = "Michael";
    $data->CPF = "071.100.407-20";
        $data2 = new stdClass();
        $data2->Logradouro = "Rua Jornalista Luis Eduardo Lobo";
        $data2->Numero = "437";
    $data->Endereco = $data2;
    return json_encode($data);
};


$app = new \Slim\App;

$app->get('/', 'ServiceHandler');
$app->post('/', 'ServiceHandler');

$app->run();

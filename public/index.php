<?php

//require __DIR__ . '/vendor/autoload.php';
require 'vendor/autoload.php';
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once __DIR__ . '/../src/DesafioUno.php';
require_once __DIR__ . '/../src/DesafioDos.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("¡Hola, IDESA!");
    return $response;
});

$app->get('/desafio-uno/{clientID}', function (Request $request, Response $response, $args) {
    $clientID = $args['clientID'];
    $data = DesafioUno::getClientDebt($clientID);
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});


// Define la ruta para obtener todos los registros de la tabla 'debts'
$app->get('/desafio-uno', function (Request $request, Response $response, $args) {
    // Obtén una conexión a la base de datos
    $db = Database::getConnection();

    // Consulta todos los registros de la tabla 'debts'
    $stmt = $db->query("SELECT * FROM debts");

    // Verifica si se encontraron registros
    if ($stmt) {
        // Formatea los resultados como un arreglo asociativo
        $debts = [];
        while ($row = $stmt->fetchArray(SQLITE3_ASSOC)) {
            $debts[] = $row;
        }

        // Devuelve los resultados como JSON en la respuesta
        $response->getBody()->write(json_encode($debts));
        return $response->withHeader('Content-Type', 'application/json');
    } else {
        // Si no se encontraron registros, devuelve un mensaje de error
        $response->getBody()->write(json_encode(["message" => "No se encontraron registros en la tabla 'debts'"]));
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }
});

// Ruta para lotes
$app->get('/desafio-dos/{loteID}', function (Request $request, Response $response, $args) {
    $loteID = $args['loteID'];
    $result = DesafioDos::retriveLotes($loteID);

    return $response->withJson($result);
});

$app->run();

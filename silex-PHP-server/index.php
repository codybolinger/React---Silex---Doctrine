<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Database.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

$app = new Silex\Application();

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app->match("{url}", function($url) use ($app) { return "OK"; })->assert('url', '.*')->method("OPTIONS");

$app->GET('/api/items', function(Application $app, Request $request) {
	$database = new Database();
	$query = 'SELECT * FROM items';
	$items = $database->Query($query);

	return new Response(json_encode(['items' => $items]));
});

$app->DELETE('/api/items/{id}', function(Application $app, Request $request, $id) {
	$database = new Database();
	$query = 'DELETE FROM items WHERE itemid = ?';
	$params = [$id];
	$item = $database->Query($query, $params);

	return new Response('Item Deleted');
});

$app->PUT('/api/items/{id}', function(Application $app, Request $request) {	
	return new Response('TODO implement PUT method ?');
});

$app->POST('/api/items', function(Application $app, Request $request) {
	$database = new Database();
	$query = 'INSERT INTO items (name, sort) VALUES(?, ?)';
	$params = [$request->request->get('name'), $request->request->get('sort')];
	$item = $database->Query($query, $params);
	
	return new Response(json_encode(['item' => $item]));
});

$app->run();

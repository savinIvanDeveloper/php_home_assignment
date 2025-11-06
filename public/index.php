<?php
// public/index.php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once __DIR__ . '/../src/api_contacts.php';
require_once __DIR__ . '/../src/api_weather.php';

$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Remove query string
$path = strtok($path, '?');

header('Content-Type: application/json; charset=utf-8');

if ($path === '/api/contacts' && $method === 'GET') {
    $name = $_GET['name'] ?? '';
    if ($name === '') {
      http_response_code(400);
      echo json_encode(['ok' => false, 'error' => 'empty name parameter']);
    }
    $res = find_contacts_by_name($name);
    echo json_encode(['search_words' => $name, 'num_results' => count($res), 'results' => $res], JSON_UNESCAPED_UNICODE);
    exit;
}


if ($path === '/api/weather' && $method === 'GET') {
  $lon = $_GET['lon'] ?? -1.0;
  $lat = $_GET['lat'] ?? -1.0;
  if ($lon === -1.0 || $lat === -1.0) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Invalid coordinates']);
  }
  $data = fetch_weather_from_api($lat, $lon);
  if (!$data) {
      http_response_code(502);
      echo json_encode(['ok' => false, 'error' => 'cannot fetch weather (check API key or network)']);
      exit;
  }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  exit;
}

// Default: show simple readme
http_response_code(404);
echo json_encode(['ok' => false, 'error' => 'endpoint not found']);

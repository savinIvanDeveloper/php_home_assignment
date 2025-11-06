<?php
// src/api_weather.php
require_once __DIR__ . '/db.php';

function fetch_weather_from_api(float $lat, float $lon): ?array {
    $apiKey = getenv('OWM_API_KEY');
    if (!$apiKey) return null;

    $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units=metric&appid={$apiKey}";

    $json = @file_get_contents($url);
    if ($json === false) return null;
    $data = json_decode($json, true);
    return $data;
}

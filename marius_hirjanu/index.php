<?php
define('CASE_NUMBER', 0);
$cities_filename = 'cities.json';
$stations_filename = 'stations.json';

$directory = 'case'.CASE_NUMBER.'/';

$cities_json = file_get_contents($directory.$cities_filename);
$cities_data = json_decode($cities_json, true);

$stations_file = file_get_contents($directory.$stations_filename);
$stations_data = json_decode($stations_file, true);

print_($stations_data);














// debug function
function print_($data = null){
    if (!empty($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
<?php
define('CASE_NUMBER', 9);
$cities_filename = 'cities.json';
$stations_filename = 'stations.json';

$directory = 'case'.CASE_NUMBER.'/';

$cities_json = file_get_contents($directory.$cities_filename);
$cities_data = json_decode($cities_json, true);

$stations_file = file_get_contents($directory.$stations_filename);
$stations_data = json_decode($stations_file, true);

$validate = validate($cities_data, $stations_data);
echo "<br />";
var_dump($validate);




function validate($cities_data, $stations_data){
    $result = true;
    try {
        if(isset($cities_data)) {
            //print_($cities_data['pairs']);

            // Every station belongs to a single city
            $my_station = array();
            foreach ($cities_data['stations'] as $city_id => $stations) {
                foreach ($stations as $station_id) {
                    $my_station[$station_id][] = $city_id;
                    if(!empty($my_station[$station_id]) && count($my_station[$station_id]) > 1) throw new Exception("Not every station belongs to a single city");
                }
            }

            // Every city has at least one station
            foreach($cities_data['cities'] as $city_id => $city_name){
                if(empty($cities_data['stations'][$city_id])){
                    throw new Exception("Not every city has at least one station");
                }
            }

            // Every station has at least one connection (station pairs)
            foreach($stations_data['stations'] as $station_id => $station_name){
                if(empty($cities_data['pairs'][$station_id])){
                    throw new Exception("Not every station has at least one connection");
                }
            }

        }
    } catch(Exception $e) {
        $result = false;
        echo 'Exception: ' .$e->getMessage();
    }

    return $result;
}











// debug function
function print_($data = null){
    if (!empty($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
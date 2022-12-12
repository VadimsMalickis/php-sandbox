<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


function getAllRepos() {
    $file = fopen('studentGitRepos.csv', 'r');

    $json = [];
    $firstIteration = true;
    $jsonKeys = null;
    
    while (($dataSet = fgetcsv($file)) !== false) {
        // on first iteration we get first row with column header values
        if ($firstIteration === true) {
            $jsonKeys = $dataSet;
            $firstIteration = false;
            continue;
        }
    
        $tempArr = null;
        /**
         * count($dataSet) returns amount of values in the single row
         */
        for ($column = 0; $column < count($dataSet); $column++) {
            $tempArr[$jsonKeys[$column]] = $dataSet[$column];
        }
        $json['repos'][] = $tempArr;
    }
    
    fclose($file);
    return $json;
}

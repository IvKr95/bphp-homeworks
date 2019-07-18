<?php

header('Content-Type: application/json');

$csv = $argv[1] or die('File does not exist');
$array = csvToArray("$csv", ';');
$jsonText = json_encode($array);

require 'detect_encoding.php';
require 'change_enc.php';

$fileName = 'data.json';
$createFile = fopen($fileName, 'w') or die('Cannot open file:  '.$fileName);
fwrite($createFile, $jsonText);

function csvToArray($filename='', $delimiter=',')
{
    if(!is_readable($filename)) {
        return false;
    };

    $header = null;
    $data = [];

    if (($handle = fopen($filename, 'rb')) !== false)
    {
        while (($row = fgetcsv($handle, filesize($filename), $delimiter)) !== false)
        {
            if(!$header) {
                $header = $row;
            } else {
                $data[] = array_combine($header, $row);
            };   
        };
        fclose($handle);
    };
    return $data;
};


<?php

$availChairs = 40;
$map = generate(5, 8, $availChairs);
$requiredRow = 5;
$requiredPlace = 8;

$reverve = reserve($map, $requiredRow, $requiredPlace);
logReserve($requiredRow, $requiredPlace, $reverve);

function generate($rows, $placesPerRow, $avaliableCount) 
{
    if ($avaliableCount > ($row * $placesPerRow)) return false;
    
    $seatMap = [];
    $seatCount = 0;

    for ($r=0; $r < $rows; $r++) { 
        for ($s=0; $s < $placesPerRow; $s++) { 
            
            $seatMap[$r][$s] = false;
            $seatCount++;
        };
    };

    return $seatCount > $avaliableCount ? false : $seatMap;
};

function reserve(&$map, $row, $place) 
{
    global $availChairs;
    $row--;
    $place--;

    if ($map[$row][$place] === false) {
        $map[$row][$place] = true;
        $availChairs--;
        return true;
    } else {
        return false;
    };
};

function logReserve($row, $place, $result)
{
    if ($result) {
        echo "Ваше место забронировано! Ряд $row, место $place".PHP_EOL;
    } else {
        echo "Что-то пошло не так=( Бронь не удалась".PHP_EOL;
    };
};
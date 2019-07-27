<?php

// Переводит дату из формата dd-mm-yyyy hh:mm:ss в hh:mm yy.dd.mm.

$inFormat = date('d-m-Y h:i:s', time());
$outFormat = date('h:i y.d.m', strtotime($inFormat));
echo $outFormat . PHP_EOL;

// Считает сколько дней осталось до нового года

function dateDiff($date_1 , $date_2 , $diffFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $int = date_diff($datetime1, $datetime2);
    
    return $int->format($diffFormat);
};

echo 'До нового года осталось ' . dateDiff('now', '01.01.' . date('Y', strtotime('+1 year'))) . ' дней' . PHP_EOL;

//Прибавляет к текущей дате два месяца

$date = date_create('+2 month', new DateTimeZone('Europe/Moscow'));
print_r($date);
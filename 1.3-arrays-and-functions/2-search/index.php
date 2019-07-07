<?php


$map = [
    [true,false,false,false,false],
    [false,true,true,true,false],
    [false,false,true,false,false],
    [false,true,false,false,false],
    [false,false,false,true,false],
    [false,false,false,false,false],
];

$n = 4;
$result = findSeats($map, $n);
logResult($result);

function findSeats($map, $n) 
{
    $seats = [];
    $seatNum = 0;

    if (!isset($map)) return;

    foreach ($map as $key => $value) {

        if ($n > count($value) || !in_array(false, $value)) {
            return;
        };

        $stop = (count($value) - $n) + 1;

        foreach ($value as $seat) {

            $seatNum++;

            if (count($seats) < $n) {

                $stop--;

                if (!$seat) {
                    $seats[] = $seatNum;
                    if (count($seats) === $n) return [++$key, $seats];
                } else {
                    $seats = [];
                    if ($stop <= 0) break;
                };

            } else {
                return [++$key, $seats];
            };
        };
    };
};

function logResult($res)
{
    if ($res) {
        echo "Поздравляем, Ваши места ".implode(",",$res[1])." в $res[0] ряду!";
    } else {
        echo 'Извините, места рядом не нашлись:(';
    };
};
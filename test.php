<?php

ini_set('memory_limit', '2G');

include('topksort.php');

$array = range(1, 1e7);

shuffle($array);

$array2 = $array;

$start = microtime(true);
topksort($array, 10000);
$timeTaken = microtime(true) - $start;

echo 'Time taken with topksort: '.$timeTaken.'s'.PHP_EOL;

$start = microtime(true);
sort($array2);
array_splice($array2, 10000);
$timeTaken = microtime(true) - $start;

echo 'Time taken normally: '.$timeTaken.'s'.PHP_EOL;

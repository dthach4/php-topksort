<?php

function topksort(&$array, $k = 0) {
  $swap = function (&$array, $i, $j) {
    $tmp = $array[$i];
    $array[$i] = $array[$j];
    $array[$j] = $tmp;
  };
  $topkheapifydown = function (&$array, $k) use ($swap) {
    $i = 0;
    do {
      $done = true;
      $maxIdx = $i;
      if(2*($i+1)-1 < $k) {
        if($array[2*($i+1)-1] > $array[$maxIdx]) {
          $maxIdx = 2*($i+1)-1;
        }
        if(2*($i+1) < $k) {
          if($array[2*($i+1)] > $array[$maxIdx]) {
            $maxIdx = 2*($i+1);
          }
        }
      }
      if($maxIdx !== $i) {
        $done = false;
        $swap($array, $i, $maxIdx);
        $i = $maxIdx;
      }
    } while (!$done);
  };
  if(0 === $k || count($array) < $k) {
    $k = count($array);
  }
  for($i = 1; $i < $k; ++$i) {
    $j = $i;
    while($j > 0 && $array[$j] > $array[intdiv($j, 2)]) {
      $swap($array, $j, intdiv($j, 2));
      $j = intdiv($j, 2);
    }
  }
  for($i = $k; $i < count($array); ++$i) {
    if($array[$i] < $array[0]) {
      $swap($array, $i, 0);
      $topkheapifydown($array, $k);
    }
  }
  for($i = $k-1; $i >= 0; --$i) {
    $swap($array, $i, 0);
    $topkheapifydown($array, $i);
  }
  array_splice($array, $k);
}

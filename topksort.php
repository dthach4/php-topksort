<?php

function topksort(&$array, $k = 0, $comparator = null) {
  if(is_null($comparator)) {
    $comparator = function ($a, $b) {
      return $a <=> $b;
    };
  }
  $swap = function (&$array, $i, $j) {
    $tmp = $array[$i];
    $array[$i] = $array[$j];
    $array[$j] = $tmp;
  };
  $topkheapifydown = function (&$array, $k) use ($swap, $comparator) {
    $i = 0;
    do {
      $done = true;
      $maxIdx = $i;
      if(2*($i+1)-1 < $k) {
        if($comparator($array[2*$i+1], $array[$maxIdx]) > 0) {
          $maxIdx = 2*$i+1;
        }
        if(2*($i+1) < $k) {
          if($comparator($array[2*$i+2)], $array[$maxIdx]) > 0) {
            $maxIdx = 2*$i+2;
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
    while($j > 0 && $comparator($array[$j], $array[intdiv($j, 2)]) > 0) {
      $swap($array, $j, intdiv($j, 2));
      $j = intdiv($j, 2);
    }
  }
  for($i = $k; $i < count($array); ++$i) {
    if($comparator($array[0], $array[$i]) > 0) {
      $array[0] = $array[$i];
      $topkheapifydown($array, $k);
    }
  }
  for($i = $k-1; $i >= 0; --$i) {
    $swap($array, $i, 0);
    $topkheapifydown($array, $i);
  }
  array_splice($array, $k);
}

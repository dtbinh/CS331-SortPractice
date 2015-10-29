<?php

function mergeSort(&$list, $indexLow, $indexHigh) {
  if ($indexLow >= $indexHigh) return;

  $mid = floor(($indexLow + $indexHigh) / 2);
  mergeSort($list, $indexLow, $mid);
  mergeSort($list, $mid + 1, $indexHigh);
  merge($list, $indexLow, $mid, $indexHigh);
}

function merge(&$list, $indexLow, $mid, $indexHigh) {
  $tempList = array();
  $i = $indexLow; $j = $mid + 1;

  while (($i <= $mid) && ($j <= $indexHigh)) {
    if ($list[$i] <= $list[$j]) {
      $tempList[count($tempList)] = $list[$i];
      $i ++;
    } else {
      $tempList[count($tempList)] = $list[$j];
      $j ++;
    }
  }
    
  if ($i > $mid) {
    for ($k = $j; $k <= $indexHigh; $k ++) $tempList[count($tempList)] = $list[$k];
  } else {
    for ($k = $i; $k <= $mid; $k ++) $tempList[count($tempList)] = $list[$k];
  }

  $ti = 0;
  for ($k = $indexLow; $k <= $indexHigh; $k ++) {
    $list[$k] = $tempList[$ti ++];
  }
}

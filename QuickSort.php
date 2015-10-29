<?php
require_once "InsertSort.php";

function quickSort1(&$list, $indexLow, $indexHigh) {
  if ($indexLow < $indexHigh) {
    $pivotPosition = partition($list, $indexLow, $indexHigh);
    quickSort1($list, $indexLow, $pivotPosition - 1);
    quickSort1($list, $pivotPosition + 1, $indexHigh);
  }
}

function quickSort2(&$list, $indexLow, $indexHigh) {
  if (($indexHigh - $indexLow + 1) >= 16) {
    quickSort1($list, $indexLow, $indexHigh);
  } else {
    insertSort($list, $indexLow, $indexHigh);
  }
}

function quickSort3(&$list, $indexLow, $indexHigh) {
  if (($indexHigh - $indexLow + 1) >= 16) {
    quickSort3R($list, $indexLow, $indexHigh);
  } else {
    insertSort($list, $indexLow, $indexHigh);
  }
}

function quickSort3R(&$list, $indexLow, $indexHigh) {
  if ($indexLow < $indexHigh) {
    selectPivot($list, $indexLow, $indexHigh);
    $pivotPosition = partition($list, $indexLow, $indexHigh);
    quickSort3($list, $indexLow, $pivotPosition - 1);
    quickSort3($list, $pivotPosition + 1, $indexHigh);
  }
}

function partition(&$list, $indexLow, $indexHigh) {
  $pivotValue = $list[$indexLow];

  $replacePosition = $indexLow;
  for ($i = $indexLow + 1;$i <= $indexHigh; $i ++) {
    if ($list[$i] < $pivotValue) {
      swapValue($list, $i, $replacePosition + 1);
      $replacePosition ++;
    }
  }
  swapValue($list, $replacePosition, $indexLow);

  return $replacePosition;
}

function swapValue(&$list, $index1, $index2) {
    $temp = $list[$index1];
    $list[$index1] = $list[$index2];
    $list[$index2] = $temp;
}

function selectPivot(&$list, $indexLow, $indexHigh) {
  $pivotPosition = mt_rand($indexLow, $indexHigh);
  swapValue($list, $indexLow, $pivotPosition);
}

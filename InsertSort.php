<?php

function insertSort(&$list, $indexLow, $indexHigh) {
  for ($i = $indexLow + 1; $i <= $indexHigh; $i ++) {
    $target = $list[$i];
    $j = $i - 1;
    while ($j >= 0 && $list[$j] > $target) {
      $list[$j + 1] = $list[$j];
      $j --;
    }
    $list[$j + 1] = $target;
  }
}

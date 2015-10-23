<?php

if (count($argv) < 3) die("GenList [rand|order] <size_power>\n");

$mode = $argv[1];
$count = pow(2, intval($argv[2]));

$list = array();
for ($i = 0; $i < $count; $i ++) {
  $list[$i] = $i + 1;
}

if ($mode == "rand") {
  randValue($list, $count);
}

echo implode(",", $list);

function randValue(&$list, $count) {
  for ($k = 0; $k < $count/2; $k ++) {
    $i = mt_rand(0, $count - 1);
    $j = mt_rand(0, $count - 1);
    while ($i == $j) {
      $j = mt_rand(0, $count - 1);
    }

    $t = $list[$i];
    $list[$i] = $list[$j];
    $list[$j] = $t;
  }
}

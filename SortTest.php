<?php
require_once "InsertSort.php";
require_once "MergeSort.php";
require_once "QuickSort1.php";
require_once "QuickSort2.php";
require_once "QuickSort3.php";

// insert | merge | quick1 | quick2 | quick3
if (count($argv) < 3) die("php sort_test.php <mode> <case file>\n");
$mode = $argv[1];
$fname = $argv[2];
$list = explode(",", file_get_contents($fname));

// initialize
$minLoopCount = 10;
$minTimeCost = 1*60*1000000; // micro second
$loopCount = 1;
$sort = null;
switch ($mode) {
  case "insert": $sort = new InsertSort(); $sort->setList($list); break;
  case "merge": $sort = new MergeSort(); $sort->setList($list); break;
  case "quick1": $sort = new QuickSort1(); $sort->setList($list); break;
  case "quick2": $sort = new QuickSort2(); $sort->setList($list); break;
  case "quick3": $sort = new QuickSort3(); $sort->setList($list); break;
  default: die("Invalid sort mode: ".$mode."!\n");
}

// evaluate the loop count and test the result
$startTime = microtime(true);
$sort->sort();
$endTime = microtime(true);
$sortHash = getHash($sort->getList());

$base = new BaseSort();
$base->setList($list)->sort();
$baseHash = getHash($base->getList());
unset($base);

if ($sortHash != $baseHash) die("Incorrect sort result!\n");

$timeCost = ($endTime - $startTime) * 1000000;
if ($timeCost >= 1000 ) { // >= 1 ms
  $loopCount = intval($minTimeCost / $timeCost);
} else { // too fast, need re-evaluate
  $loopCount = 20000;
  $startTime = microtime(true);
  for ($i = 0; $i < $loopCount; $i ++) {
    $sort->setList($list);
    $sort->sort();
  }
  $endTime = microtime(true);

  $timeCost = ($endTime - $startTime) * 1000000;
  $loopCount = intval($minTimeCost/$timeCost * 20000);
}

if ($loopCount < 10) $loopCount = 10;

// Good to go ...
echo "Looping ".$loopCount." times ...";
$startTime = microtime(true);
for ($i = 0; $i < $loopCount; $i ++) {
  $sort->setList($list);
  $sort->sort();
}
$endTime = microtime(true);
echo "done\n";

// Calculate results
$timeCost = ($endTime - $startTime) * 1000000;
$avgTime = $timeCost/$loopCount;

echo "Sort mode:\t".$mode."\n";
echo "List size:\t".count($list)."\n";
echo "Loop count:\t".$loopCount."\n";
echo "Total time:\t".$timeCost." us\n";
echo "Avg time:\t".$avgTime." us\n";

function getHash($list) {
  return hash("md5", implode("", $list));
}

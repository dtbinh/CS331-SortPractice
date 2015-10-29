<?php
require_once "InsertSort.php";
require_once "MergeSort.php";
require_once "QuickSort.php";

// insert | merge | quick1 | quick2 | quick3
if (count($argv) < 3) die("php sort_test.php <mode> <case file>\n");
$mode = $argv[1];
$fname = $argv[2];
$list = explode(",", file_get_contents($fname));

// initialize
$listCount = count($list);
$minLoopCount = 10;
$minTimeCost = 1*60; // second
$loopCount = 1;
$timeCost = 0;
$sort = createSort($mode);
if (is_null($sort)) die("Invalid sort mode: ".$mode."!\n");

// Check correctness & get a rough sense of time cost
$workList = $list;
$startTime = microtime(true);
$sort($workList, 0, $listCount - 1);
$endTime = microtime(true);
$sortHash = getHash($workList);

$workList = $list;
baseSort($workList);
$baseHash = getHash($workList);
if ($sortHash != $baseHash) die("Incorrect sort result!\n");

// Calculate a reasonable loopCount
$timeCost = $endTime - $startTime;
if ($timeCost >= 0.005) { // >= 5 ms
  $loopCount = intval($minTimeCost / $timeCost);
} else { // too fast, need re-calculate with more loops
  $loopCount = 5000;
  // total time cost
  $startTime = microtime(true);
  for ($i = 0; $i < $loopCount; $i ++) {
    $workList = $list;
    $sort($workList, 0, $listCount - 1);
  }
  $endTime = microtime(true);
  $totalCost = $endTime - $startTime;

  // overhead
  $startTime = microtime(true);
  for ($i = 0; $i < $loopCount; $i ++) {
    $workList = $list;
  }
  $endTime = microtime(true);
  $overheadCost = $endTime - $startTime;

  // calculate loop count
  $timeCost = $totalCost - $overheadCost;
  $loopCount = intval($minTimeCost/$timeCost * $loopCount);
}

if ($loopCount < 10) $loopCount = 10;

// Evaluate the performance
echo "Looping ".$loopCount." times ...";
$startTime = microtime(true);
for ($i = 0; $i < $loopCount; $i ++) {
  $workList = $list;
  $sort($workList, 0, $listCount - 1);
}
$endTime = microtime(true);
$totalCost = $endTime - $startTime;

$startTime = microtime(true);
for ($i = 0; $i < $loopCount; $i ++) {
  $workList = $list;
}
$endTime = microtime(true);
$overheadCost = $endTime - $startTime;

echo "done\n";

// Calculate results
$timeCost = ($totalCost - $overheadCost) * 1000; // ms
$avgTime = $timeCost / $loopCount; // ms

echo "Sort mode:\t".$sort."\n";
echo "List size:\t".$listCount."\n";
echo "Loop count:\t".$loopCount."\n";
echo "Total time:\t".$timeCost." ms\n";
echo "Avg time:\t".$avgTime." ms\n";

function createSort($mode) {
  $sort = null;
  switch ($mode) {
    case "insert": $sort = "insertSort"; break;
    case "merge": $sort = "mergeSort"; break;
    case "quick1": $sort = "quickSort1"; break;
    case "quick2": $sort = "quickSort2"; break;
    case "quick3": $sort = "quickSort3"; break;
  }
  return $sort;
}

function getHash($list) {
  return hash("md5", implode("", $list));
}

function baseSort(&$list) {
  sort($list);
}

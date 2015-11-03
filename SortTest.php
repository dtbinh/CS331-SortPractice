<?php
require_once "InsertSort.php";
require_once "MergeSort.php";
require_once "QuickSort.php";

enableKeyCount(false);

// insert | merge | quick1 | quick2 | quick3
if (count($argv) < 3) die("php sort_test.php <mode> <case file> show_array\n");
$mode = $argv[1];
$fname = $argv[2];
$showArray = ((count($argv) == 4) && ($argv[3] == "show_array"));
$list = explode(",", file_get_contents($fname));

// initialize
$listCount = count($list);
$minLoopCount = 10;
$minTimeCost = 1*10; // second
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

$workList2 = $list;
baseSort($workList2);
$baseHash = getHash($workList2);
unset($workList2);
if ($sortHash != $baseHash) die("Incorrect sort result!\n");

// Calculate a reasonable loopCount
$timeCost = $endTime - $startTime;
if ($timeCost >= 0.002) { // >= 5 ms
  $loopCount = intval($minTimeCost / $timeCost);
} else { // too fast, need re-calculate with more loops
  $loopCount = 2000;
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

if ($loopCount < 1) $loopCount = 1;

if ($loopCount > 1) {
  // Evaluate the performance
  echo "Looping ".$loopCount." times ...";
  $startTime = microtime(true);
  for ($i = 0; $i < $loopCount; $i ++) {
    $workList = $list;
  }
  $endTime = microtime(true);
  $overheadCost = $endTime - $startTime;

  $startTime = microtime(true);
  for ($i = 0; $i < $loopCount; $i ++) {
    $workList = $list;
    $sort($workList, 0, $listCount - 1);
  }
  $endTime = microtime(true);
  $totalCost = $endTime - $startTime;
  echo "done\n";

  // Calculate results
  $timeCost = $totalCost - $overheadCost;
}
$timeCost = $timeCost * 1000; // ms
$avgTime = $timeCost / $loopCount; // ms

echo "Sort mode:\t".$sort."\n";
echo "List size:\t".$listCount."\n";
echo "Loop count:\t".$loopCount."\n";
echo "Total time:\t".$timeCost." ms\n";
echo "Avg time:\t".$avgTime." ms\n";
if ($showArray) {
  $arrayString = implode(",",$list);
  if (strlen($arrayString) > 100)
    $arrayString = substr($arrayString, 0, 100) . "...";
  echo "Original Array:\n{".$arrayString."}\n";
  $arrayString = implode(",",$workList);
  if (strlen($arrayString) > 100)
    $arrayString = substr($arrayString, 0, 100) . "...";
  echo "Sorted Array:\n{".$arrayString."}\n";
}

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

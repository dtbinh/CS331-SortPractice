<?php
require_once "InsertSort.php";
require_once "MergeSort.php";
require_once "QuickSort.php";

enableKeyCount(true);

// insert | merge | quick1 | quick2 | quick3
if (count($argv) < 3) die("php SortCount.php <mode> <case file>\n");
$mode = $argv[1];
$fname = $argv[2];
$list = explode(",", file_get_contents($fname));

// initialize
$sort = createSort($mode);
if (is_null($sort)) die("Invalid sort mode: ".$mode."!\n");

// Evaluate the computation count
$loopCount = 1;
if ($mode == "quick3") {
  $loopCount = 100;
}
for ($i = 0; $i < $loopCount; $i ++) {
  $sort($list, 0, count($list) - 1);
}

// Show the result
echo "Sort mode:\t".$sort."\n";
echo "List size:\t".count($list)."\n";
echo "Computation count:\t".intval(getKeyCount()/$loopCount)."\n";

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

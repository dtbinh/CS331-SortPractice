runCmd="php SortTest.php insert $1"
echo $runCmd
$runCmd
echo "\n"

runCmd="php SortTest.php merge $1"
echo $runCmd
$runCmd
echo "\n"

runCmd="php SortTest.php quick1 $1"
echo $runCmd
$runCmd
echo "\n"

runCmd="php SortTest.php quick2 $1"
echo $runCmd
$runCmd
echo "\n"

runCmd="php SortTest.php quick3 $1"
echo $runCmd
$runCmd
echo "\n"

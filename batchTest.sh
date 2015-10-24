# ensure the php is optimized by opcache
php SortTest.php init

runCmd="php SortTest.php insert $1"
echo $runCmd
$runCmd

runCmd="php SortTest.php merge $1"
echo $runCmd
$runCmd

runCmd="php SortTest.php quick1 $1"
echo $runCmd
$runCmd

runCmd="php SortTest.php quick2 $1"
echo $runCmd
$runCmd

runCmd="php SortTest.php quick3 $1"
echo $runCmd
$runCmd

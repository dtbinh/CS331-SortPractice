runCmd="php sort_test.php insert $1"
echo $runCmd
$runCmd

runCmd="php sort_test.php merge $1"
echo $runCmd
$runCmd

runCmd="php sort_test.php quick1 $1"
echo $runCmd
$runCmd

runCmd="php sort_test.php quick2 $1"
echo $runCmd
$runCmd

runCmd="php sort_test.php quick3 $1"
echo $runCmd
$runCmd

<?php
require_once "QuickSort2.php";

class QuickSort3 extends QuickSort2 {

  protected function selectPivot($indexLow, $indexHigh) {
    $pivotPosition = mt_rand($indexLow, $indexHigh);
    $this->swapValue($indexLow, $pivotPosition);
  }

}

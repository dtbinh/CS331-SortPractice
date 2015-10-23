<?php
require_once "BaseSort.php";

class QuickSort1 extends BaseSort {
  public function sort() {
    $this->sortInternal(0, $this->getCount() - 1);
    return $this;
  }

  protected function sortInternal($indexLow, $indexHigh) {
    if ($indexLow < $indexHigh) {
      $this->selectPivot($indexLow, $indexHigh);
      $pivotPosition = $this->partition($indexLow, $indexHigh);
      $this->sortInternal($indexLow, $pivotPosition - 1);
      $this->sortInternal($pivotPosition + 1, $indexHigh);
    }
  }

  protected function partition($indexLow, $indexHigh) {
    $list = &$this->getList();
    $pivotValue = $list[$indexLow];

    $replacePosition = $indexLow;
    for ($i = $indexLow + 1;$i <= $indexHigh; $i ++) {
      if ($list[$i] < $pivotValue) {
        $this->swapValue($i, $replacePosition + 1);
        $replacePosition ++;
      }
    }
    $this->swapValue($replacePosition, $indexLow);

    return $replacePosition;
  }

  protected function selectPivot($indexLow, $indexHigh) {
  }

  protected function swapValue($index1, $index2) {
    $list = &$this->getList();
    $temp = $list[$index1];
    $list[$index1] = $list[$index2];
    $list[$index2] = $temp;
  }
}

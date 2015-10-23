<?php
require_once "BaseSort.php";

class MergeSort extends BaseSort {

  public function sort() {
    $this->sortInternal(0, $this->getCount() - 1);
    return $this;
  }

  protected function sortInternal($indexLow, $indexHigh) {
    if ($indexLow >= $indexHigh) return;

    $mid = floor(($indexLow + $indexHigh)/2);

    $this->sortInternal($indexLow, $mid);
    $this->sortInternal($mid + 1, $indexHigh);
    $this->merge($indexLow, $mid, $indexHigh);
  }

  protected function merge($indexLow, $mid, $indexHigh) {
    $list = &$this->getList();
    $tempList = array();
    $i = $indexLow; $j = $mid + 1;

    while (($i <= $mid) && ($j <= $indexHigh)) {
      if ($list[$i] <= $list[$j]) {
        $tempList[count($tempList)] = $list[$i];
        $i ++;
      } else {
        $tempList[count($tempList)] = $list[$j];
        $j ++;
      }
    }
    
    if ($i > $mid) {
      for ($k = $j; $k <= $indexHigh; $k ++) $tempList[count($tempList)] = $list[$k];
    } else {
      for ($k = $i; $k <= $mid; $k ++) $tempList[count($tempList)] = $list[$k];
    }


    $ti = 0;
    for ($k = $indexLow; $k <= $indexHigh; $k ++) {
      $list[$k] = $tempList[$ti ++];
    }
  }
}

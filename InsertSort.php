<?php
require_once "BaseSort.php";

class InsertSort  extends BaseSort {
  public function sort() {
    $list = &$this->getList();
    $listCount = $this->getCount();

    for ($i = 1; $i < $listCount; $i ++) {
      $target = $list[$i];
      $j = $i - 1;
      while ($j >= 0 && $list[$j] > $target) {
        $list[$j + 1] = $list[$j];
        $j --;
      }
      $list[$j + 1] = $target;
    }

    return $this;
  }
}

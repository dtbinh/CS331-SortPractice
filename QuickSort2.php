<?php
require_once "InsertSort.php";
require_once "QuickSort1.php";

class QuickSort2 extends QuickSort1 {

  public function sort() {
    if ($this->getCount() < 16) {
      // call InsertSearch
      $insertSort = new InsertSort();
      $insertSort->setList($this->getList());
      $this->setList($insertSort->sort()->getList());
    } else {
      // call QuickSearch1
      parent::sort();
    }
    return $this;
  }
}

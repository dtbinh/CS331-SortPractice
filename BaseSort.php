<?php
require_once "BaseSort.php";

class BaseSort {
  private $_list = null;
  private $_count = 0;

  public function &getList() {
    return $this->_list;
  }

  public function setList($list) {
    $this->_list = $list;
    $this->_count = count($list);

    return $this;
  }

  public function getCount() {
    return $this->_count;
  }

  public function sort() {
    $list = &$this->getList();
    sort($list);

    return $this;
  }
}
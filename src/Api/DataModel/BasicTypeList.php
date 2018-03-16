<?php

namespace ConnectID\Api\DataModel;


abstract class BasicTypeList extends BasicList implements \Countable, \Iterator {

  /**
   * @var array
   */
  protected $listOfTypes;

  public function __construct() {
    $this->listOfTypes = [];
  }

  protected function appendWithoutValidation($value) {
    $this->listOfTypes[] = $value;
  }

  public function count() {
    return count($this->listOfTypes);
  }

  public function current(): BasicTypeInterface {
    return current($this->listOfTypes);
  }

  public function key() {
    return key($this->listOfTypes);
  }

  public function next() {
    next($this->listOfTypes);
  }

  public function rewind() {
    reset($this->listOfTypes);
  }

  public function valid() {
    return isset($this->listOfTypes[$this->key()]);
  }
}

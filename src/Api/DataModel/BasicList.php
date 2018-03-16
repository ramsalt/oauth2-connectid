<?php

namespace ConnectID\Api\DataModel;


abstract class BasicList {

  protected $items;

  public function __construct() {
    $this->items = [];
  }

  public function count() {
    return count($this->items);
  }

  public function current() {
    return current($this->items);
  }

  public function next() {
    return current($this->items);
  }

  public function key() {
    return key($this->items);
  }

  public function valid() {
    return valid($this->items);
  }

  public function rewind() {
    return rewind($this->items);
  }

  public function toArray(): array {
    $list = [];
    foreach ($this->items as $value) {
      if (method_exists($value, 'toArray')) {
        $list[] = $value->toArray();
      }
      else {
        $list[] = serialize($value);
      }
    }

    return $list;
  }
}

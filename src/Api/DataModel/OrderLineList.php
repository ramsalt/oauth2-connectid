<?php

namespace ConnectID\Api\DataModel;


class OrderLineList implements \Countable, \Iterator {

  protected $items;

  public function __construct() {
    $this->items = [];
  }

  public function append(OrderLine $orderLine) {
    $this->items[] = clone $orderLine;
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
}

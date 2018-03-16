<?php

namespace ConnectID\Api\DataModel;


class OrderLineList extends BasicList implements \Countable, \Iterator {

  public function append(OrderLine $orderLine) {
    $this->items[] = clone $orderLine;
  }

  public function current(): OrderLine {
    return current($this->items);
  }
}

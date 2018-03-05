<?php

namespace ConnectID\Api\DataModel;


class ProductTypeList implements \Countable, \Iterator {

  protected $productTypes;

  public function __construct() {
    $this->productTypes = [];
  }

  public static function fromDataArray(array $productList): ProductTypeList {
    $list = new static();
    foreach ($productList as $itemData) {
      $list->withProduct(ProductType::create($itemData));
    }

    return $list;
  }

  public function count() {
    return count($this->productTypes);
  }

  public function current(): ProductType {
    return current($this->productTypes);
  }

  public function key() {
    return key($this->productTypes);
  }

  public function next() {
    next($this->productTypes);
  }

  public function rewind() {
    reset($this->productTypes);
  }

  public function valid() {
    return isset($this->productTypes[$this->key()]);
  }

  /**
   * @param \ConnectID\Api\DataModel\ProductType $product_type
   *
   * @return \ConnectID\Api\DataModel\ProductTypeList
   */
  public function withProduct(ProductType $product_type): ProductTypeList {
    $this->productTypes[] = $product_type;
    return $this;
  }
}

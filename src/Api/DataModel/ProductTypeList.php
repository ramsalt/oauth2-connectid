<?php

namespace ConnectID\Api\DataModel;


class ProductTypeList extends BasicTypeList {

  public static function fromDataArray(array $productList): ProductTypeList {
    $list = new static();
    foreach ($productList as $itemData) {
      $list->withProduct(ProductType::create($itemData));
    }

    return $list;
  }

  /**
   * @param \ConnectID\Api\DataModel\ProductType $product_type
   *
   * @return \ConnectID\Api\DataModel\ProductTypeList
   */
  public function withProduct(ProductType $product_type): ProductTypeList {
    $this->appendWithoutValidation($product_type);
    return $this;
  }
}

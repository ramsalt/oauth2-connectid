<?php

namespace ConnectID\Api\DataModel;


class CouponTypeList extends BasicTypeList {

  public static function fromDataArray(array $couponList): CouponTypeList {
    $list = new static();
    foreach ($couponList as $itemData) {
      $list->withCoupon(CouponType::create($itemData));
    }

    return $list;
  }

  /**
   * @param \ConnectID\Api\DataModel\CouponType $product_type
   *
   * @return \ConnectID\Api\DataModel\CouponTypeList
   */
  public function withCoupon(CouponType $coupon_data): CouponTypeList {
    $this->appendWithoutValidation($coupon_data);
    return $this;
  }
}

<?php

namespace ConnectID\Api\DataModel;


class CouponTypeList extends BasicTypeList implements \ArrayAccess {

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
  public function withCoupon(CouponType $coupon): CouponTypeList {
    if ($code = $coupon->getCouponCode()) {
      $this->listOfTypes[$coupon->getId()] = $coupon;
    }
    else {
      $this->appendWithoutValidation($coupon);
    }

    return $this;
  }

  /**
   * @see \ArrayAccess::offsetExists()
   */
  public function offsetExists($couponId) {
    return isset($this->listOfTypes[$couponId]);
  }

  /**
   * @see \ArrayAccess::offsetGet()
   *
   * @return \ConnectID\Api\DataModel\CouponType
   */
  public function offsetGet($couponId) {
    return $this->listOfTypes[$couponId] ?? NULL;
  }

  /**
   * @see \ArrayAccess::offsetSet()
   */
  public function offsetSet($couponId, $coupon) {
    if (!(is_object($coupon) && is_a($coupon, CouponType::class))) {
      throw new \InvalidArgumentException("Only objects of class CouponType can be set.");
    }

    $this->listOfTypes[$couponId] = $coupon;
  }

  /**
   * @see \ArrayAccess::offsetUnset()
   */
  public function offsetUnset($couponId) {
    unset($this->listOfTypes[$couponId]);
  }

}

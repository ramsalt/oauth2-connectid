<?php

namespace ConnectID\Api\DataModel;


class CouponType extends BasicType {

  /**
   * @var string
   */
  protected $couponCode;

  /**
   * @var int
   */
  protected $couponNumber;

  /**
   * @var \DateTimeImmutable|null
   */
  protected $startTime;

  /**
   * @var \DateTimeImmutable|null
   */
  protected $endTime;

  /**
   * @var string
   */
  protected $description;

  /**
   * @var float
   */
  protected $couponPrice;

  /**
   * @var array
   */
  protected $extraProducts;

  /**
   * @var int
   */
  protected $periodLength;

  /**
   * @var string
   */
  protected $periodType;

  /**
   * @inheritdoc
   */
  public function getId(): string {
    return $this->getCouponCode() . ':' . $this->getCouponNumber();
  }

  /**
   * @return string
   */
  public function getCouponCode(): string {
    return $this->couponCode;
  }

  /**
   * @param string $couponCode
   *
   * @return CouponType
   */
  public function withCouponCode(string $couponCode): CouponType {
    $this->couponCode = $couponCode;
    return $this;
  }

  /**
   * @return int
   */
  public function getCouponNumber(): int {
    return $this->couponNumber;
  }

  /**
   * @param int $couponNumber
   *
   * @return CouponType
   */
  public function withCouponNumber(int $couponNumber): CouponType {
    $this->couponNumber = $couponNumber;
    return $this;
  }

  /**
   * @return \DateTimeImmutable|null
   */
  public function getStartTime(): \DateTimeImmutable {
    return $this->startTime;
  }

  /**
   * @param \DateTimeImmutable|null $startTime
   *
   * @return CouponType
   */
  public function withStartTime($startTime): CouponType {
    if ($startTime) {
      $this->startTime = $this->getDateTimeFromData($startTime);;
    }
    return $this;
  }

  /**
   * @return \DateTimeImmutable|null
   */
  public function getEndTime(): \DateTimeImmutable {
    return $this->endTime;
  }

  /**
   * @param \DateTimeImmutable|null $endTime
   *
   * @return CouponType
   */
  public function withEndTime($endTime): CouponType {
    if ($endTime) {
      $this->endTime = $this->getDateTimeFromData($endTime);;
    }
    return $this;
  }

  /**
   * @return string
   */
  public function getDescription(): ?string {
    return $this->description;
  }

  /**
   * @param string $description
   *
   * @return CouponType
   */
  public function withDescription(?string $description): CouponType {
    $this->description = $description;
    return $this;
  }

  /**
   * @return float
   */
  public function getCouponPrice(): ?float {
    return $this->couponPrice;
  }

  /**
   * @param float $couponPrice
   *
   * @return CouponType
   */
  public function withCouponPrice(float $couponPrice): CouponType {
    if (is_numeric($couponPrice)) {
      $this->couponPrice = $couponPrice;
    }
    elseif (!empty($couponPrice)) {
      throw new \InvalidArgumentException("Invalid numeric value: " . $couponPrice);
    }
    return $this;
  }

  /**
   * @return array
   */
  public function getExtraProducts(): array {
    return $this->extraProducts;
  }

  /**
   * @param array $extraProducts
   *
   * @return CouponType
   */
  public function withExtraProducts(array $extraProducts): CouponType {
    $this->extraProducts = $extraProducts;
    return $this;
  }

  /**
   * @return int
   */
  public function getPeriodLength(): ?int {
    return $this->periodLength;
  }


  /**
   * @param int $periodLength
   *
   * @return CouponType
   */
  public function withPeriodLength(int $periodLength): CouponType {
    $this->periodLength = $periodLength;
    return $this;
  }


  /**
   * @return string
   */
  public function getPeriodType(): ?string {
    return $this->periodType;
  }


  /**
   * @param string $periodType
   *
   * @return CouponType
   */
  public function withPeriodType(string $periodType): CouponType {
    $this->periodType = $periodType;
    return $this;
  }


}

<?php

namespace ConnectID\Api\DataModel;


class OrderLine {

  /**
   * @var string
   */
  protected $productSpecType;

  /**
   * @var string
   */
  protected $productSpecCode;

  /**
   * @var int
   */
  protected $productSpecNo;

  /**
   * @var string
   */
  protected $product;

  /**
   * @var int
   */
  protected $quantity;

  /**
   * @var float
   */
  protected $unitPrice;

  /**
   * @var string
   */
  protected $voucherCode;

  /**
   * @var string
   */
  protected $allowAccessProduct;

  /**
   * @var int
   */
  protected $allowAccessSeconds;

  /**
   * @var array
   */
  protected $startInfo;

  /**
   * @var string
   */
  protected $rewardPartnerId;

  /**
   * @var string
   */
  protected $rewardId;

  /**
   * @var \ConnectID\Api\DataModel\Address
   */
  protected $receiver;

  /**
   * @var \ConnectID\Api\DataModel\Address
   */
  protected $recruiter;

  /**
   * @return string
   */
  public function getProductSpecType(): string {
    return $this->productSpecType;
  }

  /**
   * @param string $productSpecType
   *
   * @return OrderLine
   */
  public function withProductSpecType(string $productSpecType): OrderLine {
    $this->productSpecType = $productSpecType;
    return $this;
  }

  /**
   * @return string
   */
  public function getProductSpecCode(): string {
    return $this->productSpecCode;
  }

  /**
   * @param string $productSpecCode
   *
   * @return OrderLine
   */
  public function setProductSpecCode(string $productSpecCode): OrderLine {
    $this->productSpecCode = $productSpecCode;
    return $this;
  }

  /**
   * @return int
   */
  public function getProductSpecNo(): int {
    return $this->productSpecNo;
  }

  /**
   * @param int $productSpecNo
   *
   * @return OrderLine
   */
  public function setProductSpecNo(int $productSpecNo): OrderLine {
    $this->productSpecNo = $productSpecNo;
    return $this;
  }

  /**
   * @return string
   */
  public function getProduct(): string {
    return $this->product;
  }

  /**
   * @param string $product
   *
   * @return OrderLine
   */
  public function setProduct(string $product): OrderLine {
    $this->product = $product;
    return $this;
  }

  /**
   * @return int
   */
  public function getQuantity(): int {
    return $this->quantity;
  }

  /**
   * @param int $quantity
   *
   * @return OrderLine
   */
  public function setQuantity(int $quantity): OrderLine {
    $this->quantity = $quantity;
    return $this;
  }

  /**
   * @return float
   */
  public function getUnitPrice(): float {
    return $this->unitPrice;
  }

  /**
   * @param float $unitPrice
   *
   * @return OrderLine
   */
  public function setUnitPrice(float $unitPrice): OrderLine {
    $this->unitPrice = $unitPrice;
    return $this;
  }

  /**
   * @return string
   */
  public function getVoucherCode(): string {
    return $this->voucherCode;
  }

  /**
   * @param string $voucherCode
   *
   * @return OrderLine
   */
  public function setVoucherCode(string $voucherCode): OrderLine {
    $this->voucherCode = $voucherCode;
    return $this;
  }

  /**
   * @return string
   */
  public function getAllowAccessProduct(): string {
    return $this->allowAccessProduct;
  }

  /**
   * @param string $allowAccessProduct
   *
   * @return OrderLine
   */
  public function setAllowAccessProduct(string $allowAccessProduct): OrderLine {
    $this->allowAccessProduct = $allowAccessProduct;
    return $this;
  }

  /**
   * @return int
   */
  public function getAllowAccessSeconds(): int {
    return $this->allowAccessSeconds;
  }

  /**
   * @param int $allowAccessSeconds
   *
   * @return OrderLine
   */
  public function setAllowAccessSeconds(int $allowAccessSeconds): OrderLine {
    $this->allowAccessSeconds = $allowAccessSeconds;
    return $this;
  }

  /**
   * @return array
   */
  public function getStartInfo(): array {
    return $this->startInfo;
  }

  /**
   * @param array $startInfo
   *
   * @return OrderLine
   */
  public function setStartInfo(array $startInfo): OrderLine {
    $this->startInfo = $startInfo;
    return $this;
  }

  /**
   * @return string
   */
  public function getRewardPartnerId(): string {
    return $this->rewardPartnerId;
  }

  /**
   * @param string $rewardPartnerId
   *
   * @return OrderLine
   */
  public function setRewardPartnerId(string $rewardPartnerId): OrderLine {
    $this->rewardPartnerId = $rewardPartnerId;
    return $this;
  }

  /**
   * @return string
   */
  public function getRewardId(): string {
    return $this->rewardId;
  }

  /**
   * @param string $rewardId
   *
   * @return OrderLine
   */
  public function setRewardId(string $rewardId): OrderLine {
    $this->rewardId = $rewardId;
    return $this;
  }

  /**
   * @return \ConnectID\Api\DataModel\Address
   */
  public function getReceiver(): \ConnectID\Api\DataModel\Address {
    return $this->receiver;
  }

  /**
   * @param \ConnectID\Api\DataModel\Address $receiver
   *
   * @return OrderLine
   */
  public function setReceiver(\ConnectID\Api\DataModel\Address $receiver): OrderLine {
    $this->receiver = $receiver;
    return $this;
  }

  /**
   * @return \ConnectID\Api\DataModel\Address
   */
  public function getRecruiter(): \ConnectID\Api\DataModel\Address {
    return $this->recruiter;
  }

  /**
   * @param \ConnectID\Api\DataModel\Address $recruiter
   *
   * @return OrderLine
   */
  public function setRecruiter(\ConnectID\Api\DataModel\Address $recruiter): OrderLine {
    $this->recruiter = $recruiter;
    return $this;
  }



}

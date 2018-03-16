<?php

namespace ConnectID\Api\DataModel;


class OrderStatus extends BasicData {

  /**
   * @var string
   */
  protected $orderId;

  /**
   * @var string
   */
  protected $externalOrderId;

  /**
   * @var \DateTimeInterface
   */
  protected $orderTime;

  /**
   * @var string
   */
  protected $orderStatus;

  /**
   * @var float
   */
  protected $orderAmount;

  /**
   * @return string
   */
  public function getOrderId(): string {
    return $this->orderId;
  }

  /**
   * @param string $orderId
   *
   * @return OrderStatus
   */
  public function withOrderId(string $orderId): OrderStatus {
    $this->orderId = $orderId;
    return $this;
  }

  /**
   * @return string|null
   */
  public function getExternalOrderId(): ?string {
    return $this->externalOrderId;
  }

  /**
   * @param string $externalOrderId
   *
   * @return OrderStatus
   */
  public function withExternalOrderId(?string $externalOrderId): OrderStatus {
    $this->externalOrderId = $externalOrderId;
    return $this;
  }

  /**
   * @return \DateTimeInterface
   */
  public function getOrderTime(): \DateTimeInterface {
    return $this->orderTime;
  }

  /**
   * @param \DateTimeInterface $orderTime
   *
   * @return OrderStatus
   */
  public function withOrderTime($orderTime): OrderStatus {
    if ($orderTime) {
      $this->orderTime = $this->getDateTimeFromData($orderTime);
    }
    return $this;
  }

  /**
   * @return string
   */
  public function getOrderStatus(): string {
    return $this->orderStatus;
  }

  /**
   * @param string $orderStatus
   *
   * @return OrderStatus
   */
  public function withOrderStatus(string $orderStatus): OrderStatus {
    $this->orderStatus = $orderStatus;
    return $this;
  }

  /**
   * @return int
   */
  public function getOrderAmount(): ?float {
    return $this->orderAmount;
  }

  /**
   * @param float $orderAmount
   *
   * @return OrderStatus
   */
  public function withOrderAmount($orderAmount): OrderStatus {
    if (is_numeric($orderAmount)) {
      $this->orderAmount = floatval($orderAmount);
    }
    elseif (!empty($orderAmount)) {
      throw new \InvalidArgumentException("Invalid numeric value: " . $orderAmount);
    }
    return $this;
  }

  
}

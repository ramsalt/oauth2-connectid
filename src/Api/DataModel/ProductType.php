<?php

namespace ConnectID\Api\DataModel;


class ProductType extends BasicType {

  /**
   * @var string
   */
  protected $companyCode;

  /**
   * @var string
   */
  protected $product;

  /**
   * @var string
   */
  protected $description;

  /**
   * @var string
   */
  protected $productType;

  /**
   * @var \DateTimeImmutable
   */
  protected $startTime;

  /**
   * @var \DateTimeImmutable
   */
  protected $endTime;

  /**
   * @var float
   */
  protected $weight;

  /**
   * @var string
   */
  protected $campaigns;

  /**
   * @var string
   */
  protected $currency;

  /**
   * @var float
   */
  protected $webOfferPrice;

  /**
   * @var float
   */
  protected $retailPrice;

  /**
   * @var float
   */
  protected $vatPercent;

  /**
   * @var bool
   */
  protected $digital;

  /**
   * @inheritdoc
   */
  public function getId(): string {
    return $this->getCompanyCode() . ':' . $this->getProduct();
  }

  /**
   * @return string
   */
  public function getCompanyCode(): string {
    return $this->companyCode ?: '';
  }

  /**
   * @param string $companyCode
   *
   * @return ProductType
   */
  public function withCompanyCode(string $companyCode): ProductType {
    $this->companyCode = $companyCode;
    return $this;
  }

  /**
   * @return string
   */
  public function getProduct(): string {
    return $this->product ?: '';
  }

  /**
   * @param string $product
   *
   * @return ProductType
   */
  public function withProduct(string $product): ProductType {
    $this->product = $product;
    return $this;
  }

  /**
   * @return string
   */
  public function getDescription(): string {
    return $this->description ?: '';
  }

  /**
   * @param string $description
   *
   * @return ProductType
   */
  public function withDescription(string $description): ProductType {
    $this->description = $description;
    return $this;
  }

  /**
   * @return string
   */
  public function getProductType(): string {
    return $this->productType ?: '';
  }

  /**
   * @param string $productType
   *
   * @return ProductType
   */
  public function withProductType(?string $productType): ProductType {
    $this->productType = $productType;
    return $this;
  }

  /**
   * @return \DateTimeImmutable
   */
  public function getStartTime(): ?\DateTimeImmutable {
    return $this->startTime;
  }

  /**
   * @param \DateTimeImmutable|\DateTime|int $startTime
   *   Either a \DateTimeImmutable, a \DateTime object or a unix timestamp (UTC).
   *
   * @return ProductType
   */
  public function withStartTime($timeValue): ProductType {
    $this->startTime = $this->getDateTimeFromData($timeValue);

    return $this;
  }

  /**
   * @return \DateTimeImmutable
   */
  public function getEndTime(): ?\DateTimeImmutable {
    return $this->endTime;
  }

  /**
   * @param \DateTimeImmutable|\DateTime|int $startTime
   *   Either a \DateTimeImmutable, a \DateTime object or a unix timestamp (UTC).
   *
   * @return ProductType
   */
  public function withEndTime($timeValue): ProductType {
    $this->startTime = $this->getDateTimeFromData($timeValue);
    return $this;
  }

  /**
   * @return float
   */
  public function getWeight(): ?float {
    return $this->weight;
  }

  /**
   * @param float $weight
   *
   * @return ProductType
   */
  public function withWeight($weight): ProductType {
    if (is_numeric($weight)) {
      $this->weight = (float) $weight;
    }
    elseif (!empty($weight)) {
      throw new \InvalidArgumentException("Invalid numeric value: " . $weight);
    }
    return $this;
  }

  /**
   * @return string
   */
  public function getCampaigns(): string {
    return $this->campaigns ?: '';
  }

  /**
   * @param string $campaigns
   *
   * @return ProductType
   */
  public function withCampaigns(?string $campaigns): ProductType {
    $this->campaigns = $campaigns;
    return $this;
  }

  /**
   * @return string
   */
  public function getCurrency(): string {
    return $this->currency ?: '';
  }

  /**
   * @param string $currency
   *
   * @return ProductType
   */
  public function withCurrency(?string $currency): ProductType {
    $this->currency = $currency;
    return $this;
  }

  /**
   * @return float
   */
  public function getWebOfferPrice(): ?float {
    return $this->webOfferPrice;
  }

  /**
   * @param float $webOfferPrice
   *
   * @return ProductType
   */
  public function withWebOfferPrice($webOfferPrice): ProductType {
    if (is_numeric($webOfferPrice)) {
      $this->webOfferPrice = (float) $webOfferPrice;
    }
    elseif (!empty($webOfferPrice)) {
      throw new \InvalidArgumentException("Invalid numeric value: " . $webOfferPrice);
    }

    return $this;
  }

  /**
   * @return float
   */
  public function getRetailPrice(): ?float {
    return $this->retailPrice;
  }

  /**
   * @param float $retailPrice
   *
   * @return ProductType
   */
  public function withRetailPrice($retailPrice): ProductType {
    if (is_numeric($retailPrice)) {
      $this->retailPrice = (float) $retailPrice;
    }
    elseif (!empty($retailPrice)) {
      throw new \InvalidArgumentException("Invalid numeric value: " . $retailPrice);
    }

    return $this;
  }

  /**
   * @return float
   */
  public function getVatPercent(): float {
    return $this->vatPercent;
  }

  /**
   * @param float $vatPercent
   *
   * @return ProductType
   */
  public function withVatPercent($vatPercent): ProductType {
    if (!is_numeric($vatPercent)) {
      throw new \InvalidArgumentException("Invalid numeric value: " . $vatPercent);
    }
    $this->vatPercent = (float) $vatPercent;
    return $this;
  }

  /**
   * @return bool
   */
  public function isDigital(): bool {
    return $this->digital;
  }

  /**
   * @param bool $digital
   *
   * @return ProductType
   */
  public function withDigital($digital): ProductType {
    $this->digital = (bool) $digital;
    return $this;
  }
}

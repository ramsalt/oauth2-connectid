<?php

namespace ConnectID\Api\DataModel;


class ProductType {

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
   * Holds any additional information.
   *
   * @var array
   */
  protected $extra;

  public static function create(array $data) {
    $product = new static();
    foreach ($data as $key => $datum) {
      // If it's product property jsut set on the right location
      // otherwise store it in the "extra" array
      if (property_exists($product, $key)) {
        $product->{$key} = $datum;
      } else {
        $product->extra[$key] = $datum;
      }
    }

    return $product;
  }

  /**
   * @return string
   */
  public function getCompanyCode(): string {
    return $this->companyCode;
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
    return $this->product;
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
    return $this->description;
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
    return $this->productType;
  }

  /**
   * @param string $productType
   *
   * @return ProductType
   */
  public function withProductType(string $productType): ProductType {
    $this->productType = $productType;
    return $this;
  }

  /**
   * @return \DateTimeImmutable
   */
  public function getStartTime(): \DateTimeImmutable {
    return $this->startTime;
  }

  /**
   * @param \DateTimeImmutable $startTime
   *
   * @return ProductType
   */
  public function withStartTime(\DateTimeImmutable $startTime): ProductType {
    $this->startTime = $startTime;
    return $this;
  }

  /**
   * @return \DateTimeImmutable
   */
  public function getEndTime(): \DateTimeImmutable {
    return $this->endTime;
  }

  /**
   * @param \DateTimeImmutable $endTime
   *
   * @return ProductType
   */
  public function withEndTime(\DateTimeImmutable $endTime): ProductType {
    $this->endTime = $endTime;
    return $this;
  }

  /**
   * @return float
   */
  public function getWeight(): float {
    return $this->weight;
  }

  /**
   * @param float $weight
   *
   * @return ProductType
   */
  public function withWeight(float $weight): ProductType {
    $this->weight = $weight;
    return $this;
  }

  /**
   * @return string
   */
  public function getCampaigns(): string {
    return $this->campaigns;
  }

  /**
   * @param string $campaigns
   *
   * @return ProductType
   */
  public function withCampaigns(string $campaigns): ProductType {
    $this->campaigns = $campaigns;
    return $this;
  }

  /**
   * @return string
   */
  public function getCurrency(): string {
    return $this->currency;
  }

  /**
   * @param string $currency
   *
   * @return ProductType
   */
  public function withCurrency(string $currency): ProductType {
    $this->currency = $currency;
    return $this;
  }

  /**
   * @return float
   */
  public function getWebOfferPrice(): float {
    return $this->webOfferPrice;
  }

  /**
   * @param float $webOfferPrice
   *
   * @return ProductType
   */
  public function withWebOfferPrice(float $webOfferPrice): ProductType {
    $this->webOfferPrice = $webOfferPrice;
    return $this;
  }

  /**
   * @return float
   */
  public function getRetailPrice(): float {
    return $this->retailPrice;
  }

  /**
   * @param float $retailPrice
   *
   * @return ProductType
   */
  public function withRetailPrice(float $retailPrice): ProductType {
    $this->retailPrice = $retailPrice;
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
  public function withVatPercent(float $vatPercent): ProductType {
    $this->vatPercent = $vatPercent;
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
  public function withDigital(bool $digital): ProductType {
    $this->digital = $digital;
    return $this;
  }

  public function toArray(): array {
    $properties = get_object_vars($this);
    if (!empty($properties['extra'])) {
      // There should be no overlap due to the fact that we set 'extra' to be any
      // non-class property in the constructor.
      foreach ($properties['extra'] as $extra_key => $extra_property){
        $properties[$extra_key] = $extra_property;
      }
    }
    // Remove this key as it's "internal"
    unset($properties['extra']);
    // Remove NULL values, but leave other false/zero values
    array_filter($properties, function ($value){
      return ! is_null($value);
    });

    return $properties;
  }

  /**
   * Magical method to fetch info from the $extra property.
   * @param $name
   */
  public function __get($name) {
    if (isset($this->extra[$name])) {
      return $this->extra[$name];
    }

    throw new \InvalidArgumentException("Missing property {$name}.");
  }
}

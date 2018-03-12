<?php

namespace ConnectID\Api\DataModel;


abstract class BasicData {

  /**
   * Holds any additional information.
   *
   * @var array
   */
  protected $extra = [];

  public static function create(array $data) {
    $object = new static();
    foreach ($data as $key => $datum) {
      // If it's product property jsut set on the right location
      // otherwise store it in the "extra" array
      $method_name = 'with' . ucfirst($key);
      if (method_exists($object, $method_name)) {
        $object->{$method_name}($datum);
      }
      elseif (property_exists($object, $key)) {
        $object->{$key} = $datum;
      } else {
        $object->extra[$key] = $datum;
      }
    }

    return $object;
  }

  public function toArray(): array {
    $properties = get_object_vars($this);
    if (!empty($properties['extra'])) {
      // There should be no overlap due to the fact that we set 'extra' to be any
      // non-class property in the constructor.
      foreach ($properties['extra'] as $extra_key => $extra_property) {
        $properties[$extra_key] = $extra_property;
      }
    }
    // Remove this key as it's "internal"
    unset($properties['extra']);
    foreach ($properties as $key => $value) {
      // Remove NULL values, but leave other false/zero values
      if (is_null($value)) {
        unset($properties[$key]);
      }
      // Format date with default format.
      elseif (is_object($value) && is_a($value, \DateTimeInterface::class)) {
        $properties[$key] = $this->getFormattedDate($value);
      }
      elseif (is_object($value) && method_exists($value, 'toArray')) {
        $properties[$key] = $value->toArray();
      }
    }

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

  /**
   * @param \DateTimeImmutable|\DateTime|int $value
   *   Either a \DateTimeImmutable, a \DateTime object or a unix timestamp (UTC).
   *
   * @return \DateTimeImmutable
   */
  protected function getDateTimeFromData($value) {
    $time_object = NULL;
    if (is_object($value)) {
      if (is_a($value, \DateTimeImmutable::class)) {
        $time_object = $value;
      }
      elseif (is_a($value, \DateTime::class)) {
        $time_object = \DateTimeImmutable::createFromMutable($value);
      }
      else {
        throw new \InvalidArgumentException("Invalid date time object: " . get_class($value));
      }
    }
    elseif (is_numeric($value)) {
      // seems silly but we could get the time in millisecond format
      // This checks if the resulting date is larger than a reasonable date (Friday, 11 June 2128)
      $far_future = 5000000000;
      if ($value > $far_future) {
        // Shrink down from milliseconds to seconds as timestamp.
        $value = (int) $value / 1000;
      }

      // UTC Time is defaulted
      $time_object = \DateTimeImmutable::createFromFormat('U', $value);
    }
    elseif(!empty($value)) {
      throw new \InvalidArgumentException("Time must be either a valid \DateTime(Immutable) object or a unix timestamp.");
    }

    return $time_object;
  }

  /**
   * Formats a \DateTime object
   *
   * @param \DateTimeInterface $dateTime
   * @param string $format
   *
   * @return string
   */
  protected function getFormattedDate(\DateTimeInterface $dateTime, $format = 'Y-m-d'): string {
    return $dateTime->format($format);
  }
}

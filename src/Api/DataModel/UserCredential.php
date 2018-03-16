<?php

namespace ConnectID\Api\DataModel;


class UserCredential extends BasicData {

  const TYPE_MAIL = 'A';
  const TYPE_MOBILE = 'B'; // sms-capable

  const VERIFICATION_USAFE_NOT_VERIFIED = 'notVerified';
  const VERIFICATION_NOT_REPEATED = 'notRepeatedCredential';
  const VERIFICATION_REPEATED_CRED = 'repeatedCredential';
  const VERIFICATION_EXTERNAL = 'externallyVerified';
  const VERIFICATION_LINK = 'verificationLink';
  const VERIFICATION_CODE = 'verificationCode';
  /** @deprecated  */
  const VERIFICATION_PASSWORD = 'enteredPassword';

  /** @var string */
  protected $value;

  /** @var string */
  protected $type;

  /** @var string */
  protected $verificationLevel;

  /**
   * @param string $value
   * @param string $type
   * @param string $verification
   *
   * @return mixed
   */
  public static function create(string $value, string $type, string $verification) {
    $credential = new static();

    return $credential
      ->withValue($value)
      ->withType($type)
      ->withVerificationLevel($verification);
  }

  /**
   * @return string
   */
  public function getValue(): string {
    return $this->value;
  }

  /**
   * @param string $value
   *
   * @return UserCredential
   */
  public function withValue(string $value): UserCredential {
    $this->value = $value;
    return $this;
  }

  /**
   * @return string
   */
  public function getType(): string {
    return $this->type;
  }

  /**
   * @param string $type
   *
   * @return UserCredential
   */
  public function withType(string $type): UserCredential {
    if (!self::validateType($type)) {
      throw new \InvalidArgumentException("Invalid 'credentialType' provided: '{$type}'.");
    }
    $this->type = $type;
    return $this;
  }

  /**
   * @return string
   */
  public function getVerificationLevel(): string {
    return $this->verificationLevel;
  }

  /**
   * @param string $verificationLevel
   *
   * @return UserCredential
   */
  public function withVerificationLevel(string $verificationLevel): UserCredential {
    if (!self::validateType($type)) {
      throw new \InvalidArgumentException("Invalid 'verificationLevel' provided: '{$verificationLevel}'.");
    }
    $this->verificationLevel = $verificationLevel;
    return $this;
  }

  

  /**
   * @param string $type
   *
   * @return bool
   */
  public static function validateType(string $type): bool {
    switch ($type) {
      case self::TYPE_MAIL:
      case self::TYPE_MOBILE:
        return TRUE;

      default:
        return FALSE;
    }
  }

  /**
   * @param string $level
   *
   * @return bool
   */
  public static function validateVerificationLevel(string $level): bool {
    switch ($level) {
      case self::VERIFICATION_USAFE_NOT_VERIFIED:
      case self::VERIFICATION_NOT_REPEATED:
      case self::VERIFICATION_REPEATED_CRED:
      case self::VERIFICATION_EXTERNAL:
      case self::VERIFICATION_LINK:
      case self::VERIFICATION_CODE:
        return TRUE;

      case self::VERIFICATION_PASSWORD:
        // TODO: Log deprecation.
        return TRUE;

      default:
        return FALSE;
    }
  }
}

<?php

namespace ConnectID\Api\DataModel;


class PaymentInfo extends BasicData {

  /**
   * @var string
   */
  protected $ticket;

  /**
   * @var string
   */
  protected $cardNumberMasked;

  /**
   * @var string
   */
  protected $expMonth;

  /**
   * @var string
   */
  protected $expYear;

  /**
   * @var string
   */
  protected $cardTypeName;

  /**
   * @var string
   */
  protected $transactionId;

  /**
   * @var string
   */
  protected $merchantId;

  /**
   * @var string
   */
  protected $ticketMerchantId;

  /**
   * @var bool
   */
  protected $secure3d;

  /**
   * @var bool
   */
  protected $verificationIdPresent;

  /**
   * @var bool
   */
  protected $enrolled;

  /**
   * @return string
   */
  public function getTicket(): string {
    return $this->ticket;
  }

  /**
   * @param string $ticket
   *
   * @return PaymentInfo
   */
  public function withTicket(string $ticket): PaymentInfo {
    $this->ticket = $ticket;
    return $this;
  }

  /**
   * @return string
   */
  public function getCardNumberMasked(): string {
    return $this->cardNumberMasked;
  }

  /**
   * @param string $cardNumberMasked
   *
   * @return PaymentInfo
   */
  public function withCardNumberMasked(string $cardNumberMasked): PaymentInfo {
    $this->cardNumberMasked = $cardNumberMasked;
    return $this;
  }

  /**
   * @return string
   */
  public function getExpMonth(): string {
    return $this->expMonth;
  }

  /**
   * @param string $expMonth
   *
   * @return PaymentInfo
   */
  public function withExpMonth(string $expMonth): PaymentInfo {
    $this->expMonth = $expMonth;
    return $this;
  }

  /**
   * @return string
   */
  public function getExpYear(): string {
    return $this->expYear;
  }

  /**
   * @param string $expYear
   *
   * @return PaymentInfo
   */
  public function withExpYear(string $expYear): PaymentInfo {
    $this->expYear = $expYear;
    return $this;
  }

  /**
   * @return string
   */
  public function getCardTypeName(): string {
    return $this->cardTypeName;
  }

  /**
   * @param string $cardTypeName
   *
   * @return PaymentInfo
   */
  public function withCardTypeName(string $cardTypeName): PaymentInfo {
    $this->cardTypeName = $cardTypeName;
    return $this;
  }

  /**
   * @return string
   */
  public function getTransactionId(): string {
    return $this->transactionId;
  }

  /**
   * @param string $transactionId
   *
   * @return PaymentInfo
   */
  public function withTransactionId(string $transactionId): PaymentInfo {
    $this->transactionId = $transactionId;
    return $this;
  }

  /**
   * @return string
   */
  public function getMerchantId(): string {
    return $this->merchantId;
  }

  /**
   * @param string $merchantId
   *
   * @return PaymentInfo
   */
  public function withMerchantId(string $merchantId): PaymentInfo {
    $this->merchantId = $merchantId;
    return $this;
  }

  /**
   * @return string
   */
  public function getTicketMerchantId(): string {
    return $this->ticketMerchantId;
  }

  /**
   * @param string $ticketMerchantId
   *
   * @return PaymentInfo
   */
  public function withTicketMerchantId(string $ticketMerchantId): PaymentInfo {
    $this->ticketMerchantId = $ticketMerchantId;
    return $this;
  }

  /**
   * @return bool
   */
  public function isSecure3d(): bool {
    return $this->secure3d;
  }

  /**
   * @param bool $secure3d
   *
   * @return PaymentInfo
   */
  public function withSecure3d(bool $secure3d): PaymentInfo {
    $this->setSecure3d($secure3d);
    return $this;
  }

  /**
   * @param bool $secure3d
   */
  public function setSecure3d(bool $secure3d) {
    $this->secure3d = $secure3d;
  }

  /**
   * @return bool
   */
  public function isVerificationIdPresent(): bool {
    return $this->verificationIdPresent;
  }

  /**
   * @param bool $verificationIdPresent
   *
   * @return PaymentInfo
   */
  public function withVerificationIdPresent(bool $verificationIdPresent): PaymentInfo {
    $this->setVerificationIdPresent($verificationIdPresent);
    return $this;
  }

  /**
   * @param bool $verificationIdPresent
   */
  public function setVerificationIdPresent(bool $verificationIdPresent) {
    $this->verificationIdPresent = $verificationIdPresent;
  }

  /**
   * @return bool
   */
  public function isEnrolled(): bool {
    return $this->enrolled;
  }

  /**
   * @param bool $enrolled
   *
   * @return PaymentInfo
   */
  public function withEnrolled(bool $enrolled): PaymentInfo {
    $this->setEnrolled($enrolled);
    return $this;
  }

  /**
   * @param bool $enrolled
   */
  public function setEnrolled(bool $enrolled) {
    $this->enrolled = $enrolled;
  }
}

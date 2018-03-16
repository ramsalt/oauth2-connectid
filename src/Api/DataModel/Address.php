<?php

namespace ConnectID\Api\DataModel;


class Address extends BasicData {

  /**
   * @var string
   */
  protected $customerNumber;

  /**
   * @var string
   */
  protected $companyRegistrationNumber;

  /**
   * @var string
   */
  protected $companyName;

  /**
   * @var string
   */
  protected $department;

  /**
   * @var string
   */
  protected $firstName;

  /**
   * @var string
   */
  protected $middleName;

  /**
   * @var string
   */
  protected $lastName;

  /**
   * @var string
   */
  protected $coAddress;

  /**
   * @var string
   */
  protected $street;

  /**
   * @var string
   */
  protected $streetNumber;

  /**
   * @var string
   */
  protected $entrance;

  /**
   * @var string
   */
  protected $floor;

  /**
   * @var string
   */
  protected $suite;

  /**
   * @var string
   */
  protected $postalCode;

  /**
   * @var string
   */
  protected $postalPlace;

  /**
   * @var string
   */
  protected $postalAddress;

  /**
   * @var string
   */
  protected $postalAddressPostalCode;

  /**
   * @var string
   */
  protected $postalAddressPostalPlace;

  /**
   * @var string
   */
  protected $countryCode;

  /**
   * @var \DateTimeImmutable
   */
  protected $birthDate;

  /**
   * @var string
   */
  protected $sex;

  /**
   * @var string[]
   */
  protected $emails;

  /**
   * @var string[]
   */
  protected $phoneNumbers;

  /**
   * @return string
   */
  public function getCustomerNumber(): string {
    return $this->customerNumber;
  }

  /**
   * @param string $customerNumber
   *
   * @return Address
   */
  public function withCustomerNumber(string $customerNumber): Address {
    $this->customerNumber = $customerNumber;
    return $this;
  }

  /**
   * @return string
   */
  public function getCompanyRegistrationNumber(): string {
    return $this->companyRegistrationNumber;
  }

  /**
   * @param string $companyRegistrationNumber
   *
   * @return Address
   */
  public function withCompanyRegistrationNumber(string $companyRegistrationNumber): Address {
    $this->companyRegistrationNumber = $companyRegistrationNumber;
    return $this;
  }

  /**
   * @return string
   */
  public function getCompanyName(): string {
    return $this->companyName;
  }

  /**
   * @param string $companyName
   *
   * @return Address
   */
  public function withCompanyName(string $companyName): Address {
    $this->companyName = $companyName;
    return $this;
  }

  /**
   * @return string
   */
  public function getDepartment(): string {
    return $this->department;
  }

  /**
   * @param string $department
   *
   * @return Address
   */
  public function withDepartment(string $department): Address {
    $this->department = $department;
    return $this;
  }

  /**
   * @return string
   */
  public function getFirstName(): string {
    return $this->firstName;
  }

  /**
   * @param string $firstName
   *
   * @return Address
   */
  public function withFirstName(string $firstName): Address {
    $this->firstName = $firstName;
    return $this;
  }

  /**
   * @return string
   */
  public function getMiddleName(): string {
    return $this->middleName;
  }

  /**
   * @param string $middleName
   *
   * @return Address
   */
  public function withMiddleName(string $middleName): Address {
    $this->middleName = $middleName;
    return $this;
  }

  /**
   * @return string
   */
  public function getLastName(): string {
    return $this->lastName;
  }

  /**
   * @param string $lastName
   *
   * @return Address
   */
  public function withLastName(string $lastName): Address {
    $this->lastName = $lastName;
    return $this;
  }

  /**
   * @return string
   */
  public function getCoAddress(): string {
    return $this->coAddress;
  }

  /**
   * @param string $coAddress
   *
   * @return Address
   */
  public function withCoAddress(string $coAddress): Address {
    $this->coAddress = $coAddress;
    return $this;
  }

  /**
   * @return string
   */
  public function getStreet(): string {
    return $this->street;
  }

  /**
   * @param string $street
   *
   * @return Address
   */
  public function withStreet(string $street): Address {
    $this->street = $street;
    return $this;
  }

  /**
   * @return string
   */
  public function getStreetNumber(): string {
    return $this->streetNumber;
  }

  /**
   * @param string $streetNumber
   *
   * @return Address
   */
  public function withStreetNumber(string $streetNumber): Address {
    $this->streetNumber = $streetNumber;
    return $this;
  }

  /**
   * @return string
   */
  public function getEntrance(): string {
    return $this->entrance;
  }

  /**
   * @param string $entrance
   *
   * @return Address
   */
  public function withEntrance(string $entrance): Address {
    $this->entrance = $entrance;
    return $this;
  }

  /**
   * @return string
   */
  public function getFloor(): string {
    return $this->floor;
  }

  /**
   * @param string $floor
   *
   * @return Address
   */
  public function withFloor(string $floor): Address {
    $this->floor = $floor;
    return $this;
  }

  /**
   * @return string
   */
  public function getSuite(): string {
    return $this->suite;
  }

  /**
   * @param string $suite
   *
   * @return Address
   */
  public function withSuite(string $suite): Address {
    $this->suite = $suite;
    return $this;
  }

  /**
   * @return string
   */
  public function getPostalCode(): string {
    return $this->postalCode;
  }

  /**
   * @param string $postalCode
   *
   * @return Address
   */
  public function withPostalCode(string $postalCode): Address {
    $this->postalCode = $postalCode;
    return $this;
  }

  /**
   * @return string
   */
  public function getPostalPlace(): string {
    return $this->postalPlace;
  }

  /**
   * @param string $postalPlace
   *
   * @return Address
   */
  public function withPostalPlace(string $postalPlace): Address {
    $this->postalPlace = $postalPlace;
    return $this;
  }

  /**
   * @return string
   */
  public function getPostalAddress(): string {
    return $this->postalAddress;
  }

  /**
   * @param string $postalAddress
   *
   * @return Address
   */
  public function withPostalAddress(string $postalAddress): Address {
    $this->postalAddress = $postalAddress;
    return $this;
  }

  /**
   * @return string
   */
  public function getPostalAddressPostalCode(): string {
    return $this->postalAddressPostalCode;
  }

  /**
   * @param string $postalAddressPostalCode
   *
   * @return Address
   */
  public function withPostalAddressPostalCode(string $postalAddressPostalCode): Address {
    $this->postalAddressPostalCode = $postalAddressPostalCode;
    return $this;
  }

  /**
   * @return string
   */
  public function getPostalAddressPostalPlace(): string {
    return $this->postalAddressPostalPlace;
  }

  /**
   * @param string $postalAddressPostalPlace
   *
   * @return Address
   */
  public function withPostalAddressPostalPlace(string $postalAddressPostalPlace): Address {
    $this->postalAddressPostalPlace = $postalAddressPostalPlace;
    return $this;
  }

  /**
   * @return string
   */
  public function getCountryCode(): string {
    return $this->countryCode;
  }

  /**
   * @param string $countryCode
   *
   * @return Address
   */
  public function withCountryCode(string $countryCode): Address {
    $this->countryCode = $countryCode;
    return $this;
  }

  /**
   * @return \DateTimeImmutable
   */
  public function getBirthDate(): \DateTimeImmutable {
    return $this->birthDate;
  }

  /**
   * @param \DateTimeImmutable $birthDate
   *
   * @return Address
   */
  public function withBirthDate(\DateTimeImmutable $birthDate): Address {
    $this->birthDate = $birthDate;
    return $this;
  }

  /**
   * @return string
   */
  public function getSex(): string {
    return $this->sex;
  }

  /**
   * @param string $sex
   *
   * @return Address
   */
  public function withSex(string $sex): Address {
    $this->sex = $sex;
    return $this;
  }

  /**
   * @return string[]
   */
  public function getEmails(): array {
    return $this->emails;
  }

  /**
   * @param string[] $emails
   *
   * @return Address
   */
  public function withEmails(array $emails): Address {
    $this->emails = $emails;
    return $this;
  }

  /**
   * @return string[]
   */
  public function getPhoneNumbers(): array {
    return $this->phoneNumbers;
  }

  /**
   * @param string[] $phoneNumbers
   *
   * @return Address
   */
  public function withPhoneNumbers(array $phoneNumbers): Address {
    $this->phoneNumbers = $phoneNumbers;
    return $this;
  }

}

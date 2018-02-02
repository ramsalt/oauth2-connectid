<?php
/**
 * Created by PhpStorm.
 * User: esolitos
 * Date: 01/02/2018
 * Time: 16:32
 */

namespace Ramsalt\OAuth2\Client\Provider;

/**
 * ConnectIdProfile
 *
 * {
 *   "customerNumber" : 176065,
 *   "name" : {
 *     "firstName" : "FirstName",
 *     "middleName" : "MiddleName",
 *     "lastName" : "LastName",
 *     "companyName" : "CompanyName",
 *    "departmentName" : "DepartmentName"
 *   },
 *     "phoneNumbers" : [ {
 *       "phoneNumber" : "+4723339131",
 *       "phoneNumberType" : "home"
 *     }, {
 *       "phoneNumber" : "+4798007663",
 *       "phoneNumberType" : "mobile"
 *     } ],
 *     "emails" : [ "firstname.lastname@mediaconnect.no", "test@mediaconnect.no" ]
 * }
 *
 *
 * @package Ramsalt\OAuth2\Client\Provider
 */
class ConnectIdProfile {

  /**
   * @var int
   */
  protected $customerNumber;

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
  protected $companyName;

  /**
   * @var array
   */
  protected $phoneNumbers = [];

  /**
   * @var array
   */
  protected $emailAddresses = [];

  /**
   * @return int
   */
  public function getCustomerNumber(): int {
    return $this->customerNumber;
  }

  /**
   * @param int $customerNumber
   *
   * @return ConnectIdProfile
   */
  public function setCustomerNumber(int $customerNumber): ConnectIdProfile {
    $this->customerNumber = $customerNumber;
    return $this;
  }

  /**
   * @param string $separator
   *
   * @return string
   */
  public function getFullName($separator = ' '): string {
    $full_name = [];

    if ($this->firstName) {
      $full_name[] = $this->firstName;
    }
    if ($this->middleName) {
      $full_name[] = $this->firstName;
    }
    if ($this->lastName) {
      $full_name[] = $this->firstName;
    }

    return implode($separator, $full_name);
  }

  /**
   * @param string $fullName
   * @param string $delimiter
   *
   * @return ConnectIdProfile
   */
  public function setFullNameFromString(string $fullName, string $delimiter): ConnectIdProfile {
    list($this->firstName, $this->middleName, $this->lastName) = explode($fullName, $delimiter);

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
   * @return ConnectIdProfile
   */
  public function setFirstName(string $firstName): ConnectIdProfile {
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
   * @return ConnectIdProfile
   */
  public function setMiddleName(string $middleName): ConnectIdProfile {
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
   * @return ConnectIdProfile
   */
  public function setLastName(string $lastName): ConnectIdProfile {
    $this->lastName = $lastName;
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
   * @return ConnectIdProfile
   */
  public function setCompanyName(string $companyName): ConnectIdProfile {
    $this->companyName = $companyName;
    return $this;
  }

  /**
   * @return array
   */
  public function getPhoneNumbers(): array {
    return $this->phoneNumbers;
  }

  /**
   * @param array $phoneNumbers
   *
   * @return ConnectIdProfile
   */
  public function setPhoneNumbers(array $phoneNumbers): ConnectIdProfile {
    $this->phoneNumbers = $phoneNumbers;
    return $this;
  }

  /**
   * @return array
   */
  public function getEmailAddresses(): array {
    return $this->emailAddresses;
  }

  /**
   * @param array $emailAddresses
   *
   * @return ConnectIdProfile
   */
  public function setEmailAddresses(array $emailAddresses): ConnectIdProfile {
    $this->emailAddresses = $emailAddresses;
    return $this;
  }

}

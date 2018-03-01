<?php
/**
 * Created by PhpStorm.
 * User: esolitos
 * Date: 01/02/2018
 * Time: 16:32
 */

namespace Ramsalt\OAuth2\Client\DataModel;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

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
class ConnectIdProfile implements ResourceOwnerInterface {

  const CREDENTIAL_EMAIL = 'A';

  const CREDENTIAL_MOBILE = 'B';

  /** @var string UUID */
  protected $uniqueId;

  /** @var int */
  protected $userId;

  /** @var int */
  protected $customerNumber;

  /** @var int */
  protected $firstName;

  /** @var string */
  protected $middleName;

  /** @var string */
  protected $lastName;

  /** @var string */
  protected $companyName;

  /** @var array */
  protected $phoneNumbers = [];

  /** @var array */
  protected $emails = [];

  /** @var string */
  protected $credential;

  /** @var string */
  protected $credentialType;

  /**
   * @internal Doesn't have any validation and content might vary.
   *
   * @var array Raw data from the API, decoded from JSON.
   */
  protected $rawData;

  /**
   * ConnectIdProfile constructor.
   *
   * @param array|null $raw_data
   */
  private function __construct($raw_data = NULL) {
    if (is_array($raw_data)) {
      $this->rawData = $raw_data;
    }
  }

  /**
   * @param array $data
   *
   * @return \Ramsalt\OAuth2\Client\Provider\ConnectIdProfile
   */
  public static function createFromApiResponse(array $data): ConnectIdProfile {
    $profile = new static($data);

    $mandatory_properties = [
      'userId'
    ];
    foreach ($mandatory_properties as $property_name) {
      if (empty($data[$property_name])) {
        throw new \InvalidArgumentException("Missing mandatory information: {$property_name}");
      }
    }



    // Simply import the databased on name
    self::setDataFromKeys($profile, $data);

    // Full Name is an array of parts, handle it separately.
    if (isset($data['name'])) {
      self::setDataFromKeys($profile, $data['name']);
    }

    if (isset($data['credential'])) {
      $profile->withCombinedCredential($data['credential']);
    }

    return $profile;
  }

  /**
   * @see self::getUserId()
   */
  public function getId() {
    return $this->getUserId();
  }

  /**
   * Sets the profile's value based on a associative array of data
   *
   * @see https://doc.mediaconnect.no/doc/ConnectID/v1/api/customer/profile.html
   * @see https://doc.mediaconnect.no/doc/ConnectID/v2/api/customer/profile.html
   *
   * @param \Ramsalt\OAuth2\Client\Provider\ConnectIdProfile $profile
   * @param array $data
   */
  public static function setDataFromKeys(ConnectIdProfile $profile, array $data) {
    foreach ($data as $key => $value) {
      // Use of ucfirst for adapt to methodCamelCase
      $setter_method = 'with' . ucfirst($key);

      if (!empty($value) && method_exists($profile, $setter_method)) {
        $profile->{$setter_method}($value);
      }
    }
  }

  /**
   * @return string
   */
  public function getUniqueId(): string {
    return $this->uniqueId ?: '';
  }

  /**
   * @param string $uniqueId
   *
   * @return ConnectIdProfile
   */
  public function withUniqueId(string $uniqueId): ConnectIdProfile {
    $this->uniqueId = $uniqueId;
    return $this;
  }

  /**
   * @return int|null
   */
  public function getUserId(): ?int {
    return $this->userId;
  }

  /**
   * @param int $userId
   *
   * @return ConnectIdProfile
   */
  public function withUserId(string $userId): ConnectIdProfile {
    $this->userId = $userId;
    return $this;
  }

  /**
   * @return string|null
   */
  public function getCustomerNumber(): ?string {
    return $this->customerNumber;
  }

  /**
   * @param int $customerNumber
   *
   * @return ConnectIdProfile
   */
  public function withCustomerNumber(string $customerNumber): ConnectIdProfile {
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
   * @return string
   */
  public function getFirstName(): string {
    return $this->firstName ?: '';
  }

  /**
   * @param string $firstName
   *
   * @return ConnectIdProfile
   */
  public function withFirstName(string $firstName): ConnectIdProfile {
    $this->firstName = $firstName;
    return $this;
  }

  /**
   * @return string
   */
  public function getMiddleName(): string {
    return $this->middleName ?: '';
  }

  /**
   * @param string $middleName
   *
   * @return ConnectIdProfile
   */
  public function withMiddleName(string $middleName): ConnectIdProfile {
    $this->middleName = $middleName;
    return $this;
  }

  /**
   * @return string
   */
  public function getLastName(): string {
    return $this->lastName ?: '';
  }

  /**
   * @param string $lastName
   *
   * @return ConnectIdProfile
   */
  public function withLastName(string $lastName): ConnectIdProfile {
    $this->lastName = $lastName;
    return $this;
  }

  /**
   * @return string
   */
  public function getCompanyName(): string {
    return $this->companyName ?: '';
  }

  /**
   * @param string $companyName
   *
   * @return ConnectIdProfile
   */
  public function withCompanyName(string $companyName): ConnectIdProfile {
    $this->companyName = $companyName;
    return $this;
  }

  /**
   * @return array
   */
  public function getPhoneNumbers(): array {
    return $this->phoneNumbers ?: [];
  }

  /**
   * @param array $numbers
   *
   * @return ConnectIdProfile
   */
  public function withPhoneNumbers(array $numbers): ConnectIdProfile {
    foreach ($numbers as $number) {
      if (isset($number['phoneNumber'])) {
        $this->addPhoneNumber((string) $number['phoneNumber']);
      }
    }

    return $this;
  }

  public function addPhoneNumber(string $number): ConnectIdProfile {
    $this->phoneNumbers[] = $number;
    $this->phoneNumbers = array_unique($this->phoneNumbers);

    return $this;
  }

  /**
   * @return array
   */
  public function getEmails(): array {
    return $this->emails ?: [];
  }

  /**
   * @param array $emailAddresses
   *
   * @return ConnectIdProfile
   */
  public function withEmails(array $emailAddresses): ConnectIdProfile {
    foreach ($emailAddresses as $address) {
      $this->addEmail((string) $address);
    }

    return $this;
  }
  /**
   * @param string $address
   *
   * @return ConnectIdProfile
   */
  public function addEmail(string $address): ConnectIdProfile {
    if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
      throw new \InvalidArgumentException("This is not a valid email address: {$address}");
    }

    $this->emails[] = $address;
    $this->emails = array_unique($this->emails);
    return $this;
  }

  /**
   * @return string User's credentials
   */
  public function getCredential(): string {
    return $this->credential ?: '';
  }

  /**
   * @return string User's credentials
   */
  public function getCredentialType(): string {
    return $this->credentialType ?: '';
  }

  /**
   * @return bool
   */
  public function usesEmailCredential() {
    return $this->credentialType === self::CREDENTIAL_EMAIL;
  }

  /**
   * @return bool
   */
  public function usesMobileCredential() {
    return $this->credentialType === self::CREDENTIAL_MOBILE;
  }

  /**
   * @param array $credential
   *
   * @return \Ramsalt\OAuth2\Client\Provider\ConnectIdProfile
   */
  public function withCombinedCredential(array $credential): ConnectIdProfile {
    /*
     * Use this ugly workaround to prevent self::setDataFromKeys() from setting
     *  this value as it is composed.
     */
    $this->credential = $credential['credential'];
    $this->credentialType = $credential['credentialType'];


    return $this;
  }

  /**
   * @return array
   */
  public function toArray() {
    // TODO: Implement!
    return [];
  }
}

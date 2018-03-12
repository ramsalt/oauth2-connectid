<?php

namespace Ramsalt\OAuth2\Client\Provider;


use ConnectID\Api\DataModel\CouponType;
use ConnectID\Api\DataModel\CouponTypeList;
use ConnectID\Api\DataModel\Order;
use ConnectID\Api\DataModel\OrdersOverview;
use ConnectID\Api\DataModel\OrderStatus;
use ConnectID\Api\DataModel\ProductType;
use ConnectID\Api\DataModel\ProductTypeList;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;
use Ramsalt\OAuth2\Client\Provider\Exception\InvalidAccessTokenException;
use Ramsalt\OAuth2\Client\Provider\Exception\InvalidApiResponseException;
use Ramsalt\OAuth2\Client\Provider\Exception\InvalidGrantException;
use ConnectID\Api\DataModel\ConnectIdProfile;

class ConnectId extends AbstractProvider {

  const ERROR_AUTH_INVALID_TOKEN = 'invalid_token';
  const ERROR_AUTH_INVALID_GRANT = 'invalid_grant';

  use BearerAuthorizationTrait;
  /*
   * https://connectid.no/user/
   * https://api-test.mediaconnect.no/login/
   *
   * https://api.mediaconnect.no/capi
   * https://api-test.mediaconnect.no/capi/
   */

  protected $testing = FALSE;

  public function getBaseAuthorizationUrl() {
    return $this->getOAuthUrl('authorize');
  }

  public function getBaseAccessTokenUrl(array $params) {
    return $this->getOAuthUrl('token');
  }

  protected function getAccessTokenUrl(array $params) {
    $url = $this->getBaseAccessTokenUrl($params);
    // ConnectID expects the parameters in the urls not the body also for the POST
    $query = $this->getAccessTokenQuery($params);
    return $this->appendQuery($url, $query);
  }

  public function getResourceOwnerDetailsUrl(AccessToken $token) {
    return $this->getClientApiUrl('v1/customer/profile');
  }

  protected function getDefaultScopes() {
    return [];
  }

  protected function getDefaultHeaders() {
    $http_headers = parent::getDefaultHeaders();

    $http_headers['accept'] = 'application/json';

    return $http_headers;
  }

  /**
   * @param \Psr\Http\Message\ResponseInterface $response
   * @param array|string $data
   *
   * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
   */
  protected function checkResponse(ResponseInterface $response, $data) {
    $statusCode = $response->getStatusCode();

    // Exception on the other side
    if ($statusCode == 400 && isset($data['exceptionType'], $data['errorMessage'])) {
      throw new InvalidApiResponseException(
        "[{$data['exceptionType']}] {$data['errorMessage']}",
        $statusCode,
        $response
      );
    }

    if ($statusCode == 400 && $data['error'] == self::ERROR_AUTH_INVALID_GRANT) {
      throw new InvalidGrantException(
        $data['error_description'] ?? $data['error'],
        $statusCode,
        $response
      );
    }

    // Check if the error is to be attributed to an expired Access Token.
    if ($statusCode == 401 && $data['error'] == self::ERROR_AUTH_INVALID_TOKEN) {
      throw new InvalidAccessTokenException(
        $data['error_description'] ?? $data['error'],
        $statusCode,
        $response
      );
    }

    // Fallback to a generic exception
    if ($statusCode >= 400) {
      if (isset($data['error_description'])) {
        $message = $data['error_description'];
      } elseif (isset($data['errorMessage'])) {
        $message = $data['exceptionType'] . ' => ' . $data['errorMessage'];
      } else {
        $message = $response->getReasonPhrase();
      }

      throw new InvalidApiResponseException($message, $statusCode, $response);
    }
  }

  protected function createResourceOwner(array $response, AccessToken $token) {
    return ConnectIdProfile::createFromApiResponse($response);
  }

  /**
   * Returns the url for login authentication process.
   *
   * @param string $extra_path
   *
   * @return string
   */
  protected function getOAuthUrl(string $extra_path) {
    return $this->getLoginApiUrl("oauth/{$extra_path}");
  }

  /**
   * Returns the url for login authentication process.
   *
   * @param string $extra_path
   *
   * @return string
   */
  protected function getLoginApiUrl(string $extra_path) {
    $base = ($this->testing) ? 'api-test.mediaconnect.no/login' : 'connectid.no/user';

    return "https://{$base}/{$extra_path}";
  }

  /**
   * @param string $extra_path
   *
   * @return string
   */
  protected function getClientApiUrl(string $extra_path) {
    $domain = ($this->testing) ? 'api-test.mediaconnect.no' : 'api.mediaconnect.no';

    return "https://{$domain}/capi/{$extra_path}";
  }

  /**
   * @param \League\OAuth2\Client\Token\AccessToken $token
   *
   * @return \League\OAuth2\Client\Token\AccessToken
   */
  public function getRefreshedAccessToken(AccessToken $accessToken) {
    $fresh_access_token = $this->getAccessToken('refresh_token', [
      'refresh_token' => $accessToken->getRefreshToken(),
    ]);

    return $fresh_access_token;
  }

  /**
   * @param \League\OAuth2\Client\Token\AccessToken $accessToken
   *
   * @return \League\OAuth2\Client\Token\AccessToken
   */
  public function getClientCredentialsAccessToken() {
    $client_credentials_token = $this->getAccessToken('client_credentials');

    return $client_credentials_token;
  }

  /* ========================= ConnectID API ========================= */

  /**
   *
   * @see https://doc.mediaconnect.no/doc/ConnectID/v1/api/customer/product.html#Product_API
   *
   * @param \League\OAuth2\Client\Token\AccessToken $token
   *
   * @return array
   */
  public function getApiCustomerProduct(AccessToken $token): array {
    $url = $this->getClientApiUrl('v1/customer/product');
    // $options['headers'], $options['body'], $options['version']
    $request = $this->getAuthenticatedRequest(self::METHOD_GET, $url, $token);

    $response = $this->getParsedResponse($request);

    if (false === is_array($response)) {
      throw new UnexpectedValueException(
        'Invalid response received from Authorization Server. Expected JSON.'
      );
    }

    // Get the new token for client credentials
    $this->getAccessToken('client_credentials');

    return $response;
  }

  /**
   *
   * @see https://doc.mediaconnect.no/doc/ConnectID/v1/api/order.html#PaymentInfo
   *
   * @param \League\OAuth2\Client\Token\AccessToken $accessToken
   *
   * @return \ConnectID\Api\DataModel\OrdersOverview
   */
  public function getApiOrdersOverview(AccessToken $accessToken): OrdersOverview {
    $url = $this->getClientApiUrl('v1/order/status');
    $request = $this->getAuthenticatedRequest(self::METHOD_GET, $url, $token, $options);
    $response = $this->getParsedResponse($request);

    if (false === is_array($response)) {
      throw new UnexpectedValueException(
        'Invalid response received from Authorization Server. Expected JSON.'
      );
    }

    return $response;
  }

  /**
   *
   * @see https://doc.mediaconnect.no/doc/ConnectID/v1/api/order.html#PaymentInfo
   *
   * @param \League\OAuth2\Client\Token\AccessToken $accessToken
   *
   * @return \ConnectID\Api\DataModel\OrderStatus[]
   */
  public function getClientApiOrderStatus(string $orderId): OrderStatus {
    $url = $this->getClientApiUrl('v1/client/order/status/'.$orderId);
    $accessToken = $this->getClientCredentialsAccessToken();

    $request = $this->getAuthenticatedRequest(self::METHOD_GET, $url, $accessToken)
      ->withAddedHeader('Content-Type', 'application/json');
    $response = $this->getParsedResponse($request);

    if (false === is_array($response) || !isset($response['orders'])) {
      throw new UnexpectedValueException(
        'Invalid response received from Authorization Server. Expected JSON.'
      );
    }

    // Always one order will be returned.
    $order_data = reset($response['orders']);

    return OrderStatus::create($order_data);;
  }

  /**
   * @param \League\OAuth2\Client\Token\AccessToken $accessToken
   * @param \ConnectID\Api\DataModel\Order $order
   *
   * @return \ConnectID\Api\DataModel\Order
   */
  public function submitApiOrder(AccessToken $accessToken, Order $order) {
    $url = $this->getClientApiUrl('v1/order');
    $options = [
      'body' => $order->toJson(),
    ];
    $request = $this->getAuthenticatedRequest(self::METHOD_POST, $url, $accessToken, $options)
      ->withAddedHeader('Content-Type', 'application/json');

    $response = $this->getParsedResponse($request);

    if (false === is_array($response) || !isset($response['orderId'])) {
      throw new UnexpectedValueException(
        'Invalid response received from Authorization Server. Expected JSON.'
      );
    }

    $order->withOrderId($response['orderId']);

    return $order;
  }

  /**
   * @param \ConnectID\Api\DataModel\Order $order
   *
   * @return string
   */
  public function getCompleteOrderUrl(Order $order, string $returnUrl, string $errorUrl) {
    $params = [
      'clientId'  => $this->clientId,
      'orderId'   => $order->getOrderId(),
      'returnUrl' => $returnUrl,
      'errorUrl'  => $errorUrl,
    ];

    $url = $this->getLoginApiUrl('order');
    // ConnectID expects the parameters in the urls not the body also for the POST
    $query = $this->getAccessTokenQuery($params);

    return $this->appendQuery($url, $query);
  }

  /**
   * @param \League\OAuth2\Client\Token\AccessToken $accessToken
   *
   * @return ProductTypeList
   */
  public function getClientApiProducts(AccessToken $accessToken) {
    $url = $this->getClientApiUrl('v1/client/product');
    $request = $this->getAuthenticatedRequest(self::METHOD_GET, $url, $accessToken);
    $response = $this->getParsedResponse($request);

    if (!is_array($response) || !isset($response['products'])) {
      throw new UnexpectedValueException(
        'Invalid response received from API Server. Exp[ected json with a "products" key.'
      );
    }

    return ProductTypeList::fromDataArray($response['products']);
  }

  /**
   * @param \League\OAuth2\Client\Token\AccessToken $accessToken
   *
   * @return ProductTypeList
   */
  public function getClientApiCoupons(AccessToken $accessToken, ProductType $productType) {
    $url = $this->getClientApiUrl('v1/client/coupon/' . $productType->getProduct());
    $request = $this->getAuthenticatedRequest(self::METHOD_GET, $url, $accessToken);
    $response = $this->getParsedResponse($request);

    if (!is_array($response) || !isset($response['coupons'])) {
      throw new \UnexpectedValueException(
        'Invalid response received from API Server. Expected json with a "products" key.'
      );
    }

    return CouponTypeList::fromDataArray($response['coupons']);
  }
}

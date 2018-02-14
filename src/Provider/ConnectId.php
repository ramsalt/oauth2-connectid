<?php

namespace Ramsalt\OAuth2\Client\Provider;


use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;
use Ramsalt\OAuth2\Client\Provider\Exception\ExpiredTokenException;

class ConnectId extends AbstractProvider {

  const ERROR_AUTH_INVALID_TOKEN = 'invalid_token';

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
    return $this->getLoginUrl('authorize');
  }

  public function getBaseAccessTokenUrl(array $params) {
    return $this->getLoginUrl('token');
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

    // Check if the error is to be attributed to an expired Access Token.
    if ($statusCode == 401 && $data['error'] == self::ERROR_AUTH_INVALID_TOKEN) {
      throw new ExpiredTokenException(
        $data['error_description'],
        $statusCode,
        $response
      );
    }

    // Fallback to a generic exception
    if ($statusCode >= 400) {
      throw new IdentityProviderException(
        isset($data['error_description']) ? $data['error_description'] : $response->getReasonPhrase(),
        $statusCode,
        $response
      );
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
  protected function getLoginUrl(string $extra_path) {
    $base = ($this->testing) ? 'api-test.mediaconnect.no/login' : 'connectid.no/user';

    return "https://{$base}/oauth/{$extra_path}";
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
  public function getRefreshedAccessToken(AccessToken $token) {
    $fresh_access_token = $this->getAccessToken('refresh_token', [
      'refresh_token' => $token->getRefreshToken(),
    ]);

    return $fresh_access_token;
  }

  /* ========================= ConnectID API ========================= */

  public function getApiCustomerProduct(AccessToken $token) {
    $url = $this->getClientApiUrl('v1/customer/product');
    // $options['headers'], $options['body'], $options['version']
    $request = $this->getAuthenticatedRequest(self::METHOD_GET, $url, $token);

    $response = $this->getParsedResponse($request);

    if (false === is_array($response)) {
      throw new UnexpectedValueException(
        'Invalid response received from Authorization Server. Expected JSON.'
      );
    }

    return $response;
  }
}

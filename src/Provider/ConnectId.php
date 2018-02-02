<?php

namespace Ramsalt\OAuth2\Client\Provider;


use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class ConnectId extends AbstractProvider {

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

  public function getResourceOwnerDetailsUrl(AccessToken $token) {
    return $this->getClientApiUrl('/v1/customer/profile ');
  }

  protected function getDefaultScopes() {
    return [];
  }

  /**
   * @param \Psr\Http\Message\ResponseInterface $response
   * @param array|string $data
   *
   * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
   */
  protected function checkResponse(ResponseInterface $response, $data) {
    $statusCode = $response->getStatusCode();
    if ($statusCode >= 400) {
      throw new IdentityProviderException(
        isset($data['description']) ? $data['description'] : $response->getReasonPhrase(),
        $statusCode,
        $response
      );
    }
  }

  protected function createResourceOwner(array $response, AccessToken $token) {
    $foo = $response;
  }

  /**
   * Returns the url for login authentication process.
   *
   * @param string $extra_path
   *
   * @return string
   */
  protected function getLoginUrl(string $extra_path) {
    $domain = ($this->testing) ? 'api-test.mediaconnect.no' : 'connectid.no';

    return "https://{$domain}/user/oauth/{$extra_path}";
  }

  /**
   * @param string $extra_path
   *
   * @return string
   */
  protected function getClientApiUrl(string $extra_path) {
    $domain = ($this->testing) ? 'api-test.mediaconnect.no' : 'api.connectid.no';

    return "https://{$domain}/capi/{$extra_path}";
  }

}

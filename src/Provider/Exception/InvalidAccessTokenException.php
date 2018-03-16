<?php

namespace Ramsalt\OAuth2\Client\Provider\Exception;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class InvalidAccessTokenException extends IdentityProviderException {

  public function __construct(string $message, int $code, ResponseInterface $response) {
    parent::__construct($message, $code, $response);
  }
}

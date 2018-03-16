<?php

namespace Ramsalt\OAuth2\Client\Provider\Exception;


class InvalidApiResponseException extends \Exception
{
  /**
   * @var mixed
   */
  protected $response;

  /**
   * @param string $message
   * @param int $code
   * @param array|string $response The response body
   */
  public function __construct($message, $code, $response)
  {
    $this->response = $response;

    parent::__construct($message, $code);
  }

  /**
   * Returns the exception's response body.
   *
   * @return array|string
   */
  public function getResponseBody()
  {
    return $this->response;
  }
}

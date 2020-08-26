<?php


namespace Ramsalt\OAuth2\Client\Provider;


/**
 * @see https://connectid.no/user/
 * @see https://api-test.mediaconnect.no/login/
 *
 * @see https://api.mediaconnect.no/capi
 * @see https://api-test.mediaconnect.no/capi/
 */
final class Endpoints {

  public static function getBaseAuthorizationUrl(bool $testing = FALSE): string {
    return self::getOAuthUrl('authorize', $testing);
  }

  public static function getBaseAccessTokenUrl(bool $testing = FALSE) {
    return self::getOAuthUrl('token', $testing);
  }

  public static function getResourceOwnerDetailsUrl(bool $testing = FALSE) {
    return self::getClientApiUrl('v1/customer/profile', $testing);
  }


  /**
   * Returns the url for login authentication process.
   *
   * @param string $extra_path
   *
   * @return string
   */
  public static function getOAuthUrl(string $extra_path, bool $testing = FALSE) {
    return self::getLoginApiUrl("oauth/{$extra_path}", $testing);
  }

  /**
   * Returns the url for login authentication process.
   *
   * @param string $extra_path
   *
   * @return string
   */
  public static function getLoginApiUrl(string $extra_path, bool $testing = FALSE): string {
    $base = ($testing) ? 'api-test.mediaconnect.no/login' : 'connectid.no/user';

    return "https://{$base}/{$extra_path}";
  }

  /**
   * @param string $extra_path
   *
   * @return string
   */
  public static function getClientApiUrl(string $extra_path, bool $testing = FALSE): string {
    $domain = ($testing) ? 'api-test.mediaconnect.no' : 'api.mediaconnect.no';

    return "https://{$domain}/capi/{$extra_path}";
  }
}

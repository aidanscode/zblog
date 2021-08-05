<?php

namespace App\Libraries;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Helpers {

  public static function stripProtocolAndPortFromDomain(string $root) : string {
    return Str::of($root)
    ->replaceMatches('!^http(s)?://!', '')
    ->replaceMatches('!(:).+!', '');
  }

  public static function getSubdomainFromRequestRoot(string $root) : ?string {
    $domainWithSubdomains = self::stripProtocolAndPortFromDomain($root);
    $split = explode('.', $domainWithSubdomains);

    if (count($split) > self::countDomainParts(env('APP_URL'))) {
      return $split[0];
    }
    return null;
  }

  public static function countDomainParts(string $domain) : int {
    $domain = self::stripProtocolAndPortFromDomain($domain);
    $split = explode('.', $domain);

    return count($split);
  }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSourceType extends Model {
  public $timestamps = false;

  const GITHUB = 1;
  const GOOGLE = 2;

  public static function getSourceTypeIdFromProviderName(string $providerName) : ?int {
    $map = [
      'github' => self::GITHUB,
      'google' => self::GOOGLE
    ];

    return $map[$providerName] ?? null;
  }
}

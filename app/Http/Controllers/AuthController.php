<?php

namespace App\Http\Controllers;

use Socialite;
use Auth;

use App\Models\User;
use App\Models\UserSourceType;

class AuthController extends Controller {

  public function logout() {
    Auth::logout();

    return redirect(route('page.index'));
  }

  public function providerOut($provider) {
    if (UserSourceType::getSourceTypeIdFromProviderName($provider) === null) {
      abort(404);
    }

    return Socialite::driver($provider)->redirect();
  }

  public function providerCallback($provider) {
    $sourceTypeId = UserSourceType::getSourceTypeIdFromProviderName($provider);
    if ($sourceTypeId === null) {
      abort(404);
    }

    $user = Socialite::driver($provider)->user();

    User::findOrCreateUserAndLogin($sourceTypeId, $user->getEmail(), $user->getName());

    return redirect(route('page.index'));
  }

}

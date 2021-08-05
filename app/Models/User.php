<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Auth;

class User extends Authenticatable {
  use HasFactory, Notifiable;

  protected $fillable = [
    'user_source_type_id',
    'name',
    'email'
  ];

  protected $hidden = ['password', 'remember_token'];
  protected $casts = ['email_verified_at' => 'datetime'];

  public static function findOrCreateUserAndLogin(int $userSourceTypeId, string $email, string $name) {
    $user = User::firstOrCreate(
      ['email' => $email],
      ['user_source_type_id' => $userSourceTypeId, 'name' => $name]
    );

    Auth::login($user);
  }
}

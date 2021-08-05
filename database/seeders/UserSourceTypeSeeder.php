<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserSourceType;

class UserSourceTypeSeeder extends Seeder {
  public function run() {
    UserSourceType::updateOrCreate(['id' => UserSourceType::GITHUB], ['name' => 'GitHub']);
    UserSourceType::updateOrCreate(['id' => UserSourceType::GOOGLE], ['name' => 'Google']);
  }
}

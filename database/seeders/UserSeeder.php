<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      //
      DB::table('users')->insert([
         [
            'name' => 'Zoerki',
            'surname' => '',
            'address' => 'ул.Некrrfоја бр.60',
            'phone' => '123 456 789',
            'photo' => '',
            'email' => 'zoreki@zeeki.com',
            'email_verified_at' => null,
            'username' => 'zoerki',
            'password' => Hash::make('?????'),
            'reset_password_hash' => null,
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
         ],
      ]);
   }
}

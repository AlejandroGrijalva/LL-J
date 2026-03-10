<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder {
    
 public function run(): void{
  $users = [];
  $names = ['Luis','Ana','Carlos','Maria','Jorge','Elena','Raul','Paola','Hector','Sandra'];
  $domains = ['example.com','mail.com','demo.net'];
  
  // Admin
  $users[] = ['id'=>1,'name'=>'Admin','email'=>'admin@example.com','password'=>Hash::make('password'),'account_type'=>'admin','preferred_budget'=>null];

  // Owners
  for($i=2;$i<=5;$i++){
    $name = $names[array_rand($names)] . " Owner";
    $email = strtolower(str_replace(' ','',$name)) . '@' . $domains[array_rand($domains)];
    $users[] = [
      'id'=>$i,
      'name'=>$name,
      'email'=>$email,
      'password'=>Hash::make('password'),
      'account_type'=>'owner',
      'preferred_budget'=>['low','medium','high'][array_rand(['low','medium','high'])]
    ];
  }

  // Customers
  for($i=6;$i<=25;$i++){
    $name = $names[array_rand($names)] . " User";
    $email = strtolower(str_replace(' ','',$name)) . '@' . $domains[array_rand($domains)];
    $users[] = [
      'id'=>$i,
      'name'=>$name,
      'email'=>$email,
      'password'=>Hash::make('password'),
      'account_type'=>'customer',
      'preferred_budget'=>['low','medium','high'][array_rand(['low','medium','high'])]
    ];
  }

  DB::table('users')->insert($users);
 }
}

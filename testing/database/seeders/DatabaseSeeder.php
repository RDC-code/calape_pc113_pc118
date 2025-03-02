<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
  

        User::factory()->create([
            'name' => 'Rexxme',
            'email' => 'rexxme03@gmail.com',
            'password' => bcrypt('123'),
        ]);
    }
}

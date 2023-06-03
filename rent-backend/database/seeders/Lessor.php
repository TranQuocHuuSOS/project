<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class Lessor extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Thêm dữ liệu ngẫu nhiên vào bảng "renter"
        for ($i = 1; $i <= 100; $i++) {
          DB::table('Lessor')->insert([
             
              'Lessor_name' => $faker->name,
              'Lessor_email' => $faker->email,
              'Lessor_phone' => $faker->phoneNumber,
              'Lessor_address' => $faker->address,
              'Lessor_password' => bcrypt($faker->password)
          ]);
      }
    
    }
}

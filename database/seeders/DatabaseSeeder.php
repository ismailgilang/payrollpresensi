<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "name"  => "admin",
            "password"  => Hash::make('admin123'),
            "email"     => "admin@admin.com",
            "nip"   => "ADM001",
            "role_id"   => 1,
            "jabatan_id"    => 1
        ]);

        $faker = Faker::create('id_id');
        for ($i=0; $i < 5; $i++) {
            $name = $faker->firstName() . " " . $faker->lastName();
            User::create([
                "name"  => $name,
                "email" => str_replace(" ","", $name) . "@gmail.com",
                "password"  => Hash::make("admin123"),
                "nip"   => "KRYWN00" . $i,
                "role_id"   => 2,
                "jabatan_id" => random_int(1,3)
            ]);
        }

        $this->call([
            JabatanSeeder::class,
            RoleSeeder::class
        ]);
    }
}

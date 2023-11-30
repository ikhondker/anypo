<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// IQBAL
use Faker\Generator;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::factory()->count(10)->create();
        $faker = app(Generator::class);
        //User::truncate();

        $users =  [
            [
                'name'              => 'System User',
                'email'             => 'khondker@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('password') , // password
                'remember_token'    => Str::random(10),
            ],
            [
                'name'              => 'Admin User',
                'email'             => 'admin@example.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('password') , // password
                'remember_token'    => Str::random(10),
            ],

            [
                'name'              => 'Regular User',
                'email'             => 'user@example.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('password') , // password
                'remember_token'    => Str::random(10),
            ],
            [
                'name'              => 'Regular User 1',
                'email'             => 'user1@example.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('password') , // password
                'remember_token'    => Str::random(10),
            ],
            [
                'name'              => 'Regular User 2',
                'email'             => 'user2@example.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('password') , // password
                'remember_token'    => Str::random(10),
            ],
            [
                'name'              => 'Regular User 3',
                'email'             => 'user3@example.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('password') , // password
                'remember_token'    => Str::random(10),
            ],
            [
                'name'              => 'Regular User 4',
                'email'             => 'user4@example.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('password') , // password
                'remember_token'    => Str::random(10),
            ],
            [
                'name'              => 'Regular User 5',
                'email'             => 'user5@example.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('password') , // password
                'remember_token'    => Str::random(10),
            ],
            
        ];
        
        User::insert($users);

    }
}

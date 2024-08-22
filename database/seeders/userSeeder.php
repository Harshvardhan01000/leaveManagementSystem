<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $nonAdminUsers = [
            [
            'first_name'=>'harsh',
            'last_name'=>'zala',
            'email'=>'harsh@gmail.com',
            'phone_number'=>1234567890,
            'password'=>Hash::make('111111')    
            ],
            [
                'first_name'=>'mit',
                'last_name'=>'zala',
                'email'=>'mit@gmail.com',
                'phone_number'=>1234567890,
                'password'=>Hash::make('111111')    
            ],
            [
                'first_name'=>'krishna',
                'last_name'=>'patel',
                'email'=>'krishna@gmail.com',
                'phone_number'=>1234567890,
                'password'=>Hash::make('111111')    
            ],
            [
                'first_name'=>'sunil',
                'last_name'=>'sorani',
                'email'=>'sunil@gmail.com',
                'phone_number'=>1234567890,
                'password'=>Hash::make('111111')    
                ]
        ];

        // User::create([
        //     'first_name'=>'admin',
        //     'last_name'=>'admin',
        //     'email'=>'admin@gmail.com',
        //     'phone_number'=>1234567890,
        //     'role'=>1,
        //     'password'=>Hash::make('111111')
        // ]);
        foreach($nonAdminUsers as $user){
            User::create($user);
        }
    }
}

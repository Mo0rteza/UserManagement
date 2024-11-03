<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::insert([
            [
                'name' => 'مرتضی حسینی',
                'email' => 'h.morteza011@gmail.com',
                'country' => 'Iran',
                'currency' => 'IRR',
                'created_at' => now()
            ],
            [
                'name' => 'احمد احمدی',
                'email' => 'a.ahmadi@gmail.com',
                'country' => 'Iran',
                'currency' => 'IRR',
                'created_at' => now()

            ],
            [
                'name' => 'محدثه کاظمی',
                'email' => 'm.kazemi@gmail.com',
                'country' => 'Turkey',
                'currency' => 'TRY',
                'created_at' => now()

            ],
            [
                'name' => 'ریحانه ابراهیم پور',
                'email' => 'r.ebrahimpour@yahoo.com',
                'country' => 'United States',
                'currency' => 'USD',
                'created_at' => now()

            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // برای ایجاد داده فیک با استفاده از فکتوری و فیکر از این کد استفاده شود
        User::factory(10)->create();

        // برای ایجاد داده به صورت دستی از سیدر یوزر استفاده شود
        // $this->call([
        //     UserSeeder::class
        // ]);

    }
}
